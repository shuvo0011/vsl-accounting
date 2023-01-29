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
                    <h1> Salary </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"> Salary </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div style="margin-left: 20px;">
        <button class="btn btn-success text-danger"> <a href="{{ route('admin.salary.generate') }}">Generate Current Month Salary</a> </button>
    </div>

    <div style="padding-left:15px; background-color:aliceblue; color:black; ">
        {{ session('msg') }}
    </div>

    @if ($errors->any())
    <div class="alert alert-danger" style="margin: 20px;">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div>
        <form action=" {{ route('admin.salary') }}" method="POST">
            @csrf
            <div class="card-body">
                <div  style="border: 2px solid black; box-sizing: border-box; box-shadow: skyblue; background-color: #1e2125; padding: inherit; border-radius: 10px; ">
                    <div class="row">
                        <div class="form-group col-3">
                            <label for="officer"> Officer Name </label>
                            <select name="officer" id="officer" class="form-control">
                                @foreach($officer_data as $row)
                                <option value="{{ $row->id }}"> {{ $row->officer_name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-3">
                            <label for="salary_month"> Salary Month </label>
                            <select name="salary_month" id="salary_month" class="form-control">
                            </select>
                        </div>
                        <div class="form-group col-3">
                            <label for="salary_amount"> Salary Amount </label>
                            <input type="text" class="form-control" name="salary_amount" id="salary_amount" placeholder=" Salary Amount " readonly>
                        </div>
                        <div class="form-group col-3">
                            <label for="due_amount"> Due Amount </label>
                            <input type="text" class="form-control" name="due_amount" id="due_amount" placeholder=" Due Amount" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-3" >
                            <label for="payment_amount"> Payment Amount </label>
                            <input type="number" class="form-control" name="payment_amount" id="payment_amount" placeholder=" Payment Amount ">
                            <div id="p_account"> Account Total = <span id="account_total">{{ $account_money }} </span> </div>
                            <p id="amount_div"> </p>
                        </div>
                        <div class="form-group col-3" >
                            <label for="payment_date"> Payment Date </label>
                            <input type="text" class="form-control" name="payment_date" value="{{ date('Y-m-d') }}" id="payment_date" placeholder=" Payment Date " readonly>
                        </div>
                        <div class="form-group col-3">
                            <label for="remark"> Remark </label>
                            <input type="text" class="form-control" name="remark" id="remark" placeholder=" Remarks ">
                        </div>
                        <div class=" form-group col-3 mt-4">
                            <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Submit</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Salary List
            </h3>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th> SL </th>
                        <th> Officer ID </th>
                        <th> Officer Name </th>
                        <th> Salary Month </th>
                        <th> Salary Amount </th>
                        <th> Payment Amount </th>
                        <th> Payment Date </th>
                        <th> Total Due </th>
                        <th> Remark </th>
                        <!-- <th> Action </th> -->
                    </tr>
                </thead>
                <tbody>
                    @php $sl=0 @endphp
                    @foreach($salary as $row)
                    <tr>
                        <td> {{ $row->id }} </td>
                        <td> {{ $row->officer_id }} </td>
                        <td> {{ $row->user->officer_name }} </td>
                        <td> {{ $row->salary_month }} </td>
                        <td> {{ $row->salary_amount }} </td>
                        <td> {{ $row->payment_amount }} </td>
                        <td> {{ $row->payment_date }} </td>
                        <td> {{ $row->total_due }} </td>
                        <td> {{ $row->remark }} </td>
                        <!-- <td> <button class="btn" id="btn"> <a href="{{ route('admin.salary.edit',['id'=>$row->id]) }}"> Edit </a> </button> </td> -->
                        <!-- <td><button type="button" class="btn btn-primary" id="myBtn"> Edit </button></td> -->
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
<script src=" {{ asset ('support_files/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src=" {{ asset ('support_files/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src=" {{ asset ('support_files/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src=" {{ asset ('support_files/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src=" {{ asset ('support_files/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src=" {{ asset ('support_files/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src=" {{ asset ('support_files/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src=" {{ asset ('support_files/plugins/jszip/jszip.min.js') }}"></script>
<script src=" {{ asset ('support_files/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src=" {{ asset ('support_files/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src=" {{ asset ('support_files/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>



<script>
    $(document).ready(function() {
        // .......................................month update ................................
        $("#officer").change(function() {
            const officer_id = $(this).val();
            // console.log(officer_id);
            $.ajax({
                url: "{{ route('admin.salary.salaryMonth') }}",
                method: "get",
                data: {
                    'officer_id': officer_id
                },
                success: function(response) {
                    //console.log(response);
                    if (response.length == 0) {
                        $('#salary_month').empty();
                        $('#salary_amount').attr("value", 0);
                        $('#due_amount').attr("value", 0);
                        $('#salary_month').append($("<option> No Due Month</option>"));
                    } else {
                        $(salary_month).empty();
                        $.each(response, function(key, value) {
                            $('#salary_month').append($("<option></option>").attr("value", value.salary_month).text(value.salary_month));
                        });
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        })
        $('#officer').trigger('change');

        // ................................ salary update ................................
        $("#salary_month").on('click change', function() {
            const officer_id = $("#officer").val();
            const month_id = $(this).val();
            //console.log(month_id);
            // console.log(officer_id);
            $.ajax({
                url: "{{ route('admin.salary.salaryAmount') }}",
                method: "get",
                data: {
                    'month_id': month_id,
                    'officer_id': officer_id,
                },
                success: function(response) {
                    console.log(response);
                    $('#salary_amount').empty();
                    $('#due_amount').empty();
                    $.each(response, function(key, value) {
                        $('#salary_amount').attr("value", value.salary_amount);
                        $('#due_amount').attr("value", value.total_due);
                    });
                },
                error: function(response) {
                    console.log(response);
                }
            });
        })
        $('#salary_month').trigger('change');
    })
</script>


<script>
    $("#payment_amount").keyup(function() {
        var x = parseFloat($(this).val());
        var y = parseFloat($("#account_total").text());
        var m = parseFloat($("#due_amount").val());
        console.log(m);
        if (x > y) {
            $("#amount_div").empty();
            $("#p_account").hide();
            $("#payment_amount").css({
                backgroundColor: 'red'
            });
            $("#amount_div").append("<p>  There is not much money in the account  </p>")
        } else if (x > m) {
            $("#amount_div").empty();
            $("#p_account").hide();
            $("#payment_amount").css({
                backgroundColor: 'red'
            });
            $("#amount_div").append("<p> More then Due Amount  </p>")
        } else {
            $("#amount_div").empty();
            $("#p_account").show();
            $("#payment_amount").css('backgroundColor', 'black');
        }
    })
</script>


@endsection