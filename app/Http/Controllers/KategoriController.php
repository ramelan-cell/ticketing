<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use App\User;
use Alert;

class kategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $kategori = Kategori::orderby('id','DESC');
        if ($request->has('search')){
            $kategori = $kategori->where('name', 'like', '%'.$sort_search.'%');
        }
        $kategori = $kategori->paginate(10);
        return view('admin.kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nama_kategori = $request->kategori;

        $count = Kategori::where('name',$nama_kategori)->get()->count();

        if($count > 0){
            Alert::error('Data sudah ada.');
            return back();
        }

        $kategori = new Kategori;
        $kategori->name = $nama_kategori;

        if($kategori->save()){
            Alert::success('kategori has been inserted successfully');
            return redirect()->route('kategori.index');
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
        $kategori = Kategori::findOrFail(decrypt($id));
        return view('admin.kategori.edit', compact('kategori'));
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
        $nama_kategori = $request->kategori;

        $count = Kategori::where('name',$nama_kategori)->where('id','<>',$id)->get()->count();

        if($count > 0){
            Alert::error('Data sudah ada.');
            return back();
        }

        $kategori = kategori::findOrFail($id);
        $kategori->name = $nama_kategori;

        if($kategori->save()){
            Alert::success('kategori has been inserted successfully');
            return redirect()->route('kategori.index');
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
        $count = User::where('id_kategori',$id)->get()->count();

        if($count > 0){
            Alert::error('Data tidak boleh dihapus');
            return back();
        }else{
            $kategori = Kategori::findOrFail($id);
            $kategori->delete();
            Alert::success('kategori has been deleted successfully');
            return redirect()->route('kategori.index');
        }
    }
}
