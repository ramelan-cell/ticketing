

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Ubah menu</div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="PATCH">
                        @csrf
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="id_group_menu">{{__('Group Menu')}}</label>
                                <div class="col-sm-10">
                                    <select type="text" name="id_group_menu" id="id_group_menu" class="form-control" required>
                                        @foreach ($group_menu as $key => $value)
                                            <option value="{{$value->id}}" @if ($value->id == $menu->id_group_menu) selected @endif >{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="menu">{{__('menu')}}</label>
                                <div class="col-sm-10">
                                    <input type="text" name="menu" value="{{$menu->name}}" id="menu" class="form-control"  required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="route">{{__('route')}}</label>
                                <div class="col-sm-10">
                                    <input type="text" name="route" id="route" value="{{$menu->route}}" class="form-control" required>
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-primary btn-sm" type="submit"><span class="fa fa-save "></span>&nbsp;{{__('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
</div>
@endsection
@section('script')
    <script type="text/javascript">

    </script>
@endsection
