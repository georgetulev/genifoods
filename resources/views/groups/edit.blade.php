@extends('admin.index')

@section('content')
    <div class="container">
        <h1>Промени</h1>

        @include('errors.common')

        {{ Form::model($group,['method' => 'POST', 'action' => ['GroupController@update', $group->id]]) }}
        {{ method_field('PATCH') }}

            @include('groups._form', ['submitButtonText' => 'Промени'])

        {{ Form::close() }}
    </div>

@endsection
