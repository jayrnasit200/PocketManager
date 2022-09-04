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
            <div class="card mt-3">
                <div class="card-header">{{ __('History') }}
                </div>

                <div class="card-body">
                    <div class="row">
                        
                    </div>
                    <table id="example" class="table hover multiple-select-row data-table-export nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Amount</th>
                           
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payment as $key => $valu)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$valu['created_at']}}</td>
                                <td>{{$valu['type']}}</td>
                                <td>{{$valu ['amount']}}</td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                // alert("withdrawal");
                swal("Write something here:", {
                    content: "input",
                })
                .then((value) => {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var url = "{{url('/update_fund')}}"+'/'+value+'/Withdraw';
                        $.ajax({
                        type:'get',
                        url:url,
                        success:function(data){
                            if (data.success) {
                                swal(data.success, {
                                icon: "success",
                                });
                                location.reload();
                            }else{
                                swal(data.error, {
                                icon: "error",
                                });
                            }
                        }
                        });
                });
            });
            $(".deposit").click(function(){
                swal("Write something here:", {
                    content: "input",
                })
                .then((value) => {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var url = "{{url('/update_fund')}}"+'/'+value+'/deposit';
                        $.ajax({
                        type:'get',
                        url:url,
                        success:function(data){
                            if (data.success) {
                                swal(data.success, {
                                icon: "success",
                                });
                                location.reload();
                            }
                        }
                        });
                    // swal(`You amount ${value} is Credited.`);
                });
            });
        });

        $(document).ready(function() {
        $('#example').DataTable( {
        lengthMenu: [
            [20, 50, 100, -1],
            [20, 50, 100, 'All'],
        ],
    } );
    } );
    </script>

@endsection