@extends('layouts.backend')
@section('content')
<div class="container">   


    <div class="d-flex"><a href={{ route('getBoardNews', ['id'=>$board_id]) }} class="btn btn-secondary btn-lg ml-auto">Refresh</a>
    </div>
    <br/><br/><br/><br/>
    <div class="accordion" id="accordionExample">
        @foreach($websites as $website)
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $website->id }}" aria-expanded="true" aria-controls="collapse{{ $website->id }}">   
                <div class="d-flex justify-content-between w-100">
                  <div>{{ $website->name }}  </div>
                  <div>Unread: {{ $website->unread }}</div>
                </div>               
                 
                
              </button>
            </h2>
            <div id="collapse{{ $website->id }}" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body">  
                @if($website->news)
        

                <table  class="table table-striped mt-2">
                    @foreach ($website->news as $news)
                     <tr>
                           
                         @if(!$news->status)
                         <td class="text-primary">{{ $news->content }}</td>  
                        <td></td>
                         <td><a class="btn btn-sm btn-primary keep_position" href="{{ route('readNews', ['id'=>$news->id]) }} " data-accord={{ $website->id }}>Read</a></td>
                         @else
                         <td class="text-muted"><del>{{ $news->content }}</del></td>  
                         <td>Read by: {{ $news->user->name }} </td>
                         <td>{{ $news->updated_at }} </td>
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
</div>


@endsection



