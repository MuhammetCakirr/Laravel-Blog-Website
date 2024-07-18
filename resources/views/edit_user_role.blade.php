@extends('template')
@section('body')
    <div class="container" style="margin: 50px; ">
        <div class="row">
            <h5 style="margin-left: 100PX; font-size: 24px;">User Detail</h5>

            @include('components.navbar_admin')


            <div class="col-8" style="margin-top: 100px;">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="container">
                    
                    <div style="text-align: center;">
                        <img src="{{$user->photo_url==""? "https://static.thenounproject.com/png/642902-200.png" :"http://127.0.0.1:8000/images/uploads/user/".$user->photo_url}}" alt="" style="object-fit: cover;" width="100" height="100"
                            id="user-photo">
                    </div>
                    <div class="form-row m-2" >
                        <div class="col">
                            <label for="email">First Name</label>
                            <input type="text"  class="form-control" placeholder="First name *" required
                                value="{{ $user->fname }}" disabled>
                        </div>

                        <div class="col">
                            <label for="email">Last Name</label>
                            <input type="text"  class="form-control" placeholder="Last name *" required
                                value="{{ $user->lname }}" disabled>
                        </div>

                    </div>

                    <div class="form-row m-2" >
                        <div class="col">
                            <label for="email">Email</label>
                            <input type="text" id="email"  class="form-control" placeholder="First name *" required
                                value="{{ $user->email }}" disabled>
                        </div>

                        <div class="col">
                            <label for="email">Created Date</label>
                            <input type="text"  class="form-control" placeholder="Last name *" required
                                value="{{ $user->created_at }}" disabled>
                        </div>

                    </div>
                    <form action="{{route('EditUserRoleFun')}}" method="POST">
                        @csrf
                    <div class="row">
                        
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        @foreach($roles as $role)
                        <div class="col-3">
                            <input type="checkbox" id="role_{{ $role->id }}" name="roles[]" value="{{ $role->name }}"
                                @if($user->roles->contains('id', $role->id)) checked @endif>
                            <label for="role_{{ $role->id }}">{{ $role->name }}</label>
                        </div>
                    @endforeach
                    <input type="submit" value="Save Changes" class="signbtn">
                </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
