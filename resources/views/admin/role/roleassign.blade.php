@extends('layouts.admin')
@section('title')
Role permission
@endsection

@section('page-content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> User Permission </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"> Salary </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div style="padding-left:15px; background-color:aliceblue; color:black; ">
        {{ session('msg') }}
    </div>


    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <div class="">
        <form action=" {{ route('admin.roleassign') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="user"> User Name </label>
                    <select name="user" id="user" class="form-control">
                        @foreach($userdata as $row)
                        <option value="{{ $row->id }}"> {{ $row->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="role"> Role </label>
                    <select name="role" id="role" class="form-control">
                        @foreach($roledata as $row)
                        <option value="{{ $row->id }}"> {{ $row->roles_id }} </option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-primary"> submit </button>
            </div>
        </form>
    </div>

    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th> USER </th>
                    <th> permission </th>
                </tr>
            </thead>
            <tbody>
    
                @foreach($data as $row)
                <tr>
                    <td> {{ $row->userName->name }} </td>
                    <td> {{ $row->roleName->roles_id }} </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </div>




</div>

@endsection




@section('script.js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>



</script>
@endsection