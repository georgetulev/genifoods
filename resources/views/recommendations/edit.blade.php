@extends('admin.index')

@section('content')
    <div class="container">
        <h1>Промени</h1>

        @include('errors.common')

        {!! Form::model($recommendation, ['method' => 'POST', 'action' =>['RecommendationController@update', $recommendation->id]]) !!}
        {{ method_field('PATCH') }}

        @include('recommendations._form', ['submitButtonText' => 'Промени'])

        {!! Form::close() !!}
    </div>
@endsection