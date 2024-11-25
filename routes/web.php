<?php

use App\Http\Controllers\Admin\AdminPermissionController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\BrancheController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Client\ClientUserController;
use App\Http\Controllers\MatuAutoDevisController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\RmaAutoDevisController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


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

Route::get('/', function () {
    return view('auth.login');
});
// // ----------------------------login ------------------------------//
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate');
    // Route::get('/logout', 'logout')->name('logout');
    // Route::post('/change/password', 'changePassword')->name('change/password');
});



Route::group(['middleware' => ['web', 'auth']], function () {


    Route::get('accueil', [HomeController::class, 'index'])->name('accueil');
    Route::get('/quotes-bar-chart-home', [HomeController::class, 'BarChatQuotes'])->name('chart.bar.home');
    Route::get('/quotes-pie-chart-home', [HomeController::class, 'PieChatQuotes'])->name('chart.pie.home');
    
    Route::get('utilisateur-profile', [HomeController::class, 'userProfile'])->name('admin.user.profile');

    Route::controller(UserManagementController::class)->group(function () {
        Route::get('admins', 'index')->name('all.admins');
        Route::get('ajouter-admin', 'userAdd')->name('add.admin');
        Route::post('store-admin', 'userStore')->name('store.admin');
        Route::get('modifier-admin/{id}', 'userView')->name('edit.admin');
        Route::post('admin/update/{id}', 'userUpdate')->name('admin.update');
        Route::post('admin/delete', 'userDelete')->name('admin/delete');


        Route::get('update-profile',  'profileUpdateForm')->name('update.profile.form');
        Route::post('update-profile', 'updateProfile')->name('update.profile');
        Route::post('change/password', 'changePassword')->name('admin/change/password');
    });

    Route::controller(PositionController::class)->group(function () {

        Route::get('positions', 'get_all_positions')->name('all.positions');
        Route::get('ajouter-position',  'add_position')->name('add.position');
        Route::post('store/position',  'store_position')->name('store.position');
        Route::get('modifier-position/{id}', 'edit_position')->name('edit.position');
        Route::post('update/position/{id}',  'update_position')->name('update.position');
        Route::get('delete/position/{id}', 'delete_position')->name('delete.position');
    });

    Route::controller(ServiceController::class)->group(function () {

        Route::get('services', 'get_all_services')->name('all.services');
        Route::get('ajouter-service',  'add_service')->name('add.service');
        Route::post('store/service',  'store_service')->name('store.service');
        Route::get('modifier-service/{id}', 'edit_service')->name('edit.service');
        Route::post('update/service/{id}',  'update_service')->name('update.service');
        Route::get('delete/service/{id}', 'delete_service')->name('delete.service');
    });

    Route::controller(BrancheController::class)->group(function () {

        Route::get('branches', 'get_all_branches')->name('all.branches');
        Route::get('ajouter-branche',  'add_branche')->name('add.branche');
        Route::post('store/branche',  'store_branche')->name('store.branche');
        Route::get('modifier-branche/{id}', 'edit_branche')->name('edit.branche');
        Route::post('update/branche/{id}',  'update_branche')->name('update.branche');
        Route::get('delete/branche/{id}', 'delete_branche')->name('delete.branche');
    });

    Route::controller(ClientController::class)->group(function () {

        Route::get('clients', 'get_all_clients')->name('all.clients');
        Route::get('ajouter-client',  'add_client')->name('add.client');
        Route::post('store/client',  'store_client')->name('store.client');
        Route::get('modifier-client/{id}', 'edit_client')->name('edit.client');
        Route::post('update/client/{id}',  'update_client')->name('update.client');
        Route::get('delete/client/{id}', 'delete_client')->name('delete.client');
    });

    

    Route::controller(AdminRoleController::class)->group(function () {

        Route::get('roles', 'all_roles')->name('all.roles');
        Route::get('ajouter-role',  'add_role')->name('add.role');
        Route::post('store/role',  'store_role')->name('store.role');
        Route::get('modifier-role/{id}', 'edit_role')->name('edit.role');
        Route::post('update/role/{id}',  'update_role')->name('update.role');
        Route::get('delete/role/{id}', 'delete_role')->name('delete.role');
        Route::get('roles-give-permissions/{id}',  'addPermissionToRole')->name('add.permission.to.role');
        Route::post('roles/give-permissions/{id}',  'givePermissionToRole')->name('give.permission.to.role');
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
