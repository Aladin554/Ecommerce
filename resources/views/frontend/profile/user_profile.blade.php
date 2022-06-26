@extends('frontend.main_master')
@section('content')

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <img class="card-img-top" style="border-radius:50%" src="{{ $user->profile_photo_path ? 
                    asset('storage/user_photo_path/' . $user->profile_photo_path) :
                     asset('storage/no_image/no_image.png') }}" style="width: 100px" height="100px"; alt="">
                     <ul class="list-group list-group-flush">
                         <a href="" class="btn btn-primary btn-sm btn-block">Home</a>
                         <a href="{{route('user.profile')}}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                         <a href="{{route('user.change.password')}}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                         <a href="{{route('user.logout')}}" class="btn btn-primary btn-sm btn-block">Logout</a>
                     </ul>
            </div>
            <div class="col-md-2">


            </div>

            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Hi....<strong>{{Auth::user()->name}}</strong><br>Update Your Profile</span></h3>

                    <div class="card-body">
                        <form method="POST" action="{{route('user.profile.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Name <span>*</span></label>
                                <input type="name" name="name" value="{{$user->name}}" class="form-control unicase-form-control text-input">
                                
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Email<span>*</span></label>
                                <input type="email"  name="email" value="{{$user->email}}" class="form-control unicase-form-control text-input">
                               
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Phone<span>*</span></label>
                                <input type="number"  name="phone" value="{{$user->phone}}" class="form-control unicase-form-control text-input">
                                
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Image <span>*</span></label>
                                <input type="file"  name="profile_photo_path" value="{{$user->profile_photo_path}}" class="form-control unicase-form-control text-input">
                                
                            </div>
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Update</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection