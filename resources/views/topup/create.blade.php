@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><span>{{ __('Create New Top Up Record') }}</span> <span class="float-right"><a href="{{ route('top-up-details.index')}}" class="btn btn-sm btn-outline-dark">Back to list</a></span></div>

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
                    <form action="{{ route('top-up-details.store') }}" method="post" autocomplete="off" class="needs-validation">
                        @csrf
                        <div class="form-group">
                            <label for="amount">User:</label>
                            <select name="user_id" id="user_id_select" class="form-control">
                                <option value="">--Select User--</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}" {{(old('user_id') == $user->id ? "selected": "") }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('user_id'))
                                <span class="invalid-feedback" role="alert" style="display: inline"><strong>{{ $errors->first('user_id')}}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number:</label>
                            <input type="text" class="form-control" name="phone_number" value="{{old('phone_number')}}"/>
                            @if ($errors->has('phone_number'))
                                <span class="invalid-feedback" role="alert" style="display: inline"><strong>{{ $errors->first('phone_number')}}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="top_up_time">Top-up time:</label>
                            <input type="time" class="form-control" name="top_up_time" value="{{old('top_up_time')}}"/>
                            @if ($errors->has('top_up_time'))
                                <span class="invalid-feedback" role="alert" style="display: inline"><strong>{{ $errors->first('top_up_time')}}</strong></span>
                            @endif
                        </div>                        
                        <div class="form-group">
                            <label for="amount">Amount:</label>
                            <input type="number" class="form-control" name="amount" value="{{old('amount')}}"/>
                            @if ($errors->has('amount'))
                                <span class="invalid-feedback" role="alert" style="display: inline"><strong>{{ $errors->first('amount')}}</strong></span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Add new record</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
