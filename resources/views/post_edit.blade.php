@extends('template')
@section('body')

    <div class="container" style="margin: 30px;">
        <div class="row">
        <h5 style="margin-left: 100PX; font-size: 24px;">Post Edit</h5>
        <div class="col-3" style="margin-top: 100px;">
            <div class="container">
                <div class="settings-menu">
                    <div class="settings-menu-item">
                        <a id="editpostbtn" href="">Save Changes <span class="arrow-icon">➔</span></a>
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
                <form style="margin-top: 15px;" id="editpostform" method="Post" action="{{route("EditPostOfDb")}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="editpostid" value="{{$post->id}}">
                            <input type="text" name="editposttitle" class="form-control" placeholder="Title *" required
                               value="{{$post->title}}" >
                            <textarea  name="editpostsubject" placeholder="Subject *" rows="8" cols="99" style="color: :black" >
                                {{trim($post->content) }}
                            </textarea>

                        <div style="text-align: center;">
                        <div class="custom-file form-control">
                        <input type="file" class="custom-file-input" name="editvalidatedCustomFile" id="editvalidatedCustomFile" >
                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                    </div>

                    </div>
                    <div>
                    <div class="row my-4">
              <div class="col-md-6 mb-4">
                <img src="http://127.0.0.1:8000/images/uploads/post/{{$post->photo_url}}" alt="Image placeholder" id="editpostimage" class="img-fluid rounded">
              </div>
            </div>
                    </div>
                    
                </form>
            </div>
        </div>

    </div>
    </div>

    <script>
    
    document.getElementById('editvalidatedCustomFile').addEventListener('change', function (event) {
        var input = event.target;
        var file = input.files[0]; 
        var reader = new FileReader();

        reader.onload = function () {
            var dataURL = reader.result;
            var imgElement = document.getElementById('editpostimage');
            imgElement.src = dataURL; 
        };

        reader.readAsDataURL(file); 
    });
    document.getElementById('editpostbtn').addEventListener('click', function (event) {
        event.preventDefault();
        document.getElementById('editpostform').submit();
    });

    
</script>
@endsection