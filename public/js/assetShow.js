var iconFeature = new ol.Feature({
    geometry: new ol.geom.Point([Number(assetXCoord), Number(assetYCoord)]),
    name: window.assetName,
});
var iconStyle = new ol.style.Style({
    text: new ol.style.Text({
        text: "\uf041",
        font: "normal 32px FontAwesome",
        textBaseline: 'bottom',
        fill: new ol.style.Fill({
            color: '#dd4b39',
        }),
        stroke: new ol.style.Stroke({
            color: 'black',
            width: 1,
        }),
    }),
});
iconFeature.setStyle(iconStyle);
var vectorSource = new ol.source.Vector({
    features: [iconFeature]
});
var vectorLayer = new ol.layer.Vector({
    source: vectorSource
});
var tile = new ol.layer.Tile({
    source: new ol.source.OSM()
});
var map = new ol.Map({
    layers: [tile, vectorLayer],
    target: document.getElementById('map'),
    view: new ol.View({
        center: [Number(assetXCoord), Number(assetYCoord)],
        zoom: 12
    })
});
// map.getView().fit(vectorSource.getExtent(), map.getSize());
var element = document.getElementById('popup');
var popup = new ol.Overlay({
    element: element,
    positioning: 'bottom-center',
    stopEvent: false,
    offset: [0, -8]
});
map.addOverlay(popup);
// display popup on click
map.on('click', function (evt) {
    var feature = map.forEachFeatureAtPixel(evt.pixel,
        function (feature) {
            return feature;
        });
    if (feature) {
        var coordinates = feature.getGeometry().getCoordinates();
        popup.setPosition(coordinates);
        $(element).popover({
            'placement': 'top',
            'html': true,
            'content': feature.get('name')
        });
        $(element).popover('show');
    } else {
        $(element).popover('destroy');
    }
    //console.log(evt.coordinate[0], evt.coordinate[1]);
});
// change mouse cursor when over marker
map.on('pointermove', function (e) {
    if (e.dragging) {
        $(element).popover('destroy');
        return;
    }
    var pixel = map.getEventPixel(e.originalEvent);
    var hit = map.hasFeatureAtPixel(pixel);
    map.getTarget().style.cursor = hit ? 'pointer' : '';
});