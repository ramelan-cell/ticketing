@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('groupmenu.create')}}" class="btn btn-rounded btn-primary btn-sm"><span class="fa fa-plus"></span>&nbsp;{{__('Tambah')}}</a>
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
                <div class="card-header" style="background-color: orange">Master groupmenu</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Nama groupmenu')}}</th>
                                    <th width="10%" colspan="3"><center>{{__('Action')}}</center></th>
                                </tr>
                            </thead>
                            <tbody id="tablecontents">
                                @foreach($groupmenu as $key => $value)
                                    <tr class="row1" data-id="{{ $value->id }}">
                                        <td>{{ ($key+1) + ($groupmenu->currentPage() - 1)*$groupmenu->perPage() }}</td>
                                        <td>{{$value->name ? $value->name :''}}</td>
                                        {{-- <td> <a href="{{route('menu.detail', encrypt($value->id))}}" class="btn btn-warning btn-sm"><span class="fa fa-pencil"></span>&nbsp;{{('Detail')}}</a></td> --}}
                                        <td> <a href="{{route('groupmenu.edit', encrypt($value->id))}}" class="btn btn-success btn-sm"><span class="fa fa-edit"></span>&nbsp;{{('Edit')}}</a></td>
                                        <td>
                                            <form action="{{ route('groupmenu.destroy', $value->id)}}" method="post">
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
                            {{ $groupmenu->appends(request()->input())->links() }}
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
