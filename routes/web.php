<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\SearchController;
use App\Models\User;
use App\Models\Student;
use App\Models\Offer;
use App\Models\Business;


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

Route::resource('student', StudentController::class);

Route::resource('business', BusinessController::class);

Route::resource('offer', OfferController::class);

Route::get('/test', function () {
    return 0;
});

Route::get('/search', [SearchController::class, 'search'])->name('web.search');

Route::get('/offer-indexing/{id?}', function($id){
    $offers = Offer::where('id', '=', $id)->paginate(15);
    return view('offer.index',["offers" => $offers, "users" => User::all(), "businesses" => Business::all()]);
})->name('offer-indexing');

Route::get('/stats', function () {
    $studentsSignedUp = Student::all();
    $businessesSignedUp = Business::all();
    $studentsAvailable = Student::whereNull('offer_id');
    $offers = Offer::where('status','=','0');
    return view('stats',["users" => User::all(), "studentsSignedUp" => $studentsSignedUp, "businessesSignedUp" => $businessesSignedUp, "studentsAvailable" => $studentsAvailable, "offers" => $offers]);
})->name('stats');

Route::get('/contacts', function(){
    return view('contacts',["users" => User::all()]);
})->name('contacts');

Route::get('/admin', function(){
    return view('register',["users" => User::all()]);
})->name('admin');

Route::get('/download', [App\Http\Controllers\StudentController::class, 'getDownload'])->name('download');

Route::get('/download-perfil', function(Request $request){
    switch ($request->perfil) {
        case 'inf':
            return Storage::download('perf/Perfil-INF.pdf');
            break;
        case 'gat':
            return Storage::download('perf/Perfil-GAT.pdf');
            break;
        case 'muebles':
            return Storage::download('perf/Perfil-Muebles.pdf');
            break;
        case 'patronaje':
            return Storage::download('perf/Perfil-Patronaje.pdf');
            break;
        case 'elca':
            return Storage::download('perf/Perfil-ELCA.pdf');
            break;
        case 'eldad':
            return Storage::download('perf/Perfil-ELDAD.pdf');
            break;
        case 'auto':
            return Storage::download('perf/Perfil-Automotriz.pdf');
            break;
        case 'mecanizado':
            return Storage::download('perf/Perfil-Mecanizado.pdf');
            break;
        default:
            return view('home');
            break;
    }
})->name('download-perfil');

Route::post('/admin', [App\Http\Controllers\AdminController::class, 'create']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
