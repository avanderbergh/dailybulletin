@extends('app')

@section('content')
@include('errors.list')
{!! Form::model($announcement,['method' =>'PATCH','url'=> 'api/announcements/'.$announcement->id]) !!}
        @include('announcements.partials.form',['submitButtonText'=>'Update Announcement'])
{!! Form::close() !!}
{!! Form::open(['method' => 'DELETE', 'url' => 'api/announcements/'.$announcement->id]) !!}
        {!! Form::submit('Delete Announcement', ['class' => 'btn btn-danger']) !!}
{!! Form::close() !!}
@stop