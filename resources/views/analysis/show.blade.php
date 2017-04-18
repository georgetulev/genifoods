@extends('admin.index')
@section('content')
    <style>
        .table tbody>tr>td {
            line-height: 20px;
        }
        h2.title {
            position:relative;
            text-align: center;
        }
        .form-inline {
            position:relative;
        }
        .btn-group {
            width: 100%;
            position: absolute;
            top: -30px;
            text-align: right;
        }
        .btn-group>.btn {
            float: none;
        }
        .btn.btn-success {
            float: right;
            margin-left: 1px;
        }
    </style>
    <div class="container">
        <h2 class="title"><span class="text">Резултат от ДНК анализ</span>
            <span class="btn btn-success pdf-btn pdf-recommendations">PDF Препоръки</span>
            <span class="btn btn-success pdf-btn pdf-result">PDF Резултат</span>
        </h2>
        <div id="summary" class="form-group">
            <h3>Относно</h3>
            <table id="summary-table" class="table table-striped js-results" >
                <thead>
                    <tr>
                        <th width="15%"></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Пациент: </td>
                        <td>{{ $analys->customer_name }}</td>
                    </tr>
                    <tr>
                        <td>Дата на раждане на:</td>
                        <td>{{ $analys->birthdate->format('d.m.Y') }}</td>
                    </tr>
                    <tr>
                        <td>Идент.№:</td>
                        <td>{{ $analys->identity_number }}</td>
                    </tr>
                    <tr>
                        <td>Поръчан от:</td>
                        <td>{{ $analys->requested_by }}</td>
                    </tr>
                    <tr>
                        <td>С причина:</td>
                        <td>{{ $analys->reason }}</td>
                    </tr>
                    <tr>
                        <td>Изпъленен от:</td>
                        <td>{{ $analys->executed_by }}</td>
                    </tr>
                    <tr>
                        <td>Ръководен от:</td>
                        <td>{{ $analys->supervised_by }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="result" class="form-group">
            <h3>Резултат</h3>
            <table id="result-table" class="table table-striped js-results" style="border-top: 1px solid #eee; width:100%">
                <thead>
                    <tr>
                        <th>Полиморфизъм</th>
                        <th>Ген</th>
                        <th>Вариация</th>
                        <th>Генотип</th>
                        <th>Резултат</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($analys->types as $type)
                    <tr>
                        @foreach($type->getResultDescription() as $description)
                            <td>
                                {{ $description }}
                            </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            <table id="legend-table" class="table table-striped js-results" style="border-top: 1px solid #eee; width:100%">
                <thead>
                    <tr>
                        <th>Легенда</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($analys->types[0]->getLegend() as $legendEntry)
                    <tr>
                        <td>
                            {{ $legendEntry }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div id="comments" class="form-group">
            <h3>Коментари</h3>
            <table id="comments-table"  class="table table-striped js-results" style="border-top: 1px solid #eee; width:100%">
                <thead>
                <tr>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            @foreach(unserialize($analys->comments) as $key => $comment)
                                {{$key+1}}. {{ $comment }}<br/>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="recommendations" class="form-group">
            <h3>Препоръки</h3>
            <table id="recommendations-table" class="table table-striped js-results" style="border-top: 1px solid #eee; width:100%">
                <thead>
                <tr>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        @foreach(unserialize($analys->result) as $key => $result)
                            {{$key+1}}. {{ $result }}<br/>
                        @endforeach
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
    <script>var analysis = JSON.parse({!! json_encode($analys->toJson()) !!});</script>
    <script type="application/javascript" src="/js/print.js" />
@endsection