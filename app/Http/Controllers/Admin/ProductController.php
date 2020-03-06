<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\PurchaseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'category' => 'required'
        ]);

        $product = New Product();
        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->save();
        return redirect()->route('product.index')->with('successMsg', 'Product Successfully created');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $priceList = DB::table('purchase_items')
            ->where('product_id', $id)
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();

        $productSales = DB::table('sales_items')
            ->where('product_id', $id)
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.product.edit', compact('product', 'categories', 'priceList', 'productSales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'category' => 'required'
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->save();

        return redirect()->route('product.index')->with('successMsg', 'Product Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->back()->with('successMsgDe', '!Product successfully detleted');
    }
}
