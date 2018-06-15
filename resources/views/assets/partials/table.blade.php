@if($assetPic)
    <img alt="imageOfAsset" class="img-responsive img-thumbnail center-block" src="{{ asset('uploads/assets/' . $assetPic->image) }}" style="width: 75%; margin-bottom: 2%;">
@endif
<table class="table table-bordered">
    <tbody>

    <tr>
        <th>ID</th>
        <td>{{ $asset->id }}</td>
    </tr>
    <tr>
        <th>Naam</th>
        <td>{{ $asset->name }}</td>
    </tr>
    <tr>
        <th>Beschrijving</th>
        <td>
            @if($asset->description)
                {{ $asset->description }}
            @else
                {{ '(geen beschrijving)' }}
            @endif
        </td>
    </tr>
    <tr>
        <th>Categorie</th>
        <td>
            <a href="{{ route('categories.show', $asset->category->id) }}">{{ $asset->category->name }}</a>
        </td>
    </tr>
    <tr>
        <th>X-coördinaat</th>
        <td>
            {{ $asset->x_coordinate }}
        </td>
    </tr>
    <tr>
        <th>Y-coördinaat</th>
        <td>
            {{ $asset->y_coordinate }}
        </td>
    </tr>
    <tr>
        <th>Drempelwaarde</th>
        <td>
            @if($asset->category->threshold)
                {{ $asset->category->threshold }}
            @else
                {{ "(geen drempelwaarde)" }}
            @endif
        </td>
    </tr>
    <tr>
        <th>Drempelwaarde correctie</th>
        <td>
            {{ $asset->threshold_correction }}
        </td>
    </tr>
    <tr>
        <th>Drempelwaarde werkelijk</th>
        <td>
            {{ $asset->threshold_real }}
        </td>
    </tr>
    </tbody>
</table>