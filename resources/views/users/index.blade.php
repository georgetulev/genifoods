@extends('admin.index')

@section('content')

    <h1>Всички потребители</h1>

    <a class="btn btn-small btn-primary" href="{{ URL::to('/register') }}">Добави нов</a>
    <hr/>

    @include('errors.common')
    <div class="form-group">
        <table id="js-analysis-results" class="table table-striped" style="border-top: 1px solid #eee;">
            <thead>
                <tr>
                    <th>Име: </th>
                    <th>Ел. поща: </th>
                    <th>Ниво на достъп: </th>
                    <th>Действия:</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach($user->roles as $role )
                                {{ $role->name }}
                                <br>
                            @endforeach
                        </td>
                        <td>
                            <div class="btn-toolbar inline pull-left" data-toggle="buttons-checkbox">
                                {{ Form::open(array('url' => 'users/' . $user->id , 'class' => 'pull-right')) }}
                                {{ csrf_field() }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::button('<i class="fa fa-trash-o"></i>', ['class' => 'btn btn-small btn-primary', 'role' => 'button', 'type' => 'submit']) }}
                                {{ Form::close() }}
                                <a class="btn btn-small btn-primary" style="margin-right:5px" href="{{ URL::to('password/reset') }}"><i class="fa fa-pencil"></i></a>
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
                return confirm('Сигурни ли сте, че желаете да изтриете този потребител?');
            });
        });
    </script>
@endsection