@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('menu.create')}}" class="btn btn-rounded btn-primary btn-sm"><span class="fa fa-plus"></span>&nbsp;{{__('Tambah')}}</a>&nbsp;
            {{-- <a href="{{ route('groupmenu.index')}}" class="btn btn-rounded btn-danger btn-sm"><span class="fa fa-backward"></span>&nbsp;{{__('kembali')}}</a> --}}
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: orange">Master menu</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Nama Group')}}</th>
                                    <th>{{__('Nama menu')}}</th>
                                    <th>{{__('Route')}}</th>
                                    <th width="10%" colspan="2"><center>{{__('Action')}}</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($menu as $key => $value)
                                    <tr>
                                        <td>{{ ($key+1) + ($menu->currentPage() - 1)*$menu->perPage() }}</td>
                                        <td>{{$value->nama_group ? $value->nama_group :''}}</td>
                                        <td>{{$value->name ? $value->name :''}}</td>
                                        <td>{{$value->route ? $value->route :''}}</td>
                                        <td> <a href="{{route('menu.edit', encrypt($value->id))}}" class="btn btn-success btn-sm"><span class="fa fa-edit"></span>&nbsp;{{('Edit')}}</a></td>
                                        <td>
                                            <form action="{{ route('menu.destroy', $value->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit"><span class="fa fa-trash"></span>&nbsp;Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix">
                        <div class="pull-right">
                            {{ $menu->appends(request()->input())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script type="text/javascript">
        function sort_brands(el){
            $('#sort_brands').submit();
        }
    </script>
@endsection
