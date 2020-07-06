<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function getIndex(){
        if (!Auth::check()) {
            return view("pages.index");
        }
        else {
            return redirect()->route('tasks.index');
        }
    }
}
