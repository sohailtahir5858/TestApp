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
                        <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">{{ __('words.Employees') }}</a></li>
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
                            <a href="{{ route('employees.create') }}" class="btn btn-success float-end">{{ __('words.Add Employee') }}</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>{{ __('words.firstName') }}</th>
                                        <th>{{ __('words.lastName') }}</th>
                                        <th>{{ __('words.Email') }}</th>
                                        <th>{{ __('words.Phone') }}</th>
                                        <th>{{ __('words.Company') }}</th>
                                        <th>{{ __('words.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Forload to iterate through Employee Array --}}
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{ $employee->id }}</td>
                                            <td>{{ $employee->firstName }}</td>
                                            <td>{{ $employee->lastName }}</td>
                                            <td>{{ $employee->email }}</a>
                                            <td>{{ $employee->phone }}</a>
                                                <td>{{ $employee->companies->name }}</a>
                                            </td>

                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('employees.edit', $employee) }}"
                                                        class="btn btn-success btn-sm mr-1"><i class="fa fa-edit"></i></a>

                                                    <form action="{{ route('employees.destroy', $employee) }}"
                                                        method="POST" onsubmit="return confirm('Are Your Sure?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger mr-1  btn-sm">
                                                            <i class="fas fa-trash-alt "
                                                                title="Delete Employee Information"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="col-md-12">
                                {!! $employees->links() !!}
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
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
