@extends('layouts.backend')
@section('content')
<div class="col-md-12 mt-5">
    <h2>Add new user</h2>
    @foreach($allUsers as $user)
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">{{ $user->name }}</div>
                <div class="col-md-4">{{ $user->email }}</div>
                <div class="col-md-4">
                    <form method="POST" action="{{ route('addUserToBoard') }}">
                        <input type="hidden" name="board_id" value="{{ $board_id }}">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        {{ csrf_field() }}
                        <input type="submit" value="Dodaj" class="btn btn-sm btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection