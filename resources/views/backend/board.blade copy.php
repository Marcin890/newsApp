@extends('layouts.backend')
@section('content')
<div class="container">
    <h2>Add new website</h2>


    <form method="POST" action="{{ route('saveWebsite') }}">
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
    <div class="d-flex"><a href={{ route('refreshBoardNews', ['id'=>$board_id]) }}
            class="btn btn-secondary btn-lg ml-auto">Get Board News</a>
    </div>

    <h2>My Websites</h2>

    <div class="row">

        @foreach($websites as $website)

        <div class="col-md-12">

            <div class="row  mt-5">
                <div class="col-md-9"><a href="{{ $website->url }}" target="_blank">
                        <h2>{{ $website->name }}</h2>
                    </a></div>
                <div class="col-md-3">{{ $website->selector }}</div>
            </div>
            @if($website->news)


            <table class="table table-striped mt-2">
                @foreach ($website->news as $news)
                <tr>

                    @if(!$news->status)
                    <td class="text-primary">{{ $news->content }}</td>
                    <td><a class="btn btn-sm btn-primary keep_position"
                            href="{{ route('readNews', ['id'=>$news->id]) }}">Read</a></td>
                    @else
                    <td class="text-muted"><del>{{ $news->content }}</del></td>
                    <td></td>
                    @endif

                </tr>

                @endforeach
            </table>
            @endif




        </div>
        @endforeach
    </div>
</div>
@endsection