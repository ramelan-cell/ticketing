<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupMenu;
use App\MenuUser;
use App\Menu;
use Alert;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $sort_search = null;
        $menu = Menu::leftJoin('group_menus','group_menus.id','=','menus.id_group_menu')
                    ->select('menus.*','group_menus.name as nama_group')
                    ->orderby('menus.id_group_menu','ASC')
                    ->orderby('menus.id','DESC');
        if ($request->has('search')){
            $menu = $menu->where('name', 'like', '%'.$sort_search.'%');
        }
        $menu = $menu->paginate(10);
        return view('admin.menu.index', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $group_menu = GroupMenu::get();
        return view('admin.menu.create',compact('group_menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nama_menu = $request->menu;
        $route = $request->route;
        $id_group_menu = $request->id_group_menu;

        $count = Menu::where('name',$nama_menu)->get()->count();

        if($count > 0){
            Alert::error('Data sudah ada.');
            return back();
        }

        $menu = new Menu;
        $menu->id_group_menu = $id_group_menu;
        $menu->name = $nama_menu;
        $menu->route = $route;

        if($menu->save()){
            Alert::success('menu has been inserted successfully');
            return redirect()->route('menu.index',compact('id_group_menu'));
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
        $menu = Menu::findOrFail(decrypt($id));
        $group_menu = GroupMenu::get();
        return view('admin.menu.edit', compact('menu','group_menu'));
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
        $nama_menu = $request->menu;
        $route = $request->route;

        $count = Menu::where('name',$nama_menu)->where('id','<>',$id)->get()->count();

        if($count > 0){
            Alert::error('Data sudah ada.');
            return back();
        }

        $menu = Menu::findOrFail($id);
        $menu->name = $nama_menu;
        $menu->route = $route;

        if($menu->save()){
            Alert::success('menu has been inserted successfully');
            return redirect()->route('menu.index');
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
        $count = MenuUser::where('id_menu','LIKE','%'.$id.'%')->get()->count();

        if($count > 0){
            Alert::error('Data tidak boleh dihapus');
            return back();
        }else{
            $menu = Menu::findOrFail($id);
            $menu->delete();
            Alert::success('menu has been deleted successfully');
            return redirect()->route('menu.index');
        }
    }

   
}
