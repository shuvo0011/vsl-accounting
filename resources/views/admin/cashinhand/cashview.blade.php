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
                    <h1> Cash in Hand </h1>
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
        <form action=" {{ route('admin.cashinhand') }}" method="POST">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label for="month"> MONTH </label>
                    <input class="form-control" name="month" id="month" placeholder="Month" autocomplete="off" >
                </div>

                <div class="form-group">
                    <label for="date"> DATE </label>
                    <input type="date" class="form-control" name="date" id="date" placeholder="Date">
                </div>

                <div class="form-group">
                    <label for="amount"> AMOUNT </label>
                    <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount">
                </div>


            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    @if(count($cash)<1)
            <div class="card-footer canter">
                <p> NO DATA </p>
            </div>
    @else
    <div>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th> SL </th>
                    <th> Month </th>
                    <th> Date </th>
                    <th> Amount </th>
                </tr>
            </thead>
            <tbody>
            @foreach($cash as $row)
                <tr>
                    <td> {{ $row->id}}</td>
                    <td> {{ $row->month}}</td>
                    <td> {{ $row->date}}</td>
                    <td> {{ $row->amount}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endif

</div>


@endsection



@section('script.js')


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" />

<script>
    $('#month').datepicker({
        format: "MMyy",
        icons: {
            time: 'fa fa-time',
            date: 'fa fa-calendar',
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down',
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
        },
        startView: "months",
        minViewMode: "months"
    });
    
</script>

@endsection