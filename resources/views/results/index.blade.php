@extends('admin.index')

@section('content')

    <h1>Всички резултати</h1>
    <a class="btn btn-small btn-primary" href="{{ URL::to('/analysis') }}">Нов анализ</a>
    <hr/>

@include('errors.common')
    <div class="form-group">
        <table id="js-analysis-results" class="table table-striped" style="border-top: 1px solid #eee;">
            <thead>
                <tr>
                    <th>Анализ за: </th>
                    <th>Роден на: </th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($analysis as $analys)
                    <tr>
                        <td>{{ $analys->customer_name }}</td>
                        <td>{{ $analys->birthdate }}</td>
                        <td>
                            <div class="btn-toolbar inline pull-left" data-toggle="buttons-checkbox">
                                    <a class="btn btn-small btn-primary pull-left"
                                       style="margin-right:5px"
                                       href="{{ URL::to('results/' . $analys->id) }}"><i class="glyphicon glyphicon-eye-open"></i></a>

                                @if(Auth::user()->hasRole('admin'))
                                    {{ Form::open(array('url' => 'results/' . $analys->id, 'class' => 'pull-right confirmation')) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {{ Form::button('<i class="fa fa-trash-o"></i>', ['class' => 'btn btn-small btn-primary', 'role' => 'button', 'type' => 'submit']) }}
                                    {{ Form::close() }}
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            var table = $('#js-analysis-results').DataTable( {
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

            $('.confirmation').on('click', function () {
                return confirm('Сигурни ли сте, че желаете да изтриете резултата?');
            });
        });
    </script>
@endsection
