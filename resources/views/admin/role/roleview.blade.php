@extends('layouts.admin')
@section('title')
Role
@endsection

@section('page-content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Role Entry </h1>
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


    <div class="">
        <div class="col">
            <form action=" {{ route('admin.roleinsert') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="role"> Roles Name </label>
                        <input type="text" class="form-control" name="role" value="" id="role">
                    </div>

                    <div style="margin-top: 50px;">
                        <div style="background-color: #414947;border-radius: 2px;padding: 5px;">
                            <h4> Menu Parmission </h4>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="bookkeeping"> Book Keeping </label>
                                    <select name="bookkeeping" id="bookkeeping" class="form-control">
                                        <option value="Y"> Yes </option>
                                        <option value="N"> No </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="paramsetup"> Parameter Setup </label>
                                    <select name="paramsetup" id="paramsetup" class="form-control">
                                        <option value="Y"> Yes </option>
                                        <option value="N"> No </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="salary"> Salary </label>
                                    <select name="salary" id="salary" class="form-control">
                                        <option value="Y"> Yes </option>
                                        <option value="N"> No </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="budget"> Budget </label>
                                    <select name="budget" id="budget" class="form-control">
                                        <option value="Y"> Yes </option>
                                        <option value="N"> No </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="account_rec"> Account Receivable </label>
                                    <select name="account_rec" id="account_rec" class="form-control">
                                        <option value="Y"> Yes </option>
                                        <option value="N"> No </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="account_pay"> Account Payable </label>
                                    <select name="account_pay" id="account_pay" class="form-control">
                                        <option value="Y"> Yes </option>
                                        <option value="N"> No </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="setting"> Setting </label>
                                    <select name="setting" id="setting" class="form-control">
                                        <option value="Y"> Yes </option>
                                        <option value="N"> No </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="backup"> Database Backup </label>
                                    <select name="backup" id="backup" class="form-control">
                                        <option value="Y"> Yes </option>
                                        <option value="N"> No </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div style="margin:0px">
                            <button type="submit" class="btn btn-primary">submit</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div class="card-body">

    </div>

</div>

@endsection




@section('script.js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>



</script>

@endsection