@extends('layouts.backend')
@section('content')

<div class="col-md-12">
    <h2>Edit website</h2>
    <form method="POST" action="{{ route('updateWebsite') }}">
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Name *</label>
            <div class="col-sm-10"><input type="text" name="name" required class="form-control" id="name"
                    value="{{ $website->name ?? old('name')  }}"></div>
        </div>

        <div class="form-group row">
            <label for="url" class="col-sm-2 col-form-label">URL *</label>
            <div class="col-sm-10"><input type="url" name="url" required class="form-control" id="url"
                    value="{{ $website->url ?? old('url')  }}"></div>
        </div>

        <div class="form-group row">
            <label for="selector" class="col-sm-2 col-form-label">Selector *</label>
            <div class="col-sm-10"><input type="text" name="selector" required class="form-control" id="selector"
                    value="{{ $website->selector ?? old('selector')  }}"></div>
        </div>

        <div class="form-group"><button type="submit" class="btn btn-primary">Save Website</button></div>

        <input type="hidden" name="website_id" value="{{ $website->id }}">



        {{ csrf_field() }}
    </form>
</div>
@endsection