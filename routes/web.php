<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\MechanicController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\PieceDeRechangeController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SearchController;
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
Route::get('/', function () {
    return view('Auth.login');
});
Route ::get('forget-password', [ForgotPasswordController ::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route ::post('forget-password', [ForgotPasswordController ::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route ::get('reset-password/{token}', [ForgotPasswordController ::class, 'showResetPasswordForm'])->name('reset.password.get');
Route ::post('reset-password', [ForgotPasswordController ::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/home', function () {
    return view('Admin.home');
});
Route::post('/home', function () {
    return view('home');
});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::middleware(['role:Administrateur'])->group(function () {

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


Route::get('/pieces',[PieceDeRechangeController::class,'index'])->name('index');
Route::post('/addPieceDeRechange',[PieceDeRechangeController::class,'addPieceDeRechange'])->name('addPieceDeRechange');
Route::post('/updatePieceDeRechange',[PieceDeRechangeController::class,'updatePieceDeRechange'])->name('updatePieceDeRechange');
Route::delete('/deletePieceDeRechange',[PieceDeRechangeController::class,'deletePieceDeRechange'])->name('deletePieceDeRechange');
Route::delete('/showPieceDeRechange',[PieceDeRechangeController::class,'show'])->name('show');


Route::get('/repairs', [RepairController::class, 'index'])->name('admin.repairs');
Route::post('/repairs/create', [RepairController::class, 'create'])->name('repairs.create');
Route::put('/repairs/update/{id}', [RepairController::class, 'update'])->name('repairs.update');
Route::delete('/repairs/delete/{id}', [RepairController::class, 'delete'])->name('delete');
Route::get('/repairs/show/{id}', [RepairController::class, 'show'])->name('repairs.show');


Route::get('/invoices',[FactureController::class,'index'])->name('Admin.Facture');
Route::post('invoices/add',[FactureController::class,'addInvoice'])->name('addInvoice');
Route::post('invoices/update',[FactureController::class,'updateInvoice'])->name('updateInvoice');
Route::delete('invoices/delete',[FactureController::class,'deleteInvoice'])->name('deleteInvoice');
Route::post('invoices/show',[FactureController::class,'showInvoice'])->name('showInvoice');
});
Route::middleware(['role:Mecanicien'])->group(function () {
    Route::get('/mechanic', [DashboardController::class, 'mechanic'])->name('Mecanicien.mecanicien');

});

Route::middleware(['role:Client'])->group(function () {
    Route::get('/client', [DashboardController::class, 'client'])->name('Client.client');

});
});
Route::post('/client/search', [ClientController::class, 'search'])->name('users.search');

Route::controller(FactureController::class)->group(function(){
    Route::get('factures', 'index');
    Route::get('factures-export', 'export')->name('factures-export');
    Route::post('factures-import', 'import')->name('factures-import');
});

Route::post('/request-appointment', [AppointmentController::class, 'submitAppointment'])->name('request-appointment');
Route::get('/user/{id}', [UserController::class, 'showProfile'])->name('user.profile');



