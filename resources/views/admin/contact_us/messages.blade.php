@extends('layouts.admin')

@section('css')
    <style>
        #message-form-div {
            display: none;
        }
    </style>
@endsection


@section('page', 'Messages')
@section('content')
    @if(isset($mails) && count($mails)>0)
        <div class="col-lg-12 col-md-12 row">
            <div class="col-lg-6 col-md-12">
                @foreach($mails as $key => $message)
                    <div class="col-lg-12 col-md-12 row">
                        <h6 data-id="{{$message->id}}" class=" read_contact_message message_cursor col-lg-8 col-md-8"><i
                                    class="far fa-envelope message_icon"></i> From: {{$message->name}}
                        </h6>
                        <h6 data-id="{{$message->id}}" id="read-{{$message->id}}"
                            class="col-lg-1 set_read_status message_cursor"><i class="fas fa-envelope-open"></i></h6>
                        <h6 class="col-lg-3 reply" data-id="{{$message->id}}" data-name="{{$message->name}}"><i
                                    class="fas fa-reply"></i> Reply</h6>
                    </div>
                    <div class="hidden message jumbotron" id="{{"message-$message->id"}}">
                        <p>Email: {{$message->email}}</p>
                        <p>Message: {{$message->message}}</p>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-6 col-md-12" id="message-form-div">
                <form id="answer_message_form" method="POST" action="{{route('admin.message.answer', '+id+')}}">
                    {{ csrf_field() }}
                    <div class="form-group"> <!-- Message field -->
                        <label class="control-label   message_to" for="message">Message To</label>
                        <textarea class="form-control" cols="40" id="message" name="message" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary " name="submit" type="submit">Send</button>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="alert text-info col-md-12" role="alert">
            <p>No message yet</p>
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

                $(`#read-${+id} > i`).css('color', 'red');
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
                $(".message_to").text('Message to ' + name);
                $("#answer_message_form").attr('action', function (_, action) {
                    return action.replace('+id+', id)
                });

            });
        });

    </script>

@endsection