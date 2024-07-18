<div class="col-3" style="margin-top: 100px;">
    <div class="container">
        <div class="settings-menu">
            <div class="settings-menu-item">
                <a href="{{route('Settings')}}">Profile <span class="arrow-icon">➔</span></a>
            </div>
            <hr>
            <div class="settings-menu-item">
                <a href="{{route('Users')}}">Users<span class="arrow-icon">➔</span></a>
            </div>
            <hr>
            <div class="settings-menu-item">
                <a href="{{route('GetPosts')}}">Posts<span class="arrow-icon">➔</span></a>
            </div>
            <hr>
            <div class="settings-menu-item">
                <a href="{{route('AddPost')}}">Create Post<span class="arrow-icon">➔</span></a>
            </div>
            <hr>
            <div class="settings-menu-item">
                <a href="{{route('Logout')}}">Logout <span class="arrow-icon">➔</span></a>
            </div>
            <hr>
            <div class="settings-menu-item">
                <a href="{{route('DeleteUserDb')}}">Delete Account <span class="arrow-icon">➔</span></a>
            </div>
            <hr>
        </div>
    </div>
</div>

@if(session('unauthorized'))
@include('errors.unauthorized_modal')

<script>
    console.log("girdi");
    document.addEventListener('DOMContentLoaded', function() {
        openModal(); // Modalı aç
    });
</script>
@endif