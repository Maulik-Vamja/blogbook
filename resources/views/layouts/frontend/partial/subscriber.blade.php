
    <div class="subscribe-line subscribe-line-image" style="background: url(' {{ asset('public/assets/frontend/img/bg7.jpg') }} '); background-attachment: fixed;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    @if (session('succesMsg'))
                        <div class="alert alert-success" style="border-radius: 8px;" id="success-alert" role="alert">
                            {{ session('succesMsg') }}
                        </div>    
                    @endif
                    <div class="text-center">
                        <h3 class="title">Subscribe to our Newsletter</h3>
                        <p class="description">
                            Join our newsletter and get news in your inbox every week! We hate spam too, so no worries about this.
                        </p>
                    </div>

                    <div class="card card-raised card-form-horizontal">
                        <div class="card-content">
                            <form method="POST" action=" {{ route('subscriber.store') }} ">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-8">

                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">mail</i>
                                            </span>
                                            <input type="email" value="" name="email" placeholder="Your Email Address..." class="form-control @error('name') is-invalid @enderror" />
                                            @error('email')
                                            <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="submit" class="btn btn-rose btn-block">Subscribe</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
