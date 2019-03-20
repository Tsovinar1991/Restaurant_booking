@extends('layouts.admin')

@section('css')
    <style>
        .chat {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .chat li {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dotted #B3A9A9;
        }

        .chat li.left .chat-body {
            margin-left: 60px;
        }

        .chat li.right .chat-body {
            margin-right: 60px;
        }

        .chat li .chat-body p {
            margin: 0;
            color: #777777;
        }

        .panel .slidedown .glyphicon, .chat .glyphicon {
            margin-right: 5px;
        }

        .panel-body {
            overflow-y: scroll;
            height: 400px;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
            background-color: #555;
        }

        ul {
            list-style-type: none;
        }
        .clearfix{
        margin:0 !important;
        }
    </style>
@endsection


@section('page', 'Dialog history')
@section('content')
    @if(isset($emails) && count($emails)>0)
        <div class="container col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel-body">
                        @foreach($emails as $email)
                            <ul class="chat">
                                <li class="left clearfix my_form_color">
                                    <div class="chat-img pull-left">
                                        <i class="fas fa-user" style="color:#167888"></i>
                                        {{$email->id}}
                                        {{$email->name}}
                                        <small class=" text-muted"><span
                                                    class="glyphicon glyphicon-time"></span>13 mins ago
                                        </small>
                                    </div>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="pull-right primary-font">{{$email->email}}</strong>
                                        </div>
                                        <p>
                                            {{$email->message}}
                                        </p>
                                    </div>
                                </li>
                                @foreach($email->childs as $key=> $child)
                                    <ul>
                                        <li class="right clearfix">
                                            <div class="chat-img pull-right">
                                                <i class="fas fa-user" style="color: #5ac16f"></i>
                                                <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                                            </div>
                                            <div class="chat-body clearfix">
                                                <div class="header">
                                                    <strong class="pull-right primary-font">{{$email->childs[$key]->email}}</strong>
                                                </div>
                                                <p>
                                                    {{$email->childs[$key]->message}}
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                    <div class="panel-footer">
                        <div class="input-group">
                            <input id="btn-input" type="text" class="form-control input-sm"
                                   placeholder="Type your message here..."/>
                            <span class="input-group-btn">
                            <button class="btn btn-outline-success btn-md" id="btn-chat">
                                Send</button>
                        </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif





@endsection