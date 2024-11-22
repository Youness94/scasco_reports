<?php

use App\Http\Controllers\Admin\AdminPermissionController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\HomeController;
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

    Route::controller(ClientUserController::class)->group(function () {
        Route::get('utilisateurs', 'client_users')->name('all.client.users');
        Route::get('ajouter-utilisateur', 'add_client_user')->name('add.client.user');
        Route::post('store-utilisateur', 'store_client_user')->name('store.client.user');
        Route::get('modifier-utilisateur/{id}', 'edit_client_user')->name('edit.client.user');
        Route::post('utilisateur/update/{id}', 'update_client_user')->name('client.user.update');
        Route::post('utilisateur/delete', 'delete_client_user')->name('client.user.delete');
    });


    Route::controller(QuoteController::class)->group(function () {
        Route::get('les-devis', 'get_all_quotes')->name('all.quotes');
        Route::get('ajouter-devi', 'add_quote')->name('add.quote');
        Route::post('store-devi', 'store_quote')->name('store.quote');

        Route::get('modifier-devi/{id}', 'edit_quote')->name('edit.quote');
        Route::post('update-devi/{id}', 'update_quote')->name('update.quote');
        Route::get('delete-devi/{id}', 'delete_quote')->name('delete.quote');

        Route::get('details-quote-client', 'quote_details')->name('details.quote');
        Route::get('admin-details-quote/{id}', 'quote_details_id')->name('details.quote.id');
        Route::get('details-quote/{id}', 'quote_details_id_client')->name('details.quote.client');

        // 'pending', 'completed', 'processing', 'cancelled'
        Route::get('devis-pending', 'quotes_status_pending')->name('pending.quote');
        Route::get('devis-processing', 'quotes_status_processing')->name('processing.quote');
        Route::get('devis-completed', 'quotes_status_completed')->name('completed.quote');
        Route::get('devis-cancelled', 'quotes_status_cancelled')->name('cancelled.quote');

        Route::put('/quote-infos/bulk-status', [QuoteController::class, 'update_quote_status'])->name('quote.infos.bulk.status.update');
        Route::put('/quote-info/status/{id}', [QuoteController::class, 'update_one_quote_status'])->name('quote.info.status.update');
        // Route::post('/quote-infos/bulk-status', [QuoteController::class, 'bulkUpdateQuoteInfoAndQuotes'])->name('quote.infos.bulk.status.update');
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
