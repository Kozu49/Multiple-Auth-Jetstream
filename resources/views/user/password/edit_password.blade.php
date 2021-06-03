@extends('user.user_master')

@section('user')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<div class="row" style="padding: 20px;">
    <div class="col-md-4">
<h3>Change Password</h3>
   

<form method="POST" action="{{route('password.update')}}" >
@csrf
<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Current Password</label>
    <input type="password"  class="form-control" name="oldpassword" id="current_password" >
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">New Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
  </div>

  
  <button type="submit" class="btn btn-primary">Update</button>
</form>

</div>
</div>



@endsection