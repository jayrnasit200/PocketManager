@extends('layouts.app')

@section('content')

<div class="container">
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
                <div class="card-header">{{ __('Books') }}
                    <a href="{{ url('/createbook') }}" class="btn btn-success float-end">Create New Book</a>
                </div>

                <div class="card-body">
                    <div class="row">
                        
                    </div>
                    <table id="example" class="table hover multiple-select-row data-table-export nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Days</th>
                                <th>EMI</th>
                                <th>Amount</th>
                                <th>Received</th>
                                <th>Left</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $key => $valu)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$valu->name}}</td>
                                <td>{{$valu->day}}</td>
                                <td>{{$valu->emi}}</td>
                                <td>{{$valu->amount}}</td>
                                <td>{{$valu->amount_received}}</td>
                                <td>{{$valu->amount-$valu->amount_received}}</td>
                                <td><a href="{{url('book')}}?id={{$valu->id}}" class="btn btn-primary">open</a></td>
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
