@extends('layouts.backend')
@section('content')

<h2>Create new board</h2>


<form method="POST" action="{{ route('createBoard')}}">
    <div class="form-group">
        <label for="name" class="control-label">Name *</label>
        <input type="text" name="name" required class="form-control" id="name">
    </div>

    <div class="form-group"><button type="submit" class="btn btn-primary">Save Board</button></div>

    {{ csrf_field() }}
</form>

<h2 class="mt-5">My Boards</h2>

<div class="row mt-3">
    @foreach($boards as $board)
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4><a href="{{ route('showBoard', ['id'=>$board->id]) }}" class="">{{ $board->name }}</a></h4>
                    </div>
                    <div class="col-sm-3">
                        <p>Last refresh: {{ $board->updated_at->format('H:i d/m') }}</p>
                    </div>

                    <div class="col-sm-2"><a href="{{ route('showBoard', ['id'=>$board->id]) }}"
                            class="btn btn-md btn-primary">View</a>
                    </div>

                    <div class="col-sm-2"><a href="{{ route('destroyBoard', ['id'=>$board->id]) }}"
                            class="btn btn-danger btn-md">Delete</a>
                    </div>

                </div>
            </div>


        </div>
    </div>
    @endforeach
</div>

@endsection