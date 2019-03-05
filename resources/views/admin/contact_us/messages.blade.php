@extends('layouts.admin')

@section('css')
@endsection


@section('page', 'Messages')
@section('content')
    @if(isset($mails) && count($mails)>0)
        @foreach($mails as $key => $message)
            <h6 data-id="{{$message->id}}" class="message_cursor"><i class="far fa-envelope message_icon"></i> Message
                from: {{$message->name}}</h6>
            <div class="hidden message jumbotron" id="{{"message-$message->id"}}">
                <p>Email: {{$message->email}}</p>
                <p>Message: {{$message->message}}</p>
            </div>
        @endforeach

    @else
        <div class="alert alert-info " role="alert">
            No new messages yet.
        </div>
    @endif

    <div class="alert alert-info">
        <a href="https://www.facebook.com/sharer/sharer.php?u=http://restaurant2.brainfors.am/admin&display=popup">
            Testing facebook share</a>
    </div>
@endsection

@section('js')
    <script>

        $(document).ready(function () {

            $(document).on('click', "h6", function () {
                let id = $(this).attr('data-id');
                $(`#message-${id}`).fadeToggle();
            });


            jQuery.ajax({
                url: "{{ url('admin/set_messages_read') }}",
                method: 'get',
                data: {status: 1},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: (result) => {
                    //console.log(result);
                }
            });

        });

    </script>

@endsection