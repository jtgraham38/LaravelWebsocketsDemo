<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Events\ChatEvent;

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
    return redirect()->route('chat');
});

Route::get('/chat', function () {
    //event(new \App\Events\ChatEvent('Hello, Soketi!'));
    return view('chat');
})->name('chat');

Route::post('/chat/send', function (Request $request) {
    $message = $request->input('message');
    
    if ($message) {
        event(new ChatEvent($message));
    }

    return response()->json(['status' => 'Message sent!']);
})->name('chat.send');
