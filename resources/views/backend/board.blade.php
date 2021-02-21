@extends('layouts.backend')
@section('content')


<div class="d-flex"><a href={{ route('showBoardNews', ['id'=>$board_id]) }} class="btn btn-success btn-lg ml-auto">Show
    Board News</a>
</div>

<div class="row">
  <div class="col-md-12">
    <h2>Add new website</h2>


    <form method="POST" action="{{ route('saveWebsite') }}">
      <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name *</label>
        <div class="col-sm-10"><input type="text" name="name" required class="form-control" id="name"></div>
      </div>

      <div class="form-group row">
        <label for="url" class="col-sm-2 col-form-label">URL *</label>
        <div class="col-sm-10"><input type="url" name="url" required class="form-control" id="url"></div>
      </div>

      <div class="form-group row">
        <label for="selector" class="col-sm-2 col-form-label">Selector *</label>
        <div class="col-sm-10"><input type="text" name="selector" required class="form-control" id="selector"></div>
      </div>

      <div class="form-group"><button type="submit" class="btn btn-primary">Save Website</button></div>

      <input type="hidden" name="board_id" value="{{ $board_id }}">

      {{ csrf_field() }}
    </form>
  </div>
  <div class="col-md-12">
    <h2 class="mt-5">List of websites</h2>
    @foreach($websites as $website)
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">{{ $website->name }}</div>
          <div class="col-md-5">
            <a target="_blank" href="{{ $website->url }}">{{ $website->url }}</a>

          </div>
          <div class="col-md-1">{{ $website->selector }}</div>

          <div class="col-md-3">
            <a class="btn btn-sm btn-danger" href="{{ route('deleteWebsite', ['id'=>$website->id]) }}">Delete</a>
          </div>


        </div>
      </div>

    </div>
    @endforeach
  </div>
</div>


<div class="row mt-5">
  <div class="col-md-6">
    <h2>Add new user</h2>
    @foreach($allUsers as $user)
    <p>
      {{ $user->name }}
      <form method="POST" action="{{ route('addUserToBoard') }}">
        <input type="hidden" name="board_id" value="{{ $board_id }}">
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        {{ csrf_field() }}
        <input type="submit" value="Dodaj">
      </form>
    </p>

    @endforeach
  </div>
  <div class="col-md-6">
    <h2>Users of Board</h2>
    @foreach($board_users as $user)
    <p>{{ $user->name }}</p>

    @endforeach
  </div>

</div>


@endsection