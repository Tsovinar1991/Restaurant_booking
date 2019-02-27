@extends('layouts.admin')

@section('css')
@endsection


@section('page', 'Messages')
@section('content')
    @if(session()->has('contact_id'))
        <form action="{{url("/admin/clear_messages")}}" method="POST">
            {{ csrf_field() }}
            <button class="btn btn-outline-danger message_del" id="clear"><i class="fas fa-trash"></i> Clear Message List</button>
        </form>

        @foreach($messages as $key => $message)
            {{--<p><a href="{{url('admin/message/'.$message->id)}}">{{$message->name}}</a></p>--}}
            <h6 data-id="{{$message->id}}" class="message_cursor"> <i class="far fa-envelope message_icon" ></i> Message from: {{$message->name}}</h6>
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

@endsection

@section('js')
    <script>
        $(document).on('click', "h6", function () {
            let id = $(this).attr('data-id');
            $(`#message-${id}`).fadeToggle();
        });

    </script>

@endsection