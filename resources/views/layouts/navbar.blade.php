@php
        $user = Auth::user();
        $id = Auth::user()->id;

        $notification = $user->notifications->take(10);
@endphp
    <div class="dashboard-header">
        <nav class="navbar navbar-expand-lg bg-white fixed-top">
            <a class="navbar-brand" href="/admin">Concept</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-right-top">
                    <li class="nav-item">
                        <div id="custom-search" class="top-search-bar">
                            <input class="form-control" type="text" placeholder="Search..">
                        </div>
                    </li>
                    <li class="nav-item dropdown notification">
                        <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if ($notification != null)
                                    <i class="fas fa-fw fa-bell"></i>
                                    <span class="indicator"></span>
                                @else
                                @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                            <li>
                                <div class="notification-title"> {{ count(Auth::user()->notifications) }} new Notification</div>
                                <div class="notification-list">
                                    <div class="list-group">       
                                            @foreach ($notification as $item)
                                                <a href="#" onclick="markRead()" class="list-group-item list-group-item-action active">
                                                    <div class="notification-info">
                                                        <div class="notification-list-user-img">
                                                            @if(empty($user->user_image))
                                                                <img src="/assets/images/default.png" alt="" class="user-avatar-md rounded-circle">
                                                                @else
                                                                <img src="{{ asset("/images/users") }}/{{ $user->user_image }}" alt="" class="user-avatar-md rounded-circle">
                                                            @endif
                                                        </div>
                                                        <div class="notification-list-user-block"><span class="notification-list-user-name">{{ $item->id}}</span>
                                                            {{-- {{ $item->data['notification'] }}
                                                            <div class="notification-date">{{ $item->created_at->diffForHumans() }}
                                                        </div> --}}
                                                    </div>
                                                </a>
                                            </div>

                                            @endforeach 
                                        </div>
                                    </div>
                            </li>
                            <li>
                                <div class="list-footer"> <a href="#">View all notifications</a></div>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown nav-user">
                        <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if($user->user_image == null)
                                <img src="/assets/images/default.png" alt="" class="user-avatar-md rounded-circle">
                                @else
                                <img src="{{ asset("/images/users") }}/{{ $user->user_image }}" alt="" class="user-avatar-md rounded-circle">
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                            <div class="nav-user-info">
                                <h5 class="mb-0 text-white nav-user-name">{{ $user->username }} </h5>
                                <span class="status"></span><span class="ml-2">Available</span>
                            </div>
                            <a class="dropdown-item" href="/admin/account"><i class="fas fa-user mr-2"></i>Account</a>
                            <a class="dropdown-item" href="/logout"><i class="fas fa-power-off mr-2"></i>Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
{{-- <ul class="setting-area">
    <li><a href="/newsfeed" title="Home" data-ripple=""><i class="ti-home"></i></a></li>
    <li>
        <a href="#"  onclick="markRead()" title="Notification" >
            <i class="ti-bell"></i>
            @if ($notification != null)
                <span>{{ count(Auth::user()->unreadNotifications) }}</span>
            @else
            @endif
        </a>
        <div class="dropdowns">
            @if ($notification != null)
            <span>{{ count(Auth::user()->notifications) }} New Notifications</span>
            @else
            @endif
            <ul class="drops-menu">
                @foreach ($notification as $item)
                    <li id="notification">
                        <a href="/notifications" title="">
                            <img src="/assets/images/resources/thumb-1.jpg" alt="">
                            <div class="mesg-meta">
                                <h6>{{ $item->data['name'] }}</h6>
                                <span>{{ $item->data['notification'] }}</span>
                                <i>{{ $item->created_at->diffForHumans() }}</i>
                            </div>
                        </a>
                        <span class="tag green">New</span>
                    </li>
                @endforeach
            </ul>
            <a href="/notifications" title="" class="more-mesg">view more</a>
        </div>
    </li> --}}