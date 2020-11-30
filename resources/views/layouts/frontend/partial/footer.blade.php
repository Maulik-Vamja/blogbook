<!--     *********    BIG FOOTER     *********      -->

<footer class="footer footer-black footer-big">
    <div class="container">

        <div class="content">
            <div class="row text-center">
                <div class="col-md-4">
                    <h5>About</h5>
                    <ul class="links-vertical">
                        <li>
                            <p>
                            The BlogBook Provides you the information and knowledge about current affairs and even you can share your knowledge to the people by signing into BlogBook and become an author of BlogBook.</p>
                        </li>
                    </ul>
                </div>

                <div class="col-md-2">
                    <h5>Menu</h5>
                    <ul class="links-vertical">
                        <li>
                            <a href="{{ route('mainhome') }}">
                               Home
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('post.index') }}">
                               All Posts
                            </a>
                        </li>
                        <li>
                            <a href=" {{ route('popular_author.index') }} ">
                                Popular Posts
                            </a>
                        </li>
                        <li>
                            <a href=" {{ route('contact.index') }} ">
                                Contact Us
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-2">
                    <h5>Link</h5>
                    <ul class="links-vertical">
                        <li>
                            <a href="#pablo">
                               Privacy Policy
                            </a>
                        </li>
                        <li>
                            <a href="#pablo">
                               Terms & Conditions
                            </a>
                        </li>
                        <li>
                            <a href="#pablo">
                                Sitemap
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-4">
                    <h5>Recent Tags</h5>
                    <div class="lbls">
                        @foreach ($tags as $tag)
                        <a href=" {{ route('tag.post',$tag->slug) }} "><span class="label label-rose">{{ $tag->name }}</span></a>     
                        @endforeach
                    </div>
                </div>

            </div>
        </div>


        <hr />

        <ul class="pull-left">
            <li>
                <a href="{{ route('mainhome') }}">
                   Home
                </a>
            </li>
            <li>
                <a href="{{ route('post.index') }}">
                   All Posts
                </a>
            </li>
            <li>
                <a href=" {{ route('popular_author.index') }} ">
                    Popular Posts
                </a>
            </li>
            <li>
                <a href=" {{ route('contact.index') }} ">
                    Contact Us
                </a>
            </li>
        </ul>

        <div class="copyright pull-right">
            Copyright &copy; <script>document.write(new Date().getFullYear());</script> BlogBook All Rights Reserved.
        </div>
    </div>
</footer>

<!--     *********   END BIG FOOTER     *********      -->