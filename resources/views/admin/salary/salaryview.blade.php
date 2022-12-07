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
        </div><!-- /.container-fluid -->
    </section>

    <!-- ...................................................................................................................... -->
    <!--      ..............................  edit display .........................          -->

    <!-- 
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            Modal content
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="e_salary_month"> Salary Month </label>
                        <input type="date" class="form-control" name="e_salary_month" id="e_salary_month" placeholder=" Salary Month ">
                    </div>
                    <div class="form-group">
                        <label for="e_salary_amount"> Salary Amount </label>
                        <input type="text" class="form-control" name="e_salary_amount" id="e_salary_amount" placeholder=" Salary Amount ">
                    </div>
                    <div class="form-group">
                        <label for="e_pay_amount"> Payment Amount </label>
                        <input type="text" class="form-control" name="e_pay_amount" id="e_pay_amount" placeholder=" Payment Amount ">
                    </div>

                    <div class="form-group">
                        <label for="e_pay_date"> Payment Date </label>
                        <input type="date" class="form-control" name="e_pay_date" id="e_pay_date" placeholder=" Payment Date ">
                    </div>

                    <div class="form-group">
                        <label for="total_due"> Total Due </label>
                        <input type="text" class="form-control" name="total_due" id="total_due" placeholder=" Total Due ">
                    </div> 
                    <div class="form-group">
                        <label for="remark"> Remark </label>
                        <input type="text" class="form-control" name="remark" id="remark" placeholder=" Remarks ">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-default" id="save"> Save </button>
                </div>
            </div>

        </div>
    </div>
 -->


    <div style="margin-left: 10px;">
        <button class="btn btn-success text-danger"> <a href="{{ route('admin.salary.generate') }}">Generate Current Month Salary</a> </button>
    </div>

    <!-- .............................................................................................................. -->
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

        <div class="" style="margin-left: 15px;"> Account Total = <span  id="account_total">{{ $account_money }} </span> </div>

        <form action=" {{ route('admin.salary') }}" method="POST">
            @csrf

            <div class="card-body">
                <div style="display:flex; justify-content: space-between;">
                    <div class="form-group">
                        <label for="officer"> Officer Name </label>
                        <select name="officer" id="officer" class="form-control">
                            @foreach($officer_data as $row)
                            <option value="{{ $row->id }}"> {{ $row->officer_name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- <div class="form-group">
                        <label for="id"> Officer ID </label>
                        <input type="text" class="form-control" name="id" id="id" placeholder=" Officer ID ">
                    </div> -->
                    <div class="form-group">
                        <label for="salary_month"> Salary Month </label>
                        <select name="salary_month" id="salary_month" class="form-control">
                            <!-- @foreach($officer_data as $row)
                            <option value="{{ $row->id }}"> {{ $row->officer_name }} </option>
                            @endforeach -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="salary_amount"> Salary Amount </label>
                        <input type="text" class="form-control" name="salary_amount" id="salary_amount" placeholder=" Salary Amount " readonly>
                    </div>
                    <div class="form-group">
                        <label for="due_amount"> Due Amount </label>
                        <input type="text" class="form-control" name="due_amount" id="due_amount" placeholder=" Due Amount" readonly>
                    </div>
                </div>


                <div style="display: flex; justify-content: space-between;">

                    <div class="form-group" id="">
                        <label for="payment_amount"> Payment Amount </label>
                        <input type="number" class="form-control" name="payment_amount" id="payment_amount" placeholder=" Payment Amount ">
                        <p id="amount_div"></p>
                    </div>

                    <div class="form-group">
                        <label for="payment_date"> Payment Date </label>
                        <input type="text" class="form-control" name="payment_date" value="{{ date('m/d/y') }}" id="payment_date" placeholder=" Payment Date " readonly>
                    </div>
                    <!-- 
                    <div class="form-group">
                        <label for="total_due"> Total Due </label>
                        <input type="text" class="form-control" name="total_due" id="total_due" placeholder=" Total Due ">
                    </div> -->
                    <div class="form-group">
                        <label for="remark"> Remark </label>
                        <input type="text" class="form-control" name="remark" id="remark" placeholder=" Remarks ">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="form-group">
                    </div>
                </div>
            </div>
        </form>
    </div>

    @if($salary->count()==0)
    <div class="card-footer">
        <p> NO DATA </p>
    </div>
    @else
    <div>
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
                    <th> Action </th>
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
                    <td> <button class="btn" id="btn"> <a href="{{ route('admin.salary.edit',['id'=>$row->id]) }}"> Edit </a> </button> </td>
                    <!-- <td><button type="button" class="btn btn-primary" id="myBtn"> Edit </button></td> -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

</div>

@endsection







@section('script.js')

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

    $("#payment_amount").keyup(function(){
        var x = parseFloat($(this).val());
        var y = parseFloat($("#account_total").text());
        var m = parseFloat($("#due_amount").val());
        console.log(m);
        if(x>y){
            $("#amount_div").empty();
            $("#payment_amount").css({backgroundColor: 'red'});
            $("#amount_div").append("<p>  There is not much money in the account  </p>")
        }else if(x>m){
            $("#amount_div").empty();
            $("#payment_amount").css({backgroundColor: 'red'});
            $("#amount_div").append("<p> More then Due Amount  </p>")
        }       
        else{
            $("#amount_div").empty();
            $("#payment_amount").css('backgroundColor','black');
        }
    })


</script>




@endsection