@extends('main')

@section('title','Task_List')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3">
            @foreach($tasks as $task)
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
                        <p class="lead ml-075">
                            {{ substr($task->description, 0, 50) }} 
                            {{ (strlen($task->description)>50) ? "..." : "" }}
                        </p>
                    <!--/description --!>

                    <!-- buttons --!>
                        <div class="row ml-075">
                                    <a class="btn btn-earls-green mr-3" 
                                        href="{{ route('tasks.show', ['task' => $task->id]) }}"
                                        role="button">See</a>
                            @can('tasks-admin')
                                    <a class="btn btn-earls-green mr-3" 
                                        href="{{ route('tasks.set_performer', ['task' => $task->id]) }}"
                                        role="button">Set performer</a>
                            @endcan
                                    <a class="btn btn-brown-tank mr-3" 
                                        href="{{ route('tasks.complete', ['task' => $task->id]) }}" 
                                        role="button">Complete</a>
                            @can('tasks-admin')
                                {!! Form::open(['route' => ['tasks.destroy', $task->id], 'method' => 'DELETE']) !!}
                                {!! Form::submit('Del', ['class' => 'btn btn-brown-tank mr-3']) !!}
                                {!! Form::close() !!}
                            @endcan
                        </div>
                    <!--/buttons --!>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
