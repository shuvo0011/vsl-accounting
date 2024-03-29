@extends('layouts.admin')
@section('title')
Dashboard
@endsection

@section('page-content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> GL Head </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"> Income Entry </li>
                    </ol>
                </div>
            </div>
        </div>
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

    <div>
        <form action=" {{ route('admin.glhead') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="glhead"> GL Head </label>
                    <input type="text" class="form-control" name="glhead" id="glhead" placeholder=" GL Head ">
                </div>
                <div class="form-group">
                    <label for="gltype"> TYPE </label>
                    <select class="form-control" name="gltype" id="gltype">
                        <option value="I"> Income </option>
                        <option value="E"> Expense </option>
                        <option value=""> Both </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="glbudget"> Budget </label>
                    <input type="text" class="form-control" name="glbudget" id="glbudget" placeholder=" Bugdet ">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                GL HEAD Entry List
            </h3>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th> SL </th>
                        <th> GL Head </th>
                        <th> GL Code </th>
                        <th> GL Type </th>
                        <th> GL Balance </th>
                        <th> GL Budget </th>
                    </tr>
                </thead>
                <tbody>
                    @php $sl=0 @endphp
                    @foreach($gldata as $row)
                    <tr>
                        <td> {{ ++$sl }}</td>
                        <td> {{ $row->glhead}}</td>
                        <td> {{ $row->glcode}}</td>
                        <td> {{ $row->gltype}}</td>
                        <td> {{ $row->balance }}</td>
                        <td> {{ $row->glbudget }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection




@section('script.js')
@endsection