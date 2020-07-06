@extends('main')

@section('title','Login')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3">
            <div class='card mt-4'>
                <div class='card-body'>
                    {!! Form::open() !!}
                    {!! Form::label('email', 'Email:') !!}
                    {!! Form::email('email', null, ['class'=>'form-control']) !!}

                    {!! Form::label('password', 'Password:') !!}
                    {!! Form::password('password', ['class'=>'form-control']) !!}

                    {!! Form::checkbox('remember', 1, false, ['class'=> 'form-spacing-top']) !!}{!! Form::label('remember', 'Remember me') !!}
                    <br>
                    {!! Form::submit('Login', ['class' => 'btn btn-earls-green btn-block']) !!}

                    {!! Form::close() !!}
                    <!-- forgot from--!>
                    <a href="{{ route('password.request') }}" class="btn btn-link">Forgot password?</a>
                </div>
            </div>
        </div>
    </div>
@endsection
