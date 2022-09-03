@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Account') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="com-md-12">
                            <div class="float-end">
                                <a class="btn btn-danger withdrawal">Withdrawal</a>
                                <a class="btn btn-success deposit">Deposit</a>
                            </div>
                            <label for="">Current Balance </label>
                            <h1>{{Auth()->user()->account}}</h1>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $(".withdrawal").click(function(){
                alert("withdrawal");
                swal("Write something here:", {
                    content: "input",
                })
                .then((value) => {
                    swal(`You typed: ${value}`);
                });
            });
            $(".deposit").click(function(){
                alert("deposit");
                swal("Write something here:", {
                    content: "input",
                })
                .then((value) => {
                    swal(`You typed: ${value}`);
                });
            });
        });
    </script>

@endsection