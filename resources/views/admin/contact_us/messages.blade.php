@extends('layouts.admin')

@section('css')
    <style>


    </style>
@endsection


@section('page', 'Messages')
@section('content')

    @if(isset($mails) && count($mails)>0)
        <div class="col-lg-12 col-md-12 row p-0 m-0">
            <div class="col-lg-12 col-md-12 col-sm-12" style="clear: both">
                <div class="col-lg-12 col-md-12 mt-3 float-left" style="background-color:#bfc2c3">
                    @foreach($mails as $key => $message)
                        <div class="col-lg-12 col-md-12 alert my_form_color pb-0 row ml-1 mt-3">
                            <p data-id="{{$message->id}}"
                               class=" read_contact_message message_cursor col-lg-6 col-md-4 col-sm-7 col-xs-12">
                                <i class="fas fa-envelope " style="padding-right: 2px;border: 1px solid #007d00;color: #5ac16f;padding-left: 2px;">
                                </i> From: <b>{{$message->name}}</b>
                            </p>
                            <p data-id="{{$message->id}}" id="read-{{$message->id}}"
                               class="col-lg-3 col-md-3 col-sm-2 col-xs-6 set_read_status message_cursor"><i
                                        class="fas fa-envelope-open message_open_icon"></i> Mark read</p>
                            <div class="col-lg-3 col-md-5"><p><a href="{{route('admin.dialog.history', $message->id)}}"><i
                                                class="fas fa-reply"></i>View
                                        Dialog History</a></p></div>

                        </div>

                        <div class="hidden message" id="{{"message-$message->id"}}">
                            <div class="ml-2">
                            <p><b>EMAIL</b> {{$message->email}}</p>
                            <p><b>MESSAGE</b> {{$message->message}}</p>
                            </div>
                            <form id="answer_message_form" method="POST" action="{{route('admin.message.answer', $message->id)}}">
                                    {{ csrf_field() }}
                                    <div class="form-group"> <!-- Message field -->
                                        <label class="control-label message_to white" for="message"></label>
                                        <textarea class="form-control" cols="40" id="message" name="message" rows="5" placeholder="Type your message here..."></textarea>
                                        @if ($errors->has('message'))
                                            <span class="help-block  text-danger">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success btn-md" name="submit" type="submit">Send</button>
                                    </div>
                                </form>
                        </div>
                    @endforeach
                    <div class="col-lg-12 d-flex justify-content-center">
                        {{ $mails->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert text-info col-md-12" role="alert">
            <p>No Message yet</p>
        </div>
    @endif

    {{--<div class="alert alert-info">--}}
    {{--<a href="https://www.facebook.com/sharer/sharer.php?u=http://restaurant2.brainfors.am/admin&display=popup">--}}
    {{--Testing facebook share</a>--}}
    {{--</div>--}}
@endsection

@section('js')


    <script>

        $(document).ready(function () {
            $(document).on('click', ".read_contact_message", function () {
                let id = $(this).attr('data-id');
                $(`#message-${id}`).fadeToggle();
            });

            $(".set_read_status").click(function () {
                let id = $(this).attr('data-id');

                $(`#read-${+id} > i`).css('color', '#dc3545');
                jQuery.ajax({
                    url: "{{ url('admin/set_messages_read') }}",
                    method: 'get',
                    data: {status: 1, id: id},
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success: (result) => {
                        //console.log(result);
                    }
                });
            });
        });

    </script>

@endsection