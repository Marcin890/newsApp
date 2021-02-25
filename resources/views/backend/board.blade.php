@extends('layouts.backend')
@section('content')


<div class="d-flex"><a href={{ route('showBoardNews', ['id'=>$board_id]) }} class="btn btn-success btn-lg ml-auto">Show
    Board News</a>
</div>

<div class="d-flex"><a href={{ route('addWebsite', ['board_id'=>$board_id]) }} class="btn btn-primary btn-md">Add New
    Website +</a>
</div>

<div class="row">
  <div class="col-md-12">
    <h2 class="mt-4">List of websites</h2>
    @foreach($websites as $website)
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">{{ $website->name }}</div>
          <div class="col-md-4">
            <a target="_blank" href="{{ $website->url }}">{{ $website->url }}</a>

          </div>
          <div class="col-md-1">{{ $website->selector }}</div>

          <div class="col-md-2">
            <a class="btn btn-sm btn-danger" href="{{ route('deleteWebsite', ['id'=>$website->id]) }}">Delete</a>
          </div>

          <div class="col-md-2">
            <a class="btn btn-sm btn-primary" href="{{ route('editWebsite', [ 'id'=>$website->id]) }}">Edit</a>
          </div>


        </div>
      </div>

    </div>
    @endforeach
  </div>
</div>




<div class="row mt-5">
  <div class="d-flex"><a href={{ route('showUsersOffBoard', ['id'=>$board_id]) }} class="btn btn-primary btn-md">Add New
      User +</a>
  </div>

  <div class="col-md-12 mt-4">
    <h2>Users of Board</h2>
    @foreach($board_users as $user)
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">{{ $user->name }}</div>
          <div class="col-md-4">{{ $user->email }}</div>
          <div class="col-md-4">
            <form method="POST" action="{{ route('removeUserFromBoard') }}">
              <input type="hidden" name="board_id" value="{{ $board_id }}">
              <input type="hidden" name="user_id" value="{{ $user->id }}">
              {{ csrf_field() }}
              <input type="submit" value="Delete" class="btn btn-sm btn-danger">
            </form>
          </div>
        </div>
      </div>
    </div>

    @endforeach
  </div>
</div>


@endsection