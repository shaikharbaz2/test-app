@extends('layouts.app')

@section('content')


<div class="container mt-4">
    <div class="card">
    <div class="card-header text-center font-weight-bold">
    <h2>Create User</h2>
    </div>
    <div class="card-body">
    <form name="contactUsForm" id="contactUsForm" method="post" action="javascript:void(0)" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" id="name" name="name" class="form-control" value="{{ $user->name}}">
    </div>          
    <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" id="email" name="email" class="form-control" value="{{ $user->email}}">
    </div>            
    <div class="form-group">
    <label for="exampleInputEmail1">Image</label>
    <input type="file" name="image" id="image" class="form-control" accept=".png, .jpg,.jpeg">
    </div><br>
    <div class="form-group">
        <img src="/images/{{ $user->image}}" height="100px" width="100px">
    </div><br>
    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
    </form>
    </div>
    </div>
    </div>    
    <script>
    if ($("#contactUsForm").length > 0) {

    $("#contactUsForm").validate({

    rules: {
    name: {
    required: true,
    maxlength: 50
    },
    email: {
    required: true,
    maxlength: 50,
    email: true,
    },  
   
    },
    messages: {
    name: {
    required: "Please enter name",
    maxlength: "Your name maxlength should be 50 characters long."
    },
    email: {
    required: "Please enter valid email",
    email: "Please enter valid email",
    maxlength: "The email name should less than or equal to 50 characters",
    },   
    },
    submitHandler: function(form) {
     var email = document.getElementById('email').value;
     var name = document.getElementById('name').value;

  var formData = new FormData();
  formData.append('image', $("#image")[0].files[0]);
  formData.append('name', name);
  formData.append('email', email);
  formData.append('_method', 'PUT');
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $('#submit').html('Please Wait...');
    $("#submit"). attr("disabled", true);
    $.ajax({
    url: "{{route('users.update',$user->id )}}",
    type: "POST",
    cache:false,
    data:formData,
    contentType: false,
    processData: false,
    success: function( response ) {
    $('#submit').html('Submit');
    $("#submit"). attr("disabled", false);
    alert('Ajax form has been submitted successfully');
    window.location.reload();
    }
    });
    }
    })
    }
    </script>
    
@endsection
