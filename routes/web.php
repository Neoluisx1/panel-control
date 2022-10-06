<?php
use App\Http\Livewire\Categories;
use App\Http\Livewire\Users;
use App\Http\Livewire\Products;
use App\Http\Livewire\Customers;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Branchoffices;
use App\Http\Livewire\Providers;
use App\Http\Livewire\Sales;
use App\Http\Livewire\Reports;
use App\Http\Livewire\Settings;
use App\Http\Livewire\Purchases;
use App\Http\Livewire\PurchasesAdd;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\DetailsPurchase;
use App\Http\Livewire\Ventas;

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

Route::middleware(['auth'])->group(function(){


Route::get(uri:'categories', action:Categories::class)->name(name:'categories')->middleware('auth');
Route::get(uri:'products', action:Products::class)->name(name:'products')->middleware('auth');
Route::get(uri:'ventas', action:Ventas::class)->name(name:'ventas')->middleware('auth');
Route::get(uri:'customers', action:Customers::class)->name(name:'customers')->middleware('auth');
Route::get(uri:'users', action:Users::class)->name(name:'users')->middleware('auth');
Route::get(uri:'sales', action:Sales::class)->name(name:'sales')->middleware('auth');
Route::get(uri:'reports', action:Reports::class)->name(name:'reports')->middleware('auth');
Route::get(uri:'branch_offices', action:Branchoffices::class)->name(name:'branch_offices')->middleware('auth');
Route::get(uri:'purchases_add', action:PurchasesAdd::class)->name(name:'purchases_add')->middleware('auth');
Route::get('purchases_details/{id}', DetailsPurchase::class)->name(name:'purchases_details/')->middleware('auth');
Route::get(uri:'ventas', action:Ventas::class)->name(name:'ventas')->middleware('auth');

Route::get(uri:'settings', action:Settings::class)->name(name:'settings')->middleware('auth');
Route::get(uri:'dash', action:Dashboard::class)->name(name:'dash')->middleware('auth');
Route::get(uri:'purchases', action:Purchases::class)->name(name:'purchases')->middleware('auth');

Route::get(uri:'providers', action:Providers::class)->name(name:'providers')->middleware('auth');

});

Route::get('/', function () {
    return view('auth.login');
});



require __DIR__.'/auth.php';
