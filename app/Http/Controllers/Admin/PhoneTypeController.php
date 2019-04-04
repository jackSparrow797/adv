<?php

namespace App\Http\Controllers\Admin;

use App\Models\PhoneType;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhoneTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phones = PhoneType::orderBy('id', 'DESC')
            ->paginate(15);

        return view('admin.phones.index', compact('phones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::selectRaw('id, title')
            ->toBase()
            ->get();


        return view('admin.phones.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $phone = PhoneType::create($request->all());


        return redirect()->route('phones.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $phone = PhoneType::find($id);

        $products_arr = $phone->products()->select('id')->get();
        $products_active = [];
        foreach ($products_arr as $products_item) {
            $products_active[] = $products_item->id;
        }
        unset($products_item);

        $products = Product::selectRaw('id, title')
            ->toBase()
            ->get();


        return view('admin.phones.edit', compact('phone', 'products', 'products_active'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $phone = PhoneType::find($id);
        $phone->update($request->all());

        //del foreign key for this phone
        foreach ($phone->products as $product_del) {
            /**@var \App\Models\Product $product_del */
            $product_del->phoneType()->dissociate();
            $product_del->save();
        }

        //update product_id
        if ($request->input('product_id')) {
            $products = [];
            foreach ($request->input('product_id') as $pr_item) {
                $products[] = Product::find($pr_item);
            }
            $phone->products()->saveMany($products);
        }

        return redirect()->route('phones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $phone = PhoneType::find($id);

        $phone->delete();
        return redirect()->route('phones.index');
    }
}
