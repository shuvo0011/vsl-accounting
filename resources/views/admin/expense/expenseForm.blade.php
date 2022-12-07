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
                    <h1>Expense ENTRY</h1>
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
        <form action=" {{ route('admin.expense') }}" method="POST">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label for="officer"> Officer </label>
                    <select name="officer" id="officer" class="form-control">
                        @foreach($officer_data as $row)
                        <option value="{{ $row->id }}"> {{ $row->officer_name }} </option>
                        @endforeach
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
                    <label for="flag"> Type </label>
                    <select name="flag" id="flag" class="form-control">
                        <option value="1"> Account </option>
                        <option value="2"> Cash In Hand </option>
                    </select>
                    <p> total :  <span id="show_amount"> </span></p>
                </div>



                <div class="form-group" >
                    <label for="amount"> AMOUNT </label>
                    <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount">
                    <p id="amount_div"></p>
                </div>

                <div class="form-group">
                    <label for="expense_month"> MONTH </label>
                    <input class="form-control" name="expense_month" id="expense_month" placeholder="Month" autocomplete="off">
                </div>


                <div class="form-group">
                    <label for="date"> DATE </label>
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
    $('#expense_month').datepicker({
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
    $("#flag").change(function() {
        const flag = $(this).val();
        //console.log(flag);
        $.ajax({
            url: "{{ route('admin.expense.total_amount') }}",
            method: "get",
            data: {
                'flag': flag
            },
            success: function(response) {
                //console.log(response);
                //console.log( $('#show_amount').val());
                $('#show_amount').text( `${response}`);
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
        if(flag>amount){
            $("#amount_div").empty();
            $("#amount").css({backgroundColor: 'red'});
            $("#amount_div").append("<p>  There is not much money in the account  </p>")
        }else{
            $("#amount_div").empty();
            $("#amount").css('backgroundColor','black');
        }
    })
    $('#amount').trigger('change');
</script>




@endsection