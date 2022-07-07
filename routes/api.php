<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', [Controller::class, 'routes'])
     ->name('route information')
     ->withoutMiddleware('api');
Route::get('/example', [Controller::class, 'example'])->name('example route');
Route::get('/error', [Controller::class, 'error'])->name('error route');

## api routes
Route::namespace('Api')
     ->prefix('api')
     ->group(function () {
         ## about
         Route::prefix('about')
              ->group(function () {
                  Route::post('{id}', 'AboutController@update');
              });
         ## avatar
         Route::prefix('avatar')
              ->group(function () {
                  Route::post('{id}', 'AvatarController@update');
              });

         ## company routes.
         Route::prefix('company')
              ->group(function () {
                  Route::get('', 'CompanyController@show');
                  Route::put('{id}', 'CompanyController@update');
              });
         ## nature
         Route::prefix('nature')
              ->group(function () {
                  Route::post('{id}', 'NatureController@update');
              });

         ## profile routes.
         Route::prefix('profile')
              ->group(function () {
                  Route::get('', 'ProfileController@show');
                  Route::put('{id}', 'ProfileController@update');
              });
         ## skills
         Route::prefix('skills')
              ->group(function () {
                  Route::post('{id}', 'SkillController@update');
              });
     });
