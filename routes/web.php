<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Counter;
use App\Livewire\TodoTask;
use App\Livewire\TodoTaskV2;
use App\Livewire\SearchTool;

Route::get('/', function () {
    return view('welcome');
});

# Basic Counter Example
Route::get('/counter', Counter::class)->name('counter-tool'); 

# Todo Task Example
Route::get('/todo-tasks', TodoTask::class)->name('todo-tasks');

# Todo Task Example V2
Route::get('/todo-tasks-v2', TodoTaskV2::class)->name('todo-tasks-v2');

# Search Tool Example
Route::get('/search-tool', SearchTool::class)->name('search-tool');