@extends('main')

@section('title','|Create new post')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3">
            <div class='card mt-4'>
                <div class='card-body'>
                    {!! Form::open(['route' => 'tasks.store']) !!}
                    {!! Form::label('description', 'Task Description:') !!}
                    {!! Form::textarea('description', null, ['class'=>'form-control']) !!}

                    {!! Form::label('performer_id', 'Performer:') !!}
                    {!! Form::select('performer_id', $performers, "", array('class' => 'form-control')) !!}

                    <br>
                    {!! Form::submit('Create', ['class' => 'btn btn-earls-green btn-block']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
