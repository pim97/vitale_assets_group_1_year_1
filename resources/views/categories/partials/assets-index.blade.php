<div class="col-md-12">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Alle assets die gekoppeld zijn aan {{ $category->name }}</h3>
            <a href="{{route('assets.create')}}" class="btn btn-success pull-right">Asset toevoegen</a>
        </div>
        <div class="box-body">
            <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                <div class="row">
                    <div class="col-md-12">

                        <table id="category-assets-table" class="table table-bordered table-hover dataTable">

                            <thead>
                            <tr role="row">
                                <th>Id</th>
                                <th>Naam</th>
                                <th>X</th>
                                <th>Y</th>
                                <th>Correctie</th>
                            </tr>
                            </thead>

                            <tbody>

                            @if($assets->count())
                                @foreach($assets as $asset)
                                    <tr>
                                        <td>{{ $asset->id }}</td>
                                        <td>
                                            <a href="{{ route('assets.show', $asset->id)}}">{{ $asset->name }}</a>
                                        </td>
                                        <td>{{ $asset->x_coordinate }}</td>
                                        <td>{{ $asset->y_coordinate }}</td>
                                        <td>
                                            @if($asset->threshold_correction)
                                                {{ $asset->threshold_correction }}
                                            @else
                                                {{ 'Geen' }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>

                            <tfoot>
                            <th colspan="1">Id</th>
                            <th colspan="1">Naam</th>
                            <th colspan="1">X</th>
                            <th colspan="1">Y</th>
                            <th colspan="1">Correctie</th>
                            </tfoot>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('js')
    <script src="/js/customDataTables.js"></script>
@stop