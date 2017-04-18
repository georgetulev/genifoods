@extends('admin.index')

@section('content')
    <h1>Всички препоръки</h1>

    <a class="btn btn-small btn-primary" href="{{ URL::to('recommendations/create') }}">Добави</a>
    <hr>

    <div class="form-group">
        <table id="js-recommendation-index" class="table table-striped" style="border-top: 1px solid #eee;">
            <thead>
                <tr>
                    <th>Препоръка</th>
                    <th>Коментар</th>
                    <th>Генотипове</th>
                    <th>Действия</th>
                </tr>
            </thead>

            @if( ! $recommendations->count() )
                Няма създадени препоръки!
            @else
                <tbody>
                    @foreach($recommendations as $recommendation)
                        <tr>
                            <td class="col-md-4">
                                {{ $recommendation->description }}
                            </td>
                            <td class="col-md-4">
                                <uld>
                                @foreach($recommendation->types as $key => $type)
                                    <li>
                                        @if ($type->comment) {{$type->comment}}
                                        @else {{"няма"}}
                                        @endif
                                    </li>
                                @endforeach
                                </uld>
                            </td>
                            <td class="col-md-3">
                                    @if($recommendation->types->count() == 0)
                                        <a>Няма референтни стоиности</a>
                                    @else
                                    <ul>
                                        @foreach($recommendation->types as $type)
                                            <li>{{ $type->getDescription() }}</li>
                                        @endforeach
                                    </ul>
                                    @endif
                            </td>
                            <td class="col-md-1">
                                <div class="btn-toolbar inline pull-left" data-toggle="buttons-checkbox">
                                    <a class="btn btn-small btn-primary pull-left" style="margin-right:5px" href="{{ URL::to('recommendations/' . $recommendation->id . '/edit') }}"><i class="fa fa-pencil"></i></a>
                                    {{ Form::open(array('url' => 'recommendations/'. $recommendation->id, 'class' => 'pull-right')) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {{ Form::button('<i class="fa fa-trash-o"></i>', ['class' => 'btn btn-small btn-primary', 'role' => 'button', 'type' => 'submit']) }}
                                    {{ Form::close() }}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            @endif
        </table>
    </div>
    <script>
        id=""
        $(document).ready(function() {
            var table = $('#js-recommendation-index').DataTable( {
                "paging":   true,
                "ordering": true,
                "info":     true,
                "language": {
                    "url" : "/js/datatables.i18n.json"
                },
                tableTools: {
                    sSwfPath: 'http://cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf'
                },
            });
        });
    </script>
@endsection
