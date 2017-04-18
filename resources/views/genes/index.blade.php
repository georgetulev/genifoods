@extends('admin.index')

@section('content')

    <h1>Всички гени</h1>

    <a class="btn btn-small btn-primary" href="{{ URL::to('genes/create') }}">Добави</a>

    <hr>

    @include('errors.common')
    <div class="form-group">
        <table id="js-genes" class="table table-striped" style="border-top: 1px solid #eee;">
            <thead>
                <tr>
                    <th>Ген</th>
                    <th>Полиморфизъм</th>
                    <th>Нуклеотидна замяна</th>
                    <th>Аминокиселинна замяна</th>
                    <th>Wildtype</th>
                    <th>Хетерозиготен</th>
                    <th>Хомозиготен</th>
                    <th>Действия</th>
                </tr>
            </thead>

            @if( ! $genes->count() )
                Няма създадени гени в базата данни!
            @else
                <tbody>
                @foreach($genes as $gene)
                    <tr>
                        <td class="text-center">
                            {{ $gene->getGroupName()}}
                        </td>
                        <td class="text-center">
                            {{ $gene->name }}
                        </td>
                        <td class="text-center">
                           {{ $gene->getVariant()->norm }}
                        </td>
                        <td class="text-center">
                            {{ $gene->getVariant()->change }}
                        </td>
                        @foreach($types as $key => $type)
                            <td class="text-center">
                                 {{ $gene->getType($key)->genotype }}
                            </td>
                        @endforeach
                        <td>
                            <div class="btn-toolbar inline pull-left" data-toggle="buttons-checkbox">
                                <a class="btn btn-small btn-primary pull-left" style="margin-right:5px" href="{{ URL::to('genes/' . $gene->id . '/edit') }}"><i class="fa fa-pencil"></i></a>
                                {{ Form::open(array('url' => 'genes/'.$gene->id, 'class' => 'pull-right')) }}
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
        $(document).ready(function() {
            var table = $('#js-genes').DataTable( {
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
