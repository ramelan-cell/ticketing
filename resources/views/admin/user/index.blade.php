@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('user.create')}}" class="btn btn-rounded btn-primary btn-sm"><span class="fa fa-plus"></span>&nbsp;{{__('Tambah')}}</a>
        </div>
        {{-- <div class="col-md-8">
            <form class="" id="sort_brands" action="" method="GET">
                <div class="box-inline pad-rgt pull-right">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder=" Type name & Enter">
                    </div>
                </div>
            </form>
        </div> --}}
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: orange">Master user</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="10%" colspan="2"><center>{{__('Action')}}</center></th>
                                    <th>{{__('NIK')}}</th>
                                    <th>{{__('Nama Lengkap')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Kantor')}}</th>
                                    <th>{{__('Unit')}}</th>
                                    <th>{{__('Jabatan')}}</th>
                                    <th>{{__('Divisi')}}</th>
                                    <th>{{__('Rank')}}</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user as $key => $value)
                                    <tr>
                                        <td>{{ ($key+1) + ($user->currentPage() - 1)*$user->perPage() }}</td>
                                        <td> <a href="{{route('user.aksesuser', encrypt($value->id))}}" class="btn btn-info btn-sm"><span class="fa fa-cog"></span>&nbsp;{{('akses menu')}}</a></td>
                                        <td> <a href="{{route('user.edit', encrypt($value->id))}}" class="btn btn-success btn-sm"><span class="fa fa-edit"></span>&nbsp;{{('Edit')}}</a></td>
                                        {{-- <td>
                                            <form action="{{ route('user.destroy', $value->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit"><span class="fa fa-trash"></span>&nbsp;Delete</button>
                                            </form>
                                        </td> --}}
                                        <td>{{$value->nik ? $value->nik :''}}</td>
                                        <td>{{$value->name ? $value->name :''}}</td>
                                        <td>{{$value->email ? $value->email :''}}</td>
                                        <td>{{$value->nama_kantor ? $value->nama_kantor:''}}</td>
                                        <td>{{$value->nama_unit ? $value->nama_unit :''}}</td>
                                        <td>{{$value->nama_jabatan ? $value->nama_jabatan :''}}</td>
                                        <td>{{$value->nama_divisi ? $value->nama_divisi :''}}</td>
                                        <td>{{$value->nama_rank ? $value->nama_rank :''}}</td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix">
                        <div class="pull-right">
                            {{ $user->appends(request()->input())->links() }}
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
