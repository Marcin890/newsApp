@extends('layouts.backend')
@section('content')



<div class="d-flex"><a href={{ route('refreshBoardNews', ['id'=>$board_id]) }}
    class="btn btn-success btn-lg ml-auto">Refresh</a>
</div>

<h3>Last refesh: {{ $updated->format('H:i:s d/m') }}</h3>
<div class="row mt-5">
  <div class="col-md-12"><button id="show-unreaded" class="btn btn-md btn-primary btn-success">Hide Unreaded</button>
    <button id="show-readed" class="btn btn-md btn-primary">Show Readed</button>
    <button id="show-article" class="btn btn-md btn-primary">Show Article</button></div>

</div>


<div class="accordion mt-3" id="accordionExample">
  @foreach($websites as $website)
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse"
        data-bs-target="#collapse{{ $website->id }}" aria-expanded="true" aria-controls="collapse{{ $website->id }}">
        <div class="d-flex justify-content-between w-100">
          <div>{{ $website->name }} </div>
          <div>Unread: {{ $website->unread }}</div>
        </div>


      </button>
    </h2>
    <div id="collapse{{ $website->id }}" class="accordion-collapse collapse" aria-labelledby="headingOne"
      data-bs-parent="#accordionExample">
      <div class="accordion-body">
        @if($website->news)


        @foreach ($website->news as $news)

        @if($news->status === 'unread')
        {{-- CARD --}}
        <div class="card unread">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                {{ $news->content }}
              </div>
              <div class="col-md-2">
                <a class="btn btn-md btn-primary keep_position" href="{{ route('readNews', ['id'=>$news->id]) }} "
                  data-accord={{ $website->id }}>Read</a>
              </div>
              <div class="col-md-2">
                <a class="btn btn-md btn-success keep_position" href="{{ route('articleNews', ['id'=>$news->id]) }} "
                  data-accord={{ $website->id }}>Article</a>
              </div>
              <div class="col-md-2">
                <a class="btn btn-secondary btn-md" href="{{ $website->url }}" target="_blank">Zobacz</a>
              </div>
            </div>
          </div>
        </div>
        {{-- ENDCARD --}}

        @elseif($news->status ==='read')
        {{-- CARD --}}
        <div class="card text-read read d-none ">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                {{ $news->content }}
              </div>
              <div class="col-md-2">
                Read by: {{ $news->user->name }}
              </div>
              <div class="col-md-2">
                {{ $news->updated_at->format('H:i d/m') }}
              </div>
              <div class="col-md-2">
                <a class="btn btn-secondary btn-md" href="{{ $website->url }}" target="_blank">Zobacz</a>
              </div>
            </div>
          </div>
        </div>
        {{-- ENDCARD --}}

        @elseif($news->status ==='article')
        {{-- CARD --}}
        <div class="card text-white article d-none bg-secondary">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                {{ $news->content }}
              </div>
              <div class="col-md-2">
                Article by: {{ $news->user->name }}
              </div>
              <div class="col-md-2">
                {{ $news->updated_at->format('H:i d/m') }}
              </div>
              <div class="col-md-2">
                <a class="btn btn-success btn-md" href="{{ $website->url }}" target="_blank">Zobacz</a>
              </div>
            </div>
          </div>
        </div>
        {{-- ENDCARD --}}

        @endif

        @endforeach
        @endif

      </div>
    </div>
  </div>
  @endforeach
</div>

@push('scripts')
<script src="{{ asset('js/filters.js') }}" defer></script>
@endpush
@endsection