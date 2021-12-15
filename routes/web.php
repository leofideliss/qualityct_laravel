<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ExperimentController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MeasureController;
use App\Http\Controllers\NormController;
use App\Http\Controllers\ProductsController;

use App\Http\Controllers\SampleController;
use App\Http\Controllers\SpecificationsController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TypeUserController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

// Login
Route::get('/','App\Http\Controllers\LoginController@showFormLogin')->name('login');
Route::post('/login/do','App\Http\Controllers\LoginController@login')->name('login.do');
Route::get('/logout','App\Http\Controllers\LoginController@logout')->name('logout');
Route::get('/home',[LoginController::class,'home'])->name('home');



// Crud

//Users

Route::resource('user',UserController::class);

//States

Route::resource('state',StateController::class);

//City

Route::resource('city',CityController::class);

//Address

Route::resource('address',AddressController::class);

// Clients and products

Route::post('client/search',[ClientController::class,'search'])->name('client.search');
Route::resource('client',ClientController::class);
Route::resource('client.products',ProductsController::class);
Route::post('prod/directStore',[ProductsController::class,'dirStore'])->name('products.dirStore');
Route::get('prod/direct',[ProductsController::class,'createDir'])->name('products.dir');
Route::post('prod/search',[ProductsController::class,'search'])->name('products.search');
Route::get('prod/list',[ProductsController::class,'list'])->name('products.list');

//Type Users

Route::resource('type_user',TypeUserController::class);

//Specifications

Route::resource('specifications',SpecificationsController::class);
Route::post('specifications/search',[SpecificationsController::class,'search'])->name('specifications.search');

//Samples

Route::resource('sample',SampleController::class);
Route::post('sample/search',[SampleController::class,'search'])->name('sample.search');

//Experiments

Route::resource('experiment',ExperimentController::class);
Route::post('experiment/search',[ExperimentController::class,'search'])->name('experiment.search');

// Norms

Route::resource('norm',NormController::class);
Route::post('norm/search',[NormController::class,'search'])->name('norm.search');

// Measures

Route::resource('measure', MeasureController::class);

// Tests

Route::get('test',[TestController::class,'index'])->name('test.index');
Route::get('test/historic',[TestController::class,'historic'])->name('test.historic');
Route::get('test/historicDir',[TestController::class,'historicDir'])->name('test.historicDir');
Route::get('test/{op_number}',[TestController::class,'selectExperiments'])->name('test.select');
Route::post('test/setExperiments/{op_number}',[TestController::class,'setExperiments'])->name('test.setExperiments');
Route::get('test/editExperiments/{op_number}',[TestController::class,'editExperiments'])->name('test.editExperiments');
Route::put('test/updateExperiments/{op_number}',[TestController::class,'updateExperiments'])->name('test.updateExperiments');

Route::delete('test/{op_number}',[TestController::class,'destroy'])->name('test.destroy');
Route::get('test/execute/{op_number}',[TestController::class,'executeDisplay'])->name('test.execute');
Route::get('test/finish/{op_number}',[TestController::class,'finish'])->name('test.finish');
Route::post('test/save/{op_number}',[TestController::class,'saveTest'])->name('test.save');
Route::post('test/search',[TestController::class,'searchTest'])->name('test.search');
Route::post('test/searchHistoric',[TestController::class,'searchHistoric'])->name('test.searchHistoric');
Route::get('test/viewPdf/{op_number}',[TestController::class,'viewPdf'])->name('test.viewpdf');
Route::get('test/downloadPdf/{op_number}',[TestController::class,'downloadPdf'])->name('test.downloadPdf');

// Import file

Route::get('import',[ImportController::class,'index'])->name('import.index');
Route::post('import',[ImportController::class,'setUpload'])->name('import.upload');



/* AJAX */

Route::get('products/{id}',[ProductsController::class,'loadProducts'])->name('loadProducts');
Route::get('load/experiments/{id}',[ExperimentController::class,'loadExperiments'])->name('loadExperiments');
Route::get('exists/sample/{id}',[SampleController::class,'sampleExists'])->name('sampleExists');
Route::get('search/specifications/{op_number}',[SpecificationsController::class,'searchSpec'])->name('searchSpec');
Route::get('search/norm/{op_number}',[NormController::class,'searchNorm'])->name('searchNorm');
Route::get('norm/load/experiments/{id}',[ExperimentController::class,'loadNormExperiments'])->name('loadNormExperiments');
Route::get('experiments/expSelected/{id}',[ExperimentController::class,'expSelected'])->name('experiments.expSelected');
Route::get('listProducts/{id_client}',[ProductsController::class,'listProducts'])->name('products.listProducts');
Route::get('loadMeasures',[MeasureController::class,'loadMeasures'])->name('loadMeasures');
Route::delete('/productDel/{id}',[ProductsController::class,'deleteProd'])->name('products.deleteProd');