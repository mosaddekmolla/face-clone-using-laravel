@php
    $users = app\Models\User::where('id', '!=', auth()->user()->id)->get();
    // dd($users);

    $time = now()->subMinutes(1);

    $active_users = app\Models\User::where('last_login', '>=', $time)->pluck('id')->toArray();
    


@endphp


    
    <div class="col-sm-3 chat-
            
    users">
        <div class="row">
            <h3>Chat</h3>
        </div>
        <div class="row">
            @foreach ($users as $user)
            
            <div class="col-sm-12 chat-user
                @if(in_array($user->id, $active_users))
                    online
                @endif
            ">
                <a href="#">
                    <img src="{{asset($user->image)}}" class="pull-left"/>
                    &nbsp;
                    {{$user->fname}}
                </a>
            </div>
            
            @endforeach
        </div>
    </div>
