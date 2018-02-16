<!DOCTYPE html>
<html style="height: 100%;">
<head>
	<title>Haggle</title>
@include('layouts.head')
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>

<body style="height: 100%;">

<div id="app">
    @include('layouts.navigation')
    @include('layouts.store-nav')

    <div class="container-fluid fill" style="height:790px;margin-top:-4.9%;margin-bottom:-3%;">
      <div class="row chat-wrap">
        <!-- Contacts & Conversations -->
        <div class="col-sm-3 panel-wrap">
            <!--Left Menu / Conversation List-->
            <div class="col-sm-12 section-wrap">

                <!--Header-->
                <div class="row header-wrap">
                    <div class="chat-header col-sm-12">
                        <h4 id="username">Messages</h4>
                        <div class="header-button">
                            <a class="btn pull-right" href="#Contacts" style="color:#AB2A2F;" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-pencil-square-o fa-lg"></i>
                            </a>
                        </div>
                    </div>

                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">  
                            <!-- Modal content-->
                            <div class="modal-content">
                                <modal-message v-on:messagesent="addMessage" :user="{{ Auth::user() }}"></modal-message>
                            </div>
                    </div>
                    </div>
                </div>

                <!--Conversations-->
                <div class="row content-wrap" style="border-right:1px solid rgb(219, 216, 216);">
                    <div class="conversation btn">

                        @forelse ( $rooms as $room )


                            @if ( $room->user_one != Auth::id() )

                                @foreach ( App\User::where('id', $room->user_one)->get() as $user )

                                <a href="{{ url('messages').'/'.$user->id }}" style="color:#333;{{ (new \App\Http\Controllers\MessageController)->countUnseenUser($user->id) <= 0 ? 'zero' : 'color:red;' }}">
                                        <div class="media-body">
                                            <h5 class="media-heading">{{ $user->name}}</h5>
                                            <small class="pull-right time">{{ $room->created_at->diffForHumans() }}</small>
                                        </div>
                                    </a>
                                    
                                @endforeach               
                            @elseif ( $room->user_two != Auth::id() )
                                
                                @foreach ( App\User::where('id',$room->user_two)->get() as $user )

                                    <a href="{{ url('messages').'/'.$user->id }}" style="color:#333;{{ (new \App\Http\Controllers\MessageController)->countUnseenUser($user->id) <= 0 ? 'zero' : 'color:red;' }}">
                                        <div class="media-body">
                                            <h5 class="media-heading">{{ $user->name }}</h5>
                                            <small class="pull-right time">{{ $room->created_at->diffForHumans() }}</small>
                                        </div>
                                    </a>

                                @endforeach
                                
                            @endif

                            @empty

                        @endforelse
                        
                    </div>
                </div>

            </div>

        </div>

        <!-- Messages & Info -->
        <div class="col-sm-9 panel-wrap">
            
                        <!--Main Content / Message List-->
          <div class="col-sm-12 section-wrap" id="Messages">

              <!--Header-->
              <div class="row header-wrap">
                  <div class="chat-header col-sm-12">
                      <h4>Conversation Title</h4>
                      <div class="header-button">
                          {{--  <a class="btn pull-right info-btn">
                              <i class="fa fa-info-circle fa-lg"></i>
                          </a>  --}}
                      </div>
                  </div>
              </div>

              <!--Messages-->
              <div class="row content-wrap messages">
                  <chat-messages :messages="messages"></chat-messages>
              </div>        

              <!--Message box & Send Button-->
              <div class="row send-wrap">
                  <chat-form v-on:messagesent="addMessage" :user="{{ Auth::user() }}"></chat-form>
              </div>

          </div>
      </div>
    </div>
</div>

@include('layouts.foot')
<script src="{{asset('js/app.js')}}" charset="utf-8"></script>
<script type="text/javascript" src="{!!asset('js/bootstrap-3.1.1.min.js')!!}"></script>
</body>
@include('layouts.footer')
</html>
