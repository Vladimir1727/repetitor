(function($){$(function(){
console.log('filter 4');
var baseUrl = '../';
var isFilter = false;
var filter = false;
var time_from = 10;
var time_to = 18;
var cost_from = 1;
var cost_to = 11;
var page = 1;



$( "#time-slider" ).slider({
	range: true,
    min: 0,
    max: 24,
	values: [ time_from, time_to ],
    slide: function( event, ui ) {
		time_from = ui.values[ 0 ];
		time_to = ui.values[ 1 ];
        $( "#time-range" ).text( "" + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
      }
});

$( "#cost-slider" ).slider({
	range: true,
    min: 0,
    max: 50,
	values: [ cost_from, cost_to ],
    slide: function( event, ui ) {
		cost_from = ui.values[ 0 ];
		cost_to = ui.values[ 1 ];
        $( "#cost-range" ).text( "" + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
      }
});

 $( "#lesson-date" ).datepicker();
 $( "#lesson-date" ).datepicker( "option", "dateFormat", "dd.mm.yy" );

function setFilter(){
	$.ajax({
		url: baseUrl+'main/getfilter',
		type:'post',
		data: 'filter='+ JSON.stringify(filter)+'&page='+page,
		success: function(data){
			console.log(data);
			data = JSON.parse(data);
			var repetitor = data.repetitors;
			var pagg = data.pagg;
			var list = '';
			for (var i = 0; i < repetitor.length; i++) {
				list += '<aside>';
				list += '<div class="avatar">';
				list += '<div class="img">';
				var d = repetitor[i].avatar.search(/\./i);
				var av = repetitor[i].avatar.substr(0,d)+'_thumb'+repetitor[i].avatar.substr(d);
				list += '<img src="../../images/'+av+'" alt="avatar">';
				list += '</div>';
				if (repetitor[i].link){
					list += '<a href="'+repetitor[i].link+'"><span></span> Видео</a>';
				}
				list += '</div>';
				list += '<div class="info">';
				list += '<h2>';
				if (repetitor[i].online){
					list += '<span class="active">';
				} else{
					list += '<span>';
				}
				list += '</span><a href="rinfo/'+repetitor[i].id+'">'+repetitor[i].first_name+'</a></h2>';
				list += '<p><strong>Преподаёт: </strong><span>';
				var first = true;
				for (k=0; k < repetitor[i].subjects.length ; k++) {
					if (first == false){
						list += ' / ';
					} else{
						first = false;
					}
					list += repetitor[i].subjects[k];
				}
				list += '</span></p>';
				list += '<p class="lang_block"><strong>Родной язык:</strong> <span>'+repetitor[i].language+'</span></p>';
				list += '<div class="stars">';
				list += '<span class="star1"></span>';
				list += '<span class="star1"></span>';
				list += '<span class="star1"></span>';
				list += '<span class="star0"></span>';
				list += '<span class="star0"></span>';
				list += '</div>';
				list += '<p>';
				list += '<strong>Специализация: </strong>';
				list += '<span>';
				first = true;
				for (k=0; k < repetitor[i].spec.length ; k++) {
					if (first == false){
						list += ' / ';
					} else{
						first = false;
					}
					list += repetitor[i].spec[k];
				}
				list += '</span>';
				list += '</p>';
				list += '<p><strong>Возрастные группы:</strong><span> ';
				first = true;
				for (k=0; k < repetitor[i].ages.length ; k++) {
					if (first == false){
						list += ' / ';
					} else{
						first = false;
					}
					list += repetitor[i].ages[k];
				}
				list += '</span></p><p><strong>Презентация: </strong>';
				list += '<span>';
				list += repetitor[i].about;
				list += '</span></p>';
				list += '<a href="#" class="favorites"><span></span> В избранное</a>';
				list += '<div class="price">';
				list += '<span>';
				if (repetitor[i].cost.length == 1){
					list += repetitor[i].cost[0];
				} else{
					if(repetitor[i].cost[0] == repetitor[i].cost[1]){
						list += repetitor[i].cost[0];
					} else{
						if (repetitor[i].cost[0]>repetitor[i].cost[1]){
							list += repetitor[i].cost[1]+'-'+repetitor[i].cost[0];
						}else{
							list += repetitor[i].cost[0]+'-'+repetitor[i].cost[1];
						}
					}
				}
				list += '</span>$ <small>за час</small>';
				list += '</div>';
				list += '<a href="rinfo/'+repetitor[i].id+'" class="lesson">Записаться на урок</a>';
				list += '<a href="#" class="message">Написать сообщение</a>';
				list += '<a href="rinfo/'+repetitor[i].id+'" class="sh">Расписание</a>';
				list += '</div>';
				list += '</aside>';
			}
			list += '<ul class="pagg"><li><a href="#" class="filter_pagg" title="'+pagg[0]+'"><</a></li>';
			for (i=1; i <pagg.length-1; i++) {
				list += '<li><a href="#" class="filter_pagg" title="'+pagg[0]+'">'+pagg[i]+'</a></li>';
			}
			list += '<li><a href="#" class="filter_pagg" title="'+pagg[pagg.length-1]+'">></a></li></ul>';

			if (data.repetitors.length == 0){
				$('#result').html('<h2 style="text-align:center">Упс..Попробуйте ввести другие параметры в поиск.</h2>');
			}else{
				$('#result').html(list);
			}
			$('.filter_pagg').each(function(){
				$(this).click(function(){
					page = $(this).attr('title');
					console.log($(this).attr('title'));
					setFilter();
					return false;
				});
			});
		},
	});
}

$('#show_filter').click(function(){
	isFilter = true;
	var Utc = new Date().getTimezoneOffset();
	filter = {
		'subject_id' : ($('#subject_select').val() > 0) ? $('#subject_select').val() : false,
		'age_id' : ($('#age_select').val() > 0) ? $('#age_select').val() : false,
		'spec_id' : ($('#spec_select').val() > 0) ? $('#spec_select').val() : false,
		'date_from' : ($('#lesson-date').val() != '') ? $('#lesson-date').val() : false,
		'time_from' : time_from,
		'time_to' : time_to,
		'cost_from' : cost_from,
		'cost_to' : cost_to,
		'lang_id' : ($('#lang_select').val() > 0) ? $('#lang_select').val() : false,
		'level_id' : ($('#level_select').val() > 0) ? $('#level_select').val() : false,
		'online' : ($('#online').prop('checked')) ? true : false,
		'video' : ($('#video').prop('checked')) ? true : false,
		'utc' : Utc/60,
	};
	setFilter();

});

})})(jQuery)
