<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Message;

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
//thak you for giving me a tips - https://petericebear.github.io/starting-laravel-echo-20170303/

Route::get('/', [HomeController::class, 'index']);
Route::get('notify', [HomeController::class, 'notify']);
Route::get('markasread/{id}', [HomeController::class, 'markasread'])->name('markasread');


Route::get('/dashboard', function () {
    //message part filter the array
    $message = Message::all();
    $formatedMessage = $message->map(function ($m) {
        return [
            'user' => ["id" => $m->users->id, "name" => $m->users->name],
            'message' => $m->body
        ];
    });

    //for notification bell
    return Inertia::render('Dashboard', [
        'messages' => $formatedMessage,
        'notifications' => auth()->user()->notifications
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//create a route for controller
Route::post('/message', [MessageController::class, 'post']);

require __DIR__.'/auth.php';
