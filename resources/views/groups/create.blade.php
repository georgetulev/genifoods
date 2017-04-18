@extends('admin.index')

@section('content')
    <div class="container">
        <h1>Създай нов ген</h1>

        @include('errors.common')

        <!-- if there are creation errors, they will show here -->
        {!! Form::open(array('url' => 'groups')) !!}

            @include('groups._form', ['submitButtonText' => 'Готово'])

        {!! Form::close() !!}
    </div>
@endsection

