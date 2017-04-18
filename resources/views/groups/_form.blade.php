<fieldset class="js-form">

    <div class="form-group">
        {!! Form::label('name', 'Ген:') !!}
        {!! Form::text('name', $group->name, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('function', 'Функция:') !!}
        {!! Form::textarea('function', $group->function, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit($submitButtonText , ['class' => 'btn btn-primary form-control']) !!}
    </div>
</fieldset>