@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><span>{{ __('Top Up List') }}</span><span class="btn btn-md btn-outline-dark float-right">{{$top_up_numbers->sum('amount')}} /=</span></div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div>
                        <a style="margin: 19px;" href="{{ route('top-up-details.create')}}" class="btn btn-primary">New top up record</a>
                    </div>

                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Phone</th>
                                <th>Amount</th>
                                <th>Top up time</th>
                                <th>Status</th>
                                <td colspan = 2>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($top_up_numbers as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->user->full_name }}</td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td>{{ $item->amount }}</td>
                                    <td>{{ $item->top_up_time }}</td>
                                    <td>{{ $item->published }}</td>
                                    <td>
                                        <a href="{{ route('top-up-details.edit',$item->id)}}" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('top-up-details.destroy', $item->id)}}" method="post">
                                          @csrf
                                          @method('DELETE')
                                          <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
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
