<div class="header-2">
    <nav class="navbar navbar-inverse navbar-transparent navbar-fixed-top navbar-color-on-scroll" color-on-scroll="100" id="sectionsNav">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href=" {{ route('mainhome') }} "><img src=" {{ asset('public/assets/frontend/img/logo/logo.png') }}"></a>
            </div>

            <div class="collapse navbar-collapse" id="navigation-example-2">
                <ul class="nav navbar-nav navbar-right">
                    <li class="">
                          <a href=" {{ route('mainhome') }} ">
                            Home
                        </a>
                    </li>
                    
                    <li class="{{ Request::is('posts*') ? 'active' : '' }}">
                        <a href=" {{ route('post.index') }} ">
                           Posts
                        </a>
                    </li>
                    <li class="dropdown {{ Request::is('category*') ? 'active' : '' }}">
                        <a href="javascrit::void(0)" class="dropdown-toggle" data-toggle="dropdown">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">
                                Categories
                            </li>
                            @foreach ($categories as $cat)
                            <li>
                                <a href=" {{ route('category.post',$cat->slug) }} ">{{ $cat->name }}</a>
                            </li>    
                            @endforeach
                        </ul>
                    </li>
                    <li class=" {{ Request::is('popular-author*') ? 'active' : '' }} ">
                        <a href=" {{ route('popular_author.index') }} ">
                        Popular Author
                        </a>
                    </li>
                    <li class=" {{ Request::is('contact-us') ? 'active' : '' }} ">
                        <a href="{{ route('contact.index') }} ">
                            Contact Us
                        </a>
                    </li>
                    @guest
                        <li class="" style="margin-left: 10px;">
                            <a href=" {{ route('login') }} " class="btn btn-rose btn-raised btn-round">
                                LOGIN
                            </a>
                        </li>
                    @else
                    <li class="dropdown" style="margin-left: 15px;">
                        <a href="javascript:void(0)" class="profile-photo dropdown-toggle" data-toggle="dropdown">
                            <div class="profile-photo-small">
                                @if (Auth::user()->image == 'default.png')
                                <img src=" {{ asset('public/assets/backend/img/default-avatar.png') }} " alt="Circle Image" class="img-circle img-responsive">
                                @else
                                <img src=" {{ Storage::disk('public')->url('profile/'.Auth::user()->image) }} " alt="Circle Image" class="img-circle img-responsive">
                                @endif
                                
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                        <li class="dropdown-header">
                            Profile Settings
                        </li>
                        <li class="">
                                <a href=" {{ Auth::user()->role_id == 1 ? route('admin.dashboard') : route('author.dashboard') }} " class="active">
                                    Dashbord
                                </a>
                        </li>
                        <li>
                            @if (Auth::user()->role_id == 1)
                              <a href=" {{ route('admin.setting') }} ">Edit Profile</a>
                            @else
                              <a href=" {{ route('author.setting') }} ">Edit Profile</a>
                            @endif
                            
                        </li>
                        <li>
                                @if (Auth::user()->role_id == 1)
                                    <a href=" {{ route('admin.password.index') }} ">Change Password</a>
                                @else
                                    <a href=" {{ route('author.password.index') }} ">Change Password</a>
                                @endif
                                </li>
                            <li class="divider"></li>
                            <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">Sign Out
                                                </a>
                                            
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                        </li>
                        </ul>
                    </li>
                    
                    @endguest
                 </ul>
              </div><!-- /.navbar-collapse -->
        </div>
    </nav>


</div>