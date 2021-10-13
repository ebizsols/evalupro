<?php

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

/*Route::prefix('valuation')->group(function() {
    Route::get('/', 'ValuationController@index');
});*/

Route::prefix('valuation')->group(function() {
    Route::get('/valModuleMirgration', function () {
        Artisan::call('module:migrate-refresh Valuation');

        return 'check table';
    });

    Route::prefix('admin')->group(function() {


        Route::get('/orderOrigination', 'Admin\OrderManagement\OrderOriginationController@create')->name('valuation.admin.orderOrigination');
        Route::post('/orderOrigination/store', 'Admin\OrderManagement\OrderOriginationController@store')->name('valuation.admin.orderOrigination.store');

        Route::prefix('settings')->group(function() {

            Route::get('/menu', 'Admin\Settings\MenuController@index')->name('valuation.admin.settings.menu');
            Route::get('/menu/data', 'Admin\Settings\MenuController@data')->name('valuation.admin.settings.menu.data');
            Route::get('/menu/addEditView/{id?}', 'Admin\Settings\MenuController@addEditView')->name('valuation.admin.settings.menu.addEditView');
            Route::post('/menu/saveUpdateData/{id?}', 'Admin\Settings\MenuController@saveUpdateData')->name('valuation.admin.settings.menu.saveUpdateData');
            Route::delete('/menu/destroy/{id?}', 'Admin\Settings\MenuController@destroy')->name('valuation.admin.settings.menu.destroy');

            Route::get('/country', 'Admin\Settings\CountryController@index')->name('valuation.admin.settings.country');
            Route::get('/country/data', 'Admin\Settings\CountryController@data')->name('valuation.admin.settings.country.data');
            Route::get('/country/edit/{id}', 'Admin\Settings\CountryController@edit')->name('valuation.admin.settings.country.edit');
            Route::post('/country/saveUpdate/{id}', 'Admin\Settings\CountryController@saveUpdate')->name('valuation.admin.settings.country.saveUpdate');

            Route::get('/governorate', 'Admin\Settings\GovernorateController@index')->name('valuation.admin.settings.governorate');
            Route::get('/governorate/data', 'Admin\Settings\GovernorateController@data')->name('valuation.admin.settings.governorate.data');
            Route::get('/governorate/addEditView/{id?}', 'Admin\Settings\GovernorateController@addEditView')->name('valuation.admin.settings.governorate.addEditView');
            Route::post('/governorate/saveUpdateData/{id?}', 'Admin\Settings\GovernorateController@saveUpdateData')->name('valuation.admin.settings.governorate.saveUpdateData');
            Route::delete('/governorate/destroy/{id?}', 'Admin\Settings\GovernorateController@destroy')->name('valuation.admin.settings.governorate.destroy');

            Route::get('/city', 'Admin\Settings\CityController@index')->name('valuation.admin.settings.city');
            Route::get('/city/data', 'Admin\Settings\CityController@data')->name('valuation.admin.settings.city.data');
            Route::get('/city/getAjaxData', 'Admin\Settings\CityController@getAjaxData')->name('valuation.admin.settings.city.getAjaxData');
            Route::get('/city/addEditView/{id?}', 'Admin\Settings\CityController@addEditView')->name('valuation.admin.settings.city.addEditView');
            Route::post('/city/saveUpdateData/{id?}', 'Admin\Settings\CityController@saveUpdateData')->name('valuation.admin.settings.city.saveUpdateData');
            Route::delete('/city/destroy/{id?}', 'Admin\Settings\CityController@destroy')->name('valuation.admin.settings.city.destroy');

            Route::get('/block', 'Admin\Settings\BlockController@index')->name('valuation.admin.settings.block');
            Route::get('/block/data', 'Admin\Settings\BlockController@data')->name('valuation.admin.settings.block.data');
            Route::get('/block/getAjaxData', 'Admin\Settings\BlockController@getAjaxData')->name('valuation.admin.settings.block.getAjaxData');
            Route::get('/block/addEditView/{id?}', 'Admin\Settings\BlockController@addEditView')->name('valuation.admin.settings.block.addEditView');
            Route::post('/block/saveUpdateData/{id?}', 'Admin\Settings\BlockController@saveUpdateData')->name('valuation.admin.settings.block.saveUpdateData');
            Route::delete('/block/destroy/{id?}', 'Admin\Settings\BlockController@destroy')->name('valuation.admin.settings.block.destroy');

        });

        //Property routes group
        Route::prefix('property')->group(function() {

            //Property routes
            Route::get('/', 'Admin\Properties\PropertyController@index')->name('valuation.admin.property');
            Route::get('/data', 'Admin\Properties\PropertyController@data')->name('valuation.admin.property.data');
            Route::get('/addEditView/{id?}', 'Admin\Properties\PropertyController@addEditView')->name('valuation.admin.property.addEditView');
            Route::post('/saveUpdateData/{id?}', 'Admin\Properties\PropertyController@saveUpdateData')->name('valuation.admin.property.saveUpdateData');
            Route::delete('/destroy/{id?}', 'Admin\Properties\PropertyController@destroy')->name('valuation.admin.property.destroy');
            Route::get('/newCreateView', 'Admin\Properties\PropertyController@newCreateView')->name('valuation.admin.property.newCreateView');

            //Property Type routes
            Route::get('/type', 'Admin\Properties\TypeController@index')->name('valuation.admin.property.type');
            Route::get('/type/data', 'Admin\Properties\TypeController@data')->name('valuation.admin.property.type.data');
            Route::get('/type/getAjaxData', 'Admin\Properties\TypeController@getAjaxData')->name('valuation.admin.property.type.getAjaxData');
            Route::get('/type/addEditView/{id?}', 'Admin\Properties\TypeController@addEditView')->name('valuation.admin.property.type.addEditView');
            Route::post('/type/saveUpdateData/{id?}', 'Admin\Properties\TypeController@saveUpdateData')->name('valuation.admin.property.type.saveUpdateData');
            Route::delete('/type/destroy/{id?}', 'Admin\Properties\TypeController@destroy')->name('valuation.admin.property.type.destroy');

            //Property Classification routes
            Route::get('/classification', 'Admin\Properties\ClassificationController@index')->name('valuation.admin.property.classification');
            Route::get('/classification/data', 'Admin\Properties\ClassificationController@data')->name('valuation.admin.property.classification.data');
            Route::get('/classification/getAjaxData', 'Admin\Properties\ClassificationController@getAjaxData')->name('valuation.admin.property.classification.getAjaxData');
            Route::get('/classification/addEditView/{id?}', 'Admin\Properties\ClassificationController@addEditView')->name('valuation.admin.property.classification.addEditView');
            Route::post('/classification/saveUpdateData/{id?}', 'Admin\Properties\ClassificationController@saveUpdateData')->name('valuation.admin.property.classification.saveUpdateData');
            Route::delete('/classification/destroy/{id?}', 'Admin\Properties\ClassificationController@destroy')->name('valuation.admin.property.classification.destroy');

            //Property Categorization  routes
            Route::get('/categorization', 'Admin\Properties\CategorizationController@index')->name('valuation.admin.property.categorization');
            Route::get('/categorization/data', 'Admin\Properties\CategorizationController@data')->name('valuation.admin.property.categorization.data');
            Route::get('/categorization/getAjaxData', 'Admin\Properties\CategorizationController@getAjaxData')->name('valuation.admin.property.categorization.getAjaxData');
            Route::get('/categorization/addEditView/{id?}', 'Admin\Properties\CategorizationController@addEditView')->name('valuation.admin.property.categorization.addEditView');
            Route::post('/categorization/saveUpdateData/{id?}', 'Admin\Properties\CategorizationController@saveUpdateData')->name('valuation.admin.property.categorization.saveUpdateData');
            Route::delete('/categorization/destroy/{id?}', 'Admin\Properties\CategorizationController@destroy')->name('valuation.admin.property.categorization.destroy');

            //Property Class routes
            Route::get('/class', 'Admin\Properties\ClassController@index')->name('valuation.admin.property.class');
            Route::get('/class/data', 'Admin\Properties\ClassController@data')->name('valuation.admin.property.class.data');
            Route::get('/class/getAjaxData', 'Admin\Properties\ClassController@getAjaxData')->name('valuation.admin.property.class.getAjaxData');
            Route::get('/class/addEditView/{id?}', 'Admin\Properties\ClassController@addEditView')->name('valuation.admin.property.class.addEditView');
            Route::post('/class/saveUpdateData/{id?}', 'Admin\Properties\ClassController@saveUpdateData')->name('valuation.admin.property.class.saveUpdateData');
            Route::delete('/class/destroy/{id?}', 'Admin\Properties\ClassController@destroy')->name('valuation.admin.property.class.destroy');

        });

        Route::prefix('project')->group(function() {

            Route::get('project-template', 'Admin\Projects\ProjectTemplateController@index')->name('valuation.admin.project.templates');
            Route::get('/project-template/data', 'Admin\Projects\ProjectTemplateController@data')->name('valuation.admin.project.templates.data');
            //Route::get('project-template/data', array('uses' => 'ProjectTemplateController@data'))->name('project-template.data');
            //Route::get('project-template/detail/{id?}', array('uses' => 'ProjectTemplateController@taskDetail'))->name('project-template.detail');
            //Route::resource('project-template', 'Admin\Projects\ProjectTemplateController');

        });



    });


    Route::get('/', 'ValuationController@index');

    Route::get('/orderOrigination', 'OrderManagement\OrderOriginationController@index')->name('valuation.orderOrigination');

    Route::prefix('member')->group(function() {
        Route::get('/dashboard', 'Member\MemberDashboardController@index')->name('valuation.member.dashboard');
    });

});
