@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Return product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Return product history</li>
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
                <h5 class="card-title">Return product history</h5> <br>

                <table class="table table-bordered datatable">
                    <thead>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Product</th>
                        <th>Size</th>
                        <th>Quantity</th>
                    </thead>
                    <tbody>
                        @foreach ($returnProducts as $key => $product)
                        <tr class="text-center">
                            <td>{{ ++$key }}</td>
                            <td>{{ $product->date }}</td>
                            <td>{{ $product->product->name ?? null }}</td>
                            <td>{{ $product->size->size ?? null }}</td>
                            <td>{{ $product->quantity }}</td>
                        </tr>
                        @endforeach
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