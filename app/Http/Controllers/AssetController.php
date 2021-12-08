<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asset;
use App\User;
use Alert;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $asset = Asset::orderby('id','DESC');
        if ($request->has('search')){
            $asset = $asset->where('name', 'like', '%'.$sort_search.'%');
        }
        $asset = $asset->paginate(10);
        return view('admin.asset.index', compact('asset'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.asset.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nama_asset = $request->asset;

        $count = Asset::where('name',$nama_asset)->get()->count();

        if($count > 0){
            Alert::error('Data sudah ada.');
            return back();
        }

        $asset = new Asset;
        $asset->name = $nama_asset;

        if($asset->save()){
            Alert::success('asset has been inserted successfully');
            return redirect()->route('asset.index');
        }
        else{
            Alert::error('Something went wrong');
            return back();
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
        $asset = asset::findOrFail(decrypt($id));
        return view('admin.asset.edit', compact('asset'));
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
        $nama_asset = $request->asset;

        $count = asset::where('name',$nama_asset)->where('id','<>',$id)->get()->count();

        if($count > 0){
            Alert::error('Data sudah ada.');
            return back();
        }

        $asset = asset::findOrFail($id);
        $asset->name = $nama_asset;

        if($asset->save()){
            Alert::success('asset has been inserted successfully');
            return redirect()->route('asset.index');
        }
        else{
            Alert::error('Something went wrong');
            return back();
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
        $count = User::where('id_asset',$id)->get()->count();

        if($count > 0){
            Alert::error('Data tidak boleh dihapus');
            return back();
        }else{
            $asset = Asset::findOrFail($id);
            $asset->delete();
            Alert::success('asset has been deleted successfully');
            return redirect()->route('asset.index');
        }
    }
}
