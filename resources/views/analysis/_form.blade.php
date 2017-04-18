<fieldset class="js-form">
    <div class="form-group">
        {!! Form::label('name', 'Име на пациент:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('name', 'Дата на раждане: ') !!}
        <div class="input-append date" data-date="12-02-2012">
            {!! Form::text('dateOfBirth', null, ['class' => 'form-control datepicker span2']) !!}
            <span class="add-on"><i class="icon-th"></i></span>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('identity_number', 'Идентификационен номер: ') !!}
        {!! Form::text('identity_number', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('requested_by', 'Поръчано от: ') !!}
        {!! Form::text('requested_by', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('reason', 'Повод за изледване: ') !!}
        {!! Form::text('reason', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('executed_by', 'Изпълнено от: ') !!}
        {!! Form::text('executed_by', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('supervised_by', 'Ръководител/Сектор: ') !!}
        {!! Form::text('supervised_by', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit($submitButtonText , ['class' => 'btn btn-primary btn-sm form-control']) !!}
    </div>

    <hr/>

    <table class="table genes">
        <thead>
        <tr>
            <th>Ген</th>
            <th>Полиморфизъм</th>
            <th>Н. Замяна</th>
            <th>А. Замяна</th>
            <th>Видове Генотип</th>
        </tr>
        </thead>

        <tbody>
                @foreach($groups as $group)
                    <tr>
                        <td rowspan="{{count($group->genes)+1}}">{{$group->name}}</td>
                        @foreach($group->genes as $gene)
                            <tr>
                                <td>{{ $gene->name }}</td>
                                <td>{{ $gene->getVariant()->norm }}</td>
                                <td>{{ $gene->getVariant()->change }}</td>
                                <td>
                                    <div>
                                        <input type="hidden" name="types[]" value="">
                                            @foreach($gene->getVariant()->types as $type)
                                                <div class="type-btn btn btn-primary text-center" data-id="{{$type->id}}">{{$type->type}} : {{$type->genotype}}</div>
                                            @endforeach
                                        <div class="type-btn-clear-all btn btn-primary text-center">(X)</div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                @endforeach
        </tbody>
    </table>
</fieldset>
<script>
    $(function(){
        $('.type-btn').on('click', function(event){
            var button = $(event.currentTarget);
            var hiddenInput =  button.siblings('input').first();

            button.siblings('div').removeClass('btn-success');

            button.addClass('btn-success');
            hiddenInput.val(button.attr('data-id'));
        });

        $('.type-btn-clear-all').on('click', function(event){
            var button = $(event.currentTarget);
            var hiddenInput =  button.siblings('input').first();

            button.siblings('div').removeClass('btn-success');

            hiddenInput.val("");

        });
    });

    $('.datepicker').datepicker({
        format: 'dd.mm.yyyy'
    });
</script>
<div class="form-group">
    {!! Form::submit($submitButtonText , ['class' => 'btn btn-primary btn-sm form-control']) !!}
</div>