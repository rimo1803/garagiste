<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\MechanicController;
use App\Http\Controllers\VehiculeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route ::get('forget-password', [ForgotPasswordController ::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route ::post('forget-password', [ForgotPasswordController ::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route ::get('reset-password/{token}', [ForgotPasswordController ::class, 'showResetPasswordForm'])->name('reset.password.get');
Route ::post('reset-password', [ForgotPasswordController ::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/home', function () {
    return view('Admin.home');
});
Route::post('/home', function () {
    return view('home ');
});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/clients',[ClientController::class,'welcome'])->name('welcome');
Route::post('/addClient',[ClientController::class,'addClient'])->name('addClient');
Route::post('/updateClient',[ClientController::class,'updateClient'])->name('updateClient');
Route::delete('/deleteClient',[ClientController::class,'deleteClient'])->name('deleteClient');
Route::delete('/showClient',[ClientController::class,'show'])->name('show');


Route::get('/mecaniciens',[MechanicController::class,'welcomee'])->name('welcomee');
Route::post('/addMecanicien',[MechanicController::class,'addMechanic'])->name('addMechanic');
Route::post('/updateMecanicien',[MechanicController::class,'updateMechanic'])->name('updateMechanic');
Route::delete('/deleteMecanicien',[MechanicController::class,'deleteMechanic'])->name('deleteMechanic');
Route::delete('/showMecanicien',[MechanicController::class,'show'])->name('show');


Route::get('/vehicules',[VehiculeController::class,'welcomeee'])->name('welcomeee');
Route::post('/addVehicule',[VehiculeController::class,'addVehicule'])->name('addVehicule');
Route::post('/updateVehicule',[VehiculeController::class,'updateVehicule'])->name('updateVehicule');
Route::delete('/deleteVehicule',[VehiculeController::class,'deleteVehicule'])->name('deleteVehicule');
Route::delete('/showVehicule',[VehiculeController::class,'show'])->name('show');

