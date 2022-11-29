@extends('layout')
@section('content')

<br><br>
<H5>Transfer to:</H5>
<div class="transfer">
    <form action="{{ url('check-out/transfer') }}" method="POST">
        @csrf
        @foreach($users as $us)
        <input type="hidden" name="userID" id="userID" value="{{$us -> id}}">
        <div class="form-group">
            <input type="text" name="userName" id="userName" value="{{$us -> name}}" readonly>
        </div>
        <div class="form-group">
            <label for="amount">Transfer Amount: </label>
            <input type="number" name="amount" id="amount" class="form-control">
        </div>
        @endforeach
        <button class="btn btn-primary" type="submit">SUBMIT</button>
    </form>
</div>

@endsection