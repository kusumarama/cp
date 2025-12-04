<?php

use App\Models\Client;
use App\Models\Service;
use App\Models\Portofolio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\editor\AuthController;
use App\Http\Controllers\editor\HomeController;
use App\Http\Controllers\editor\UserController;
use App\Http\Controllers\editor\AboutController;
use App\Http\Controllers\editor\ClientController;
use App\Http\Controllers\editor\ContactController;
use App\Http\Controllers\editor\ServiceController;
use App\Http\Controllers\editor\MasterHeadController;
use App\Http\Controllers\editor\PortofolioController;
use App\Http\Controllers\editor\DesignController;
use App\Http\Controllers\editor\LegalityController;

Route::get('/', function () {
    // If user is authenticated, send them to the editor dashboard
    if (Auth::check()) {
        return redirect()->route('editor.home');
    }

    return view('welcome');
});

Route::controller(PublicController::class)->group(function () {
    Route::get('/', 'index')->name('public');
    Route::get('data', 'getdata')->name('public.data');
    Route::get('detail', 'detail')->name('detail');
    Route::get('design-detail', 'designDetail')->name('design.detail');
    Route::get('legality-detail', 'legalityDetail')->name('legality.detail');
    Route::get('client', 'clients')->name('clients');
    Route::get('portfolio', 'portfolio')->name('portfolio.index');
    Route::get('design', 'design')->name('design.index');
    Route::get('legality', 'legality')->name('legality.index');
    Route::get('board-of-directors', 'board')->name('board.index');
    Route::get('management', 'management')->name('management.index');
    Route::get('switch-language/{locale}', 'switchLanguage')->name('switch.language');
});
Route::controller(AuthController::class)->middleware('guest')->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('login/auth', 'authenticate')->name('login.auth');
});


Route::prefix('editor')->middleware('auth')->group(function () {
    Route::controller(AuthController::class)->group(function () {
    Route::post('logout', 'logout')->name('logout');
});
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('editor.home');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('editor.user');
        Route::get('/users/data', 'getData')->name('editor.user.data');
        Route::post('/users/store', 'storeData')->name('editor.user.store');
        Route::get('/users/detail', 'detail')->name('editor.user.detail');
        Route::post('/users/update', 'updateData')->name('editor.user.update');
        Route::delete('/users/delete', 'deleteData')->name('editor.user.delete');
    });
    Route::controller(MasterHeadController::class)->group(function () {
        Route::get('/master-head', 'index')->name('editor.master-head');
        Route::get('/master-head/data', 'getData')->name('editor.master-head.data');
        Route::post('/master-head/store', 'storeData')->name('editor.master-head.store');
        Route::get('/master-head/detail', 'detail')->name('editor.master-head.detail');
        Route::post('/master-head/update', 'updateData')->name('editor.master-head.update');
        Route::delete('/master-head/delete', 'deleteData')->name('editor.master-head.delete');
    });
        Route::controller(ContactController::class)->group(function () {
        Route::get('/contact', 'index')->name('editor.contact');
        Route::get('/contact/data', 'getData')->name('editor.contact.data');
        Route::delete('/contact/delete', 'deleteData')->name('editor.contact.delete');
    });
    Route::controller(ServiceController::class)->group(function () {
        Route::get('/service', 'index')->name('editor.service');
        Route::get('/service/data', 'getData')->name('editor.service.data');
        Route::post('/service/store', 'storeData')->name('editor.service.store');
        Route::get('/service/detail', 'detail')->name('editor.service.detail');
        Route::post('/service/update', 'updateData')->name('editor.service.update');
        Route::delete('/service/delete', 'deleteData')->name('editor.service.delete');
    });

    Route::controller(AboutController::class)->group(function () {
        Route::get('/about', 'index')->name('editor.about');
        Route::get('/about/data', 'getData')->name('editor.about.data');
        Route::post('/about/store', 'storeData')->name('editor.about.store');
        Route::get('/about/detail', 'detail')->name('editor.about.detail');
        Route::post('/about/update', 'updateData')->name('editor.about.update');
        Route::delete('/about/delete', 'deleteData')->name('editor.about.delete');
    });

    Route::controller(ClientController::class)->group(function () {
        Route::get('/client', 'index')->name('editor.client');
        Route::get('/client/data', 'getData')->name('editor.client.data');
        Route::post('/client/store', 'storeData')->name('editor.client.store');
        Route::get('/client/detail', 'detail')->name('editor.client.detail');
        Route::post('/client/update', 'updateData')->name('editor.client.update');
        Route::delete('/client/delete', 'deleteData')->name('editor.client.delete');
    });

    Route::controller(PortofolioController::class)->group(function () {
        Route::get('/portofolio', 'index')->name('editor.portofolio');
        Route::get('/portofolio/data', 'getData')->name('editor.portofolio.data');
        Route::post('/portofolio/store', 'storeData')->name('editor.portofolio.store');
        Route::get('/portofolio/detail', 'detail')->name('editor.portofolio.detail');
        Route::post('/portofolio/update', 'updateData')->name('editor.portofolio.update');
        Route::delete('/portofolio/delete', 'deleteData')->name('editor.portofolio.delete');
        Route::delete('/portofolio/image/delete', 'deleteImage')->name('editor.portofolio.image.delete');
        Route::post('/portofolio/images/add', 'addImages')->name('editor.portofolio.images.add');
    });

    Route::controller(DesignController::class)->group(function () {
        Route::get('/design', 'index')->name('editor.design');
        Route::get('/design/data', 'getData')->name('editor.design.data');
        Route::post('/design/store', 'storeData')->name('editor.design.store');
        Route::get('/design/detail', 'detail')->name('editor.design.detail');
        Route::post('/design/update', 'updateData')->name('editor.design.update');
        Route::delete('/design/delete', 'deleteData')->name('editor.design.delete');
        Route::delete('/design/image/delete', 'deleteImage')->name('editor.design.image.delete');
        Route::post('/design/images/add', 'addImages')->name('editor.design.images.add');
    });

    Route::controller(LegalityController::class)->group(function () {
        Route::get('/legality', 'index')->name('editor.legality');
        Route::get('/legality/data', 'getData')->name('editor.legality.data');
        Route::post('/legality/store', 'storeData')->name('editor.legality.store');
        Route::get('/legality/detail', 'detail')->name('editor.legality.detail');
        Route::post('/legality/update', 'updateData')->name('editor.legality.update');
        Route::delete('/legality/delete', 'deleteData')->name('editor.legality.delete');
        Route::delete('/legality/image/delete', 'deleteImage')->name('editor.legality.image.delete');
        Route::post('/legality/images/add', 'addImages')->name('editor.legality.images.add');
    });

    Route::resource('/statistic', \App\Http\Controllers\Admin\StatisticController::class);

    Route::controller(\App\Http\Controllers\editor\ProfessionalController::class)->group(function () {
        Route::get('/professional', 'index')->name('editor.professional');
        Route::get('/professional/create', 'create')->name('editor.professional.create');
        Route::post('/professional/store', 'store')->name('editor.professional.store');
        Route::get('/professional/{id}/edit', 'edit')->name('editor.professional.edit');
        Route::put('/professional/{id}', 'update')->name('editor.professional.update');
        Route::delete('/professional/{id}', 'destroy')->name('editor.professional.destroy');
    });

});
