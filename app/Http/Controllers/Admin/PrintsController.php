<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CollectionPrint;
use App\Models\PrintModel;
use App\Models\Product;
use Illuminate\Http\Request;

class PrintsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prints = PrintModel::orderBy('id', 'DESC')
            ->paginate(15);

        return view('admin.prints.index', compact('prints'));
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

        $collPrints = CollectionPrint::selectRaw('id, title')
            ->toBase()
            ->get();

        return view('admin.prints.create', compact('products', 'collPrints'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $print = PrintModel::create($request->all());
        //save product_id
        if ($request->input('product_id')) {
            $products = [];
            foreach ($request->input('product_id') as $pr_item) {
                $products[] = Product::find($pr_item);
            }
            $print->products()->saveMany($products);
        }

        if ($request->input('collection_print_id')) {
            $print->CollectionPrints()->attach($request->input('collection_print_id'));
        }

        return redirect()->route('prints.index');
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
        $print = PrintModel::find($id);

        $products_arr = $print->products()->select('id')->get();
        $products_active = [];
        foreach ($products_arr as $products_item) {
            $products_active[] = $products_item->id;
        }
        unset($products_item);

        $products = Product::selectRaw('id, title')
            ->toBase()
            ->get();

        $collPrints_arr = $print->CollectionPrints()->select('id')->get();
        $collPrints_active = [];
        foreach ($collPrints_arr as $collPrints_item) {
            $collPrints_active[] = $collPrints_item->id;
        }
        unset($collPrints_item);

        $collPrints = CollectionPrint::selectRaw('id, title')
            ->toBase()
            ->get();

        return view('admin.prints.edit',
            compact('print', 'products', 'products_active' , 'collPrints', 'collPrints_active'));
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
        $print = PrintModel::find($id);
        $print->update($request->all());

        //del foreign key for this print
        foreach ($print->products as $product_del) {
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
            $print->products()->saveMany($products);
        }

        if ($request->input('collection_print_id')) {
            $print->CollectionPrints()->detach();
            $print->CollectionPrints()->attach($request->input('collection_print_id'));
        }

        return redirect()->route('prints.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $print = PrintModel::find($id);
        $print->CollectionPrints()->detach();
        $print->delete();
        return redirect()->route('prints.index');
    }
}
