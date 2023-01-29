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
                    <h1> Account Receivable </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"> </li>
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
        <form action=" " method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-3">
                        <label for="month"> Tentative Income Month </label>
                        <input type="text" class="form-control" name="month" id="month" autocomplete="off">
                    </div>
                    <div class="form-group col-3">
                        <label for="clientName"> Client Name </label>
                        <select name="clientName" id="clientName" class="form-control">
                            @foreach($clientdata as $row)
                            <option value="{{ $row->id }}"> {{ $row->vsl_client }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <label for="incomehead"> Income Head </label>
                        <select name="incomehead" id="incomehead" class="form-control">
                            @foreach($incomedata as $row)
                            <option value="{{ $row->glcode }}"> {{ $row->glhead }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <label for="amount"> Amount </label>
                        <input type="number" class="form-control" name="amount" id="amount">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-3">
                        <label for="status"> Status </label>
                        <select name="status" id="status" class="form-control">
                            <option value="P"> Paid </option>
                            <option value="U"> Unpaid </option>
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <label for="details"> Details </label>
                        <input type="text" class="form-control" name="details" id="details">
                    </div>
                    <div class="form-group col-3">
                        <label for="plan"> Payment Plan to use </label>
                        <input type="text" class="form-control" name="plan" id="plan">
                    </div>
                    <div class="col-3 mt-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Entry List
            </h3>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th> id </th>
                        <th> Entry Date </th>
                        <th> Tentative Income Month </th>
                        <th> Client Name </th>
                        <th> Income Hand </th>
                        <th> Amount </th>
                        <th> Status </th>
                        <th> Details </th>
                        <th> Payment plan to use </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $row)
                    <tr>
                        <td> {{ $row->id }}</td>
                        <td> {{ $row->entry_date }}</td>
                        <td> {{ $row->tentative_income_m }}</td>
                        <td> {{ $row->client->vsl_client }}</td>
                        <td> {{ $row->glname->glhead}}</td>
                        <td> {{ $row->amount}}</td>
                        <td>
                            @if($row->status=="P")
                            <input type="text" value="Paid" class="form-control" readonly>
                            @else
                            <select name="status" id="{{'status'.$row->id}}" class="form-control" onchange="paidunpaid({{ $row->id}}, {{$row->client_name}} ,{{$row->amount}},{{$row->income_head}},{{$row->details}})">
                                <option value="P" @if($row->status=="P") selected @endif> Paid </option>
                                <option value="U" @if($row->status=="U") selected @endif> Unpaid </option>
                            </select>
                            @endif
                        </td>
                        <td> {{ $row->details}}</td>
                        <td> {{ $row->payment_plan}}</td>
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

<script>
    function paidunpaid(id,user_id,amount,glcode,remark) {
        console.log(id);
        console.log(user_id);
        console.log(amount);
        console.log(glcode);
        console.log(remark);
        $.ajax({
            url: "{{ route('admin.accountRecUpdate') }}",
            data: {
                id,
                amount,
                user_id,
                glcode,
                remark
            },
            success: function(entry) {
                console.log(entry);
                location.reload();
            }
        })
    }

    
</script>


@endsection