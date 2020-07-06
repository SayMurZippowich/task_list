@extends('main')

@section('title','|Edit Task')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3">
            <div class='card mt-4'>
                <div class='card-body'>
                    {!! Form::model($task, ['route' => ['tasks.update', $task->id], 'method' => 'PATCH']) !!}
                    {!! Form::label('description', 'Task Description:') !!}
                    {!! Form::textarea('description', null, ['class'=>'form-control']) !!}

                    {!! Form::label('performer_id', 'Performer:') !!}
                    {!! Form::select('performer_id', $performers, null, array('class' => 'form-control')) !!}

                    {!! Form::label('task_status_id', 'Task Status:') !!}
                    {!! Form::select('task_status_id', $statuses, null, array('class' => 'form-control')) !!}

                    <br>
                    {!! Form::submit('Edit', ['class' => 'btn btn-earls-green btn-block']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
