@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Companies</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('companies.index') }}">Companies</a></li>
                        <li class="breadcrumb-item active">Home</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10 ">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update '{{ $company['name'] }}' Information</h3>
                        </div>

                        <!-- form start -->
                        <form method="POST" action="{{ route('companies.update',$company) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Company Name" required value="{{ $company['name'] }}">
                                        @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Company Email" value="{{ $company['email'] }}">
                                        @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <input type="text" class="form-control" id="website" name="website"
                                        placeholder="Company Website" value="{{ $company['website'] }}">
                                        @error('website')
                                                    <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label for="logo">Logo</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="form-control" id="logo" name="logo" placeholder="Add Logo">
                                        </div>
                                    </div>
                                    
                                    <img src="{{ asset('storage/logos/' . $company['logo']) }}" alt="Logo"
                                    style="width:200px" class="mt-2 ml-2">
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Create</button>
                                <a href="{{ route('companies.index') }}" class="btn btn-warning">Cancel</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection

