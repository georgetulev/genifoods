@extends('admin.index')

@section('content')
    <h1>Всички гени</h1>

    <a class="btn btn-small btn-primary" href="{{ URL::to('groups/create') }}">Добави</a>

    <hr>
    <div class="form-group">
        <table id="js-groups" class="table table-striped" style="border-top: 1px solid #eee;">
            <thead>
                <tr>
                    <th>Име</th>
                    <th>Функция</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
            @foreach($groups as $key => $value)
                <tr>
                    <td width="10%">{{ $value->name }}</td>
                    <td width="70%">{{ $value->function }}</td>
                    <td width="20%">
                        <div class="btn-toolbar inline pull-left" data-toggle="buttons-checkbox">
                            <a class="btn btn-small btn-primary" style="margin-right:5px" href="{{ URL::to('groups/' . $value->id . '/edit') }}"><i class="fa fa-pencil"></i>Промени</a>
                            {{ Form::open(array('url' => 'groups/' . $value->id, 'class' => 'pull-right')) }}
                            {{ csrf_field() }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::button('<i class="fa fa-trash-o"></i> Изтрий', ['class' => 'btn btn-small btn-primary', 'role' => 'button', 'type' => 'submit']) }}
                            {{ Form::close() }}
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            var table = $('#js-groups').DataTable( {
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

