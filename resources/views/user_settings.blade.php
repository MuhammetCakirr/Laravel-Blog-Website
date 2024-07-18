@extends('template')
@section('body')

<div class="container" style="margin: 50px; ">
    <div class="row">
        <h5 style="margin-left: 100PX; font-size: 24px;">Settings</h5>

        @include('components.navbar_admin')


        <div class="col-8">
            <div class="container">
                <form style="margin-top: 15px;" method="Post" action="{{route('UserSettingsUpdate')}}" enctype="multipart/form-data">
                    @csrf
                    <div style="text-align: center;">
                        <img src="{{$photo_url==""? "https://static.thenounproject.com/png/642902-200.png" :"http://127.0.0.1:8000/images/uploads/user/".$photo_url}}" alt="" style="object-fit: cover;" width="100" height="100"
                            id="user-photo">
                    </div>
                    @if ($errors->hasBag('UserUpdateErrors'))
                    @foreach ($errors->UserUpdateErrors->all() as $hatalar)
                        <li>{{$hatalar}}</li>
                    @endforeach     
                    @endif
                    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('validatedCustomFile'))
        <div class="alert alert-success">
            {{ session('validatedCustomFile') }}
        </div>
    @endif
                    <div class="custom-file form-control">
                        <input type="file" class="custom-file-input" name="validatedCustomFile" id="validatedCustomFile" >
                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <input type="text" name="setfname" class="form-control" placeholder="First name *" required
                                value="{{ $fname }}">
                        </div>

                        <div class="col">
                            <input type="text" name="setlname" class="form-control" placeholder="Last name *" required
                                value="{{ $lname }}">
                        </div>

                    </div>
                    <input type="email" class="form-control" name="setemail" placeholder="Email *" 
                        value="{{ $email }}" disabled>
                    <input type="password" class="form-control" name="setcurrentpasw" placeholder="Current Password *" >
                    <input type="password" class="form-control" name="setnewpasw_confirmation"
                        placeholder="New Password *" >
                    <input type="submit" value="Save Changes" class="signbtn">
                </form>
            </div>
        </div>

    </div>

</div>

<script>
    
    document.getElementById('validatedCustomFile').addEventListener('change', function (event) {
        var input = event.target;
        var file = input.files[0]; 
        var reader = new FileReader();

        reader.onload = function () {
            var dataURL = reader.result;
            var imgElement = document.getElementById('user-photo');
            imgElement.src = dataURL; 
        };

        reader.readAsDataURL(file); 
    });
</script>
@endsection