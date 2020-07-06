@extends('main')

@section('title','| Register')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3">
            <div class='card mt-4'>
                <div class='card-body'>
                    {!! Form::open() !!}

                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}

                    {!! Form::label('email', 'Email:', ['class' => 'form-spacing-top']) !!}
                    {!! Form::email('email', null, ['class'=>'form-control']) !!}

                    {!! Form::label('password', 'Password:', ['class' => 'form-spacing-top']) !!}
                    {!! Form::password('password', ['class'=>'form-control']) !!}


                    {!! Form::label('password_confirmation', 'Password Confirm:', ['class' => 'form-spacing-top']) !!}
                    {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}

                    {!! Form::submit('Register', ['class' => 'btn btn-brown-tank btn-block btn-h1-spacing']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

