<?php

use App\Models\Post;
use App\Models\User;
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

Route::get('/create', function () {
    $user = User::findOrFail(1);
    $user->posts()->save(new Post(['title' => 'multiple post', 'body' => 'Multiple post created by one user']));
});

Route::get('/show', function () {
    $user = User::findOrFail(1);

    foreach ($user->posts as $post) {
        echo $post->title . '<br>' . $post->body . '<br>';
    }

    return true;
});

Route::get('/update', function () {
    $user = User::findOrFail(1);
    $user->posts()->where('id', 2)->update(['title' => 'updated title 2', 'body' => 'updated post body 2']);
});

Route::get('/delete', function () {
    $user = User::findOrFail(1);

    //$user->posts()->delete();

    foreach ($user->posts as $post) {
        $post->delete();
    }
    $user->delete();
});
