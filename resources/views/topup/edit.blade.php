@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><span>{{ __('Edit - ' .  $top_up_number->user->name) . "'s " . 'Record' }}</span> <span class="float-right"><a href="{{ route('top-up-details.index')}}" class="btn btn-sm btn-outline-dark">Back to list</a></span></div>


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <br /> 
                    @endif
                    <form action="{{route('top-up-details.update', $top_up_number->id)}}" method="post">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="phone_number">Phone Number:</label>
                            <input type="text" class="form-control" name="phone_number" value="{{$top_up_number->phone_number}}"/>
                        </div>
                        <div class="form-group">
                            <label for="top_up_time">Top-up time:</label>
                        <input type="time" class="form-control" name="top_up_time" value="{{ $top_up_number->top_up_time }}"/>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount:</label>
                        <input type="number" class="form-control" name="amount" value="{{ $top_up_number->amount }}"/>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
