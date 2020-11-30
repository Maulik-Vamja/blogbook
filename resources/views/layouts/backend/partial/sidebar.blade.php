<div class="sidebar" data-active-color="rose" data-background-color="black"
    data-image="{{ asset('public/assets/backend/img/sidebar-1.jpg') }}">

    <div class="logo">
        <a href=" {{ route('mainhome') }} " class="simple-text" style="color: #FF3366;">
            <img src=" {{ asset('public/assets/backend/img/favicon/logo.png') }}">
        </a>
    </div>
    <div class="logo logo-mini">
        <a href="{{ route('mainhome') }}" class="simple-text" style="color: #FF3366;">
            <img src="{{ asset('public/assets/frontend/img/logo/minicon.png') }}">
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                @if (Auth::user()->image == 'default.png')
                <img src=" {{ asset('public/assets/backend/img/default-avatar.png') }} " alt="...">
                @else
                <img src=" {{ Storage::disk('public')->url('profile/'.Auth::user()->image) }} " alt="...">
                @endif
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    {{ Auth::user()->name }}
                    <b class="caret"></b>
                </a>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li>
                            <a
                                href=" {{ Auth::user()->role_id == 1 ? route('admin.setting') : route('author.setting') }} ">Edit
                                Profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                {{ __('Sign out') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">

            @if (Request::is('admin*'))
            <li class=" {{ Request::is('admin/dashboard') ? 'active' : '' }} ">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class=" {{ Request::is('admin/tag*') ? 'active' : '' }} ">
                <a href="{{ route('admin.tag.index') }}">
                    <i class="material-icons">local_offer</i>
                    <p>Tags</p>
                </a>
            </li>
            <li class=" {{ Request::is('admin/category*') ? 'active' : '' }} ">
                <a href="{{ route('admin.category.index') }}">
                    <i class="material-icons">apps</i>
                    <p>Category</p>
                </a>
            </li>
            <li class=" {{ Request::is('admin/post*') ? 'active' : '' }} ">
                <a href="{{ route('admin.post.index') }}">
                    <i class="material-icons">library_books</i>
                    <p>Post</p>
                </a>
            </li>
            <li class=" {{ Request::is('admin/pending/post') ? 'active' : '' }} ">
                <a href="{{ route('admin.post.pending') }}">
                    <i class="material-icons">history</i>
                    <p>Pending Posts</p>
                </a>
            </li>
            <li class=" {{ Request::is('admin/favourite') ? 'active' : '' }} ">
                <a href="{{ route('admin.favourite.index') }}">
                    <i class="material-icons">favorite</i>
                    <p>Favorite Posts</p>
                </a>
            </li>
            <li class=" {{ Request::is('admin/comments') ? 'active' : '' }} ">
                <a href="{{ route('admin.comment.index') }}">
                    <i class="material-icons">comment</i>
                    <p>All Comment</p>
                </a>
            </li>
            <li class=" {{ Request::is('admin/authors') ? 'active' : '' }} ">
                <a href="{{ route('admin.author.index') }}">
                    <i class="material-icons">account_circle</i>
                    <p>All Author</p>
                </a>
            </li>
            <li class=" {{ Request::is('admin/subscriber') ? 'active' : '' }}">
                <a href="{{ route('admin.subscriber.index') }}">
                    <i class="material-icons">subscriptions</i>
                    <p>All Subscribers</p>
                </a>
            </li>
            <li class=" {{ Request::is('admin/follower') ? 'active' : '' }}">
                <a href="{{ route('admin.follower.index') }}">
                    <i class="material-icons">people</i>
                    <p>Followers</p>
                </a>
            </li>
            <li class=" {{ Request::is('admin/following') ? 'active' : '' }}">
                <a href="{{ route('admin.following.index') }}">
                    <i class="material-icons">people</i>
                    <p>Following</p>
                </a>
            </li>
            <li class=" {{ Request::is('admin/ads*') ? 'active' : '' }}">
                <a href="{{ route('admin.ads.index') }}">
                    <i class="material-icons">assignment</i>
                    <p>All Ads Offers</p>
                </a>
            </li>
            <li class=" {{ Request::is('admin/adv_post*') ? 'active' : '' }}">
                <a href="{{ route('admin.adv_post.index') }}">
                    <i class="material-icons">assignment</i>
                    <p>All Ads Post</p>
                </a>
            </li>
            <li class="separator">
            </li>
            <li class=" {{ Request::is('admin/settings') ? 'active' : '' }}">
                <a href="{{ route('admin.setting') }}">
                    <i class="material-icons">person</i>
                    <p>Edit Profile</p>
                </a>
            </li>
            <li class=" {{ Request::is('admin/password-change') ? 'active' : '' }}">
                <a href="{{ route('admin.password.index') }}">
                    <i class="material-icons">lock</i>
                    <p>Update Password
                    </p>
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                    <i class="material-icons">power_settings_new</i>
                    <p>Sign Out
                    </p>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            @endif

            @if (Request::is('author*'))
            <li class=" {{ Request::is('author/dashboard') ? 'active' : '' }} ">
                <a href="{{ route('author.dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class=" {{ Request::is('author/tag*') ? 'active' : '' }} ">
                <a href="{{ route('author.tag.index') }}">
                    <i class="material-icons">local_offer</i>
                    <p>Tag</p>
                </a>
            </li>
            <li class=" {{ Request::is('author/post*') ? 'active' : '' }} ">
                <a href="{{ route('author.post.index') }}">
                    <i class="material-icons">library_books</i>
                    <p>Post</p>
                </a>
            </li>
            <li class=" {{ Request::is('author/favourite') ? 'active' : '' }} ">
                <a href="{{ route('author.favourite.index') }}">
                    <i class="material-icons">favorite</i>
                    <p>Facourite Posts</p>
                </a>
            </li>
            <li class=" {{ Request::is('author/comments') ? 'active' : '' }} ">
                <a href="{{ route('author.comment.index') }}">
                    <i class="material-icons">comment</i>
                    <p>All Comment</p>
                </a>
            </li>
            <li class=" {{ Request::is('author/follower') ? 'active' : '' }}">
                <a href="{{ route('author.follower.index') }}">
                    <i class="material-icons">people</i>
                    <p>Followers</p>
                </a>
            </li>
            <li class=" {{ Request::is('author/following') ? 'active' : '' }}">
                <a href="{{ route('author.following.index') }}">
                    <i class="material-icons">people</i>
                    <p>Following</p>
                </a>
            </li>
            <li class=" {{ Request::is('author/ads*') ? 'active' : '' }}">
                <a href="{{ route('author.ads.index') }}">
                    <i class="material-icons">assignment</i>
                    <p>Advertisment Post</p>
                </a>
            </li>
            <li class="separator">
            </li>
            <li class=" {{ Request::is('author/settings') ? 'active' : '' }}">
                <a href="{{ route('author.setting') }}">
                    <i class="material-icons">person</i>
                    <p>Edit Profile</p>
                </a>
            </li>
            <li class=" {{ Request::is('author/password-change') ? 'active' : '' }}">
                <a href="{{ route('author.password.index') }}">
                    <i class="material-icons">lock</i>
                    <p>Update Password
                    </p>
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                    <i class="material-icons">power_settings_new</i>
                    <p>Sign Out
                    </p>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            @endif
        </ul>
    </div>
</div>