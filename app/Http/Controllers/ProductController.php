<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller {
  /**
   * ProductController constructor.
   */
  public function __construct() {
    $this->middleware('auth');
  }

  /**
   * Display a listing of the resource.
   *
   * @param \Illuminate\Http\Request $request
   * @return $this
   */
  public function index(Request $request) {
    $products = Product::where('uid', Auth::id())
      ->orderBy('id', 'DESC')
      ->paginate(5);
    return view('Product.index', compact('products'))
      ->with('i', ($request->input('page', 1) - 1) * 5);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    return view('Product.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    $this->validate($request, [
      'name' => 'required',
      'desc' => 'required',
      'price' => 'required|numeric|min:0.1',
    ]);
    $data = $request->all();
    $data['uid'] = Auth::id();

    //print_R($data);die;
    Product::create($data);
    return redirect()->route('product.index')
      ->with('success', 'Product created successfully');
  }

  public function comment(Request $request, $id) {
    $this->validate($request, [
      'comment' => 'required',
      // Validate if product is really exists in the db.
      'product_id' => 'required|exists:products,id',
    ]);
    $data = $request->all();
    $data['uid'] = Auth::id();
    $data['product_id'] = $id;
    Comment::create($data);
    return json_encode(array(
      'success' => TRUE,
      'username' => Auth::user()->name,
      'comment' => $data['comment'],
    ));
  }

  /**
   * Display the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {
    $product = Product::find($id);
    $comments = array();
    if (!empty($product)) {
      $comments = Comment::join('users', 'users.id', '=', 'comments.uid')
        ->where('comments.product_id', $product->id)
        ->orderBy('comments.created_at', 'desc')
        ->get();
    }

    return view('Product.show', compact('product', 'comments'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    $product = Product::where('uid', Auth::id())->find($id);
    return view('Product.edit', compact('product'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    $this->validate($request, [
      'name' => 'required',
      'desc' => 'required',
      'price' => 'required|numeric|min:0.1',
    ]);
    $data = array(
      'name' => $request->get('name'),
      'desc' => $request->get('desc'),
      'price' => $request->get('price'),
    );
    Product::where('id', $id)->where('uid', Auth::id())->update($data);
    return redirect()->route('product.index')
      ->with('success', 'Product updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    Product::find($id)->where('uid', Auth::id())->delete();
    return redirect()->route('product.index')
      ->with('success', 'Product deleted successfully');
  }
}
