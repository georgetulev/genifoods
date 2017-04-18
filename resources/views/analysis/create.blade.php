@extends('admin.index')

@section('content')

        <h1>Бланка за анализ</h1>

        @include('errors.common')

        {!! Form::open(array('url' => 'analysis')) !!}

            @include('analysis._form', ['submitButtonText' => 'Резултат'])

        {!! Form::close() !!}

@endsection