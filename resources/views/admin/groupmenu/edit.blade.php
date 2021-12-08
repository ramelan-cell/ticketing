

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Ubah grou pmenu</div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('groupmenu.update', $groupmenu->id) }}" method="POST" enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="PATCH">
                        @csrf
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="groupmenu">{{__('groupmenu')}}</label>
                                <div class="col-sm-10">
                                    <input type="text" name="groupmenu" value="{{$groupmenu->name}}" id="groupmenu" class="form-control"  required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="order">{{__('no urut')}}</label>
                                <div class="col-sm-10">
                                    <input type="text" name="order" value="{{$groupmenu->order}}" id="order" class="form-control"  required>
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
