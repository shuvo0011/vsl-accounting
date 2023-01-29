@extends('layouts.admin')
@section('title')
Dashboard
@endsection

@section('page-content')

<div class="content-wrapper" style=" display: block; background-color: #33354121; height: 50px; border-radius: 6px; ">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Budget Report </h1>
                </div>
            </div>
        </div>
    </section>

    <section class="container-fluid">
        <div class="container-fluid">
            <div>
                <form action="{{ route('admin.budgetreport') }}" method="post">
                    @csrf
                    <label for="month"> Month </label>
                    <input type="text" class="form-control" name="month" id="month" autocomplete="off" />
                    <div style="margin-top: 15px;">
                        <button class="btn btn-primary">submit</button>
                    </div>
                </form>
            </div>

        </div>


        <div id="table" style="border: 1px solid black; margin: 100px 0px;">
            <div class="container-fluid">
                <div>
                    <h5> Income </h5>
                </div>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th> GL Head </th>
                            <th> Budget </th>
                            <th> Monthly Cost </th>
                            <th> Month </th>
                            <th> Report </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reportdata as $row)
                        @if($row->acc_flag == "I")
                        <tr>
                            <td> {{ $row->glhead }} </td>
                            <td> {{ $row->budget }} </td>
                            <td> {{ $row->amount }} </td>
                            <td> {{ $row->month }} </td>
                            <td> {{ $row->budget - $row->amount }} </td>
                        </tr>
                        @endif
                        @endforeach

                    </tbody>
                </table>
            </div>

            <div class="container-fluid">
                <div>
                    <h5> Expence </h5>
                </div>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th> GL Head </th>
                            <th> Budget </th>
                            <th> Monthly Cost </th>
                            <th> Month </th>
                            <th> report </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reportdata as $row)
                        @if($row->acc_flag == "E")
                        <tr>
                            <td> {{ $row->glhead }} </td>
                            <td> {{ $row->budget }} </td>
                            <td> {{ $row->amount }} </td>
                            <td> {{ $row->month }} </td>
                            <td> {{ $row->budget - $row->amount }} </td>
                        </tr>
                        @endif
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>


    </section>
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