@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Ubah user</div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('user.update', encrypt($user->id)) }}" method="POST" enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="PATCH">
                        @csrf
                        <div class="panel-body">
                            <div class="form-group row">
                                <label for="nik" class="col-md-2 col-form-label text-md-left">{{ __('nik') }}</label>
    
                                <div class="col-md-4">
                                    <input id="nik" type="text" value="{{$user->nik}}" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('name') }}" required autocomplete="name" autofocus>
    
                                    @error('nik')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <label for="status" class="col-md-2 col-form-label text-md-left">{{ __('status') }}</label>
    
                                <div class="col-md-4">
                                    <select id="status" type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" required autocomplete="status" autofocus>
                                        <option value="0">Aktif</option>
                                        <option value="1">Non Aktif</option>
                                    </select>
    
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-left">{{ __('Name') }}</label>
    
                                <div class="col-md-4">
                                    <input id="name" type="text" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror" onkeyup="javascript:this.value=this.value.toUpperCase()" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <label for="email" class="col-md-2 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>
    
                                <div class="col-md-4">
                                    <input id="email" type="email" value="{{$user->email}}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="id_kantor" class="col-md-2 col-form-label text-md-left">{{ __('Kantor') }}</label>
                                <div class="col-md-4">
                                    <select id="id_kantor"  class="form-control" name="id_kantor" required >
                                        @php
                                            $kantor = App\Kantor::get();
                                        @endphp
                                        @foreach ($kantor as $key => $value)
                                            <option value="{{$value->id}}" @if ($value->id == $user->id_kantor) selected @endif>{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="id_unit" class="col-md-2 col-form-label text-md-left">{{ __('Unit') }}</label>
                                <div class="col-md-4">
                                    <select id="id_unit"  class="form-control" name="id_unit" required >
                                        @php
                                            $unit = App\Unit::get();
                                        @endphp
                                        @foreach ($unit as $key => $value)
                                            <option value="{{$value->id}}" @if ($value->id == $user->id_unit) selected @endif>{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id_jabatan" class="col-md-2 col-form-label text-md-left">{{ __('Jabatan') }}</label>
                                <div class="col-md-4">
                                    <select id="id_jabatan"  class="form-control" name="id_jabatan" required >
                                        @php
                                            $jabatan = App\Jabatan::where('id','>',1)->get();
                                        @endphp
                                        @foreach ($jabatan as $key => $value)
                                            <option value="{{$value->id}}" @if ($value->id == $user->id_jabatan) selected @endif>{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="id_divisi" class="col-md-2 col-form-label text-md-left">{{ __('Divisi') }}</label>
                                <div class="col-md-4">
                                    <select id="id_divisi"  class="form-control" name="id_divisi" required >
                                        @php
                                            $divisi = App\Divisi::get();
                                        @endphp
                                        @foreach ($divisi as $key => $value)
                                            <option value="{{$value->id}}" @if ($value->id == $user->id_divisi) selected @endif>{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id_rank" class="col-md-2 col-form-label text-md-left">{{ __('Rank') }}</label>
                                <div class="col-md-4">
                                    <select id="id_rank"  class="form-control" name="id_rank" required >
                                        @php
                                            $rank = App\Rank::get();
                                        @endphp
                                        @foreach ($rank as $key => $value)
                                            <option value="{{$value->id}}" @if ($value->id == $user->id_rank) selected @endif>{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="user_id_induk" class="col-md-2 col-form-label text-md-left">{{ __('Atasan') }}</label>
                                <div class="col-md-4">
                                    <select id="user_id_induk"  class="form-control" name="user_id_induk" required >
                                        @php
                                            $user = App\User::where('id','<>',$user->id)->get();
                                        @endphp
                                        <option value="0">{{__('TANPA ATASAN')}}</option>
                                        @foreach ($user as $key => $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
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
