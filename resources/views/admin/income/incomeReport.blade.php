@extends('layouts.admin')
@section('title')
Report
@endsection

@section('page-content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Income Report</h1>
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
                <tr>
                    <td> </td>
                    <td></td>
                    <td> </td>
                    <td> </td>
                    <td > Total Amount </td>
                    <td id="total"> </td>
                    <td></td>
                </tr>
                @foreach($income as $row)
                <tr>
                    <td> {{ $row->id }}</td>
                    <td>{{ $row->date }}</td>
                    <td>{{ $row->month }}</td>
                    <td>{{ $row->officer }}</td>
                    <td>{{ $row->gl_head }}</td>
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

<script>
    $(document).ready(function() {
        var sum = 0;
        $(".amount").each(function() {
            var data = $(this).html();
           // console.log(data);
            sum = sum + parseFloat(data);
        })
        //console.log(sum);
        $('#total').html(sum);
    })
</script>

@endsection