<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kantor;
use App\User;
use Alert;

class KantorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $sort_search = null;
        $kantor = Kantor::orderby('id','DESC');
        if ($request->has('search')){
            $kantor = $kantor->where('name', 'like', '%'.$sort_search.'%');
        }
        $kantor = $kantor->paginate(10);
        return view('admin.kantor.index', compact('kantor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kantor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nama_kantor = $request->kantor;

        $count = Kantor::where('name',$nama_kantor)->get()->count();

        if($count > 0){
            Alert::error('Data sudah ada.');
            return back();
        }

        $kantor = new Kantor;
        $kantor->name = $nama_kantor;

        if($kantor->save()){
            Alert::success('Kantor has been inserted successfully');
            return redirect()->route('kantor.index');
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
        $kantor = Kantor::findOrFail(decrypt($id));
        return view('admin.kantor.edit', compact('kantor'));
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
        $nama_kantor = $request->kantor;

        $count = Kantor::where('name',$nama_kantor)->where('id','<>',$id)->get()->count();

        if($count > 0){
            Alert::error('Data sudah ada.');
            return back();
        }

        $kantor = Kantor::findOrFail($id);
        $kantor->name = $nama_kantor;

        if($kantor->save()){
            Alert::success('Kantor has been inserted successfully');
            return redirect()->route('kantor.index');
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
        $count = User::where('id_kantor',$id)->get()->count();

        if($count > 0){
            Alert::error('Data tidak boleh dihapus');
            return back();
        }else{
            $kantor = Kantor::findOrFail($id);
            $kantor->delete();
            Alert::success('Kantor has been deleted successfully');
            return redirect()->route('kantor.index');
        }

        
    }
}
