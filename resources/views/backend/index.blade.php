@extends('layouts.backend')
@section('content')
<div class="container">
    <h2>Create new board</h2>


<form  method="POST" action="{{ route('saveBoard')}}">
    <div class="form-group">
        <label for="name" class="control-label">Name *</label>
        <input type="text" name="name" required class="form-control" id="name">
    </div>

    <div class="form-group"><button type="submit" class="btn btn-primary">Save Board</button></div>

    {{ csrf_field() }}
</form>

<h2>My Boards</h2>

<div class="row">
@foreach($boards as $board)
   <div class="col-md-4">
    <div class="card">
        
        <div class="card-body">{{ $board->name }}</div>
        <a href="{{ route('board', ['id'=>$board->id]) }}" class="btn btn-primary">View</a>
        
    </div>
   </div>
@endforeach
</div>
</div>
@endsection



