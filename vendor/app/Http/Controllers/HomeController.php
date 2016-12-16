<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller {
  /**
   * HomeController constructor.
   */
  public function __construct() {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @param \Illuminate\Http\Request $request
   * @return $this
   */
  public function index(Request $request) {
    $products = Product::orderBy('id', 'DESC')
      ->paginate(5);
    return view('home', compact('products'))
      ->with('i', ($request->input('page', 1) - 1) * 5);
  }
}
