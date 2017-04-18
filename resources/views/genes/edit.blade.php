@extends('admin.index')

@section('content')
    <div class="container">

        @include('errors.common')

        <h1>Промяна на полиморфизъм</h1>

        {!! Form::model($gene, ['method' => 'POST', 'action' =>['GeneController@update', $gene->id]]) !!}
            {{ method_field('PATCH') }}

            @include('genes._form', ['submitButtonText' => 'Промени'])

        {!! Form::close() !!}
    </div>
@endsection
