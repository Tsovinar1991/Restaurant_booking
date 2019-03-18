@extends('layouts.admin')

@section('css')
    <style>
        #message-form-div {
            display: none;
        }

        .message-header {
            font-style: italic;
            color: #293a79;
        }

        .jumbotron {
            /*background-color:transparent !important;*/
            background:rgba(255,255,255,0.5);
        }
    </style>
@endsection


@section('page', 'Messages')
@section('content')


    @if(isset($mails) && count($mails)>0)
        <div class="col-lg-12 col-md-12 row">
            <div class="col-lg-12 col-md-12 col-sm-12" style="clear: both">
                <div class="col-lg-6 col-md-7 mt-3 float-left">
                @foreach($mails as $key => $message)
                    <div class="col-lg-12 col-md-12 alert my_form_color pb-0 row">
                        <p data-id="{{$message->id}}" class=" read_contact_message message_cursor col-lg-8 col-md-7 col-sm-7 col-xs-12"><i
                                    class="far fa-envelope message_icon"></i> From: {{$message->name}}
                        </p>
                        <p data-id="{{$message->id}}" id="read-{{$message->id}}"
                            class="col-lg-1 col-md-2 col-sm-2 col-xs-6 set_read_status message_cursor"><i class="fas fa-envelope-open message_open_icon"></i></p>
                        <p class="col-lg-3 col-md-3 col-sm-3 col-xs-6 reply" data-id="{{$message->id}}" data-name="{{$message->name}}"><i
                                    class="fas fa-reply"></i> Reply</p>
                    </div>
                    <div class="hidden message jumbotron" id="{{"message-$message->id"}}">
                        <p><b>EMAIL</b> {{$message->email}}</p>
                        <p><b>MESSAGE</b> {{$message->message}}</p>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-6 col-md-12  alert  float-right" id="message-form-div">
                <form id="answer_message_form" method="POST" action="{{route('admin.message.answer', '+id+')}}">
                    {{ csrf_field() }}
                    <div class="form-group alert my_form_color"> <!-- Message field -->
                        <label class="control-label message_to " for="message"></label>
                        <textarea class="form-control" cols="40" id="message" name="message" rows="5"></textarea>
                        @if ($errors->has('message'))
                            <span class="help-block  text-danger">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button class="btn btn-outline-success btn-sm" name="submit" type="submit">Send</button>
                    </div>
                </form>
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


            $(".reply").click(function () {
                let id = $(this).attr('data-id');
                let name = $(this).attr('data-name');
                // alert(id);
                console.log(name);
                $("#message-form-div").show();
                $(".message_to").text('Message to ' + name).css('font-style','italic');

                $("#answer_message_form").attr('action', function (_, action) {
                    return action.replace('+id+', id)
                });

            });
        });

    </script>

@endsection