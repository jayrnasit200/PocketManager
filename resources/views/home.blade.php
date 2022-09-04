@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session()->get('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('status') }}
                <button type="button" class="close float-end" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                    
            @endif
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}
                </div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-2 ">
                            <div class="m-2 alert alert-primary text-center">
                                <label>Account Balance</label>
                                <h1><b>{{Auth()->user()->account}}</b></h1>
                            </div>
                        </div>  
                        <div class="col-md-2 ">
                            <div class="m-2 alert alert-danger text-center">
                                <label>Pending Amount</label>
                                <h1><b>{{$pending}}</b></h1>
                            </div>
                        </div> 
                        <div class="col-md-2 ">
                            <div class="m-2 alert alert-success text-center">
                                <label>Total Profit</label>
                                <h1><b>{{$profit}}</b></h1>
                            </div>
                        </div> 
                        <div class="col-md-2 ">
                            <div class="m-2 alert alert-warning text-center">
                                <label>Total Withdrawal</label>
                                <h1><b>{{$Withdrawal}}</b></h1>
                            </div>
                        </div>  
                        <div class="col-md-2 ">
                            <div class="m-2 alert alert-secondary text-center">
                                <label>Total Deposit</label>
                                <h1><b>{{$deposit}}</b></h1>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    } );
</script>
@endsection
