//cookie functionaliteiten
function createCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    }
    else var expires = "";
    document.cookie = name + "=" + value + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}

/*
 * jQuery OnLoad functie. Laadt assetbestand in en voegt dit toe als een nieuwe laag.
 */
$(function () {
    addLayer("../api/breachlocations");
    addLayer("../api/assets");
});

var addLayer = function (name) {
    $.getJSON(name, function (data) {
        // data bevat de geojson data in Web Mercator ESPG:3857 (https://epsg.io/3857)
        var vectorSource = new ol.source.Vector({
            features: (new ol.format.GeoJSON()).readFeatures(data)
        });
        // Nieuwe vectorlaag aan de map toevoegen
        map.addLayer(
            new ol.layer.Vector({
                source: vectorSource,
                style: styleFunction // zorgt ervor dat per asset een passende stijl wordt gekozen
            }));
    });
};

/*
 * De stijlen waarmee de verschillende assets worden gerenderd. Ik maak nu gebruik van FontAwesome
 */
var styles = {
    'Breachlocation': new ol.style.Style({
        text: new ol.style.Text({
            text: "\uf041",
            font: "normal 32px FontAwesome",
            textBaseline: 'bottom',
            fill: new ol.style.Fill({
                color: '#111111',
            }),
            stroke: new ol.style.Stroke({
                color: 'black',
                width: 1,
            }),
        }),
    }),
    'C2000': new ol.style.Style({
        text: new ol.style.Text({
            text: "\uf1eb",
            font: "normal 18px FontAwesome",
            textBaseline: 'bottom',
            fill: new ol.style.Fill({
                color: 'black',
            }),
            stroke: new ol.style.Stroke({
                color: 'black',
                width: 1,
            }),
        }),
    }),
    'Gemaal': new ol.style.Style({
        text: new ol.style.Text({
            text: "\uf0a3",
            font: "normal 18px FontAwesome",
            textBaseline: 'bottom',
            fill: new ol.style.Fill({
                color: 'black',
            }),
            stroke: new ol.style.Stroke({
                color: 'black',
                width: 1,
            }),
        }),
    }),
    'Rioolgemaal': new ol.style.Style({
        text: new ol.style.Text({
            text: "\uf06b",
            font: "normal 18px FontAwesome",
            textBaseline: 'bottom',
            fill: new ol.style.Fill({
                color: 'black',
            }),
            stroke: new ol.style.Stroke({
                color: 'black',
                width: 1,
            }),
        }),
    }),
    'Straatkast': new ol.style.Style({
        text: new ol.style.Text({
            text: "\uf108",
            font: "normal 18px FontAwesome",
            textBaseline: 'bottom',
            fill: new ol.style.Fill({
                color: 'black',
            }),
            stroke: new ol.style.Stroke({
                color: 'black',
                width: 1,
            }),
        }),
    }),
    'Zendmast': new ol.style.Style({
        text: new ol.style.Text({
            text: "\uf2ce", //f1eb f2ce
            font: "normal 18px FontAwesome",
            textBaseline: 'bottom',
            fill: new ol.style.Fill({
                color: 'black',
            }),
            stroke: new ol.style.Stroke({
                color: 'black',
                width: 1,
            }),
        }),
    }),
    'GSM 1800': new ol.style.Style({
        text: new ol.style.Text({
            text: "\uf2ce", //f1eb f2ce
            font: "normal 18px FontAwesome",
            textBaseline: 'bottom',
            fill: new ol.style.Fill({
                color: 'black',
            }),
            stroke: new ol.style.Stroke({
                color: 'black',
                width: 1,
            }),
        }),
    }),
    'GSM 900': new ol.style.Style({
        text: new ol.style.Text({
            text: "\uf2ce", //f1eb f2ce
            font: "normal 18px FontAwesome",
            textBaseline: 'bottom',
            fill: new ol.style.Fill({
                color: 'black',
            }),
            stroke: new ol.style.Stroke({
                color: 'black',
                width: 1,
            }),
        }),
    }),
    'LTE': new ol.style.Style({
        text: new ol.style.Text({
            text: "\uf2ce", //f1eb f2ce
            font: "normal 18px FontAwesome",
            textBaseline: 'bottom',
            fill: new ol.style.Fill({
                color: 'black',
            }),
            stroke: new ol.style.Stroke({
                color: 'black',
                width: 1,
            }),
        }),
    }),
    'UMTS': new ol.style.Style({
        text: new ol.style.Text({
            text: "\uf2ce", //f1eb f2ce
            font: "normal 18px FontAwesome",
            textBaseline: 'bottom',
            fill: new ol.style.Fill({
                color: 'black',
            }),
            stroke: new ol.style.Stroke({
                color: 'black',
                width: 1,
            }),
        }),
    }),
    'Wijkcentrale': new ol.style.Style({
        text: new ol.style.Text({
            text: "\uf108", //f1eb f2ce
            font: "normal 18px FontAwesome",
            textBaseline: 'bottom',
            fill: new ol.style.Fill({
                color: 'black',
            }),
            stroke: new ol.style.Stroke({
                color: 'black',
                width: 1,
            }),
        }),
    }),
};

/*
 * Deze functie zorgt ervoor dat per feature (is één asset) een passende stijl wordt gekozen.
 */
var styleFunction = function (feature) {

    var asset;
    if(feature.getProperties().category) {
        asset = feature.getProperties().category.sub.name;
    } else {
        asset = feature.getProperties().Asset;
    }

    asset = asset.trim(); // removes unwanted spaces

    if(styles[asset]) {
        var style = styles[asset];
    } else {
        console.log('Not found [' + asset + ']');
    }

    if (asset == "Breachlocation") {
        // For Breachlocations
        color = '#4b4c54';

        var currentCookieBreachLocationId = readCookie('breachlocation');
        var breachlocationId = feature.getProperties().id;

        if(currentCookieBreachLocationId == breachlocationId) {
            color = '#D81B60';
        }

    } else {

        var state = feature.getProperties().state;
        var color;
        switch (state) {
            case 0:
                var color = 'green';
                break;
            case 1:
                color = 'orange';
                break;
            case 2:
                color = 'red';
                break;
            default:
                //unknown state
                color = 'black';
                break;
        }

    }

    style.getText().getFill().setColor(color);

    // if(style) {
    //     style.getText().getFill().setColor(color);
    // }

    return style;
};

/*
 * Deze definities heeft openlayers (en proj4) nodig om de rasterdata te transformeren
 */
proj4.defs('EPSG:28992', '+proj=sterea +lat_0=52.15616055555555 +lon_0=5.38763888888889 ' +
    '+k=0.9999079 +x_0=155000 +y_0=463000 +ellps=bessel ' +
    '+towgs84=565.4171,50.3319,465.5524,-0.398957,0.343988,-1.87740,4.0725 +units=m +no_defs');
var imageExtent = [59100, 378900, 74900, 392900];

var overstromingsSource = new ol.source.ImageStatic({
    url: '../img/WD-01-2.png',
    crossOrigin: '',
    projection: 'EPSG:28992',
    imageExtent: imageExtent
});

var overstromingsLayer = new ol.layer.Image({source: overstromingsSource});

/*
 * Hier wordt de Map geconstrueerd
 */
var map = new ol.Map({
    target: 'map',
    layers: [
        // Eerste laag: OpenStreetMap tiles
        new ol.layer.Tile({source: new ol.source.OSM()}),
        // Tweede laag: rasterdata met overstromingsscenario
        overstromingsLayer,
    ],
    view: new ol.View({
        // hier transformeert Proj4 de rasterdata
        center: ol.proj.transform(ol.extent.getCenter(imageExtent), 'EPSG:28992', 'EPSG:3857'),
        zoom: 12,
    }),
});

var overlay = new ol.Overlay({
    element: document.getElementById('popup-container'),
    positioning: 'bottom-center',
    offset: [0, -10]
});
map.addOverlay(overlay);

//click events on the map
map.on('click', function (e) {

    overlay.setPosition();
    var features = map.getFeaturesAtPixel(e.pixel);

    if (features) {
        var coordinate = e.coordinate;
        //var hdms = ol.coordinate.toStringHDMS(ol.proj.transform(coordinate, 'EPSG:3857', 'EPSG:4326'));

        overlay.getElement().innerHTML = '<p><a href="' + features[0].values_.links.self + '">' + features[0].values_.name + '</a></p>';
        overlay.setPosition(coordinate);
    }

    if (features && features[0].values_.Asset == "Breachlocation") {
        // create cookie
        createCookie('breachlocation', features[0].values_.id, 7);
        //read the assets again
        addLayer("../api/assets");
        //reload map
        map.getLayers().forEach(function (layer) {
            layer.getSource().changed();
        });
    }

});

// Ik probeer hier de zoom aan te passen
//console.log(overstromingsLayer.getSource());
var mapExtent = ol.proj.transform(imageExtent, 'EPSG:28992', 'EPSG:3857');
map.getView().fit(mapExtent, map.getSize());