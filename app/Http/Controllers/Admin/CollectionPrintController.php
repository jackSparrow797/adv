<?php

namespace App\Http\Controllers\Admin;

use App\Models\CollectionPrint;
use App\Models\PrintModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CollectionPrintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collPrints = CollectionPrint::orderBy('id', 'DESC')
            ->paginate(15);

        return view('admin.collectionPrints.index', compact('collPrints'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prints = PrintModel::selectRaw('id, title')
            ->toBase()
            ->get();

        return view('admin.collectionPrints.create', compact('prints'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $collPrints = CollectionPrint::create($request->all());

        if ($request->input('print_id')) {
            $collPrints->printModels()->attach($request->input('print_id'));
        }

        return redirect()->route('collections.index');
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
        $collPrints = CollectionPrint::find($id);

        $prints = PrintModel::selectRaw('id, title')
            ->toBase()
            ->get();

        $collPrints_arr = $collPrints->printModels()->select('id')->get();
        $collPrints_active = [];
        foreach ($collPrints_arr as $collPrint_item) {
            $collPrints_active[] = $collPrint_item->id;
        }
        unset($collPrint_item);


        return view('admin.collectionPrints.edit',
            compact('prints', 'collPrints', 'collPrints_active'));
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
        $collPrints = CollectionPrint::find($id);
        $collPrints->update($request->all());

        if ($request->input('print_id')) {
            $collPrints->printModels()->detach();
            $collPrints->printModels()->attach($request->input('print_id'));
        }
        return redirect()->route('collections.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collPrints = CollectionPrint::find($id);
        $collPrints->printModels()->detach();
        $collPrints->delete();
        return redirect()->route('collections.index');
    }
}
