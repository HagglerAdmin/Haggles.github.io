<div class="store-nav-background">
    <div class="container" >
        <div class="row" style="padding-top:15px;padding-bottom:15px;">

            <div class="col-md-8">
                
                <div style="margin-top:40px;">
                    <h1 style="color:white;margin-bottom:20px;">{{Auth::user()->name}}</h1>
                    
                    <p style="color:white;">in this series, you'll come along with me as i build a web app, called "Project Flyer". well 'ill tackle
                        everything from the domain name purchase, to the deployment
                    </p>
                </div>

                <div style="margin-top:90px;padding-bottom:20px;border-bottom:1px solid #504d4d;">
                    <a href="{{ url('orders') }}" class="store-nav">Orders</a>
                    <a href="{{ url('store') }}" class="store-nav">Storage</a>
                    <a class="store-nav">Messages</a>
                    <a href="{{ url('analytics') }}" class="store-nav">Store Status</a>
                    <a class="store-nav">Reports</a>
                </div>
            </div>

            <div class="col-md-4">
                
                <div style="margin-top:40px;">
                    @forelse(Auth::user()->picture()->get() as $pic)
                    
                        @if($pic->photo_type == "display")
        
                            <img src="{{asset('storage').'/'.$pic->user_photo}}" class="media-object" style="border-radius:100%;width:300px;height:300px;border:5px solid #424242;">
                        @endif
                    @empty
        
                        <img src="{{asset('img/faces/proxy.png')}}" class="media-object" style="border-radius:100%;width:80%;border:5px solid #424242;">
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>