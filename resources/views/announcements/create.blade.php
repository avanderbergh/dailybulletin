@extends('app')

@section('content')
@include('errors.list')
    {!! Form::open(['url'=>'api/announcements']) !!}
        @include('announcements.partials.form',['submitButtonText'=>'Add Announcement'])
    {!! Form::close() !!}
@stop