(function($){$(function(){
console.log('filter 2');

$( "#time-slider" ).slider({
	range: true,
    min: 0,
    max: 24,
	values: [ 10, 18 ],
    slide: function( event, ui ) {
        $( "#time-range" ).text( "" + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
      }
});

$( "#cost-slider" ).slider({
	range: true,
    min: 0,
    max: 50,
	values: [ 1, 11 ],
    slide: function( event, ui ) {
        $( "#cost-range" ).text( "" + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
      }
});

 $( "#lesson-date" ).datepicker();
 $( "#lesson-date" ).datepicker( "option", "dateFormat", "dd.mm.yy" );
 //$( "#lesson-date" ).datepicker( $.datepicker.regional[ "ru" ] );

})})(jQuery)
