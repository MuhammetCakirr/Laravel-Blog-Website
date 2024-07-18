@extends('template')
@section('body')
    <div  style="margin: 50px; ">
        <div class="row">
            <h5 style="margin-left: 100PX; font-size: 24px;">Posts</h5>

            @include('components.navbar_admin')


            <div class="col-8" style="margin-top: 100px;">
                @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
                <div class="container">
                    <div style="overflow-x: auto;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Comment Count</th>
                                    <th scope="col">Created By</th>
                                    <th scope="col">Edit By</th>
                                    <th scope="col">Status</th>
                                    <th scope="row"></th>
                                    <th scope="row"></th>
                                    <th scope="row">Approved</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $item)
                                @php
                                    $words = explode(' ', $item->content);
                                    $content = count($words) > 50 ? implode(' ', array_slice($words, 0, 9)) . '...' : $item->content;
                                    $editor = empty($item->editor->fname) ? '-' : $item->editor->fname . ' ' . $item->editor->lname;
                                @endphp
                                <tr>
                                    <td>{{$item->title}}</td>
                                    <td>{{ $content }}</td>
                                    <td><img src="{{ url('images/uploads/post/' . $item->photo_url) }}" alt="Photo" width="50" height="50" style="object-fit: cover;"></td>
                                    <td>{{count($item->comments) }}</td>
                                    <td>{{$item->publisher->fname . ' ' . $item->publisher->lname}}</td>
                                    <td>{{$editor}}</td>
                                    @component('components.table_active_td', ['item' => $item])
                                    @endcomponent
                                    


                                    @component('components.table_btn_td', ['item' => $item])
                                    @endcomponent


                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    

@endsection