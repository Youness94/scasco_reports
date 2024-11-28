<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Traits\PhotoTrait;
use Brian2694\Toastr\Toastr as ToastrToastr;
use Illuminate\Support\Facades\Session;
use Toastr;

class UserManagementController extends Controller
{
    use PhotoTrait;
    public function __construct()
    {
        $this->middleware('permission:voir les admins', ['only' => ['index']]);
        $this->middleware('permission:créer admin', ['only' => ['userAdd', 'userStore']]);
        $this->middleware('permission:mettre à jour le admin', ['only' => ['userUpdate', 'userView']]);
        $this->middleware('supprimer admin', ['only' => ['userDelete']]);
    }

    public function index()
    {
        $users = User::all();
        $userRoles = [];
        foreach ($users as $user) {
            $userRoles[$user->id] = $user->roles->pluck('name')->implode(', ');
        }
        return view('usermanagement.list_users', compact('users', 'userRoles'));
    }

    public function userAdd()
    {
        $roles = Role::pluck('name', 'name')->all();
        $responsibles = User::where('user_type', 'Responsable')->latest()->get();
        return view('usermanagement.add_user', compact('responsibles', 'roles'));
    }

    public function userStore(Request $request)
    {

        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'responsible_id' => 'nullable|exists:users,id',
            'password' => 'required|min:8',
            'phonenumber' => 'nullable|min:8|unique:users,phonenumber',
            'roles' => 'required',
            'user_type' => 'nullable|string',
        ], [
            'first_name.required' => 'Veuillez entrer votre prénom.',
            'last_name.required' => 'Veuillez entrer votre nom de famille.',
            'email.required' => 'Veuillez entrer votre adresse email.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'password.required' => 'Veuillez entrer un mot de passe.',
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
            'phonenumber.min' => 'Le numéro de téléphone doit contenir au moins :min caractères.',
            'roles.required' => 'Veuillez sélectionner au moins un rôle.',
            'user_type.string' => 'Le type d\'utilisateur doit être une chaîne de caractères.',
        ]);
        try {
            $role = $validatedData['roles'][0];
            $user = User::create([
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'email' => $validatedData['email'],
                'user_type' => $role ?? 'Commercial',
                'status' => $request->input('status', 'Active'),
                'password' => bcrypt($validatedData['password']),
                'phonenumber' => $validatedData['phonenumber'],
                'responsible_id' => $validatedData['responsible_id'] ?? null,
            ]);


            $user->syncRoles($request->roles);
            // $user->syncRoles($validatedData['roles']);

            session()->flash('success', 'User added successfully :)');
            return redirect('admins');
        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());

            session()->flash('error', 'User add failed :(');
            return redirect()->back();
        }
    }


    public function userView($id)
    {
        try {

            $user = User::where('user_type', 'Admin')->findOrFail($id);
            $responsibles = User::where('user_type', 'Responsable')->latest()->get();
            $roles = Role::pluck('name', 'name')->all();
            $userRoles = $user->roles()->pluck('name', 'name')->all();

            Log::info([
                $user->userRoles,
                // $userRoles,
                // $roles,
            ]);
            return view('usermanagement.user_update', compact('user', 'roles', 'userRoles','responsibles'));
        } catch (\Exception $e) {
            Log::error('Error viewing user: ' . $e->getMessage());
            session()->flash('error', 'User view failed :(');
            return redirect()->back();
        }
    }

    /** user Update */
    public function userUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'first_name' => 'sometimes',
            'last_name' => 'sometimes',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'roles' => 'sometimes',
            'status' => 'sometimes',
            'user_type' => 'sometimes',
            // 'role_name' => 'sometimes,
        ]);

        try {
            // $file_name = $this->savePhoto($request->photo, ['folder' => 'photos/users']);
            $user = User::where('user_type', 'Admin')->findOrFail($id);
            $user->update([
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'email' => $validatedData['email'],
                'status' => $request->has('status_user') ? $request->input('status_user') : $user->status,
                'user_type' => $request->input('user_type') ?? 'Admin',
                // 'role_name' => $validatedData['role_name'],
                'phonenumber' => $validatedData['phonenumber'] ?? $user->phonenumber,
            ]);
            $user->syncRoles($request->roles);
            session()->flash('success', 'User updated successfully :)');
            return redirect('admins');
        } catch (\Exception $e) {

            Log::error('Error updating user: ' . $e->getMessage());

            session()->flash('error', 'User update failed :(');
            return redirect()->back();
        }
    }


    /** user delete */
    public function userDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            if (Session::get('role_name') === 'Super Admin') {
                if ($request->photo == 'photo_defaults.jpg') {
                    User::destroy($request->user_id);
                } else {
                    User::destroy($request->user_id);
                    unlink('images/' . $request->photo);
                }
                DB::commit();
                // Success message
                session()->flash('success', 'User deleted successfully :)');
                return redirect()->back();
            } else {
                // Error message for unauthorized access
                session()->flash('error', 'Unauthorized access to delete user :(');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            // Error message for general exception
            session()->flash('error', 'User deletion failed :(');
            return redirect()->back();
        }
    }
    /** change password */



    // ==================
    public function profileUpdateForm()
    {
        // Fetch the user data as needed
        $id = Auth::user()->id;
        $users = User::find($id);

        // Pass the user data to the view
        return view('dashboard.profile', compact('users'));
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password'     => ['required', new MatchOldPassword],
            'new_password'         => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        DB::commit();
        Toastr::success('User change successfully :)', 'Success');
        return redirect('utilisateur-profile');
    }

    /** Update User Profile */

    public function updateProfile(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();
            Log::info('test gggggg =' . $user);

            $user->update([
                'first_name' => $request->input('first_name', $user->first_name),
                'last_name' => $request->input('last_name', $user->last_name),
                'email' => $request->input('email', $user->email),
                'phonenumber' => $request->input('phone1', $user->phonenumber),
            ]);

            if ($request->hasFile('photo')) {
                $file_name = $this->savePhoto($request->file('photo'), ['folder' => 'public/photos/admin_images']);
                $user->update(['photo' => $file_name]);
            }

            // Commit the transaction
            DB::commit();

            // Display success message and redirect
            Toastr::success('Profile updated successfully :)', 'Success');
            return redirect('utilisateur-profile');
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollback();

            // Display error message and redirect back
            Toastr::error('Profile update failed :(', 'Error');
            return redirect()->back();
        }
    }
}
