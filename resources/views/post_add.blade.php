@extends('template')
@section('body')

    <div class="container" style="margin: 30px;">
        <div class="row">
        <h5 style="margin-left: 100PX; font-size: 24px;">Create Post</h5>
        <div class="col-3" style="margin-top: 100px;">
            <div class="container">
                <div class="settings-menu">
                    <div class="settings-menu-item">
                        <a id="addpostbtn" href="">Create <span class="arrow-icon">➔</span></a>
                    </div>
                    <hr>
                    <div class="settings-menu-item">
                        <a  href="">Preview <span class="arrow-icon">➔</span></a>
                    </div>
                    <hr>
                </div>
            </div>
        </div>

        <div class="col-8">
            <div class="container">
                <form style="margin-top: 15px;" id="addpostform" method="Post" action="{{route('AddPostDb')}}" enctype="multipart/form-data">
                    @csrf

                    @if ($errors->hasBag('PostAddErrors'))
                    @foreach ($errors->PostAddErrors->all() as $hatalar)
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
                            <input type="text" name="posttitle" class="form-control" placeholder="Title *" required
                                >
                            <textarea  name="postsubject" placeholder="Subject *" rows="8" cols="99">
                            </textarea>

                        <div style="text-align: center;">
                        <div class="custom-file form-control">
                        <input type="file" class="custom-file-input" name="validatedCustomFile" id="validatedCustomFile" >
                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                    </div>

                    </div>
                    <div>
                    <div class="row my-4">
              <div class="col-md-6 mb-4">
                <img src="" alt="Image placeholder" id="postimage" class="img-fluid rounded">
              </div>
            </div>
                    </div>
                    
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
            var imgElement = document.getElementById('postimage');
            imgElement.src = dataURL; 
        };

        reader.readAsDataURL(file); 
    });
    document.getElementById('addpostbtn').addEventListener('click', function (event) {
        event.preventDefault();
        document.getElementById('addpostform').submit();
    });

    
</script>
@endsection