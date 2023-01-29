@extends('layouts.admin')
@section('title')
database backup
@endsection

@section('page-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> User Permission </h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"> User Permission </li>
                    </ol>
                </div>
            </div>
        </div>

    </div>



    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="form-group col-4 mt-5">
                <label for=""> user </label>
                <select name="officer" id="officer" class="form-control">
                    @foreach($data as $row)
                    <option value="{{ $row->id }}"> {{ $row->name }} </option>
                    @endforeach
                </select>
            </div>

            <div class="col-7 mt-5">
                <div class="form-group">
                    <label for=""> User Disable </label>
                </div>

                <div class="form-group">
                    <label for=""> password Lock </label>
                </div>

                <div class="form-group">
                    <label for=""> password change </label>
                </div>

            </div>
        </div>
    </section>

</div>

@endsection