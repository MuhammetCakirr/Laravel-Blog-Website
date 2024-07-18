@extends('template')
@section('body')

<div style="margin: 20px; ">
    <div class="row container">
        <div class="col-5">
            <div class="container uac">
                <div style="text-align: center;" class="user-info">
                    <img src="http://127.0.0.1:8000/images/uploads/user/{{$personel->photo_url}}" alt="avatar" width="100" height="100">
                </div>

                <div style="text-align: center;">
                    <span style="color: black;">{{$personel->fname." ".$personel->lname}}</span> <br>
                    <span>{{$personel->preface}}</span>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-6 col-md-6" style="text-align: center;">
                        <span style="color: black;">{{count($personel->posts)}}</span> <br>
                        <span>Post</span>
                    </div>
                    <div class="col-lg-6 col-6 col-md-6" style="text-align: center;">
                        <span style="color: black;">258</span><br>
                        <span>Followers</span>
                    </div>
                </div>
                <hr>

                <div>
                    <ul class="social-media-links">
                        <li style="text-align: center;">
                            <i class="fab fa-facebook"></i>
                            <a href="https://www.facebook.com/yourprofile" target="_blank">https://www.facebook.com/in/muhammet-çakır-35ba29222/</a>
                        </li>
                        <li>
                            <i class="fab fa-twitter"></i>
                            <a href="https://www.twitter.com/yourprofile" target="_blank">https://www.twitter.com/in/muhammet-çakır-35ba29222/</a>
                        </li>
                        <li>
                            <i class="fab fa-instagram"></i>
                            <a href="https://www.instagram.com/yourprofile" target="_blank">https://www.instagram.com/in/muhammet-çakır-35ba29222/</a>
                        </li>
                        <li>
                            <i class="fab fa-linkedin"></i>
                            <a href="https://www.linkedin.com/in/yourprofile" target="_blank">https://www.linkedin.com/in/muhammet-çakır-35ba29222/</a>
                        </li>
                       
                    </ul>
                </div>

            </div>
        </div>

        <div class="col-7">
            <section class="uapsection">
                @foreach ($personel->posts as $item)
                <div class="post">
                    <div class="post-header">
                        <div class="user-info">
                            <img src="http://127.0.0.1:8000/images/uploads/user/{{$personel->photo_url}}" alt="Avatar">
                            <span>{{$personel->fname." ".$personel->lname}}</span>
                        </div>
                        <?php
                        $formatted_date = \Carbon\Carbon::parse($item->created_at)->diffForHumans();
                        ?>
                        <span>{{ $formatted_date }}</span>
                    </div>
                    <div class="post-content">
                        
                        {{$item->content}}
                    </div>
                    <div class="post-images">
                        <img src="http://127.0.0.1:8000/images/uploads/post/{{$item->photo_url}}" alt="Blog Image 1">

                    </div>
                </div>
                @endforeach


            </section>
        </div>

            {{-- <div class="col-3">
                <div class="container uac">

                    <div>
                        <span style="color: black;">Writers You May Know</span> <br>
                        <div class="writers-list">
                            <div class="writer">
                                <img src="https://cdn.pixabay.com/photo/2014/09/17/11/47/man-449404_1280.jpg" alt="Avatar">
                                <div class="writer-info">
                                    <span>İsim Soyisim 1</span>
                                    <span>@kullanici1</span>
                                </div>
                            </div>
                            <div class="writer">
                                <img src="https://cdn.pixabay.com/photo/2024/03/27/15/23/customer-8659308_1280.png"
                                    alt="Avatar">
                                <div class="writer-info">
                                    <span>İsim Soyisim 2</span>
                                    <span>@kullanici2</span>
                                </div>
                            </div>
                            <div class="writer">
                                <img src="https://via.placeholder.com/50" alt="Avatar">
                                <div class="writer-info">
                                    <span>İsim Soyisim 3</span>
                                    <span>@kullanici3</span>
                                </div>
                            </div>
                            <div class="writer">
                                <img src="https://cdn.pixabay.com/photo/2014/09/17/11/47/man-449404_1280.jpg" alt="Avatar">
                                <div class="writer-info">
                                    <span>İsim Soyisim 1</span>
                                    <span>@kullanici1</span>
                                </div>
                            </div>
                            <div class="writer">
                                <img src="https://cdn.pixabay.com/photo/2024/03/27/15/23/customer-8659308_1280.png"
                                    alt="Avatar">
                                <div class="writer-info">
                                    <span>İsim Soyisim 2</span>
                                    <span>@kullanici2</span>
                                </div>
                            </div>
                            <div class="writer">
                                <img src="https://via.placeholder.com/50" alt="Avatar">
                                <div class="writer-info">
                                    <span>İsim Soyisim 3</span>
                                    <span>@kullanici3</span>
                                </div>
                            </div>

                        </div>



                    </div>

                    <hr>
                    <div>
                        <span style="color: black;">Topics that may interest you</span> <br>
                        <div class="topics-list">
                            <a class="topic-link" href="#">Konu Başlığı 1</a>
                            <a class="topic-link" href="#">Konu Başlığı 2</a>
                            <a class="topic-link" href="#">Konu Başlığı 3</a>
                            <!-- Daha fazla konu başlığı ekleyebilirsiniz -->
                        </div>
                    </div>
                </div>
            </div> --}}
    </div>
</div>

@endsection