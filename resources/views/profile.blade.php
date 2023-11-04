@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="row g-5">
                <div class="col-md-6">
                    <div class="card">
                        <h4 class="card-header">User Informations</h4>

                        <div class="card-body">

                            @if(session()->has('successInfo'))
                                <div class="alert alert-success">
                                    <h6 class="mb-0">{{session()->get('successInfo')}}</h6>
                                </div>
                            @endif

                            <form action="{{route('updateInfo')}}" method="POST">

                                @csrf
                                @method('PATCH')

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" placeholder="Your Name" name="name" value="{{$user->name}}">
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" placeholder="Your Email" name="email" value="{{$user->email}}">
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="username" placeholder="Your Username" name="username" value="{{$user->username}}">
                                    @error('username')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="date_of_birth" class="form-label">Date Of Birth</label>
                                    <input type="date" class="form-control" id="date_of_birth"  name="date_of_birth" value="{{$user->date_of_birth}}">
                                    @error('date_of_birth')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="bio" class="form-label">Bio</label>
                                    <textarea name="bio" id="bio" class="form-control" placeholder="Describe Yourself In 200 Characters">{{$user->bio}}</textarea>
                                    @error('bio')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Mobile</label>
                                    <input type="tel" min="10" max="10" class="form-control" id="mobile" placeholder="enter your mobile"  name="mobile" value="{{$user->mobile}}">
                                    @error('mobile')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select name="gender" id="gender" class="form-select">
                                        <option value="" selected></option>
                                        <option value="male" @selected($user->gender == 'male')>Male</option>
                                        <option value="female" @selected($user->gender == 'female')>Female</option>
                                    </select>
                                    @error('gender')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary w-100 mt-3">Update Info</button>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row gy-3">
                        <div class="col-md-12">
                            <div class="card">
                                <h4 class="card-header">Avatar</h4>
                                <div class="card-body">
                                    <form @submit.prevent=""  enctype="multipart/form-data">
                                        <span class="bg-dark p-5 rounded-circle d-flex justify-content-center align-items-center mx-auto position-relative" style="width: 180px;height: 180px">
                                            <div  class="rounded-circle profile-photo position-absolute  w-100 h-100"></div>
                                            <input id="avatar"  type="file" class="w-100 h-100 position-absolute opacity-0" name="avatar" accept="image/*"/>
                                        </span>
                                        <button class="btn btn-primary d-block mt-3 mx-auto" disabled>Update Avatar</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <h4 class="card-header">Password</h4>

                                <div class="card-body">

                                    @if(session()->has('successPassword'))
                                        <div class="alert alert-success">
                                            <h6 class="mb-0">{{session()->get('successPassword')}}</h6>
                                        </div>
                                    @elseif(session()->has('failedPassword'))
                                        <div class="alert alert-danger">
                                            <h6 class="mb-0">{{session()->get('failedPassword')}}</h6>
                                        </div>
                                    @endif


                                    <form action="{{route('updatePassword')}}" method="POST">

                                        @csrf
                                        @method('PATCH')

                                        <div class="mb-3">
                                            <label for="current_password" class="form-label">Current Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" id="current_password" placeholder="Current Password" name="current_password" value="{{old("current_password")}}">
                                            @error('current_password')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="new_password" class="form-label">New Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" id="new_password" placeholder="New Password" name="new_password" value="{{old("new_password")}}">
                                            @error('new_password')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>


                                        <div class="mb-3">
                                            <label for="new_password_confirmation" class="form-label">Current Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" id="new_password_confirmation" placeholder="New Password Confirmation" name="new_password_confirmation" value="{{old("new_password_confirmation")}}">
                                            @error('new_password_confirmation')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100 mt-3">Update Password</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

</div>

<script>

    document.querySelector('#avatar').onchange = function () {

        let reader = new FileReader();
        reader.addEventListener('load',()=> {
            const image = reader.result;
            document.querySelector('.profile-photo').style.backgroundImage = `url('${image}')`;
            document.querySelector('#submit-image').removeAttribute('disabled');
        })
        reader.readAsDataURL(this.files[0]);
    }

</script>

<style>
    .profile-photo {
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
    }
</style>

@endsection
