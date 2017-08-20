<!--- Add Title Field --->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class'=>'form-control']) !!}
</div>
<!--- Add Body Field --->
<div class="form-group">
    {!! Form::label('body', 'Message:') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label>Display to students in grade: </label>
    @foreach($grades as $grade)
        {!! Form::label('grades['.$grade->id.']' , $grade->id) !!}
        {!! Form::checkbox('grades['.$grade->id.']' , $grade->id, in_array($grade->id,$announcement->gradeList->toArray())) !!}
    @endforeach
</div>
<div class="form-group">
    {!! Form::label('postFor', 'Display this announcement until:')!!}
    {!! Form::select('postFor', $dates, null, ['class'=>'form-control']) !!}
</div>
<!--- Add Announcement Field --->
<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
    <a href="{{URL::previous()}}" class="btn btn-default">Cancel</a>
</div>