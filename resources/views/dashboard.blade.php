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
        
              <h1>WelCome {{Auth::user()->name}} </h1> 
       
    </div>

</div>
</div>
</div>
</div>

@endsection