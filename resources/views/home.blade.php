@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12" style="margin-top:30px">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Users</h4>
                    <form method="GET" action="/search-user"> 
                        @csrf
                    <div>
                      
                        <input type="text" class="form-control" name="search">
                     </div>
                     <div>
                        <input type="submit" value="Search" class="form-control btn btn-primary">
                     </div>
                    </form>

                    <div>
                        <a class="btn btn-sm btn-primary" href="{{ route('users.create') }}">
                            <i class="fa fa-plus"></i>
                            Add New User
                        </a>
                    </div>
                    
                  
                </div>
                <!-- /.box-header -->
                <div class="card-body table-responsive no-padding">

                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>

                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id}}</th>
                            <td>{{ $user->name}}</td>
                            <td>{{ $user->email}}</td>
                            <td><img src="/images/{{ $user->image}}" height="100" width="100"></td>
                            <td class="text-center">
                                <form  method="POST" action="{{ route('users.destroy', $user->id) }}">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <input type="submit" value="Delete" class="btn btn-danger btn-block" onclick="return confirm('Are you sure to delete?')">       
                                 </form>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-primary btn-sm" href="{{ route('users.edit', $user->id) }}">
                                    Edit
                                </a>
    
                            </td>
                          </tr>
                        @endforeach 
                    </tbody>
                  </table>
                  {{ $users->links()}}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
            
</div>
@endsection
