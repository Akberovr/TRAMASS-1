@extends('layouts.main_layout')

@section('content')
<section id="signin">
        <div  class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <h2>Sign in</h2>
                    <p>Please enter your username and password</p>
                    <form role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            <!--                            <label for="inputEmail1">Username or Email</label>-->
<!--                            <input type="email" class="form-control" id="inputEmail1" placeholder="">-->
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
<!--
                            <label for="inputPassword1">Password</label>
                            <input type="password" class="form-control" id="inputPassword1" placeholder="">

-->
                           <label for="password" class="col-md-4 control-label">Password</label>
                           <input id="password" type="password" class="form-control" name="password">
                               @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>


                        <a href="{{ url('/password/reset') }}">Forgot Password?</a><br>
                        <input type="submit" value="SIGN IN" class="btn btn-success btn-lg text-center col-md-12 btn-2">

<!--                        <p class="text-center">OR</p>-->

                        <button type="submit" class="btn btn-primary btn-lg text-center col-md-12 btn-2">
                        <a href="#"  style="color:white !important">
                            <i class="fa fa-facebook" aria-hidden="true"></i> LOGIN WITH FACEBOOK
                        </a>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
