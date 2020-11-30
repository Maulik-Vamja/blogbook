{{-- <div class="header-2">
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
                <a class="navbar-brand" href="#"><img src="../assets/img/logo/logo.png"></a>
            </div>

            <div class="collapse navbar-collapse" id="navigation-example-2">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active">
                          <a href="#pablo" class="active">
                              Home
                          </a>
                    </li>
                    <li class="">
                        <a href="#pablo" class="active">
                           Dashbord
                        </a>
                    </li>
                    <li class="">
                        <a href="following.html" class="active">
                           Following
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">
                                Categories
                            </li>
                            <li>
                                <a href="#pablo">Programming</a>
                            </li>
                            <li>
                                <a href="#pablo">Technologies</a>
                            </li>
                            <li>
                                <a href="#pablo">Cars</a>
                            </li>
                            <li>
                                <a href="#pablo">News</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#pablo">
                            Contact Us
                        </a>
                    </li>
                    <li class="">
                        <a href="#pablo" class="btn btn-rose btn-raised btn-round" data-toggle="dropdown" aria-expanded="false">
                            LOGIN
                        </a>
                    </li>
                      <li class="dropdown">
                          <a href="#pablo" class="profile-photo dropdown-toggle" data-toggle="dropdown">
                              <div class="profile-photo-small">
                                  <img src="../assets/img/faces/avatar.jpg" alt="Circle Image" class="img-circle img-responsive">
                              </div>
                          </a>
                          <ul class="dropdown-menu">
                            <li class="dropdown-header">
                                Profile Settings
                            </li>
                            <li>
                                <a href="#pablo">Edit Profile</a>
                            </li>
                            <li>
                                <a href="#pablo">Change Password</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#pablo">Sign out</a></li>
                          </ul>
                      </li>
                 </ul>
              </div><!-- /.navbar-collapse -->
        </div>
    </nav>


    <div class="page-header header-filter" style="background-image: url('../assets/img/blogbook3.jpg'); background-attachment: fixed;">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <h1 class="title"> Welcome To BLOGBOOK</h1>
                    <h4>The BlogBook Provides you the information and knowledge about current affairs and even you can share your knowledge to the people by signing into BlogBook and become an author of BlogBook.</h4>
                </div>
            </div>
            <div class="text-center">
                <h4 class="title">Connect with us on</h4>
                                    <div class="buttons">
                                        <a href="#pablo" class="btn btn-just-icon btn-white btn-simple btn-lg">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                        <a href="#pablo" class="btn btn-just-icon btn-white btn-simple btn-lg">
                                            <i class="fa fa-facebook-square"></i>
                                        </a>
                                        <a href="#pablo" class="btn btn-just-icon btn-white btn-simple btn-lg">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                        <a href="#pablo" class="btn btn-just-icon btn-white btn-simple btn-lg">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </div>
            </div>
        </div>
    </div>
</div> --}}
<!--     *********     HEADER    *********      -->
<div class="header-2">
    <nav class="navbar navbar-inverse navbar-transparent navbar-fixed-top navbar-color-on-scroll " color-on-scroll="100" id="sectionsNav">
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
                    <li class="active">
                          <a href=" {{ route('mainhome') }} " class=" active ">
                              Home
                          </a>
                    </li>
                    <li class="">
                        <a href=" {{ route('post.index') }}">
                            Posts
                         </a>
                    </li>
                    <li class="dropdown">
                        <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
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
                    <li>
                        <a href=" {{ route('popular_author.index') }} ">
                           Popular Author
                        </a>
                    </li>
                    <li>
                        <a href=" {{ route('contact.index') }} ">
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
                    <li class="dropdown" style="margin-left: 10px;">
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
     <div class="page-header header-filter" style="background-image: url( {{ asset('public/assets/frontend/img/blogbook3.jpg') }}); background-attachment: fixed;">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <h1 class="title"> Welcome To BLOGBOOK</h1>
                    <h4>The BlogBook Provides you the information and knowledge about current affairs and even you can share your knowledge to the people by signing into BlogBook and become an author of BlogBook.</h4>
                </div>
            </div>
            <div class="text-center">
                <h4 class="title">Connect with us on</h4>
                                    <div class="buttons">
                                        <a href="#pablo" class="btn btn-just-icon btn-white btn-simple btn-lg">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                        <a target="blank" href="https://www.facebook.com/Blog-Book-112621887051735/ " class="btn btn-just-icon btn-white btn-simple btn-lg">
                                            <i class="fa fa-facebook-square"></i>
                                        </a>
                                        <a href="#pablo" class="btn btn-just-icon btn-white btn-simple btn-lg">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                        <a href="#pablo" class="btn btn-just-icon btn-white btn-simple btn-lg">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </div>
            </div>
        </div>
    </div>
   
</div>
<!--     *********    END HEADER      *********      -->

