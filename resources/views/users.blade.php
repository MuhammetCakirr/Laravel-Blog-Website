
@extends('template')
@section('body')
    <div class="container" style="margin: 50px; ">
        <div class="row">
            <h5 style="margin-left: 100PX; font-size: 24px;">Users</h5>

            @include('components.navbar_admin')


            <div class="col-8" style="margin-top: 100px;">
              @if (session('message'))
              <div class="alert alert-success">
                  {{ session('message') }}
              </div>
          @endif

          @if (session('error'))
          <div class="alert alert-danger">
              {{ session('error') }}
          </div>
      @endif
                <div class="container">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Id</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Role</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Confirm</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->fname}}</td>
                                <td>{{$item->lname}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->created_at}}</td>

                                <td>
                                  @foreach($item->roles as $role)
                                      <span>{{ $role->name }}</span><br>
                                  @endforeach
                              </td>
                              <td>
                                <form action="{{ route('EditUserRole') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="userid" value="{{ $item->id }}">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </form>

                            </td>
                                @component('components.table_btn_users', ['item' => $item])
                                @endcomponent
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
@endsection
