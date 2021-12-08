

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Ubah unit</div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('unit.update', $unit->id) }}" method="POST" enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="PATCH">
                        @csrf
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="unit">{{__('Kantor')}}</label>
                                <div class="col-sm-10">
                                    <select id="id_kantor"  class="form-control" name="id_kantor" required >
                                        @php
                                            $kantor = App\Kantor::get();
                                        @endphp
                                        @foreach ($kantor as $key => $value)
                                            <option value="{{$value->id}}" @if ($value->id == $unit->id_kantor) selected @endif >{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="unit">{{__('unit')}}</label>
                                <div class="col-sm-10">
                                    <input type="text" name="unit" value="{{$unit->name}}" id="unit" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase()" required>
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
    $(document).ready(function() {
        $('#id_kantor').select2();
    });
</script>
@endsection
