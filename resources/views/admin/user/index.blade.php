@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">User List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-10 offset-1">
            {{-- for flash message --}}
            @include('flash::message')
            {{-- card --}}
            <div class="card card-primary card-outline">
              <div class="card-body">
                <h5 class="card-title">User List</h5> <br>

                <a href="{{ route('users.create') }}" 
                  class="btn btn-success btn-sm mb-2 mt-2">
                  <i class="fa fa-plus"></i> Create
                </a>
                <table class="table table-bordered datatable">
                    <thead>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @if ($users)
                            @foreach ($users as $key => $user)
                                <tr class="text-center">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        {{ $user->email }}
                                        @if(auth()->id() == $user->id)
                                            (you)
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('Y-m-d') ?? null }}</td>
                                    <td>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                       @if (auth()->id() != $user->id)
                                            <a href="javascript:;" class="btn btn-danger sweet-alert-delete ml-2" data-form-id="user-delete-{{ $user->id }}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form id="user-delete-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                       @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
              </div>
            </div><!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection