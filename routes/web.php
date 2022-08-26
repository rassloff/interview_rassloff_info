<?php

use App\Http\Controllers\InterviewAnswerController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\InterviewQuestionController;
use Illuminate\Support\Facades\Auth;
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


Route::group(['middleware' => 'auth'], function()
{
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('interviews', InterviewController::class);
    Route::resource('interviewQuestions', InterviewQuestionController::class);

    Route::get('interviewQuestion/{interview_id}/', [InterviewController::class, 'addQuestion'])->name('interviews.addQuestion');


    Route::post('storeInterviewQuestion/{interview_id}', [InterviewController::class, 'storeQuestion'])
        ->name('interviews.storeQuestion');

    Route::resource('interviewAnswers', InterviewAnswerController::class);

    //Route::post('addQuestion/{interview_id}', InterviewController::class, 'addQuestion')->name('addQuestion');

    //Route::post('/addQuestion/{interview_id}', 'InterviewController@addQuestion')->name('addQuestion');
    //Route::put('/storeQuestion/{interview_id}', 'InterviewController@storeQuestion')->name('storeQuestion');
});
