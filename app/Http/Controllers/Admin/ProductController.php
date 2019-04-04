<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\PhoneType;
use App\Models\PrintModel;
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
        $products = Product::orderBy('id', 'DESC')
            ->paginate(15);

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $columns = [
            'id',
            'title'
        ];
        $product = new Product();
        $prints = PrintModel::select($columns)
            ->orderBy('id', 'DESC')
            ->get();
        $phones = PhoneType::select($columns)
            ->orderBy('id', 'DESC')
            ->get();
        return view('admin.product.create', compact('product', 'prints', 'phones'));
    }


    /**
     * @param ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->all());


        return redirect()->route('products.index');
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
        $columns = [
            'id',
            'title'
        ];
        $product = Product::find($id);
        $prints = PrintModel::select($columns)
            ->orderBy('id', 'DESC')
            ->get();
        $phones = PhoneType::select($columns)
            ->orderBy('id', 'DESC')
            ->get();


        return view('admin.product.edit', compact('product', 'prints', 'phones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());

        return redirect()->route('products.index');
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

        $product->delete();
        return redirect()->route('products.index');
    }
}
