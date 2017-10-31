(function($){$(function(){
console.log('filter 1');
var baseUrl = '../';
var isFilter = false;
var filter = false;
var time_from = 0;
var time_to = 24;
var cost_from = 0;
var cost_to = 50;
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
		'utc' : -Utc/60,
	};
	console.log(filter);
	$.ajax({
		url: baseUrl+'main/getfilter2',
		type:'post',
		data: 'filter='+ JSON.stringify(filter)+'&page='+page,
		success: function(data){
			data = JSON.parse(data);
			var repetitor = data.repetitors;
			var pagg = data.pagg;
			var list = '';
			for (var i = 0; i < repetitor.length; i++) {
				list += '<aside>';
				list += '<div class="avatar">';
				list += '<div class="img">';
				list += '<img src="../../';

				if (repetitor[i].avatar == null){
					list += 'img/avatar3.png';
				} else{
					var d = repetitor[i].avatar.search(/\./i);
					var av = repetitor[i].avatar.substr(0,d)+'_thumb'+repetitor[i].avatar.substr(d);
					list += 'images/'+av;
				}
				list += '" alt="avatar">';
				list += '</div>';
				if (repetitor[i].link){
					list += '<a href="rinfo/'+repetitor[i].id+'?subject='+repetitor[i].subject_id+'#video"><span></span> Видео</a>';
				}
				list += '</div>';
				list += '<div class="info">';
				list += '<h2>';
				if (repetitor[i].online){
					list += '<span class="active">';
				} else{
					list += '<span>';
				}
				list += '</span><a href="rinfo/'+repetitor[i].id+'?subject='+repetitor[i].subject_id+'">'+repetitor[i].first_name+'</a></h2>';
				list += '<p><strong>Преподаёт: </strong><span>';
				var first = true;
				list += repetitor[i].subject;
				list += '</span></p>';
				list += '<p class="lang_block"><strong>Родной язык:</strong> <span>'+repetitor[i].language+'</span></p>';
				list += '<div class="stars">';
				var rating = repetitor[i].reight;
				for (j=1; j <= rating ; j++) {
					list += '<span class="star1"></span>';
				}
				for (j=5; j > rating ; j--) {
					list += '<span class="star0"></span>';
				}

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
				if ($('#student_id').val()==0){
					list += '<a href="remember?link=student/addrepetitor/'+repetitor[i].id+'?subject='+repetitor[i].subject_id+'" class="favorites"><span></span> В избранное</a>';
				} else{
					list += '<a href="../student/addrepetitor/'+repetitor[i].id+'?subject='+repetitor[i].subject_id+'" class="favorites"><span></span> В избранное</a>';
				}

				list += '<div class="price">';
				list += '<span>';
				list += repetitor[i].cost;
				list += '</span>$ <small>за час</small>';
				list += '</div>';
				if ($('#student_id').val()==0){
					list += '<a href="remember?link=student/step1/'+repetitor[i].id+'?subject='+repetitor[i].subject_id+'" class="lesson">Записаться на урок</a>';
					list += '<a href="remember?link=student/chat?id='+repetitor[i].id+'" class="message">Написать сообщение</a>';
				} else{
					list += '<a href="../student/step1/'+repetitor[i].id+'?subject='+repetitor[i].subject_id+'" class="lesson">Записаться на урок</a>';
					list +=  '<a href="../student/chat?id='+repetitor[i].id+'" class="message">Написать сообщение</a>';
				}
				list += '<a href="rinfo/'+repetitor[i].id+'?subject='+repetitor[i].subject_id+'#table" class="sh">Расписание</a>';
				list += '</div>';
				list += '</aside>';
			}
			list += '<ul class="pagg"><li><a href="#" class="filter_pagg" title="'+pagg[0]+'"><</a></li>';
			for (i=1; i <pagg.length-1; i++) {
				list += '<li><a href="#" class="filter_pagg" title="'+pagg[i]+'">'+pagg[i]+'</a></li>';
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
	page = 1;
	setFilter();
});

console.log('filter=',$('#filter').val());
setFilter();
if ($('#filter').val()==1){
	setFilter();
}

})})(jQuery)
