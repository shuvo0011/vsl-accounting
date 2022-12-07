@extends('layouts.admin')
@section('title')
Salary Edit
@endsection

@section('page-content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Salary </h1>
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



    <div>
        <form action=" {{ route('admin.salary.update') }}" method="POST">
            @csrf
            <div class="card-body">

                <input name="id" value="{{ $id }}" hidden>

                <div class="form-group">
                    <label for="officer_name"> Officer Name </label>
                    <input type="text" class="form-control" name="officer_name" value="{{ $data->officer_name }}" id="Officer_name">
                </div>

                <div class="form-group">
                    <label for="officer_id"> Officer ID </label>
                    <input type="text" class="form-control" name="officer_id" value="{{ $data->officer_id }}" id="officer_id">
                </div>

                <div class="form-group">
                    <label for="salary_month"> Salary Month </label>
                    <input type="date" class="form-control" name="salary_month" value="{{ $data->salary_month }}" id="salary_month">
                </div>

                <div class="form-group">
                    <label for="salary_amount"> Salary Amount </label>
                    <input type="text" class="form-control" name="salary_amount" value="{{ $data->salary_amount }}" id="salary_amount">
                </div>
                <div class="form-group">
                    <label for="payment_amount"> Payment Amount </label>
                    <input type="text" class="form-control" name="payment_amount" id="payment_amount" value="{{ $data->payment_amount }}">
                </div>

                <div class="form-group">
                    <label for="payment_date"> Payment Date </label>
                    <input type="date" class="form-control" name="payment_date" id="payment_date" value="{{ $data->payment_date }}">
                </div>

                <div class="form-group">
                    <label for="remark"> Remark </label>
                    <input type="text" class="form-control" name="remark" id="remark" value="{{ $data->remark }}">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </div>
        </form>
    </div>


</div>

@endsection