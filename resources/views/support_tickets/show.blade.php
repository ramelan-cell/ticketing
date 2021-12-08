@extends('layouts.app')

@section('content')

<div class="container">
    <div class="panel-body">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: orange">Ticketing</div>
                    <div class="card-body">
                        <div class="col-lg-10 col-lg-offset-1 pad-btm mar-btm">
                            <div class="panel">
                                <div class="pad-all bg-gray-light">
                                    <h3 class="mar-no">{{ $ticket->subject }} #{{ $ticket->code }}</h3>
                                     <ul class="mar-top list-inline">
                                        <li>{{ $ticket->user->name }}</li>
                                        <li>{{ $ticket->created_at }}</li>
                                        <li><span class="badge badge-pill badge-secondary">{{ ucfirst($ticket->status) }}</span></li>
                                    </ul>
                                </div>
                        
                                <div class="panel-body">
                                    <form class="" action="{{ route('support_ticket.admin_store') }}" method="post" id="ticket-reply-form" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="ticket_id" value="{{$ticket->id}}" required>
                                        <input type="hidden" name="status" value="{{ $ticket->status }}" required>
                                        <div class="form-group">
                                            <textarea class="form-control" name="reply"  required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="file" name="attachments[]" class="form-control" multiple>
                                        </div>
                                        <div class="form-group text-right pos-rel">
                                            <button type="button" class="btn btn-primary" onclick="submit_reply('pending')">Submit as <strong>{{ ucfirst($ticket->status) }}</strong></button>
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right" style="font-size: 13px;padding: 20px;">
                                                <li onclick="submit_reply('open')"><a href="#">Submit as <strong>Open</strong></a></li>
                                                <li onclick="submit_reply('solved')"><a href="#">Submit as <strong>Solved</strong></a></li>
                                            </ul>
                                        </div>
                                    </form>
                                    <div class="pad-top">
                                        @foreach($ticket->ticketreplies as $ticketreply)
                                            <div class="media bord-top pad-top">
                                                <a class="media-left" href="#">
                                                    <img class="img-circle img-sm" src="{{ asset('frontend/images/user.png') }}" width="50">
                                                </a>
                                                <div class="media-body" style="padding:20px;">
                                                    <div class="comment-header" >
                                                        <a href="#" class="media-heading box-inline text-main text-bold">{{ $ticketreply->user->name }}</a>
                                                        <p class="text-muted text-sm">{{$ticketreply->created_at}}</p>
                                                    </div>
                                                    <div>
                                                        @php
                                                            echo $ticketreply->reply;
                                                        @endphp
                                                        @if($ticketreply->files != null && is_array(json_decode($ticketreply->files)))
                                                            <div>
                                                                @foreach (json_decode($ticketreply->files) as $key => $file)
                                                                    <div>
                                                                        <a href="{{ asset($file->path) }}" download="{{ $file->name }}" class="support-file-attach bg-gray pad-all rounded">
                                                                            <div class="d-flex">
                                                                                <div class="flex-grow-1 minw-0">
                                                                                    <div class="text-truncate">
                                                                                        <img src="{{ asset($file->path) }}" width="100">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="media bord-top pad-top">
                                            <img class="img-circle img-sm" src="{{ asset('frontend/images/user.png') }}" width="50">
                                            
                                            <div class="media-body" style="padding:20px;">
                                                <div class="comment-header">
                                                    <a href="#" class="media-heading box-inline text-main text-bold">{{ $ticket->user->name }}</a>
                                                    <p class="text-muted text-sm">{{$ticket->created_at}}</p>
                                                </div>
                                                <p>
                                                    @php
                                                        echo $ticket->details;
                                                    @endphp
                                                    @if($ticket->files != null && is_array(json_decode($ticket->files)))
                                                        <div>
                                                            @foreach (json_decode($ticket->files) as $key => $file)
                                                                <div>
                                                                    <a href="{{ asset($file->path) }}" download="{{ $file->name }}" class="support-file-attach bg-gray pad-all rounded">
                                                                        <div class="d-flex">
                                                                            <div class="flex-grow-1 minw-0">
                                                                                <div class="text-truncate">
                                                                                    <img src="{{ asset($file->path) }}" width="100">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </p>
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
        
    </div>
</div>



@endsection

@section('script')
    <script type="text/javascript">
        function submit_reply(status){
            $('input[name=status]').val(status);
            if($('textarea[name=reply]').val().length > 0){
                $('#ticket-reply-form').submit();
            }
        }
    </script>
@endsection
