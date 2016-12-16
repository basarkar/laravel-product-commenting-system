<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller {
  public function index(Request $request) {
    if (Auth::guest()) {
      return view('welcome');
    }
    else {
      return redirect()->action('HomeController@index');
    }
  }
}
