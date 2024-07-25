@extends('layouts.content')
@section('main-content')
<div class="container">
    <div class="col-md-12">
        <div class="form-appl">
            <h3>{{ $title }}</h3>
            <form class="form1" method="post" action="@if (isset($edit->id)) {{ route('user.update', ['id' => $edit->id]) }}@else{{ route('user.store') }} @endif" enctype="multipart/form-data">
                @csrf
                <div class="form-group col-md-12 mb-3">
                    <label for="first_name">First Name</label>
                    <input class="form-control" type="text" name="first_name" placeholder="Jane" value="@if (isset($edit->id)) {{ $edit->first_name }}@else {{ old('first_name') }} @endif">
                    @error('first_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-12 mb-3">
                    <label for="last_name">Last Name</label>
                    <input class="form-control" type="text" name="last_name" placeholder="Doe" value="@if (isset($edit->id)) {{ $edit->last_name }}@else {{ old('last_name') }} @endif">
                    @error('last_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-12 mb-3">
                    <label for="phone_number">Phone Number</label>
                    <input class="form-control" type="text" name="phone_number" placeholder="+63XXXXXXXXX" value="@if (isset($edit->id)) {{ $edit->phone_number }}@else {{ old('phone_number') }} @endif">
                    @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-12 mb-3">
                    <label for="email">Email Address</label>
                    <input class="form-control" type="email" name="email" placeholder="janedoe@testmail.com" value="@if (isset($edit->id)) {{ $edit->email }}@else {{ old('email') }} @endif">
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-12 mb-3">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input class="form-control" type="password" name="password" placeholder="Enter Your Password">
                        <div class="input-group-append">
                            <span class="input-group-text" onclick="togglePasswordVisibility(this)">
                                <i class="fas fa-eye p-1"></i>
                            </span>
                        </div>
                    </div>
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-12 mb-5">
                    <label for="">Photo</label>
                    <div class="avatar-upload">
                        <div>
                            <input type='file' id="imageUpload" name="photo" accept=".png, .jpeg, .jpg" onchange="previewImage(this)" />
                            <label for="imageUpload"></label>
                        </div>
                        @php
                        $background = isset($edit->photo) && $edit->photo != ''
                        ? 'url(' . url('/') . '/uploads/' . $edit->photo . ')'
                        : 'url(' . url('/img/avatar.png') . ')';
                        @endphp
                        <div class="avatar-preview mt-3">
                            <div id="imagePreview" style="background-image: url('{{ $background }}')"></div>
                        </div>
                    </div>
                    @error('photo')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <input type="submit" class="btn btn-success" value="Submit">
                <a class="btn btn-danger" href="{{ route('user.index') }}">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
@push('js')
<script type="text/javascript">
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#imagePreview").css('background-image', 'url(' + e.target.result + ')');
                $("#imagePreview").hide();
                $("#imagePreview").fadeIn(700);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function togglePasswordVisibility(element) {
        var passwordInput = element.parentElement.previousElementSibling;
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            element.innerHTML = '<i class="fas fa-eye-slash p-1"></i>';
        } else {
            passwordInput.type = "password";
            element.innerHTML = '<i class="fas fa-eye p-1"></i>';
        }
    }
</script>
@endpush
<style>
    .avatar-upload {
        position: relative;
        max-width: 205px;
    }

    .avatar-upload .avatar-preview {
        width: 67%;
        height: 147px;
        position: relative;
        border-radius: 3%;
        border: 6px solid #F8F8F8;
    }

    .avatar-upload .avatar-preview>div {
        width: 100%;
        height: 100%;
        border-radius: 3%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }

    .input-group-text {
        cursor: pointer;
    }
</style>