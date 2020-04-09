<?php

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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/** Admin site **/
/***Route::group(['middleware' => ['status', 'auth']], function () {
    $groupData = [
        'namespace' => 'Bot\Admin',
        'prefix' => 'admin',
    ];
    Route::group($groupData, function (){
       Route::resource('index', 'MainController')
           ->names('bot.admin.index');


    });
});***/

Route::group(['middleware' => ['status', 'auth']], function () {
    $groupData = [
        'namespace' => 'Bot\Admin',
        'prefix' => 'admin',
    ];
    Route::group($groupData, function (){
        Route::resource('index', 'MainController')
            ->names('bot.admin.index');

//Route::get('/cruds', 'CrudController@index');
//Route::post('/cruds', 'CrudController@update');

        Route::resource('cruds.type.id', 'CrudController')
            ->names('bot.admin.index');
        Route::resource('cruds.type', 'CrudController')
            ->names('bot.admin.index');

        Route::resource('cruds', 'CrudController')
            ->names('bot.admin.index');
        Route::resource('communication', 'CommController')
            ->names('bot/admin.communication');
    });
});

Route::get('user/index', 'Bot\User\MainController@index');


/*Route::get('ajax',function(){
    return view('auth.login');
});

Route::get('/getmsg',function(){
    return view('auth.login');
});

Route::post('/getmsg','AjaxController@index');
*/

// POST-запрос при нажатии на нашу кнопку.
/////Route::post('more', array('before'=>'csrf-ajax', 'as'=>'more', 'uses'=>'HomeController@getMoreEvents'));


// Фильтр, срабатывающий перед пост запросом.
/*Route::filter('csrf-ajax', function()
{
    if (Session::token() != Request::header('x-csrf-token'))
    {
        throw new Illuminate\Session\TokenMismatchException;
    }
});
Route::
*/