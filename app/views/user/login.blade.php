@extends('layouts.admin')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.login') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')

        <div id="content" class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hidden-xs hidden-sm">

                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                        <!-- Notifications -->
                            @include('notifications')
                        <!-- ./ notifications -->   
                        <div class="well no-padding">
                            {{$formOpen}}
                                <header>
                                    Sign In
                                </header>

                                <fieldset>
                                    
                                    <section>
                                        <label class="label">Username</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="username" name="username">
                                            <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address/username.</b></label>
                                    </section>

                                    <section>
                                        <label class="label">Password</label>
                                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                                            <input type="password" name="password">
                                            <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password.</b> </label>
                                        <div class="note">
                                            <a href="{{{ URL::action('login.index') }}}">Forgot password?</a>
                                        </div>
                                    </section>

                                    <section>
                                        <label class="checkbox">
                                            <input type="checkbox" name="remember" checked="">
                                            <i></i>Stay signed in</label>
                                    </section>
                                </fieldset>
                                <footer>
                                    <button type="submit" class="btn btn-primary">
                                        Sign in
                                    </button>
                                </footer>
                            {{ $formClose }}

                        </div>
                        
                    </div>
                </div>
            </div>

@stop
