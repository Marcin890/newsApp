@extends('layouts.backend')
@section('content')



<div class="d-flex"><a href={{ route('refreshBoardNews', ['id'=>$board_id]) }}
        class="btn btn-success btn-lg ml-auto">Refresh</a>
</div>
{{-- <h3>Last refresh: {{ $board->updated_at->format('H:i d/m') }}</h3> --}}
<br /><br /><br /><br />
<div class="accordion" id="accordionExample">
    @foreach($websites as $website)
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapse{{ $website->id }}" aria-expanded="true"
                aria-controls="collapse{{ $website->id }}">
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


                <table class="table table-striped mt-2">
                    @foreach ($website->news as $news)
                    <tr>

                        @if($news->status === 'unread')
                        <td class="text-success"><strong>{{ $news->content }}</strong></td>
                        <td></td>
                        <td><a class="btn btn-sm btn-primary keep_position"
                                href="{{ route('readNews', ['id'=>$news->id]) }} "
                                data-accord={{ $website->id }}>Read</a></td>

                        <td><a class="btn btn-sm btn-success keep_position"
                                href="{{ route('articleNews', ['id'=>$news->id]) }} "
                                data-accord={{ $website->id }}>Article</a></td>

                        <td><a class="btn btn-info btn-sm" href="{{ $website->url }}" target="_blank">Zobacz</a></td>

                        @elseif($news->status ==='read')
                        <td class="text-read"><del>{{ $news->content }}</del></td>
                        <td></td>
                        <td>Read by: {{ $news->user->name }} </td>
                        <td>{{ $news->updated_at->format('H:i d/m') }} </td>
                        <td><a class="btn btn-info btn-sm" target="_blank" href="{{ $website->url }}">Zobacz</a></td>
                        <td></td>

                        @elseif($news->status ==='article')
                        <td class="text-info"><del>{{ $news->content }}</del></td>
                        <td></td>
                        <td>Article by: {{ $news->user->name }} </td>
                        <td>{{ $news->updated_at->format('H:i d/m') }} </td>
                        <td><a class="btn btn-info btn-sm" target="_blank" href="{{ $website->url }}">Zobacz</a></td>

                        @endif

                    </tr>

                    @endforeach
                </table>
                @endif

            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection