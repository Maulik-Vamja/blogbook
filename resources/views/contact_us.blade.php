@extends('layouts.frontend.app')

@section('title','Contact us')

@push('css')
    
@endpush

@section('content')

<div class="page-header header-filter header-small" data-parallax="true" style="background-image: url(' {{ asset('public/assets/frontend/img/contact.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="brand text-center">
                    <h2 class="title">CONTACT US</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main main-raised">

    <div class="section">
           <div class="container">
               <div class="row">
                    <h5 class="col-md-8 col-md-offset-2 text-center description">
                        We are the team of four developer. We have developed this system for provide great content to the audience.

                        You can register yourself to this system then you will be able to post your blog, Then you can write your own blog and make your profile.
                    </h5>
               </div>

               <div class="row">

                    <h2 class="title text-center">OUR TEAM</h2>
                    <div class="col-md-6">
                        <div class="card card-profile card-plain">
                            <div class="col-md-5">
                                <div class="card-image">
                                    <a href="#pablo">
                                        <img class="img" src=" {{ asset('public/assets/frontend/img/faces/nik.jpg') }} "/>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card-content">
                                    <h4 class="card-title">Nikunj Thesiya</h4>
                                    <h6 class="category text-muted">Front End Developer</h6>
    
                                    <p class="card-description">
                                        Don't be scared of the truth because we need to restart the human foundation in truth...
                                    </p>
    
                                    <div class="footer">
                                        <a href="#pablo" class="btn btn-just-icon btn-simple btn-instagram"><i class="fa fa-instagram"></i></a>
                                        <a href="#pablo" class="btn btn-just-icon btn-simple btn-facebook"><i class="fa fa-facebook-square"></i></a>
                                        <a href="#pablo" class="btn btn-just-icon btn-simple btn-google"><i class="fa fa-google"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-md-6">
                        <div class="card card-profile card-plain">
                            <div class="col-md-5">
                                <div class="card-image">
                                    <a href="#pablo">
                                        <img class="img" src=" {{ asset('public/assets/frontend/img/faces/maulik.jpg') }} " />
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card-content">
                                    <h4 class="card-title">Maulik Vamja</h4>
                                    <h6 class="category text-muted">Back End Developer</h6>
    
                                    <p class="card-description">
                                        Don't be scared of the truth because we need to restart the human foundation in truth...
                                    </p>
    
                                    <div class="footer">
                                        <a href="#pablo" class="btn btn-just-icon btn-simple btn-instagram"><i class="fa fa-instagram"></i></a>
                                        <a href="#pablo" class="btn btn-just-icon btn-simple btn-facebook"><i class="fa fa-facebook-square"></i></a>
                                        <a href="#pablo" class="btn btn-just-icon btn-simple btn-google"><i class="fa fa-google"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-md-6">
                        <div class="card card-profile card-plain">
                            <div class="col-md-5">
                                <div class="card-image">
                                    <a href="#pablo">
                                        <img class="img" src=" {{ asset('public/assets/frontend/img/faces/harshil.jpeg') }} " />
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card-content">
                                    <h4 class="card-title">Harshil Vastarpara</h4>
                                    <h6 class="category text-muted">UI / UX Designer</h6>
    
                                    <p class="card-description">
                                        I love you like Kanye loves Kanye. Don't be scared of the truth.
                                    </p>
    
                                    <div class="footer">
                                        <a href="#pablo" class="btn btn-just-icon btn-simple btn-instagram"><i class="fa fa-instagram"></i></a>
                                        <a href="#pablo" class="btn btn-just-icon btn-simple btn-facebook"><i class="fa fa-facebook-square"></i></a>
                                        <a href="#pablo" class="btn btn-just-icon btn-simple btn-google"><i class="fa fa-google"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-md-6">
                        <div class="card card-profile card-plain">
                            <div class="col-md-5">
                                <div class="card-image">
                                    <a href="#pablo">
                                        <img class="img" src="  {{ asset('public/assets/frontend/img/faces/sachin.jfif') }} " />
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card-content">
                                    <h4 class="card-title">Sachin Sheladiya</h4>
                                    <h6 class="category text-muted">Graphic Designer</h6>
    
                                    <p class="card-description">
                                        I love you like Kanye loves Kanye. Don't be scared of the truth because we need to restart the human foundation.
                                    </p>
    
                                    <div class="footer">
                                        <a href="#pablo" class="btn btn-just-icon btn-simple btn-instagram"><i class="fa fa-instagram"></i></a>
                                        <a href="#pablo" class="btn btn-just-icon btn-simple btn-facebook"><i class="fa fa-facebook-square"></i></a>
                                        <a href="#pablo" class="btn btn-just-icon btn-simple btn-google"><i class="fa fa-google"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>

               <div class="contact-content">
                <div class="container">
                    <h2 class="title text-center">Send us a message</h2>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            {{-- <p class="description text-center">You can contact us with anything related to our posts and services. We'll get in touch with you as soon as possible.<br><br> --}}
                                @if (session('contactMsg'))
                            <div class="alert alert-success" id="success-alert" role="alert">
                                {{ session('contactMsg') }}
                            </div>    
                        @endif
                            </p>
                            <form role="form" id="contact-form" method="POST" action=" {{ route('sendMail') }} ">
                                @csrf
                                <div class="form-group label-floating">
                                    <label class="control-label">Your name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="@error('name') is-invalid @enderror form-control">
                                </div>
                                @error('name')
                                <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div class="form-group label-floating">
                                    <label class="control-label">Email address</label>
                                    <input type="email" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror"/>
                                </div>
                                @error('email')
                                <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div class="form-group label-floating">
                                    <label class="control-label">Phone</label>
                                    <input type="text" name="phone" value="{{ old('phone')}}" class="form-control @error('phone') is-invalid @enderror"/>
                                </div>
                                @error('phone')
                                <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div class="form-group label-floating">
                                    <label class="control-label">Your message</label>
                                    <textarea name="message" class="form-control @error('message') is-invalid @enderror" id="message" rows="6">{{ old('message') }}</textarea>
                                </div>
                                @error('message')
                                <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div class="submit text-center">
                                    <input type="submit" class="btn btn-primary btn-raised btn-round" oncl value="Contact Us" />
                                </div>
                            </form>
                        </div>
                        
                   </div>
                </div>
            </div>
           </div>   
    </div><!-- section -->
    
</div> <!-- end-main-raised -->

@endsection

@push('js')
    
@endpush