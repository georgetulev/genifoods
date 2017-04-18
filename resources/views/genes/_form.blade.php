<fieldset class="js-form">
    <div class="form-group">
        {!! Form::label('groups', 'Ген:' ) !!}
        {!! Form::select('group', $groupsList, ($gene->group ? $gene->group->id : null), ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('name', 'Полиморфизъм:' ) !!}
        {!! Form::text('name', $gene->name, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('nZamqna', 'Нуклеотидна замяна:') !!}
        {!! Form::text('nZamqna',  ($gene->getVariant() ? $gene->getVariant()->norm : null) , ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('aZamqna', 'Аминокиселинна замяна:') !!}
        {!! Form::text('aZamqna', ($gene->getVariant() ? $gene->getVariant()->change : null), ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <div class="container">
            <div class="form-group row">
                @foreach($typesList as $key => $type)
                    <div class="col-md-1 text-center"  style="padding: 5px;">
                        {{$type}}
                    </div>
                    <div class="col-md-3">
                        {!! Form::text("variant[]", ($gene->getType($key) ? $gene->getType($key)->genotype : null), ['class' => 'form-control ', 'name' => "variants[$key]"]) !!}
                    </div>
                @endforeach
                @foreach($typesList as $key => $type)
                    <div class="col-md-1 text-center"  style="padding: 5px;">
                        Коментар
                    </div>
                    <div class="col-md-3">
                        {!! Form::textarea("comment[]", ($gene->getType($key) ? $gene->getType($key)->comment : null), ['class' => 'form-control ', 'name' => "comment[$key]", 'placeholder' => "Коментар към {$type}"]) !!}
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="form-group">
        {!! Form::submit($submitButtonText , ['class' => 'btn btn-primary btn-sm form-control']) !!}
    </div>

</fieldset>
