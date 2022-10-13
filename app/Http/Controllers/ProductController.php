<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::query()->get();
        return view('product.index',[
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            Product::create($request->validated());
            return redirect()->route('product.index')->with('msg_success','Thêm sản phẩm mới thành công.');
        }catch (\Throwable $e){
            return redirect()->back()->with('msg_error',$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        if (is_null($product)){
            return redirect()->route('product.index')->with('msg_error','Sản phẩm không tìm thấy!');
        }
        return view('product.edit',[
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $product = Product::find($id);
        if (is_null($product)){
            return redirect()->route('product.index')->with('msg_error','Sửa sản phẩm thất bại!');
        }
        try {
            $product->update($request->validated());
            return redirect()->route('product.index')->with('msg_success','Sửa sản phẩm thành công.');
        }catch (\Throwable $e){
            return redirect()->back()->with('msg_error',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (is_null($product)){
            return redirect()->route('product.index')->with('msg_error','Xóa sản phẩm thất bại!');
        }
        try {
            $product->delete();
            return redirect()->route('product.index')->with('msg_success','Xóa sản phẩm thành công.');
        }catch (\Throwable $e){
            return redirect()->route('product.index')->with('msg_error',$e->getMessage());
        }
    }
}
