@extends('admin.layout.locked')

@section('contents')
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            @error('email')
            <div class="alert alert-primary left-icon-big   alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                </button>
                <div class="media">
                    <div class="alert-left-icon-big">
                        <span><i class="las la-exclamation-triangle"></i></span>
                    </div>
                    <div class="media-body">
                        <h5 class="mt-1 mb-2 text-black">We're Sorry!</h5>
                        <p class="mb-0">{{ $message }}</p>
                    </div>
                </div>
            </div>
            @enderror
            <div class="authincation-content">

                <div class="row no-gutters">
                    <div class="col-xl-12">

                        <div class="auth-form">

                            <h4 class="text-center mb-4 text-white">Sign in your account</h4>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf


                                <div class="form-group">
                                    <label class="mb-1 text-white" for="email"><strong>Email</strong></label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" autocomplete>
                                </div>
                                <div class="form-group">
                                    <label class="mb-1 text-white"><strong>Password</strong></label>
                                    <input type="password" name="password" class="form-control" value="" autocomplete >

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox ml-1 text-white">
                                            <input type="checkbox" class="custom-control-input" type="checkbox" name="remember" id="remember" checked>
                                            <label class="custom-control-label" for="remember">Remember my preference</label>
                                        </div>
                                    </div>
                                    {{--<div class="form-group">
                                        <a class="text-white" href="#">Forgot Password?</a>
                                    </div>--}}
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-white text-primary btn-block">Sign In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
