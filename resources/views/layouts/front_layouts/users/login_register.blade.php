@extends('layouts.front_layouts.master')

@section('title', 'Login')

@section('main-content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{  url('/') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Login-Register</li>
    </ul>
	<h3> Login / Register</h3>	
    <hr class="soft"/>
        @if(Session::has('error_message'))
            <div class="alert alert-danger">
            <strong>Oppps!</strong>  {{ Session::get('error_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        @endif
	
	<div class="row">
		<div class="span4">
			<div class="well">
                <h5>CREATE YOUR ACCOUNT</h5><br/>
                Enter your details to create an account.<br/><br/><br/>
                <form action="{{ url('/register') }}" method="post" id="registerForm">
                @csrf
                    <div class="control-group">
                        <label class="control-label" for="name">Name</label>
                        <div class="controls">
                            <input class="span3"  type="text" id="name" placeholder="Enter Name" name="name">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="email">E-mail</label>
                        <div class="controls">
                            <input class="span3"  type="email" name="email" id="email" placeholder="Enter Email">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="mobile">Mobile</label>
                        <div class="controls">
                            <input class="span3"  type="text" id="mobile" placeholder="Enter Mobile" name="mobile">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="password">Password</label>
                        <div class="controls">
                            <input class="span3"  type="password" name="password" id="password" placeholder="Enter Password">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="password">Re-type Password</label>
                        <div class="controls">
                            <input class="span3"  type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                        </div>
                    </div>

                    <div class="controls">
                        <button type="submit" class="btn block">Create Your Account</button>
                    </div>
                </form>
		    </div>
		</div>
		<div class="span1"> &nbsp;</div>
		<div class="span4">
			<div class="well">
			    <h5>ALREADY REGISTERED ?</h5>
                <form action="{{ url('/login') }}" method="post" id="loginForm">
                @csrf
                    <div class="control-group">
                        <label class="control-label" for="email">Email</label>
                        <div class="controls">
                        <input class="span3"  type="text" id="email" name="email" placeholder="Enter Email">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="password">Password</label>
                        <div class="controls">
                        <input type="password" class="span3"  id="password" name="password" placeholder="Enter Password">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                        <button type="submit" class="btn">Sign in</button> <a href="#">Forget password?</a>
                        </div>
                    </div>
                </form>
		    </div>
		</div>
	</div>	
</div>
@endsection