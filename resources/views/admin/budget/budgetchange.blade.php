@extends('layouts.admin')
@section('title')
    Dashboard
@endsection


@section('page-content')

<div class="content-wrapper" style=" display: block; background-color: #33354121; height: 50px; border-radius: 6px; ">


    <section class=" content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Budget change </h1>
                </div>
            </div>
        </div>
    </section>

    <section class=" content-header" id="main">
        <div class="container-fluid">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th> GL Head</th>
                            <th> Balance </th>
                            <th> Budget </th>
                            <th style="width: 40px"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                        <tr>
                            <td> {{ $row->glcode }} </td>
                            <td> {{ $row->glhead }} </td>
                            <td> {{ $row->balance }} </td>
                            <td> {{ $row->glbudget }} </td>
                            <td> <button onclick="change_btn('{{ $row->glcode }}')" class="btn btn-primary"> change</button> </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>


    <section id="popchagne" class=" content-header" style="background-color: black; width:400px; border-radius:6px; position:absolute; top:30%; left:40%; visibility:hidden">
        <div class="container-fluid">
            <div class="form-group">
                <label for="change"> Input The Budget </label>
                <input type="text" class="form-control" id="change">
            </div>
            <div class="card-footer">
                <button id="submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </section>

</div>
@endsection



@section('script.js')

<script>
    function change_btn(id) {
        $("#main").css({
            "opacity": 0
        })

        $("#popchagne").css({
            "visibility": "visible"
        })

        $("#submit").click(function() {
            var input = $("#change").val();
            console.log(id);
            console.log(input);
            $.ajax({
                url: "{{ route('admin.budgetupdate') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type:"POST",
                data:{
                    id,
                    input,
                },
                success: function(data) {
                    console.log(data);
                    location.reload();
                }
            });
            

        })
    }
</script>


@endsection