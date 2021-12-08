@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tambah unit</div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('unit.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="unit">{{__('Kantor')}}</label>
                                <div class="col-sm-10">
                                    <select id="id_kantor"  class="form-control" name="id_kantor" >
                                        @php
                                            $kantor = App\Kantor::get();
                                        @endphp
                                        @foreach ($kantor as $key => $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="unit">{{__('unit')}}</label>
                                <div class="col-sm-10">
                                    <input type="text" name="unit" id="unit" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase()" required>
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-primary btn-sm" type="submit"><span class="fa fa-save "></span>&nbsp;{{__('Simpan')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#id_kantor').select2();
    });
</script>
@endsection
