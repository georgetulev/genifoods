@extends('admin.index')

@section('content')
    <div class="container">

        @include('errors.common')

        <h1>Създаване на полиморфизъм</h1>

        {!! Form::open(array('url' => 'genes')) !!}

            @include('genes._form', ['submitButtonText' => 'Създай'])

        {!! Form::close() !!}
    </div>
@endsection

