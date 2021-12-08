

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="panel-body">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="pull-right">
                    <form class="" id="sort_support" action="" method="GET">
                        <div class="box-inline pad-rgt pull-right">
                            <div style="display:flex">
                                {{-- <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type ticket code & Enter">&nbsp;
                                <button type="submit" class="btn btn-primary">Cari</button>&nbsp; --}}
                                <a href="#" data-toggle="modal" data-target="#ticket_modal" class="btn btn-primary"><span class="fa fa-plus"></span>&nbsp;{{__('Tambah')}}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr width="100%">
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
                                        <th>{{__('Subject')}}</th>
                                        <th>{{__('Status')}}</th>
                                        <th>{{__('Options')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($tickets) > 0)
                                        @foreach ($tickets as $key => $ticket)
                                            <tr>
                                                <td>#{{ $ticket->code }}</td>
                                                <td>{{ $ticket->created_at }}</td>
                                                <td>{{ $ticket->subject }}</td>
                                                <td>
                                                    @if ($ticket->status == 'pending')
                                                        <span class="badge badge-pill badge-danger">{{__('Pending')}}</span>
                                                    @elseif ($ticket->status == 'open')
                                                        <span class="badge badge-pill badge-secondary">{{__('Open')}}</span>
                                                    @else
                                                        <span class="badge badge-pill badge-success">{{__('Solved')}}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{route('support_ticket_user.show', encrypt($ticket->id))}}" class="btn-link">
                                                        {{__('View Details')}}
                                                        <i class="la la-angle-right text-sm"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center pt-5 h4" colspan="100%">
                                                <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                                                <span class="d-block">{{ __('No history found.') }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                {{ $tickets->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="ticket_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5">{{__('Create a Ticket')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-3 pt-3">
                <form class="" action="{{ route('support_ticket_user.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Subject <span class="text-danger">*</span></label>
                        <input type="text" class="form-control mb-3" name="subject" placeholder="Subject" required>
                    </div>
                    <div class="form-group">
                        <label>Provide a detailed description <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="details" placeholder="Type your reply" ></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="attachments[]" id="file-2" class="custom-input-file custom-input-file--2" data-multiple-caption="{count} files selected" multiple />
                        {{-- <label for="file-2" class=" mw-100 mb-0">
                            <i class="fa fa-upload"></i>
                            <span>Attach files.</span>
                        </label> --}}
                    </div>
                    <div class="text-right mt-4">
                        {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('cancel')}}</button> --}}
                        <button type="submit" class="btn btn-primary">{{__('Send Ticket')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

