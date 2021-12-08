<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupMenu;
use App\Menu;
use Alert;

class GroupMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $groupmenu = GroupMenu::orderby('order','ASC');
        if ($request->has('search')){
            $groupmenu = $groupmenu->where('name', 'like', '%'.$sort_search.'%');
        }
        $groupmenu = $groupmenu->paginate(10);
        return view('admin.groupmenu.index', compact('groupmenu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.groupmenu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nama_groupmenu = $request->groupmenu;

        $count = GroupMenu::where('name',$nama_groupmenu)->get()->count();

        if($count > 0){
            Alert::error('Data sudah ada.');
            return back();
        }

        $groupmenu = new GroupMenu;
        $groupmenu->name = $nama_groupmenu;

        if($groupmenu->save()){
            Alert::success('groupmenu has been inserted successfully');
            return redirect()->route('groupmenu.index');
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
        $groupmenu = GroupMenu::findOrFail(decrypt($id));
        return view('admin.groupmenu.edit', compact('groupmenu'));
    }

    public function detail($id)
    {
        $id_group_menu = $id;
        $menu = Menu::leftJoin('group_menus','group_menus.id','=','menus.id_group_menu')
                    ->select('menus.*','group_menus.name as nama_group')
                    ->orderby('id','DESC')
                     ->where('menus.id_group_menu',decrypt($id))->paginate(10);
        return view('admin.menu.index', compact('menu','id_group_menu'));
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
        $nama_groupmenu = $request->groupmenu;

        $count = GroupMenu::where('name',$nama_groupmenu)->where('id','<>',$id)->get()->count();

        if($count > 0){
            Alert::error('Data sudah ada.');
            return back();
        }

        $groupmenu = GroupMenu::findOrFail($id);
        $groupmenu->name = $nama_groupmenu;

        if($groupmenu->save()){
            Alert::success('groupmenu has been inserted successfully');
            return redirect()->route('groupmenu.index');
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
        $count = Menu::where('id_group_menu',$id)->get()->count();

        if($count > 0){
            Alert::error('Data tidak boleh dihapus');
            return back();
        }else{
            $groupmenu = GroupMenu::findOrFail($id);
            $groupmenu->delete();
            Alert::success('groupmenu has been deleted successfully');
            return redirect()->route('groupmenu.index');
        }
    }

    public function update_sort(Request $request){
        $posts = GroupMenu::all();

        foreach ($posts as $post) {
            foreach ($request->order as $order) {
                if ($order['id'] == $post->id) {
                    $post->update(['order' => $order['position']]);
                }
            }
        }

        Alert::success('groupmenu has been successfully');
    }

}
