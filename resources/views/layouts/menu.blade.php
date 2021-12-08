@php
    $id_jabatan = Auth::user()->id_jabatan;
    $count  = App\MenuUser::where('user_id',Auth::user()->id)->where('id_jabatan',$id_jabatan)->get()->count();
    if($count == 0){
        $id_group_menu  = App\MenuUser::where('id_jabatan','2')->first()->id_group_menu;
        $id_menu  = App\MenuUser::where('id_jabatan','2')->first()->id_menu;
    }else{
        $id_group_menu  = App\MenuUser::where('user_id',Auth::user()->id)->where('id_jabatan',$id_jabatan)->first()->id_group_menu;
        $id_menu  = App\MenuUser::where('user_id',Auth::user()->id)->where('id_jabatan',$id_jabatan)->first()->id_menu;
    }
    $group_menu = DB::select("SELECT * FROM group_menus WHERE id in ($id_group_menu) ORDER BY `order` ASC ");
    $menus = DB::select("SELECT * FROM menus WHERE id in ($id_menu) ORDER BY `id` ASC ");
@endphp

@foreach ($group_menu as $key => $group)
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="{{$key}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      {{$group->name}}
    </a>
    <div class="dropdown-menu" aria-labelledby="{{$key}}">
       @foreach (App\Menu::where('id_group_menu',$group->id)->get() as $key => $menu)
            @foreach ($menus as $item)
                @if ($item->id == $menu->id)
                <a class="dropdown-item" href="{{route($menu->route)}}">{{$menu->name}}</a> 
                @endif
            @endforeach
            
       @endforeach
    </div>
</li> 
@endforeach
<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
       Hallo ! {{ Auth::user()->name }}
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</li>