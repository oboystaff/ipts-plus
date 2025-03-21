/**
 * Created by degre on 11/29/2017.
 */

var StyleFactory=function () {
    return {
        markerCategories: ['arrow-circle-up', 'default', 'paw', 'bicycle', 'ship', 'bus', 'car',
        'motorcycle','user','plane', 'ship', 'truck', 'van','ambulance','taxi'],
        refreshPeriod: 60 * 1000,
        reconnectTimeout: 60 * 1000,

        normalPadding: 10,

        windowWidth: 800,
        windowHeight: 600,

        formFieldWidth: 275,

        dateTimeFormat24: 'Y-m-d H:i:s',
        dateTimeFormat12: 'Y-m-d g:i:s a',
        timeFormat24: 'H:i',
        timeFormat12: 'g:i a',
        dateFormat: 'Y-m-d',
        weekStartDay: 1,

        deviceWidth: 400,
        toastWidth: 300,

        reportHeight: 250,

        columnWidthNormal: 100,

        mapDefaultLat: 1.283333,
        mapDefaultLon: 103.833333,
        mapDefaultZoom: 4,

        mapRouteColor: [
            '#F06292',
            '#BA68C8',
            '#4DD0E1',
            '#4DB6AC',
            '#FF8A65',
            '#A1887F'
        ],
        mapRouteWidth: 5,

        mapTextColor: 'rgba(50, 50, 50, 1.0)',
        mapTextStrokeColor: 'rgba(255, 255, 255, 1.0)',
        mapTextStrokeWidth: 2,
        mapTextOffset: 2,
        mapTextFont: 'bold 12px sans-serif',

        mapColorOnline: 'green',//'rgba(77, 250, 144, 1.0)',
        mapColorUnknown: 'orange',//'rgba(250, 190, 77, 1.0)',
        mapColorOffline: 'red',//'rgba(255, 162, 173, 1.0)',

        mapScaleNormal: 1,
        mapScaleSelected: 1.5,

        mapMaxZoom: 18,
        mapDelay: 500,

        mapAccuracyColor: 'rgba(96, 96, 96, 1.0)',

        mapGeofenceTextColor: 'rgba(14, 88, 141, 1.0)',
        mapGeofenceColor: 'rgba(21, 127, 204, 1.0)',
        mapGeofenceOverlayOpacity: 0.2,
        mapGeofenceWidth: 5,
        mapGeofenceRadius: 9,

        coordinatePrecision: 6,
        numberPrecision: 2,

        reportGridStyle: 'borderTop: 1px solid lightgray',

        chartPadding: '20 40 10 10',
        chartMarkerRadius: 3,
        chartMarkerHighlightScaling: 1.5
    };
};