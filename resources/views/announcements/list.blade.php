@extends('app')

@section('content')
    @forelse($announcements as $announcement)
        <div class="panel panel-default">
        	  <div class="panel-heading">
                  @if($announcement->user->id==Auth::user()->id)
                      <a href="{{url('api/announcements/'.$announcement->id.'/edit')}}" class="pull-right">
                          <span class="glyphicon glyphicon-edit"></span>
                      </a>
                  @endif
                  <h3 class="panel-title">{{$announcement->title}}</h3>
        	  </div>
        	  <div class="panel-body">
                  <?php $paragraphs = explode(PHP_EOL, $announcement->body)?>
                  @foreach($paragraphs as $paragraph)
                      <p>{{{$paragraph}}}</p>
                  @endforeach
        	  </div>
            <div class="panel-footer">
                <small>Posted by {{$announcement->user->name}}</small>
            </div>
        </div>
    @empty
        <div style="text-align: center">
            <img src="/images/Rainbow-icon.png" class="center-block">
            <p class="lead">No announcements, have a nice day!</p>
        </div>
    @endforelse
@stop