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
    <input type="text" id="name" name="name" class="form-control">
    </div>          
    <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" id="email" name="email" class="form-control">
    </div>  
    <div class="form-group">
        <label for="exampleInputEmail1">Password</label>
        <input type="password" id="password" name="password" class="form-control">
        </div>           
    <div class="form-group">
    <label for="exampleInputEmail1">Image</label>
    <input type="file" name="image" id="image" class="form-control" accept=".png, .jpg,.jpeg">
    </div>
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
    password: {
    required: true,
    maxlength: 10
    },
    image: {
        required: true,
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
    image: {
            required: "Please upload Image.",
            extension: "Please upload Image in these format only (jpg, jpeg, png, ico, bmp)."
        },
   password: {
            required: "Please enter password.",
        }
    },
    submitHandler: function(form) {
     var email = document.getElementById('email').value;
     var name = document.getElementById('name').value;
     var password = document.getElementById('password').value;

  var formData = new FormData();
  formData.append('image', $("#image")[0].files[0]);
  formData.append('name', name);
  formData.append('password', password);
  formData.append('email', email);

    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $('#submit').html('Please Wait...');
    $("#submit"). attr("disabled", true);
    $.ajax({
    url: "{{route('users.store')}}",
    type: "POST",
    cache:false,
    data:formData,
    contentType: false,
    processData: false,
    success: function( response ) {
    $('#submit').html('Submit');
    $("#submit"). attr("disabled", false);
    alert('Ajax form has been submitted successfully');
    document.getElementById("contactUsForm").reset(); 
    }
    });
    }
    })
    }
    </script>
    
@endsection
