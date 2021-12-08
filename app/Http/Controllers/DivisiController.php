<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Divisi;
use App\User;
use Alert;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $divisi = Divisi::orderby('id','DESC');
        if ($request->has('search')){
            $divisi = $divisi->where('name', 'like', '%'.$sort_search.'%');
        }
        $divisi = $divisi->paginate(10);
        return view('admin.divisi.index', compact('divisi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.divisi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nama_divisi = $request->divisi;

        $count = Divisi::where('name',$nama_divisi)->get()->count();

        if($count > 0){
            Alert::error('Data sudah ada.');
            return back();
        }

        $divisi = new Divisi;
        $divisi->name = $nama_divisi;

        if($divisi->save()){
            Alert::success('divisi has been inserted successfully');
            return redirect()->route('divisi.index');
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
        $divisi = Divisi::findOrFail(decrypt($id));
        return view('admin.divisi.edit', compact('divisi'));
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
        $nama_divisi = $request->divisi;

        $count = Divisi::where('name',$nama_divisi)->where('id','<>',$id)->get()->count();

        if($count > 0){
            Alert::error('Data sudah ada.');
            return back();
        }

        $divisi = Divisi::findOrFail($id);
        $divisi->name = $nama_divisi;

        if($divisi->save()){
            Alert::success('divisi has been inserted successfully');
            return redirect()->route('divisi.index');
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
        $count = User::where('id_divisi',$id)->get()->count();

        if($count > 0){
            Alert::error('Data tidak boleh dihapus');
            return back();
        }else{
            $divisi = Divisi::findOrFail($id);
            $divisi->delete();
            Alert::success('divisi has been deleted successfully');
            return redirect()->route('divisi.index');
        }
    }
}
