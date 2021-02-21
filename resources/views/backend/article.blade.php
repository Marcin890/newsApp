@extends('layouts.backend')
@section('content')

<h3>{{ $articles->count() }} Articles</h3>
<table class="table table-striped mt-2">
    @foreach($articles as $article)
    <tr>
        <td class="">{{ $article->content }}</td>
        <td>{{ $article->updated_at->format('H:i d/m') }} </td>
        <td><a target="_blank" href="{{ $article->url }}">Zobacz</a></td>
        <td></td>
    </tr>
    @endforeach
</table>
@endsection