<div class="row">
    <div class="col-sm-12">
        <table id="example2" class="table table-bordered table-hover">

            <thead>
            <tr>
                <th style="width: 80px;">@sortablelink('id', 'Id')</th>
                <th>@sortablelink('name', 'naam')</th>
                <th>Beschrijving</th>
                <th>@sortablelink('threshold', 'Drempelwaarde')</th>
                <th>Assets</th>
                <th>Acties</th>
            </tr>
            </thead>

            <tbody id="results">

            @foreach($categories as $category)

                <tr>
                    <td>{{ $category->id }}</td>
                    <td>
                        <a href="{{ route('categories.show', ['category' => $category]) }}">{{ $category->name }}</a>
                    </td>
                    <td>
                        @if($category->description)
                            {{ $category->description }}
                        @else
                            {{ '(geen beschrijving)' }}
                        @endif
                    </td>
                    <td>
                        @if($category->threshold)
                            {{ $category->threshold }}
                        @else
                            {{ '(geen drempelwaarde)' }}
                        @endif
                    </td>
                    <td>{{ count($category->assets) }}</td>
                    <td>
                        <a href="{{ route('categories.edit', ['id' => $category->id]) }}"
                           type="button"
                           class="btn btn-warning btn-sm">
                            Wijzigingen
                        </a>
                        <a href="{{ route('categories.delete', ['id' => $category->id]) }}"
                           type="button"
                           class="btn btn-danger btn-sm">
                            Verwijderen
                        </a>
                    </td>
                </tr>

            @endforeach

            </tbody>

            <tfoot>

            </tfoot>

        </table>
    </div>
</div>