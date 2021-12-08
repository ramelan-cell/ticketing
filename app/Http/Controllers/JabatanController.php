<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jabatan;
use App\User;
use Alert;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $jabatan = Jabatan::orderby('id','DESC');
        if ($request->has('search')){
            $jabatan = $jabatan->where('name', 'like', '%'.$sort_search.'%');
        }
        $jabatan = $jabatan->paginate(10);
        return view('admin.jabatan.index', compact('jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nama_jabatan = $request->jabatan;

        $count = Jabatan::where('name',$nama_jabatan)->get()->count();

        if($count > 0){
            Alert::error('Data sudah ada.');
            return back();
        }

        $jabatan = new Jabatan;
        $jabatan->name = $nama_jabatan;

        if($jabatan->save()){
            Alert::success('jabatan has been inserted successfully');
            return redirect()->route('jabatan.index');
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
        $jabatan = Jabatan::findOrFail(decrypt($id));
        return view('admin.jabatan.edit', compact('jabatan'));
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
        $nama_jabatan = $request->jabatan;

        $count = Jabatan::where('name',$nama_jabatan)->where('id','<>',$id)->get()->count();

        if($count > 0){
            Alert::error('Data sudah ada.');
            return back();
        }

        $jabatan = Jabatan::findOrFail($id);
        $jabatan->name = $nama_jabatan;

        if($jabatan->save()){
            Alert::success('jabatan has been inserted successfully');
            return redirect()->route('jabatan.index');
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
        $count = User::where('id_jabatan',$id)->get()->count();

        if($count > 0){
            Alert::error('Data tidak boleh dihapus');
            return back();
        }else{
            $jabatan = Jabatan::findOrFail($id);
            $jabatan->delete();
            Alert::success('jabatan has been deleted successfully');
            return redirect()->route('jabatan.index');
        }
    }
}
