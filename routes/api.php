<?php
// use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function(){
    Route::post('/register', [App\Http\Controllers\API\Auth\RegisterController::class, 'register'])->name('register');
    Route::post('login', [App\Http\Controllers\API\Auth\LoginController::class, 'login'])->name('login');

    Route::get('logout', [App\Http\Controllers\API\UserController::class, 'logout'])->middleware('auth:api');
    Route::get('user', [App\Http\Controllers\API\UserController::class, 'user'])->middleware('auth:api');

    /**
     * override the auto redirect feature and send a message using middlleware Authenticate.php
     * //route name user here if auth failed
     */
    Route::get('authntication-failed', [App\Http\Controllers\API\UserController::class, 'authFailed'])->name('authntication-failed');
});


//API Resources
// Route::get('opportunities', [App\Http\Controllers\OpportunityController::class, 'index']);
// Route::get('opportunity/{opportunity}', [App\Http\Controllers\OpportunityController::class, 'show']);


// Route::resource('opportunity', App\Http\Controllers\OpportunityController::class)->middleware('auth:api');

//route group and route authentication user here
Route::group(['prefix' => 'lookups', 'middleware' => 'auth:api'],function () {
    //route resource used here
    Route::resource('category', App\Http\Controllers\CategoryController::class);
    Route::resource('country', App\Http\Controllers\CountryController::class);
});


/** CRUD (Create, Read, Update, Deleta) Operation **/
Route::group(['middleware' => 'auth:api'], function () {
    //Opportunities
    Route::resource('opportunity', App\Http\Controllers\OpportunityController::class);

    //Questions
    Route::get('questions', [App\Http\Controllers\QuestionyController::class, 'index']);
    Route::post('question', [App\Http\Controllers\QuestionController::class, 'post']);
    Route::put('question/{question}', [App\Http\Controllers\QuestionController::class, 'update']);

    //Favourites
    Route::get('favourites', [App\Http\Controllers\FavouriteController::class, 'index']);
    Route::post('favourite', [App\Http\Controllers\FavouriteController::class, 'post']);
    Route::put('favourite/{favourite}', [App\Http\Controllers\FavouriteController::class, 'update']);
});
