@extends('layouts.backend')
@section('content')
<div class="container">

  <div class="d-flex"><a href={{ route('showBoardNews', ['id'=>$board_id]) }} class="btn btn-secondary btn-lg ml-auto">Show Board News</a>
  </div>
  <h2>Add new website</h2>


  <form  method="POST" action="{{ route('saveWebsite') }}" >
      <div class="form-group">
          <label for="name" class="control-label">Name *</label>
          <input type="text" name="name" required class="form-control" id="name">
      </div>
  
      <div class="form-group">
          <label for="url" class="control-label">URL *</label>
          <input type="url" name="url" required class="form-control" id="url">
      </div>
  
      <div class="form-group">
          <label for="selector" class="control-label">Selector *</label>
          <input type="text" name="selector" required class="form-control" id="selector">
      </div>
      
      <div class="form-group"><button type="submit" class="btn btn-primary">Save Website</button></div>
  
      <input type="hidden" name="board_id" value="{{ $board_id }}">
  
      {{ csrf_field() }}
  </form>
  <h2>List of websites</h2>
@foreach($websites as $website)
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-4">{{ $website->name }}</div>
        <div class="col-md-4">
          <a target="_blank" href="{{ $website->url }}">{{ $website->url }}</a>
          
        </div>
        <div class="col-md-4">{{ $website->selector }}</div>
      </div>           
    </div>
    
  </div>
 @endforeach

    
</div>


@endsection



