@extends('admin.index')

@section('content')
    <div class="container">
        <h1>Създай Препоръка</h1>

        @include('errors.common')

        {!! Form::open(array('url' => 'recommendations')) !!}

        @include('recommendations._form', ['submitButtonText' => 'Създай'])

        {!! Form::close() !!}
    </div>
@endsection