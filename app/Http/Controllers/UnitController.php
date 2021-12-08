<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use App\Kantor;
use App\User;
use Alert;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $unit = Unit::leftJoin('kantors','kantors.id','=','units.id_kantor')
                      ->select('units.*','kantors.name as nama_kantor')
                      ->orderby('id','DESC');
        if ($request->has('search')){
            $unit = $unit->where('name', 'like', '%'.$sort_search.'%');
        }
        $unit = $unit->paginate(10);
        return view('admin.unit.index', compact('unit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.unit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nama_unit = $request->unit;
        $id_kantor = $request->id_kantor;

        $count = Unit::where('name',$nama_unit)->get()->count();

        if($count > 0){
            Alert::error('Data sudah ada.');
            return back();
        }

        $unit = new Unit;
        $unit->name = $nama_unit;
        $unit->id_kantor = $id_kantor;
        if($unit->save()){
            Alert::success('unit has been inserted successfully');
            return redirect()->route('unit.index');
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
        $unit = Unit::findOrFail(decrypt($id));
        return view('admin.unit.edit', compact('unit'));
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
        $nama_unit = $request->unit;
        $id_kantor = $request->id_kantor;
        $count = Unit::where('name',$nama_unit)->where('id','<>',$id)->get()->count();

        if($count > 0){
            Alert::error('Data sudah ada.');
            return back();
        }

        $unit = Unit::findOrFail($id);
        $unit->name = $nama_unit;
        $unit->id_kantor = $id_kantor;
        if($unit->save()){
            Alert::success('unit has been inserted successfully');
            return redirect()->route('unit.index');
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
        $count = User::where('id_unit',$id)->get()->count();

        if($count > 0){
            Alert::error('Data tidak boleh dihapus');
            return back();
        }else{
            $unit = Unit::findOrFail($id);
            $unit->delete();
            Alert::success('unit has been deleted successfully');
            return redirect()->route('unit.index');
        }

    }
}
