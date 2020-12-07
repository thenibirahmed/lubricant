
<div id="left-sidebar" class="sidebar">
    {{-- brand  --}}
    <div class="navbar-brand">
        <a href="{{ asset('/home') }}"><img src=" {{ asset('assets/images/icon.svg') }} " alt="Lubricant Logo" class="img-fluid logo"><span>Lubricant</span></a>
        <button type="button" class="btn-toggle-offcanvas btn btn-sm float-right"><i class="lnr lnr-menu icon-close"></i></button>
    </div>
    
    <div class="sidebar-scroll">
        {{-- settings  --}}
        <div class="user-account">
            <div class="user_div">
                <img width="100%" height="40px" src=" {{ Auth::user()->media ? Auth::user()->media->path : '//via.placeholder.com/50' }} " class="user-photo img img-responsive" alt="User Profile Picture">
            </div>
            <div class="dropdown">
                <span>Welcome,</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong> {{ Auth::user()->name ?? 'Not Found' }} </strong></a>
                <ul class="dropdown-menu dropdown-menu-right account vivify flipInY">
                    <li><a href="#"><i class="icon-user"></i>My Profile</a></li>
                    <li><a href="app-inbox.html"><i class="icon-envelope-open"></i>Messages</a></li>
                    <li><a href="javascript:void(0);"><i class="icon-settings"></i>Settings</a></li>
                    {{-- <li class="divider"></li> --}}
                    <li>
                        {{-- <a href="page-login.html"><i class="icon-power"></i>Logout</a> --}}
                        <a class="icon-power" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>                
        </div>  
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">
                <li class="header">Main</li>
                {{-- <li><a href="../html/index.html"><i class="icon-home"></i><span>Home</span></a></li> --}}
                <li class="open"><a href="{{ route('home') }}" class=""><i class="icon-speedometer"></i><span>Dashboard</span></a></li>
                <li class="header">Projects</li>
                <li><a href="#" class="has-arrow"><i class="icon-users"></i><span>Users</span></a>
                    <ul>
                        <li> 
                            <a href="{{ route('users.index') }}">All Users</a>
                            @if (Auth::user()->role && (Auth::user()->role->priority == 1 || Auth::user()->role->priority == 2 || Auth::user()->role->priority == 8) )
                            <a href="{{ route('user.search') }}">Search Users</a>
                            @endif
                            @if (Auth::user()->role && (Auth::user()->role->priority == 1 || Auth::user()->role->priority == 2 || Auth::user()->role->priority == 5 || Auth::user()->role->priority == 8) )
                            <a href="{{ route('users.create') }}">Create Users</a>
                            @endif
                            <a href="{{ route('user.profile') }}">My Profile</a>   
                        </li>
                    </ul>                 
                </li>
               
                
                            
            </ul>
        </nav>     
    </div>
</div>
