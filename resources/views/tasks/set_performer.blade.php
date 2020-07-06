@extends('main')

@section('title','Set Performer')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3">
            <div class='card mt-4'>
                <div class='card-body'>

                    <!-- table --!>
                        <table class="table">
                            <thead>
                                <th>Task Creator</th>
                                <th>Task Performer</th>
                                <th>Task Status</th>
                            </thead>
                            <tbody>
                                <td>{{ $task->creator->name }}</td>
                                <td>
                                    @if (empty($task->performer))
                                        <p class="lead">No performer</p>
                                    @else
                                        <p class="lead">{{ $task->performer->name }}</p>
                                    @endif
                                </td>
                                <td>{{ $task->task_statuses->status }}</td>
                            </tbody>
                        </table>
                    <!--/table --!>

                    <!-- description --!>
                        <h5 class="ml-075">Task Description:</h5>
                        <p class="lead ml-075">{{ $task->description }}</p>
                    <!--/description --!>
                    {!! Form::open(['route' => ['tasks.update_performer', $task->id], 'method' => 'PUT']) !!}
                    {!! Form::label('performer_id', 'Performer:') !!}
                    {!! Form::select('performer_id', $performers, "", array('class' => 'form-control')) !!}

                    <br>
                    {!! Form::submit('Set', ['class' => 'btn btn-earls-green btn-block']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

