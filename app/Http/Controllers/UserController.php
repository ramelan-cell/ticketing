<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\MenuUser;
use App\Menu;
use App\GroupMenu;
use Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $user = User::leftJoin('kantors','kantors.id','=','users.id_kantor') 
                     ->leftJoin('units','units.id','=','users.id_unit')
                     ->leftJoin('divisis','divisis.id','=','users.id_divisi')
                     ->leftJoin('jabatans','jabatans.id','=','users.id_jabatan')
                     ->leftJoin('ranks','ranks.id','=','users.id_rank')
                     ->where('users.status','0')
                     ->select('users.*','kantors.name as nama_kantor','units.name as nama_unit',
                              'divisis.name as nama_divisi','ranks.name as nama_rank','jabatans.name as nama_jabatan')
                     ->orderby('id','DESC');
        if ($request->has('search')){
            $user = $user->where('name', 'like', '%'.$sort_search.'%');
        }
        $user = $user->paginate(10);
        return view('admin.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validatedData = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'id_kantor'=>['required'],
            'id_unit'=>['required'],
            'id_jabatan'=>['required'],
            'id_divisi'=>['required'],
            'id_rank'=>['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = new User;
        $user->username = $request->username;
        $user->nik = $request->nik;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->id_kantor = $request->id_kantor;
        $user->id_unit = $request->id_unit;
        $user->id_jabatan = $request->id_jabatan;
        $user->id_divisi = $request->id_divisi;
        $user->id_rank = $request->id_rank;
        $user->password = Hash::make($request->password);

        if($user->save()){
            Alert::success('User has been inserted successfully');
            return redirect()->route('user.index');
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
        $user = User::findOrFail(decrypt($id));
        return view('admin.user.edit', compact('user'));
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
        $validatedData = $request->validate([
            'nik' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'id_kantor'=>['required'],
            'id_unit'=>['required'],
            'id_jabatan'=>['required'],
            'id_divisi'=>['required'],
            'id_rank'=>['required'],
            'status'=>['required']
        ]);

        $user = User::find(decrypt($id));
        $user->nik = $request->nik;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->id_kantor = $request->id_kantor;
        $user->id_unit = $request->id_unit;
        $user->id_jabatan = $request->id_jabatan;
        $user->id_divisi = $request->id_divisi;
        $user->id_rank = $request->id_rank;
        $user->status = $request->status;

        if($user->save()){
            Alert::success('User has been updated successfully');
            return redirect()->route('user.index');
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
        //
    }

    public function aksesuser($id){
        $idakses = $id;
        $user = User::find(decrypt($id));
        $menuuser = MenuUser::leftJoin('users','users.id','=','menu_users.user_id')
                    ->select('menu_users.*','users.name as nama_user')
                    ->where('menu_users.user_id','<>',$user->id)
                    ->get();
        $menu = Menu::leftJoin('group_menus','group_menus.id','=','menus.id_group_menu')
                    ->select('menus.*','group_menus.name as nama_group')
                    ->orderBy('group_menus.id','ASC')
                    ->get();
        return view('admin.user.aksesuser', compact('idakses','user','menuuser','menu'));
    }

    public function update_aksesuser(Request $request,$id){
        $id_user = decrypt($id);
        $id_menu_array = $request->id_menu;
        $idmenu ="";
        $id_group_menu ="";
        $namauser = $request->namauser;
        
        if(empty($namauser)){

            foreach ($id_menu_array as $key => $value) {
                $idmenu .= $value.",";
            }
            $idmenu = substr($idmenu,0,strlen($idmenu) - 1);
            $id_group_menus = DB::select("SELECT DISTINCT id_group_menu FROM menus WHERE id in ($idmenu) ORDER BY id ASC ");
    
            foreach ($id_group_menus as $key => $value) {
                $id_group_menu .= $value->id_group_menu.",";
            }
            $id_group_menu = substr($id_group_menu,0,strlen($id_group_menu) - 1);

            $count = MenuUser::where('user_id',$id_user)->get()->count();

            if($count == 0){
                $menuuser = new MenuUser;
                $menuuser->user_id = $id_user;
                $menuuser->id_jabatan = User::where('id',$id_user)->first()->id_jabatan;
                $menuuser->id_group_menu = $id_group_menu;
                $menuuser->id_menu = $idmenu;
                if($menuuser->save()){
                    Alert::success('User has been inserted successfully');
                    return redirect()->route('user.index');
                }
                else{
                    Alert::error('Something went wrong');
                    return back();
                }
            }else{

                $menuuser = MenuUser::where('user_id',$id_user)->first();
                $menuuser->user_id = $id_user;
                $menuuser->id_jabatan = User::where('id',$id_user)->first()->id_jabatan;
                $menuuser->id_group_menu = $id_group_menu;
                $menuuser->id_menu = $idmenu;
                if($menuuser->update()){
                    Alert::success('User has been inserted successfully');
                    return redirect()->route('user.index');
                }
                else{
                    Alert::error('Something went wrong');
                    return back();
                }
            }
        }else{
            $count = MenuUser::where('user_id',$id_user)->get()->count();

            if($count == 0){
                $menu_user = MenuUser::where('user_id',$namauser)->first();

                $menuuser = new MenuUser;
                $menuuser->user_id = $id_user;
                $menuuser->id_jabatan = User::where('id',$id_user)->first()->id_jabatan;
                $menuuser->id_group_menu = $menu_user->id_group_menu;
                $menuuser->id_menu = $menu_user->id_menu;
                if($menuuser->save()){
                    Alert::success('User has been inserted successfully');
                    return redirect()->route('user.index');
                }
                else{
                    Alert::error('Something went wrong');
                    return back();
                }
            }else{

                foreach ($id_menu_array as $key => $value) {
                    $idmenu .= $value.",";
                }
                $idmenu = substr($idmenu,0,strlen($idmenu) - 1);
                $id_group_menus = DB::select("SELECT DISTINCT id_group_menu FROM menus WHERE id in ($idmenu) ORDER BY id ASC ");
        
                foreach ($id_group_menus as $key => $value) {
                    $id_group_menu .= $value->id_group_menu.",";
                }
                $id_group_menu = substr($id_group_menu,0,strlen($id_group_menu) - 1);

                $menuuser = MenuUser::where('user_id',$id_user)->first();
                $menuuser->user_id = $id_user;
                $menuuser->id_jabatan = User::where('id',$id_user)->first()->id_jabatan;
                $menuuser->id_group_menu = $id_group_menu;
                $menuuser->id_menu = $idmenu;
                if($menuuser->update()){
                    Alert::success('User has been inserted successfully');
                    return redirect()->route('user.index');
                }
                else{
                    Alert::error('Something went wrong');
                    return back();
                }
            }
        }

    }
}
