

@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <div class="col-md-4">
        <div class="pull-right">
            <form class="" id="sort_support" action="" method="GET">
                <div class="box-inline pad-rgt pull-right">
                    <div style="display:flex">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type ticket code & Enter">&nbsp;
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <hr width="100%"> --}}
    <div class="panel-body">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: orange">Ticketing</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>{{ __('Ticket ID') }}</th>
                                        <th>{{ __('Sending Date') }}</th>
                                        <th>{{ __('Subject') }}</th>
                                        <th>{{ __('User') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Last reply') }}</th>
                                        <th>{{ __('Options') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($tickets as $key => $ticket)
                                        @if ($ticket->user != null)
                                            <tr>
                                                <td>#{{ $ticket->code }}</td>
                                                <td>{{ $ticket->created_at }} @if($ticket->viewed == 0) <span class="pull-right badge badge-info">{{ __('New') }}</span> @endif</td>
                                                <td>{{ $ticket->subject }}</td>
                                                <td>{{ $ticket->user->name }}</td>
                                                <td>
                                                    @if ($ticket->status == 'pending')
                                                        <span class="badge badge-pill badge-danger">Pending</span>
                                                    @elseif ($ticket->status == 'open')
                                                        <span class="badge badge-pill badge-secondary">Open</span>
                                                    @else
                                                        <span class="badge badge-pill badge-success">Solved</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (count($ticket->ticketreplies) > 0)
                                                        {{ $ticket->ticketreplies->last()->created_at }}
                                                    @else
                                                        {{ $ticket->created_at }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{route('support_ticket.admin_show', encrypt($ticket->id))}}" class="btn-link" style="font-size: 12px;">{{__('View Details')}}</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="clearfix">
                            <div class="pull-right">
                                {{ $tickets->appends(request()->input())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
