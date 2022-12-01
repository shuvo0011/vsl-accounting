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
                    <h1> Client Name </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"> Income Entry </li>
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
        <form action=" {{ route('admin.glhead') }}" method="POST">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label for="client"> VSL Client </label>
                    <input type="text" class="form-control" name="client" id="client" placeholder="  VSL client ">
                </div>

                <div class="form-group">
                    <label for="f_client_cor"> First Client Corrospondent </label>
                    <input type="text" class="form-control" name="f_client_cor" id="f_client_cor" placeholder=" GL Client Corrospondent ">
                </div>
                <div class="form-group">
                    <label for="f_cor_mobile"> First Corrospondent Mobile  </label>
                    <input type="text" class="form-control" name="f_cor_mobile" id="f_cor_mobile" placeholder=" First Corrospondent Mobile ">
                </div>
                <div class="form-group">
                    <label for="sec_client_cor"> Second Client Corrospondent </label>
                    <input type="text" class="form-control" name="sec_client_cor" id="sec_client_cor" placeholder=" Second Client Corrospondent  ">
                </div>
                <div class="form-group">
                    <label for="sec_cor_mobile"> Second Corrospondent Mobile </label>
                    <input type="text" class="form-control" name="sec_cor_mobile" id="sec_cor_mobile" placeholder=" Second Corrospondent Mobile  ">
                </div>

                <div class="form-group">
                    <label for="rmo"> VSL RMO </label>
                    <input type="text" class="form-control" name="rmo" id="rmo" placeholder=" VSL RMO ">
                </div>
                
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>


    @if ( count(client_data)>1 )
    <div class="card-footer canter">
        <p> NO DATA </p>
    </div>
    @else
    <div>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th> id </th>
                    <th> VSL Client </th>
                    <th> First Client Corrospondent </th>
                    <th> First Corrospondent Mobile </th>
                    <th> Second Client Corrospondent </th>
                    <th> Second Client Mobile </th>
                    <th> VSL RMO </th>
                </tr>
            </thead>
            <tbody>

                @foreach($client_data as $row)
                <tr>
                    <td> {{ $row->id }}</td>
                    <td> {{ $row->vsl_client }}</td>
                    <td> {{ $row->first_client_cor }}</td>
                    <td> {{ $row->first_cor_mobile }}</td>
                    <td> {{ $row->second_client_cor}}</td>
                    <td> {{ $row->second_cor_mobile}}</td>
                    <td> {{ $row->vsl_rmo}}</td>
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