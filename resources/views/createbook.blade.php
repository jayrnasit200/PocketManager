@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('New Book') }}</div>

                <div class="card-body">
                    <form action="{{url('/createbook')}}" method="POST">@csrf
                        <div class="col-md-12">
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="basic-addon1">Name</span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" >
                            </div>
                            @error('name')<b><span class="text-danger">{{ $message }}</span></b>@enderror
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="basic-addon1">Number</span>
                                <input type="text" class="form-control @error('number') is-invalid @enderror" name="number" placeholder="Number" >
                            </div>
                            @error('number')<b><span class="text-danger">{{ $message }}</span></b>@enderror
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="basic-addon1">Days</span>
                                <input type="number" class="form-control @error('days') is-invalid @enderror" name="days" placeholder="Days" >
                            </div>
                            @error('days')<b><span class="text-danger">{{ $message }}</span></b>@enderror

                            <div class="input-group mt-3">
                                <span class="input-group-text" id="basic-addon1">Date</span>
                                <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" placeholder="Date" >
                            </div>
                            @error('date')<b><span class="text-danger">{{ $message }}</span></b>@enderror

                            <div class="input-group mt-3">
                                <span class="input-group-text" id="basic-addon1">EMI</span>
                                <input type="number" class="form-control @error('emi') is-invalid @enderror" name="emi" placeholder="EMI" >
                            </div>
                            @error('emi')<b><span class="text-danger">{{ $message }}</span></b>@enderror
                            
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="basic-addon1">Amount</span>
                                <input type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" placeholder="Amount" >
                            </div>
                            @error('amount')<b><span class="text-danger">{{ $message }}</span></b>@enderror

                            <input type="submit" value="Create"  class="form-control btn btn-success  mt-3">
                           
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
