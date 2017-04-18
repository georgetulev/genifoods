<fieldset class="js-form">
    <div class="form-group">
        {!! Form::label('description', 'Препоръка') !!}
        {!! Form::textarea('description', $recommendation->description, ['class' => 'form-control', 'rows' => '3']) !!}
    </div>

    <div class="form-group">
        <select name="types[]" class="type" style="width: 100%" multiple="multiple">
            @foreach($recommendation->types as $type)
                    <option value="{{$type->id}}" selected>{{$type->getDescription()}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        {!! Form::submit($submitButtonText , ['class' => 'btn btn-primary btn-sm form-control']) !!}
    </div>
</fieldset>
<script type="text/javascript">
    $('.type').select2({
        ajax: {
            url: "/types-option",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    term: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;

                return {
                    results: data,
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            },
            cache: true
        },
        placeholder: "Генотипове",
        multiple: true,
        escapeMarkup: function (markup) { return markup; },
        minimumInputLength: 1,
    });
</script>