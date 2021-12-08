@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Akses user</div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('user.updateaksesuser', encrypt($user->id)) }}" method="POST" enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="POST">
                        @csrf
                        <div class="panel-body">
                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-left">{{ __('Nama user') }}</label>
    
                                <div class="col-md-4">
                                    <input id="name" type="text" readonly value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <label for="namauser" class="col-md-2 col-form-label text-md-left">{{ __('Duplikas menu user') }}</label>
    
                                <div class="col-md-4">
                                    <select id="namauser" type="text"  class="form-control" name="namauser" >
                                        <option value="">{{__('PILIH DATA')}}</option>
                                        @foreach ($menuuser as $key =>$value)
                                            <option value="{{$value->id}}">{{$value->nama_user}}</option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>
                            <div class="form-group row ">
                                <div class="table-responsive">
                                    <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
                                        <thead>
                                            <th width="5">Pilih</th>
                                            <th>Group menu</th>
                                            <th>Menu</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($menu as $key => $value)
                                                @php
                                                    $count = App\MenuUser::where('user_id',$user->id)->where('id_menu','like','%'.$value->id.'%')
                                                             ->get()->count();
                                                @endphp
                                                <tr>
                                                    <td width="5"><input type="checkbox" name="id_menu[]" value="{{$value->id}}" @if ($count > 0) checked @endif > </td>
                                                    <td>{{$value->nama_group}} </td>
                                                    <td>{{$value->name}} </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
    
                            <div class="form-group row ">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Ubah data') }}
                                    </button>
                                </div>
                            </div>
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
