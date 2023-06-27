<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
});


//*******************page de connexion / inscription****************************** */


// Route :: méthode http (url, [emplacement du controlleur concerné, méthode du ctrl concerné])-> nom de la route
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');


// ****************************Accueil (home.blade.php) Liste des messages*******   ****/
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');


//*******************routes de l'authentification laraval UI       ******************* */

Auth::routes();

//************************************************************************************ */
Route::resource('/users', App\Http\Controllers\UserController::class)->except('index','create','store');



//*************************route resource posts ****************************************/
Route::resource('/posts', App\Http\Controllers\PostController::class)->except('index','create','show');


//*************************Route resource comments *************************/
Route::resource('/comments',\App\Http\Controllers\CommentController::class)->except('index', 'create', 'show');