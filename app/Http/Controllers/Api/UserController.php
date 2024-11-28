<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Api\UserService;
use App\Traits\PhotoTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
// use DB;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use PhotoTrait;
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getAllAdmins()
    {
        $user = Auth::user();

        if (!$user || $user->user_type !== 'Admin') {
            throw new \Exception('Unauthorized.');
        }
        $admins = User::where('user_type', 'Admin')->get();
        $userRoles = [];
        foreach ($admins as $admin) {
            $userRoles[$admin->id] = $admin->roles->pluck('name')->implode(', ');
        }


        return response()->json([
            'status' => 'Success',
            'admins' => $admins,
            'userRoles' => $userRoles,
        ], 200);
    }

    public function addAdmin()
    {
        $user = Auth::user();

        if (!$user || $user->user_type !== 'Admin') {
            throw new \Exception('Unauthorized.');
        }
        $roles = Role::pluck('name', 'name')->all();

        return [
            'roles' => $roles,
        ];
    }
    // public function createAdmin(RegisterAdminRequest $request)
    // {

    //     try {
    //         $file_name = $this->savePhoto($request->photo, ['folder' => 'public/photos/admins']);
    //         $superAdminRole = Role::where('name', 'super-admin')->first();
    //         $user = User::create([
    //             'photo' => $file_name,
    //             'first_name' => $request->input('first_name'),
    //             'last_name' => $request->input('last_name'),
    //             'phone1' => $request->input('phone1'),
    //             'phone2' => $request->input('phone2'),
    //             'email' => $request->input('email'),
    //             'identity_piece' => $request->input('identity_piece'),
    //             'user_status' => $request->input('user_status', 'Active'),
    //             'user_type' => $request->input('user_type', 'Admin'),
    //             'password' => Hash::make($request->input('password')),
    //         ]);
    //         $user->syncRoles($request->roles);
           
    //         $token = $user->createToken('UserToken')->plainTextToken;

    //         return response()->json([
    //             'status' => 'Success',
    //             'message' => 'Admin created successfully.',
    //             'user' => $user,
    //             'token' => $token,
    //         ], 200);
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'status' => 'Error',
    //             'message' => $th->getMessage(),
    //         ], 422);
    //     }
    // }

    public function editAdmin($id)
    {
        $user = Auth::user();

        if (!$user || $user->user_type !== 'Admin') {
            throw new \Exception('Unauthorized.');
        }

        $user_admin = User::with('admins')->findOrFail($id);

        $roles = Role::pluck('name', 'name')->all();

        return [
            'roles' => $roles,
            'user_admin' => $user_admin,
        ];
    }

    // public function updateAdmin(UpdateAdminRequest $request, $id)
    // {
    //     $user = Auth::user();

    //     if (!$user || $user->user_type !== 'Admin') {
    //         return response()->json(['error' => 'Unauthorized.'], 403);
    //     }

    //     $admin =  User::with('admins')->findOrFail($id);

    //     if (!$admin) {
    //         return response()->json(['error' => 'Admin not found.'], 404);
    //     }

    //     // if ($request->hasFile('photo')) {
    //     //     $file_name = $this->savePhoto($request->photo, ['folder' => 'public/photos/admins']);
    //     //     $admin->photo = $file_name;
    //     // }

    //     if ($request->has('delete_admin_photo') && $request->input('delete_admin_photo') == 'yes') {
    //         if ($admin->photo) {
    //             Storage::delete($admin->photo);
    //             $admin->photo = null;
    //         }
    //     }
    //     if ($request->has('photo')) {
    //         $photo = $this->savePhoto($request->photo, ['folder' => 'public/photos/admins']);
    //         $admin->photo = $photo;
    //     }

    //     $admin->update([
    //         'first_name' => $request->input('first_name', $admin->first_name),
    //         'last_name' => $request->input('last_name', $admin->last_name),
    //         'phone1' => $request->input('phone1', $admin->phone1),
    //         'phone2' => $request->input('phone2', $admin->phone2),
    //         'email' => $request->input('email', $admin->email),
    //         'identity_piece' => $request->input('identity_piece', $admin->identity_piece),
    //         'user_status' => $request->input('user_status', $admin->user_status),
    //         'user_type' => $request->input('user_type', $admin->user_type),
    //         'password' => $request->filled('password') ? Hash::make($request->input('password')) : $admin->password,
    //     ]);

    //     $admin->syncRoles($request->roles);

    //     $admin->admins()->updateOrCreate(
    //         ['user_id' => $admin->id],
    //         [
    //             'admin_matricule' => $request->input('admin_matricule', $admin->admin_matricule ?? null),
    //             'admin_role' => $request->input('admin_role', $admin->admin_role ?? null),
    //             'admin_status' => $request->input('admin_status', $admin->admin_status ?? null),
    //             'admin_identity' => $request->input('admin_identity', $admin->admin_identity ?? null),
    //         ]
    //     );

    //     return response()->json([
    //         'status' => 'Success',
    //         'message' => 'Admin updated successfully.',
    //         'admin' => $admin->load('roles', 'admins'),
    //     ], 200);
    // }


    public function updateAdminProfile(Request $request)
    {
        try {
            $user = Auth::user();
            
            $user->update([
                'first_name' => $request->input('first_name', $user->first_name),
                'last_name' => $request->input('last_name', $user->last_name),
                'email' => $request->input('email', $user->email),
                'phonenumber' => $request->input('phonenumber', $user->phonenumber),
            ]);
    
            if ($request->has('delete_admin_photo') && $request->input('delete_admin_photo') === 'yes') {
                if ($user->photo) {
                    Storage::delete($user->photo);
                    $user->update(['photo' => null]);
                }
            }
    
            if ($request->hasFile('photo')) {
                $file_name = $this->savePhoto($request->file('photo'), ['folder' => 'photos/users']);
                $user->update(['photo' => $file_name]);
            }
    
            // $admin = $user->admins()->firstOrNew(['user_id' => $user->id]);
            // $admin->fill([
            //     'admin_matricule' => $request->input('admin_matricule', $admin->admin_matricule),
            //     'admin_role' => $request->input('admin_role', $admin->admin_role),
            //     'admin_status' => $request->input('admin_status', $admin->admin_status),
            //     'admin_identity' => $request->input('admin_identity', $admin->admin_identity),
            // ])->save();
    
            return response()->json([
                'status' => true,
                'message' => 'Profile updated successfully',
                'user' => $user,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
    public function index(Request $request): JsonResponse
    {
        $data = User::orderBy('id', 'DESC')->paginate(5);
        return response()->json($data);
    }
    public function sendResetLinkEmail(ForgotPasswordRequest $request): JsonResponse
    {
        $result = $this->userService->forgotPassword($request);

        return response()->json($result, $result['status'] === 'Success' ? 200 : 422);
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $result = $this->userService->resetPassword($request);

        return response()->json($result, $result['status'] === 'Success' ? 200 : 422);
    }

    public function login(LoginRequest $request)
    {
        try {
            // Call the userService login method
            $result = $this->userService->login($request->validated());
    
            if ($result['status'] === 'success') {
                return response()->json([
                    'user' => $result['user'],   // Include user in response
                    'token' => $result['token'],
                    'status' => $result['status'],
                ], 201);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => $result['message'],
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    public function logoutUser(Request $request)
    {
        try {

            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'status' => true,
                'message' => 'Logged out successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function changePassword(Request $request)
    {
        try {
            $user = Auth::user();

            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|confirmed|min:6',
            ]);

            if (!Hash::check($request->input('old_password'), $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Ancien mot de passe incorrect',
                ], 422);
            }

            // Update the user's password
            $user->password = Hash::make($request->input('new_password'));
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Mot de passe changé avec succès',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur interne du serveur',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

   
}
