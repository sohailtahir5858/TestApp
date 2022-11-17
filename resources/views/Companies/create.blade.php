@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('words.Companies') }}</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('companies.index') }}">{{ __('words.Companies') }}</a></li>
                        <li class="breadcrumb-item active">Home</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10 ">
                    {{-- Showing if we have any message from the session! --}}
                    @if (Session::has('message'))
                        <div class="alert alert-{{ Session::get('type') }} alert-dismissible fade show" role="alert">
                            {{ Session::get('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('words.Add New Company') }}</h3>
                        </div>

                        <!-- form start -->
                        <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">{{ __('words.Name') }}</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Company Name" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">{{ __('words.Email') }}</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Company Email" required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="website">{{ __('words.Website') }}</label>
                                    <input type="text" class="form-control" id="website" name="website"
                                        placeholder="Company Website">
                                    @error('website')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="logo">{{ __('words.Logo') }}</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="form-control" id="logo" name="logo"
                                                placeholder="Add Logo">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{ __('words.Create') }}</button>
                                <a href="{{ route('companies.index') }}" class="btn btn-warning">{{ __('words.Cancel') }}</a>
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
