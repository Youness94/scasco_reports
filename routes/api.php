<?php


use App\Http\Controllers\Api\AppointmentApiController;
use App\Http\Controllers\Api\BrancheApiController;
use App\Http\Controllers\Api\ClientApiController;
use App\Http\Controllers\Api\LoginApiController;
use App\Http\Controllers\Api\HomeApiController;
use App\Http\Controllers\Api\ObjectiveApiController;
use App\Http\Controllers\Api\PositionApiController;
use App\Http\Controllers\Api\PotencialCaseApiController;
use App\Http\Controllers\Api\ReportApiController;
use App\Http\Controllers\Api\ServiceApiController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserManagementApiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Auth::routes();

if (!function_exists('set_active')) {
    function set_active($route)
    {
        if (is_array($route)) {
            return in_array(Request::path(), $route) ? 'Active' : '';
        }
        return Request::path() == $route ? 'Active' : '';
    }
}


// // ----------------------------login ------------------------------//
Route::post('/login', [UserController::class, 'login']);
Route::post('password-email', [UserController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('reset-password', [UserController::class, 'resetPassword'])->name('password.reset');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [UserController::class, 'logoutUser']);

    Route::post('/change-password', [UserController::class, 'changePassword']);
    Route::post('/update-profile', [UserController::class, 'updateAdminProfile']);

    // Route::get('accueil', [HomeController::class, 'index'])->name('accueil');
    // Route::get('/quotes-bar-chart-home', [HomeController::class, 'BarChatQuotes'])->name('chart.bar.home');
    // Route::get('/quotes-pie-chart-home', [HomeController::class, 'PieChatQuotes'])->name('chart.pie.home');

    // Route::get('utilisateur-profile', [HomeController::class, 'userProfile'])->name('admin.user.profile');

    // Route::controller(UserManagementController::class)->group(function () {
    //     Route::get('admins', 'index')->name('all.admins');
    //     Route::get('ajouter-admin', 'userAdd')->name('add.admin');
    //     Route::post('store-admin', 'userStore')->name('store.admin');
    //     Route::get('modifier-admin/{id}', 'userView')->name('edit.admin');
    //     Route::post('admin/update/{id}', 'userUpdate')->name('admin.update');
    //     Route::post('admin/delete', 'userDelete')->name('admin/delete');


    //     Route::get('update-profile',  'profileUpdateForm')->name('update.profile.form');
    //     Route::post('update-profile', 'updateProfile')->name('update.profile');
    //     Route::post('change/password', 'changePassword')->name('admin/change/password');
    // });

    Route::controller(PositionApiController::class)->group(function () {

        Route::get('positions', 'get_all_positions')->name('all.positions');
        Route::get('ajouter-position',  'add_position')->name('add.position');
        Route::post('store/position',  'store_position')->name('store.position');
        Route::get('modifier-position/{id}', 'edit_position')->name('edit.position');
        Route::post('update/position/{id}',  'update_position')->name('update.position');
        Route::get('delete/position/{id}', 'delete_position')->name('delete.position');
    });

    Route::controller(ServiceApiController::class)->group(function () {

        Route::get('services', 'get_all_services')->name('all.services');
        Route::get('ajouter-service',  'add_service')->name('add.service');
        Route::post('store/service',  'store_service')->name('store.service');
        Route::get('modifier-service/{id}', 'edit_service')->name('edit.service');
        Route::post('update/service/{id}',  'update_service')->name('update.service');
        Route::get('delete/service/{id}', 'delete_service')->name('delete.service');
    });

    Route::controller(BrancheApiController::class)->group(function () {

        Route::get('branches', 'get_all_branches')->name('all.branches');
        Route::get('ajouter-branche',  'add_branche')->name('add.branche');
        Route::post('store/branche',  'store_branche')->name('store.branche');
        Route::get('modifier-branche/{id}', 'edit_branche')->name('edit.branche');
        Route::post('update/branche/{id}',  'update_branche')->name('update.branche');
        Route::get('delete/branche/{id}', 'delete_branche')->name('delete.branche');
    });

    Route::controller(ClientApiController::class)->group(function () {

        Route::get('clients', 'get_all_clients')->name('all.clients');
        Route::get('ajouter-client',  'add_client')->name('add.client');
        Route::post('store/client',  'store_client')->name('store.client');
        Route::get('modifier-client/{id}', 'edit_client')->name('edit.client');
        Route::post('update/client/{id}',  'update_client')->name('update.client');
        Route::get('delete/client/{id}', 'delete_client')->name('delete.client');
        Route::get('détail-de-client/{id}', 'display_client')->name('display.client');
    });

    Route::controller(PotencialCaseApiController::class)->group(function () {

        Route::get('affaires', 'get_all_potential_cases')->name('all.potential_cases');
        Route::get('ajouter-affaire',  'add_potential_case')->name('add.potential_case');
        Route::post('store/affaire',  'store_potential_case')->name('store.potential_case');
        Route::get('modifier-affaire/{id}', 'edit_potential_case')->name('edit.potential_case');
        Route::post('update/affaire/{id}',  'update_potential_case')->name('update.potential_case');
        Route::get('delete/affaire/{id}', 'delete_potential_case')->name('delete.potential_case');
        Route::get('détail-de-affaire/{id}', 'display_potential_case')->name('display.potential_case');

        Route::get('get-branches-by-service', 'getBranchesByService')->name('getBranchesByService');

        Route::post('/update-branches-for-service', 'updateBranchesForService')->name('updateBranchesForService');
        Route::post('/remove-branches-from-service', 'removeBranchesFromService')->name('removeBranchesFromService');
        Route::get('/edit-branches-by-service', 'editBranchesByService')->name('editBranchesByService');


        Route::post('update/status_potential_case/{id}',  'updateStatusPotentialCase')->name('update.status.potential.case');
        Route::post('store/commnet_potential_case/{id}',  'createCommentPotentialCase')->name('store.comment.potential.case');
        Route::post('store/client_potential_case',  'store_client_potential_case')->name('store.client.potential.case');
    });

    Route::controller(ReportApiController::class)->group(function () {

        Route::get('comptes-rendus', 'get_all_reports')->name('all.reports');
        Route::get('ajouter-compte-rendu',  'add_report')->name('add.report');
        Route::post('store/report',  'store_report')->name('store.report');
        Route::get('modifier-compte-rendu/{id}', 'edit_report')->name('edit.report');
        Route::post('update/report/{id}',  'update_report')->name('update.report');
        Route::get('delete/report/{id}', 'delete_report')->name('delete.report');
        Route::get('détail-de-compte-rendu/{id}', 'display_report')->name('display.report');

        Route::get('/get-appointments-by-case/{potencial_case_id}', 'get_appointments_by_case')->name('get.appointments.by.case');
    });

    Route::controller(AppointmentApiController::class)->group(function () {

        Route::get('rendez-vous', 'get_all_appointments')->name('all.appointments');
        Route::get('ajouter-rendez-vous',  'add_appointment')->name('add.appointment');
        Route::post('store/appointment',  'store_appointment')->name('store.appointment');
        Route::get('modifier-rendez-vous/{id}', 'edit_appointment')->name('edit.appointment');
        Route::post('update/appointment/{id}',  'update_appointment')->name('update.appointment');
        Route::get('delete/appointment/{id}', 'delete_appointment')->name('delete.appointment');
        Route::get('détail-de-rendez-vous/{id}', 'display_appointment')->name('display.appointment');

        Route::get('/get-client-by-case/{potencial_case_id}','getClientByCase')->name('get.client.by.case');
    });


    Route::controller(ObjectiveApiController::class)->group(function () {

        Route::get('objectifs', 'get_all_objectives')->name('all.objectives');
        Route::get('ajouter-objectif',  'add_objective')->name('add.objective');
        Route::post('store/objective',  'store_objective')->name('store.objective');
        Route::get('modifier-objectif/{id}', 'edit_objective')->name('edit.objective');
        Route::post('update/objective/{id}',  'update_objective')->name('update.objective');
        Route::get('delete/objective/{id}', 'delete_objective')->name('delete.objective');
    });

    // Route::controller(AdminPermissionController::class)->group(function () {

    //     Route::get('all/permissions',  'all_permissions')->name('all.permissions');
    //     Route::get('add/permission', 'add_permission')->name('add.permission');
    //     Route::post('store/permission',  'store_permission')->name('store.permission');
    //     Route::get('modifier/permission/{id}',  'edit_permission')->name('edit.permission');
    //     Route::post('update/permission/{id}', 'update_permission')->name('update.permission');
    //     Route::get('delete/permission/{id}',  'delete_permission')->name('delete.permission');
    // });
});
