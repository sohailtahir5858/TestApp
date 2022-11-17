@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('words.Employees') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('companies.index') }}">{{ __('words.Employees') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('words.Update') }}</li>
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
                            <h3 class="card-title">Update '{{ $employee['firstName'] .' '. $employee['lastName'] }}' Information
                            </h3>
                        </div>

                        <!-- form start -->
                        <form method="POST" action="{{ route('employees.update', $employee) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstName">{{ __('words.firstName') }}</label>
                                            <input type="text" class="form-control" id="firstName" name="firstName"
                                                placeholder="First Name" required value="{{ $employee->firstName }}">
                                            @error('firstName')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lastName">{{ __('words.lastName') }}</label>
                                            <input type="text" class="form-control" id="lastName" name="lastName"
                                                placeholder="Last Name" required value="{{ $employee->lastName }}">
                                            @error('lastName')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">{{ __('words.Email') }}</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Email" value="{{ $employee->email }}">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">{{ __('words.Phone') }}</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                placeholder="Phone" value="{{ $employee->phone }}">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="company">{{ __('words.Company') }}</label>
                                    <select class="form-control" id="company" name="company" required>
                                        <option value="">{{ __('words.Select Company') }}</option>

                                        {{-- Showing all the companies in dropdown --}}
                                        @foreach ($companies as $company)
                                            {{-- Making sure that previuos company is selected by default --}}

                                            @if ($employee->company == $company->id)
                                                <option value="{{ $company->id }}" selected>{{ $company->name }}</option>
                                            @else
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                    @error('company')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{ __('words.Update') }}</button>
                                <a href="{{ route('employees.index') }}" class="btn btn-warning">{{ __('words.Cancel') }}</a>
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
