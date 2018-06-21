@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong class="panel-title pull-left">{{ trans('allstr.login') }}</strong>
                    <!-- Single button -->
                    <div class="btn-group pull-right" >
                        <button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if(LaravelLocalization::getCurrentLocale() == 'en')
                                <img src="/en.png" alt="English"> English
                            @else
                                <img src="/kh.png" alt="ភាសាខ្មែរ"> ភាសាខ្មែរ
                            @endif
                                <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            @if(LaravelLocalization::getCurrentLocale() == 'en')
                                <li>
                                    <a rel="alternate" hreflang="km" href="{{ LaravelLocalization::getLocalizedURL('km') }}">
                                       <img src="/kh.png" alt="ភាសាខ្មែរ"> ភាសាខ្មែរ
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a rel="alternate" hreflang="en" href="{{ LaravelLocalization::getLocalizedURL('en') }}">
                                        <img src="/en.png" alt="English"> English
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">{{ trans('allstr.email_address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">{{ trans('allstr.password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ trans('allstr.remember_me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('allstr.login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ trans('allstr.forgot_password') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="pull-left">
                <h4><strong> {{ trans('allstr.mobile_app') }} </strong></h4>
            </div>
            <div class="pull-right">
                <a href="https://itunes.apple.com/us/app/salt-cambodia/id1400726630?ls=1&mt=8" target="_blank">
                    <img src="/appstore.png">
                </a>
                <a href="https://play.google.com/store/apps/details?id=com.unicef.saltapp" target="_blank">
                    <img src="/playstore.png">
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
