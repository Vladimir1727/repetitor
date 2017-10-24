(function($){$(function(){
var baseUrl = '';
console.log('student free');

function MonthByNumber(number){
    switch(number){
        case 0:
        return 'января';
        case 1:
        return 'февраля';
        case 2:
        return 'марта';
        case 3:
        return 'апреля';
        case 4:
        return 'мая';
        case 5:
        return 'июня';
        case 6:
        return 'июля';
        case 7:
        return 'августа';
        case 8:
        return 'сентября';
        case 9:
        return 'октября';
        case 10:
        return 'ноября';
        case 11:
        return 'декабря';
    }
}

function WeekDayByNumber(number){
    switch(number){
        case 0:
        return 'воскресенье';
        case 1:
        return 'понедельник';
        case 2:
        return 'вторник';
        case 3:
        return 'среда';
        case 4:
        return 'четверг';
        case 5:
        return 'пятница';
        case 6:
        return 'суббота';
    }
}

function sTime(){
    var s = new Date();
    var hour = (s.getHours()>9) ? s.getHours(): '0'+s.getHours();
    var min = (s.getMinutes()>9) ? s.getMinutes(): '0'+s.getMinutes();
    var day = (s.getDate()>9) ? s.getDate(): '0'+s.getDate();
    var year = s.getFullYear();
    var month = MonthByNumber(s.getMonth());
    var wday = WeekDayByNumber(s.getDay());
    var time = hour + ':' + min;
    var date = day + ' ' + month + ' ' + year+','+wday;
    $('#local-time').text(time);
    $('#local-date').text(date);
}

var timer = setInterval(function(){
    sTime();
},500);

$('#add_but').click(function(){
    var about = $('#about').val().trim();
    var dates = $('#dates').val().trim();
    var subject_id = $('#subject_id').val();
    var mess= '';
    var err = false;
    if (subject_id == 0){
        err = true;
        mess += 'Выберите предмет<br>';
    }
    if (about.length < 10){
        err = true;
        mess += 'Цель обучения должна содержать хотя бы 10 символов<br>';
    }
    if (about.length > 1000){
        err = true;
        mess += 'Цель обучения должна содержать не более 1000 символов<br>';
    }
    if (dates.length < 10){
        err = true;
        mess += 'Время занятия должно содержать хотя бы 10 символов<br>';
    }
    if (dates.length > 1000){
        err = true;
        mess += 'Время занятия должно содержать не более 1000 символов<br>';
    }
    if (err){
        errdiag('Предупреждение', mess);
        return false;
    } else{
        console.log('all ok');
    }
});


$('button.ok').click(function(){
	var id = $(this).parent().find('input[name="id"]').val();
	$.ajax({
        url: baseUrl+'getFreeRepetitors',
        type:'post',
        data: 'free_id=' + id,
        success: function(data){
            console.log(data);
			var repetitors = JSON.parse(data);
			//console.log(repetitors);
			$( "#deldialog" ).remove();
			var body = '<div id="deldialog" title="Репетиторы">';
			for (var i = 0; i < repetitors.length; i++) {
				body += '<a href="../main/rinfo/'+repetitors[i].id+'?subject='+repetitors[i].subject_id+'" target="_blank">'+repetitors[i].first_name;
				if (repetitors[i].father_name != null){
					body += ' '+repetitors[i].father_name;
				}
				body += '</a><br>';
			}
			body += '</div>';
			$('body').append(body);
			$( "#deldialog" ).dialog({
				  autoOpen: true,
				  show: {
					effect: "fade",
					duration: 500
				  },
				  hide: {
					  effect: "fade",
					  duration: 500
				  },
		     });
		}
	});
	return false;
});

})})(jQuery)
