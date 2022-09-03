@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 m-4">
            <div class="card">
                <div class="card-header">{{ __('Book') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                           <ul class="list-group">
                            <li class="list-group-item">Name</li>
                            <li class="list-group-item">Number</li>
                            <li class="list-group-item">Days</li>
                            <li class="list-group-item">EMI</li>
                            <li class="list-group-item">Amount</li>
                           </ul>
                        </div>
                        <div class="col-md-5">
                            <ul class="list-group">
                             <li class="list-group-item">{{$book->name}}</li>
                             <li class="list-group-item">{{$book->number}}</li>
                             <li class="list-group-item">{{$book->day}}</li>
                             <li class="list-group-item">{{$book->emi}}</li>
                             <li class="list-group-item">{{$book->amount}}</li>
                            </ul>
                         </div>
                        <div class="col-md-4">
                            <table class="table">
                                <tr>
                                    <th>Recovery Amount</th>
                                    <td class="text-success"><b>{{$book->amount_received}}</b></td>
                                </tr>
                                <tr>
                                    <th>Left Amount</th>
                                    <td class="text-danger"><b>{{$book->amount - $book->amount_received}}</b></td>
                                </tr>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
               

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table  class="table hover multiple-select-row data-table-export nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Status<th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($emi as $key => $valu)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$valu->date}}</td>
                                            <td>{{$valu->amount}}</td>
                                            <td>
                                                @if($valu->ststus =='not')  
                                                    <button type="button" class="btn btn-danger" onclick="myFunction({{$valu->id}},'{{$valu->date}}','{{$valu->amount}}','{{$valu->book_id}}')">receive</button>   
                                                @else
                                                     <b class="text-success">received</b>
                                                @endif 
                                            </td>
                                        </tr>
                                    @endforeach
                                   
                                </tbody>
                            </table>
                        </div>
                        {{-- <div class="col-md-6">
                            
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('js')
<script>
    function myFunction(no,date,amount,book) {
        swal({
            title: "Are you Receive Money?",
            text: ""+date+"",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    // vat sourl = no +'/'+ amount;
                    var url = "{{url('/book_emi_update')}}"+'/'+no+'/'+book+'/'+ amount;
                        $.ajax({
                        type:'get',
                        url:url,
                        success:function(data){
                            // alert(data);
                            if (data="success") {
                                swal("Poof! You have been Received!", {
                                icon: "success",
                                });
                                location.reload();
                            }
                        }
                        });
                
                    
                
            } else {
                swal("Your are safe!");
            }
            });
    }
    </script>

@endsection