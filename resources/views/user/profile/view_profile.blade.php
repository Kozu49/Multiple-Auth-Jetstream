@extends('user.user_master')

@section('user')
<div class="card" style="width: 20rem;">
  <img src="{{ (!empty($user->profile_photo_path)) ? url('upload/user_images/'.$user->profile_photo_path):url('upload/no_image.jpg')}}" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">User Name:{{$user->name}}</h5>
    <p class="card-text">User Email:{{$user->email}}</p>
    <a href="{{route('profile.edit')}}" class="btn btn-primary">Edit</a>
  </div>
</div>



@endsection


