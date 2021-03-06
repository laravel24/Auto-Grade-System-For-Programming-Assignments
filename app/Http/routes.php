<?php
use App\User;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('home');
    });
    Route::get('mylogin', function () {
        return view('auth.login2');
    });
    Route::get('front', 'HomeController@front');
    Route::get('about', 'HomeController@about');
    Route::get('contact', 'HomeController@contact');
    Route::post('contact', 'HomeController@postContact');
    Route::get('admin', 'HomeController@admin');
});

Route::group(['middleware' => ['web']], function () {

    Route::get('/mail', function () {
        $confirmation_code = str_random(30); 
        $data1 = [
            'confirmation_code' => $confirmation_code
        ];
         Mail::send('emails.index', $data1, function ($m) {
            $m->to('snkaushi@gmail.com')->subject('Your Reminder!');
        });
    	/*Mail::raw('Text to e-mail', function ($message) {
    		$message->from('charunikaushalya.13@cse.mrt.ac.lk', 'hello sweetheat');

    		$message->to('snkaushi@gmail.com');
		});*/
        return view('welcome');
    });

});

//auth routes
Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/staff_register', 'PrivilegeController@staffRegister');
    Route::post('/staff_register', 'PrivilegeController@postStaffRegister');
    Route::get('/staff_register2', 'PrivilegeController@staffRegister2');
    Route::post('/staff_register2', 'PrivilegeController@postStaffRegister2');
    Route::get('/home', 'HomeController@index');
    Route::get('register_verify_{confirmationCode}', 'Auth\AuthController@confirmEmail');
    Route::get('/user', 'PrivilegeController@users');
    Route::get('/student', 'StudentController@students');
    Route::get('/student_{id}', 'StudentController@progress');
    Route::get('/stuUpdate/{id}', 'StudentController@update');
    Route::patch('/stuUpdate/{id}', 'StudentController@postUpdate');
});

//compile routes
Route::group(['middleware' => 'web'], function () {
    Route::get('/compile', 'CompileController@index');
    Route::post('/compile', 'CompileController@runcode');
});

//prevelege routes
Route::group(['middleware' => 'web'], function () {
    Route::get('/privilege_insert', 'PrivilegeController@insert');
    Route::post('/privilege_insert', 'PrivilegeController@postInsert');
    Route::get('/privileges', 'PrivilegeController@viewPrevileges');

    //role routes
    Route::get('/roles', 'RoleController@viewRoles');
    Route::get('/role_insert', 'RoleController@Insert');
    Route::post('/role_insert', 'RoleController@postInsert');

    //language routes
    Route::get('/languages', 'LanguageController@viewLanguages');
    Route::get('/language_insert', 'LanguageController@Insert');
    Route::post('/language_insert', 'LanguageController@postInsert');
});

//assignment routes
Route::group(['middleware' => 'web'], function () {
    Route::get('/assignments', 'AssignmentController@index');
    Route::get('/assignment_insert', 'AssignmentController@insert');
    Route::post('/assignment_insert', 'AssignmentController@postInsert');
     Route::get('/assignmentEdit_{id}', 'AssignmentController@update');
    Route::post('/assignmentEdit_{id}', 'AssignmentController@postUpdate');
    Route::get('/assignmentView_{id}', 'AssignmentController@viewAnswers');
    Route::get('/leaderboard_{id}', 'AssignmentController@leaderboard');
    Route::get('/submission_{id}', 'AssignmentController@submission');
    Route::get('/discussion_{id}', 'AssignmentController@disscusion');
    Route::Post('/discussion_{id}', 'AssignmentController@PostDisscusion');
    Route::get('/assignment_{id}', 'AssignmentController@show');
   Route::post('/assignment_{id}', 'AssignmentController@runCode');


  

   Route::get('/marks', 'AssignmentController@getMarks');
   Route::post('/marks_{id}', 'AssignmentController@saveMarks');
  // Route::get('/assignment_{id}_submit', 'AssignmentController@runcode');
});