@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Product List</li>
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
                <h5 class="card-title">Product List</h5> <br>

                <a href="{{ route('products.create') }}" 
                  class="btn btn-success btn-sm mb-2 mt-2">
                  <i class="fa fa-plus"></i> Create
                </a>
                <table class="table table-bordered datatable">
                    <thead>
                        <th>SL</th>
                        <th class="text-center">Image</th>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                        <tr class="text-center">
                            <td>{{ ++$key }}</td>
                            <td class="text-center">
                              <img style="width: 64px" src="{{ asset('storage/images/products/'. $product->image) }}" alt="product_image">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->sku }}</td>
                            <td>{{ ($product->category->name) ?? null }}</td>
                            <td>{{ ($product->brand->name) ?? null }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info btn-sm">
                                  <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm ml-2">
                                  <i class="fa fa-eye"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-danger sweet-alert-delete btn-sm ml-2" data-form-id="product-delete-{{ $product->id }}">
                                  <i class="fa fa-trash"></i>
                                </a>
                                <form id="product-delete-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST">
                                  @csrf
                                  @method('DELETE')

                                </form>
                            </td>
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