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
                <div class="col-12">
                    {{-- Showing if we have any message from the session! --}}
                    @if (Session::has('message'))
                        <div class="alert alert-{{ Session::get('type') }} alert-dismissible fade show" role="alert">
                            {{ Session::get('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            {{-- <h3 class="card-title">List of Companies</h3> --}}
                            <a href="{{ route('companies.create') }}" class="btn btn-success float-end">Add
                                Company</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Website</th>
                                        <th>Logo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($companies as $company)
                                        <tr>
                                            <td>{{ $company->id }}</td>
                                            <td>{{ $company->name }}</td>
                                            <td>{{ $company->email }}</td>
                                            <td><a href="{{ $company->name }}" target="_blank">{{ $company->website }}</a>
                                            </td>
                                            <td>
                                                <img src="{{ asset('storage/logos/' . $company->logo) }}" alt="Logo"
                                                    style="width:80px;height:80px">
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('companies.edit', $company) }}"
                                                        class="btn btn-success btn-sm mr-1"><i class="fa fa-edit"></i></a>

                                                    <form action="{{ route('companies.destroy', $company) }}"
                                                        method="POST" onsubmit="return confirm('Are Your Sure?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger mr-1  btn-sm">
                                                            <i class="fas fa-trash-alt "
                                                                title="Delete Company Information"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="col-md-12">
                                {!! $companies->links() !!}
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

{{-- section add add script and js --}}
@section('script')
    <script>
        $("#example").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "bPaginate": false,
        });
    </script>
@endsection
