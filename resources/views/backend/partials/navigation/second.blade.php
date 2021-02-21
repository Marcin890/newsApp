<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link " href="{{ route('boardIndex') }}">Dashboard</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" href="{{ route('boardIndex') }}">Boards</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach($boards as $board)
            <a class="dropdown-item " href="{{ route('showBoard', ['id'=>$board->id]) }}">{{ $board->name }}</a>
            @endforeach
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link " href="{{ route('showUserArticles') }}">My Articles</a>
    </li>
</ul>