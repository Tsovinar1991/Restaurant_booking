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
            height: 300px;
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

        .clearfix {
            margin: 0 !important;
        }

        .pad-20 {
            padding: 20px;
        }
    </style>
@endsection


@section('page', 'Dialog history')
@section('content')
    @if(isset($emails) && count($emails)>0)
        <div class="container col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel-body pad-20">
                            @foreach($emails as $email)
                                <ul class="chat">
                                    <li class="left clearfix alert alert secondary my_form_color">
                                        <div class="chat-img pull-left pl-5 ">
                                            <i class="fas fa-user" style="color:#167888"></i>
                                            {{--{{$last_id->id}}--}}
                                            {{$email->name}}
                                            <small class=" text-muted"><span
                                                        class="glyphicon glyphicon-time"></span>13 mins ago
                                            </small>
                                        </div>
                                        <div class="chat-body clearfix  pl-3">
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
                                            <li class="right clearfix pl-3 alert alert-dark">
                                                <div class="chat-img pull-right pl-5">
                                                    <i class="fas fa-user" style="color: #5ac16f"></i> Us
                                                    <small class=" text-muted"><span
                                                                class="glyphicon glyphicon-time"></span>13 mins ago
                                                    </small>
                                                </div>
                                                <div class="chat-body clearfix pl-3">
                                                    <div class="header">
                                                        <strong class="pull-right primary-font">{{$email->childs[$key]->email}}</strong>
                                                    </div>
                                                    <p>
                                                        {{$email->childs[$key]->message}}
                                                        <span id="here"></span>
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                    @endforeach
                                </ul>
                            @endforeach
                        </div>

                    <div class="panel-footer col-lg-12 alert p-0">
                        <div class="input-group">
                            <form method="POST" action="{{route('admin.dialog.answer', $last_id->id )}}"
                                  class="col-lg-12 ">
                                {{ csrf_field() }}
                                <div class="alert" style="background-color: #686a6b;">
                                <textarea id="btn-input" name="message" type="text" rows="3"
                                          class="form-control input-sm"
                                          placeholder="Type your message here..."/></textarea>
                                </div>
                                <input type="hidden" id="custId" name="history" value="history">
                                <span class="input-group-btn">
                            <button class="btn btn-success btn-md" id="btn-chat">
                                Send</button>
                              </span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection