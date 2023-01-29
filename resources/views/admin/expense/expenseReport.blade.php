@extends('layouts.admin')
@section('title')
Expense Report
@endsection

@section('page-content')
<link rel="stylesheet" href="{{ asset('support_files/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" />
<link rel="stylesheet" href="{{ asset('support_files/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" />
<link rel="stylesheet" href="{{ asset('support_files/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}" />
<link rel="stylesheet" href="{{ asset('support_files/dist/css/adminlte.min.css') }}" />


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Expense Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Expense
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section>
        <form action=" {{ route('admin.expense.report')}}" method="post">
            @csrf
            <div class="row m-5">
                <div class="col">
                    <label for="start"> Start Date </label>
                    <input type="date" class="form-control" name="start">
                </div>
                <div class="col">
                    <label for="end"> End Date </label>
                    <input type="date" class="form-control" name="end">
                </div>
                <div class="col m-4">
                    <button class="btn btn-primary"> submit</button>
                </div>
            </div>
        </form>
    </section>

    <input type="hidden" id="start" value="{{ $start }}" >
    <input type="hidden" id="end" value="{{ $end }}" >

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- <h3 class="card-title">
                                Income Report
                            </h3> -->
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
            </div>
        </div>
    </section>
</div>


<!-- <div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Expense Report </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"> Expense Report </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div>
        <table id="example1" class="table table-bordered table-striped">
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
    </div>
</div> -->
@endsection






@section('script.js')
<script src=" {{ asset ('support_files/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
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
    $(function() {

        var start = document.getElementById("start").value;
        var end = document.getElementById("end").value;

        console.log(start);

        var now = new Date();
        var date = now.getDate() + '/' + (now.getMonth() + 1) + '/' + now.getFullYear();
        $("#example1").DataTable({
            dom: 'Blftipr',
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'Excel ',
                    title: "Expense report",
                    messageTop: "Date: " + date,
                    titleAttr: 'Exportar a Excel',
                    //  className: 'btn btn-success'
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    title: "Expense Report",
                    messageTop:"  Date: " + date + "\n start date: "+start + "\n end date :"+end,
                    titleAttr: 'Exportar a PDF',
                    // className: 'btn btn-danger'
                },
            ],
            columnDefs: [{
                targets: -9,
                className: 'dt-body-right'
            }],
            columnDefs: [{
                    targets: [1, 2,3, 4, 6, 7,8],
                    searchable: true
                },
                {
                    targets: '_all',
                    searchable: false
                }
            ]
        })
    });
</script>
@endsection