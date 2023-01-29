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
                    <h1> Expense ENTRY </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"> <a href="#"> Home </a> </li>
                        <li class="breadcrumb-item active"> Expense Entry </li>
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

    <div class="row">
        <div class="col-8">
            <form action=" {{ route('admin.expense') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="officer"> OFFICER </label>
                        <select name="officer" id="officer" class="form-control">
                            @foreach($officer_data as $row)
                            <option value="{{ $row->id }}"> {{ $row->officer_name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tr_mood"> TRANSACTION MOOD </label>
                        <select name="tr_mood" id="tr_mood" class="form-control">
                            <option value="A"> Account </option>
                            <option value="C"> Cash In Hand </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gl_head"> GL HEAD </label>
                        <select name="gl_head" id="gl_head" class="form-control">
                            @foreach($gldata as $row)
                            <option value="{{ $row->glcode }}"> {{ $row->glhead }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount"> AMOUNT </label>
                        <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="tr_type"> TRANSACTION TYPE </label>
                        <select name="tr_type" id="tr_type" class="form-control">
                            <option value="D"> Deposite </option>
                            <option value="W"> Withdraw </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="month"> MONTH </label>
                        <input type="text" class="form-control" name="month" id="month" value="{{ date('Fy') }}" readonly />
                    </div>
                    <div class="form-group">
                        <label for="date"> CURRENT DATE </label>
                        <input type="text" class="form-control" value="{{ date('Y-m-d') }}" name="date" id="date" placeholder="Date" readonly />
                    </div>
                    <div class="form-group">
                        <label for="remark"> REMARKS </label>
                        <input type="text" class="form-control" name="remark" id="remark" placeholder="Remarks">
                    </div>
                    <button type="submit" class="btn btn-primary float-right">SUBMIT</button>
                </div>
            </form>
        </div>

        <div class="col-4" style=" margin-top:30px">
            <div class="form-group">
                <div style="background-color: teal; text-align: center; border-radius: 10px; margin:10px"> SUMMARY </div>
                <div style="border: 1px solid; border-radius: 10px; padding: 5px; margin: 20px;">
                    <p> Account Balance = {{ $account_total }} </p>
                    <p> Cash In Hand = {{ $cash_total }} </p>
                    <!-- <p> Yearly Income = </p> -->
                </div>
            </div>
        </div>
    </div>


    <!-- <div>
        <table id="table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th> SL </th>
                    <th> Date </th>
                    <th> Income Month </th>
                    <th> Officer </th>
                    <th> GL_HEAD </th>
                    <th> Transaction Type </th>
                    <th> Amount </th>
                    <th> Remarks </th>
                </tr>
            </thead>
            <tbody>
                @foreach($expense as $row)
                <tr>
                    <td> {{ $row->id }}</td>
                    <td>{{ $row->date }}</td>
                    <td>{{ $row->month }}</td>
                    <td>{{ $row->office->officer_name }}</td>
                    <td>{{ $row->glname->glhead  }}</td>
                    <td>
                        @php
                        if($row->tr_type == 'D'){
                        echo "Deposite";
                        }else{
                        echo "Withdraw";
                        }
                        @endphp
                    </td>
                    <td class="amount">{{ $row->amount }}</td>
                    <td>{{ $row->remark }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div> -->


    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Expense Entry List
            </h3>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th> SL </th>
                        <th> Date </th>
                        <th> Income Month </th>
                        <th> Officer </th>
                        <th> GL_HEAD </th>
                        <th> Transaction Mood </th>
                        <th> Transaction Type </th>
                        <th> Amount </th>
                        <th> Remarks </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expense as $row)
                    <tr>
                        <td> {{ $row->id }}</td>
                        <td>{{ $row->date }}</td>
                        <td>{{ $row->month }}</td>
                        <td>{{ $row->office->officer_name }}</td>
                        <td>{{ $row->glname->glhead  }}</td>
                        <td>
                            @php
                            if($row->tr_mood == 'A'){
                            echo "Account";
                            }else{
                            echo "Cash In Hand";
                            }
                            @endphp
                        </td>

                        <td>
                            @php
                            if($row->tr_type == 'D'){
                            echo "Deposite";
                            }else{
                            echo "Withdraw";
                            }
                            @endphp
                        </td>
                        <td class="amount">{{ $row->amount }}</td>
                        <td>{{ $row->remark }}</td>
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
    $("#flag").change(function() {
        const flag = $(this).val();
        $.ajax({
            url: "{{ route('admin.expense.total_amount') }}",
            method: "get",
            data: {
                'flag': flag
            },
            success: function(response) {
                $('#show_amount').text(`${response}`);
            },
            error: function(response) {
                console.log(response);
            }
        });
    })
    $('#flag').trigger('change');
</script>


<script>
    $("#amount").keyup(function() {
        const flag = parseFloat($("#amount").val());
        const amount = parseFloat($("#show_amount").text());
        console.log(flag);
        console.log(amount);
        if (flag > amount) {
            $("#amount_div").empty();
            $("#amount").css({
                backgroundColor: 'red'
            });
            $("#amount_div").append("<p>  There is not much money in the account  </p>")
        } else {
            $("#amount_div").empty();
            $("#amount").css('backgroundColor', 'black');
        }
    })
    $('#amount').trigger('change');
</script>




@endsection