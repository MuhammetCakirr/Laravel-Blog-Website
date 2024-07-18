@extends('template')
@section('body')
<div class="container" style="margin: 75px;">
    <div class="row">
        @guest
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="container" id="ncc">
                    <h5 style="color: black;">New Customer</h5>
                    @if ($errors->hasBag('SignUpErrors'))
                        @foreach ($errors->SignUpErrors->all() as $hatalar)
                            <li>{{$hatalar}}</li>
                        @endforeach     
                    @endif
                    @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                    <form style="margin-top: 15px;" method="Post" action="{{route('SignUp')}}">
                        @csrf
                        <div class="form-row">
                            <div class="col">
                                <input type="text" name="sofname" class="form-control" placeholder="First name *" required>
                            </div>
                            <div class="col">
                                <input type="text" name="solname" class="form-control" placeholder="Last name *" required>
                            </div>
                        </div>
                        <input type="email" class="form-control" name="soemail" placeholder="Email *" required>
                        <input type="password" class="form-control" name="sopasw" placeholder="Password *" required>
                        <input type="password" class="form-control" name="sopasw_confirmation"
                            placeholder="Confirm Password *" required>
                        <p>By registering your details, you agree with our Terms & Conditions, and Privacy and Cookie
                            Policy.</p>
                        <input type="submit" value="Sign Up" class="signbtn">
                    </form>
                </div>
            </div>
        @endguest


        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="container" id="ncc">
                <h5 style="color: black;">Returning Customer</h5>
                @if ($errors->hasBag('SignInErrors'))
                    @foreach ($errors->SignInErrors->all() as $hatalar)
                        <li>{{$hatalar}}</li>
                    @endforeach     
                @endif
                @if ($errors->has('email'))
                    <div class="alert alert-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <form style="margin-top: 15px;" method="Post" action="{{route('SignIn')}}">
                    @csrf
                    <input type="email" name="siemail" class="form-control" placeholder="Email * ">
                    <input type="password" class="form-control" name="sipasw" placeholder="Password *">
                    <input type="checkbox" id="rememberme" name="sirme" value="0">
                    <label for="rememberme"> Remember me </label><br>
                    <input type="submit" value="Sign In" class="signbtn">
                </form>

            </div>
        </div>
    </div>
</div>
@endsection