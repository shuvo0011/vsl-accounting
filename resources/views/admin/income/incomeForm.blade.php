@extends('layouts.admin')
@section('title')
Dashboard
@endsection

@section('page-content')

<div class="content-wrapper">
    

<section class="content-header">
        <div class="container-fluid" >
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>INCOME ENTRY</h1>
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

    <div style="margin-left: 10px;">
        <button style="margin-left: 100px;" class="btn btn-success"> <a href=" {{ route('admin.income.todayreport') }}">  Today Income Repot </a></button>
        <button style="margin-left: 100px;"  class="btn btn-success"> <a href=" {{ route('admin.income.monthreport') }}">  This Month Income Report </a>  </button>
        <button style="margin-left: 100px;"  class="btn btn-success"> <a href=" {{ route('admin.income.report') }}"> All  Income  Report </a>   </button>
    </div>

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
        <form action=" {{ route('admin.income') }}" method="POST">
            @csrf
            <div class="card-body">
                
                <div class="form-group">
                    <label for="officer"> OFFICER </label>
                    <select name="officer" id="officer" class="form-control">
                    @foreach($officer_data as $row)
                        <option value="{{ $row->id }}" > {{ $row->officer_name }} </option>
                    @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="flag"> Type  </label>
                    <select name="flag" id="flag"  class="form-control">
                        <option value="1" > Account </option>
                        <option value="2" > Cash In Hand  </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="gl_head"> GL HEAD </label>
                    <select name="gl_head" id="gl_head" class="form-control">
                    @foreach($gldata as $row)
                        <option value="{{ $row->glcode }}" > {{ $row->glhead }} </option>
                    @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="amount"> AMOUNT </label>
                    <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount" autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="month"> MONTH </label>
                    <input type="text" class="form-control" name="month" id="month" placeholder="Month" autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="date"> Current DATE </label>
                    <input type="text" class="form-control" value="{{ date('m/d/y') }}" name="date" id="date" placeholder="Date" readonly>
                </div>

                <div class="form-group">
                    <label for="remarks"> REMARKS </label>
                    <input type="text" class="form-control" name="remark" id="remarks" placeholder="Remarks">
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>


    
    <div>
        <table id="table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th> SL </th>
                    <th> Date </th>
                    <th> Income Month </th>
                    <th> Officer </th>
                    <th> GL_HEAD </th>
                    <th> Amount </th>
                    <th> Remarks </th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr>
                    <td> </td>
                    <td></td>
                    <td> </td>
                    <td> </td>
                    <td > Total Amount </td>
                    <td id="total"> </td>
                    <td></td>
                </tr> -->
                @foreach($income as $row)
                <tr>
                    <td> {{ $row->id }}</td>
                    <td>{{ $row->date }}</td>
                    <td>{{ $row->month }}</td>
                    <td>{{ $row->office->officer_name }}</td>
                    <td>{{ $row->glname->glhead  }}</td>
                    <td class="amount">{{ $row->amount }}</td>
                    <td>{{ $row->remark }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>



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