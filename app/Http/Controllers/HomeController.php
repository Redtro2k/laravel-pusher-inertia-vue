<?php

namespace App\Http\Controllers;

use App\Notifications\WelcomeNotification;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Notification;
use App\Models\User;


class HomeController extends Controller
{
    //
    public function index(){

        $users = User::get();
        $post = [
            'title' => 'post title',
            'slug' => 'post-slug'
        ];
        foreach($users as $user){
            // Notification::send($user, new WelcomeNotification($post));
            $user->notify(new WelcomeNotification($post));
        }
        dd('done');

        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }
}
