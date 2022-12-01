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
                    <h1> Officer Entry </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"> Officer Entry </li>
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

    <div>
        <form action=" {{ route('admin.officer') }}" method="POST">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label for="name"> Officer Name </label>
                    <input type="text" class="form-control" name="name" id="name" placeholder=" Officer Name ">
                </div>

                <div class="form-group">
                    <label for="salary"> Fixed Salary </label>
                    <input type="text" class="form-control" name="salary" id="salary" placeholder=" salary ">
                </div>

                <div class="form-group">
                    <label for="remark"> Remarks </label>
                    <input type="text" class="form-control" name="remark" id="remark" placeholder=" Remarks ">
                </div>

                <div class="form-group">
                    <label for="status"> Status </label>
                    <select name="status" id="status">
                        <option value="Y"> Yes </option>
                        <option value="N"> No </option>
                    </select>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
        </form>
    </div>



    @if ( count($officer_data) < 1 ) <div class="card-footer">
        <p> NO DATA </p>
</div>
@else
<div>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th> SL </th>
                <th> Officer Name </th>
                <th> Fixed Salary </th>
                <th> Remark </th>
                <th> Status </th>
                <th> Action </th>
            </tr>
        <tbody>
            @php $sl=0 @endphp
            @foreach($officer_data as $row)
            <tr>
                <td> {{ $row->id }}</td>
                <td> {{ $row->officer_name}}</td>
                <td> {{ $row->fixed_salary}}</td>
                <td> {{ $row->remark}}</td>
                <td> {{ $row->status}}</td>
                <td> <button> <a href="{{ route('admin.officer.delete',['id'=>$row->id]) }}"> Delete </a> </button> </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif


</div>


@endsection



@section('script.js')



@endsection