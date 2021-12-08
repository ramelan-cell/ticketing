@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <div class="panel panel-primary">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="col-xs-3">
                                            <i class="fa fa-id-card fa-5x"></i>
                                        </div>
                                        <div class="col-lg-12 text-right">
                                            @php
                                               $total_user =   App\User::where('id','>','1')->get()->count();
                                            @endphp
                                            <div class="huge"><h5>{{$total_user}}</h5></div>
                                            <div><h5>Pengguna</h5></div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#">
                                            <div class="panel-footer">
                                                <span class="pull-left"></span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <div class="panel panel-primary">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="col-xs-3">
                                            <i class="fa fa-ticket fa-5x"></i>
                                        </div>
                                        <div class="col-lg-12 text-right">
                                            @php
                                               $total_open =   App\Ticket::where('status','open')->get()->count();
                                            @endphp
                                            <div class="huge"><h5>{{$total_open}}</h5></div>
                                            <div><h5>Ticket Open</h5></div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#">
                                            <div class="panel-footer">
                                                <span class="pull-left"></span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <div class="panel panel-primary">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="col-xs-3">
                                            <i class="fa fa-ticket fa-5x"></i>
                                        </div>
                                        <div class="col-lg-12 text-right">
                                            @php
                                               $total_solved =   App\Ticket::where('status','solved')->get()->count();
                                            @endphp
                                            <div class="huge"><h5>{{$total_solved}}</h5></div>
                                            <div><h5>Solved</h5></div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#">
                                            <div class="panel-footer">
                                                <span class="pull-left"></span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <div class="panel panel-primary">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="col-xs-3">
                                            <i class="fa fa-ticket fa-5x"></i>
                                        </div>
                                        <div class="col-lg-12 text-right">
                                            @php
                                               $total_solved =   App\Ticket::where('status','pending')->get()->count();
                                            @endphp
                                            <div class="huge"><h5>{{$total_solved}}</h5></div>
                                            <div><h5>Pending</h5></div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#">
                                            <div class="panel-footer">
                                                <span class="pull-left"></span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                
                            </div>
                        </div> 
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
