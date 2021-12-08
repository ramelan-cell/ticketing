<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rank;
use App\User;
use Alert;

class RankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $rank = Rank::orderby('id','DESC');
        if ($request->has('search')){
            $rank = $rank->where('name', 'like', '%'.$sort_search.'%');
        }
        $rank = $rank->paginate(10);
        return view('admin.rank.index', compact('rank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.rank.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nama_rank = $request->rank;

        $count = Rank::where('name',$nama_rank)->get()->count();

        if($count > 0){
            Alert::error('Data sudah ada.');
            return back();
        }

        $rank = new Rank;
        $rank->name = $nama_rank;

        if($rank->save()){
            Alert::success('rank has been inserted successfully');
            return redirect()->route('rank.index');
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
        $rank = Rank::findOrFail(decrypt($id));
        return view('admin.rank.edit', compact('rank'));
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
        $nama_rank = $request->rank;

        $count = Rank::where('name',$nama_rank)->where('id','<>',$id)->get()->count();

        if($count > 0){
            Alert::error('Data sudah ada.');
            return back();
        }

        $rank = Rank::findOrFail($id);
        $rank->name = $nama_rank;

        if($rank->save()){
            Alert::success('rank has been inserted successfully');
            return redirect()->route('rank.index');
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
        $count = User::where('id_rank',$id)->get()->count();

        if($count > 0){
            Alert::error('Data tidak boleh dihapus');
            return back();
        }else{
            $rank = Rank::findOrFail($id);
            $rank->delete();
            Alert::success('rank has been deleted successfully');
            return redirect()->route('rank.index');
        }
    }
}
