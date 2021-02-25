@extends('layouts.backend')
@section('content')

<div class="col-md-12">
    <h2>Add new website</h2>
    <form method="POST" action="{{ route('saveWebsite') }}">
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Name *</label>
            <div class="col-sm-10"><input type="text" name="name" required class="form-control" id="name"
                    value="{{ $website['name'] ?? ''}}">
            </div>
        </div>

        <div class="form-group row">
            <label for="url" class="col-sm-2 col-form-label">URL *</label>
            <div class="col-sm-10"><input type="url" name="url" required class="form-control" id="url"
                    value="{{ $website['url'] ?? '' }}"></div>
        </div>

        <div class="form-group row">
            <label for="selector" class="col-sm-2 col-form-label">Selector *</label>
            <div class="col-sm-10"><input type="text" name="selector" required class="form-control" id="selector"
                    value="{{ $website['selector'] ?? '' }}"></div>
        </div>

        <div class="d-flex justify-content-between">
            <div class="form-group"><button type="submit" class="btn btn-primary" value="test" name="test">Test
                    Website</button></div>
            <div class="form-group"><button type="submit" class="btn btn-success" value="save" name="save">Save
                    Website</button></div>


        </div>


        <input type="hidden" name="board_id" value="{{ $board_id }}">

        {{ csrf_field() }}
    </form>

    @if(!empty($news))
    @foreach ($news as $new)
    <div class="card">
        <div class="card-body">
            {{ $new }}
        </div>
    </div>
    @endforeach
    @else
    <h3>No results</h3>
    @endif
</div>
@endsection