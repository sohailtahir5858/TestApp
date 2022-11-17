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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Website</th>
                                        <th>Logo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Company</td>
                                        <td>Company @123 .com
                                        </td>
                                        <td><a href="">companysite</a></td>
                                        <td><img src="" alt="img not found" style=""></td>
                                        <td>
                                            <i class="fa fa-edit"></i>
                                            <i class="fa fa-trash"></i>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
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
        });
    </script>
@endsection
