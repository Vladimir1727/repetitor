(function($){$(function(){
console.log('lessonsRequests 1');
var baseUrl = '../';


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


function canceldiag(id){
	$( "#deldialog" ).remove();
	var body = '<div id="deldialog" title="Отменить занятие?">';
	body += '<form action="cancelLesson" method="post">';
	body += '<button id="del" name="del" type="submit" class="ui-button ui-corner-all ui-widget">Удалить</button>';
	body += '<input type="hidden" value='+id+' name="id">';
	body += '</form>';
	body += '<button id="cancel" class="ui-button ui-corner-all ui-widget">Отмена</button>';
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

function acceptdiag(id){
	$( "#deldialog" ).remove();
	var body = '<div id="deldialog" title="Подтвердить занятие?">';
	body += '<form action="acceptLesson" method="post">';
	body += '<button id="del" name="del" type="submit" class="ui-button ui-corner-all ui-widget">Подтвердить</button>';
	body += '<input type="hidden" value='+id+' name="id">';
	body += '</form>';
	body += '<button id="cancel" class="ui-button ui-corner-all ui-widget">Отмена</button>';
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

function addClick(){
    $('.del').each(function(){
        $(this).click(function(){
            var id = $(this).attr('lesson');
            canceldiag(id);
            $('#cancel').click(function(){
                $('#deldialog').dialog('close');
            });
            $('#del').click(function(){
                console.log('cancel');
            });
            return false;
        });
    });
	$('.ok').each(function(){
        $(this).click(function(){
            var id = $(this).attr('lesson');
			acceptdiag(id);
            $('#cancel').click(function(){
                $('#deldialog').dialog('close');
            });
            $('#del').click(function(){
                console.log('accept');
            });
            return false;
        });
    });
}

addClick();

})})(jQuery)
