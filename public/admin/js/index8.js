$(function() {
    "use strict";
    MorrisArea();
});
//======
function MorrisArea() {

    Morris.Area({
        element: 'area_chart',
        data: [{
            period: '2011',
            Sales: 5,
            Revenue: 12,

        }, {
            period: '2012',
            Sales: 62,
            Revenue: 10,

        }, {
            period: '2013',
            Sales: 20,
            Revenue: 84,

        }, {
            period: '2014',
            Sales: 108,
            Revenue: 12,

        }, {
            period: '2015',
            Sales: 30,
            Revenue: 95,

        }, {
            period: '2016',
            Sales: 25,
            Revenue: 25,

        }, {
            period: '2017',
            Sales: 135,
            Revenue: 12,

        }

    ],
    lineColors: ['#ffc107', '#17a2b8'],
    xkey: 'period',
    ykeys: ['Sales', 'Revenue'],
    labels: ['Sales', 'Revenue'],
    pointSize: 2,
    lineWidth: 1,
    resize: true,
    fillOpacity: 0.5,
    behaveLikeLine: true,
    gridLineColor: '#e0e0e0',
    hideHover: 'auto'
    });

}


// progress bars
$('.progress .progress-bar').progressbar({
    display_text: 'none'
});

$('.sparkline-pie').sparkline('html', {
    type: 'pie',
    offset: 90,
    width: '155px',
    height: '155px',
    sliceColors: ['#02b5b2', '#445771', '#ffcd55']
})

$('.sparkbar').sparkline('html', { type: 'bar' });

