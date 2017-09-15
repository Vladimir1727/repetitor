(function($){$(function(){
console.log('1');
var baseUrl = '../../';
var table = 0;
var monday =0;
var week = 0;
var repetitor_id = $('#repetitor_id').val();
var student_id = $('#student_id').val();
var d = new Date();
var utc = d.getTimezoneOffset()/60;
var student_zone = ($('#student_zone').val() == 0) ? utc : $('#student_zone').val();
console.log('student_zone=',student_zone);
if ($('#student_zone').val() == 0){
	if (utc>0){
		$('#s_zone').text('UTC +'+utc);
	} else{
		$('#s_zone').text('UTC '+utc);
	}
}

$('.switch').each(function(){
	$(this).parent().next('div').hide();
	$(this).click(function(){
		if ($(this).hasClass('switch-down')){
			$(this).removeClass('switch-down');
			$(this).addClass('switch-up');
			$(this).parent().next('div').slideDown();
		} else{
			$(this).removeClass('switch-up');
			$(this).addClass('switch-down');
			$(this).parent().next('div').slideUp();
		}
	})
});

$('#next').click(function(){
    week++;
    weekHeader();
    tableView();
    return false;
});

$('#prev').click(function(){
    week = (week>0) ? week-1 : 0;
    weekHeader();
    tableView();
    return false;
});

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

function getDateByid(id){
    id = id+'';
    var wday = id.substr(0,1);
    var hour = id.substr(1);
    return new Date(monday.getTime()+60*60*1000*24*(wday-1)+60*60*1000*hour);
}

function ObjDate(id){
    var addDate = getDateByid(id);
    var t={
        'year' : addDate.getFullYear()+'',
        'month' : (parseInt(addDate.getMonth())>9) ? addDate.getMonth()+1 : '0'+(addDate.getMonth()+1),
        'day' : (parseInt(addDate.getDate())>9) ? addDate.getDate()+'' : '0'+(addDate.getDate()+1),
        'hour' : (parseInt(addDate.getHours())>9) ? addDate.getHours()+'' : '0'+addDate.getHours(),
        'min' : (parseInt(addDate.getMinutes())>9) ? addDate.getMinutes()+'' : '0'+addDate.getMinutes(),
    };
    return t;
}

function idDateString(id){
    var t = ObjDate(id)
    return objToStr(t);
}

function getFromTable(dateStr){
    if (dateStr == null) return false;
    var t={
        'year' : dateStr.substr(0,4),
        'month' : dateStr.substr(5,2),
        'day' : dateStr.substr(8,2),
        'hour' : dateStr.substr(11,2),
        'min' : dateStr.substr(14,2),
    };
    return t;
}

function equalDates(id, dateStr){
    var d1 = ObjDate(id);
    var d2 = getFromTable(dateStr);
    if (d1.year == d2.year && d1.month == d2.month && d1.hour == d2.hour &&d1.day == d2.day){
        return true;
    } else{
        return false;
    }
}

function objToStr(t){
    return t.year+'-'+t.month+'-'+t.day+' '+t.hour+':'+t.min+':00';
}

function killDead(table){
    var temp = [];
    for (var i = 0; i < table.length; i++) {
        if (table[i].id > 0 || table[i].date_from != null){
             temp.push(table[i]);
        }
    }
    return temp;
}

function tableClick(){
    $('.busy').each(function(){
        $(this).unbind();
        $(this).click(function(){
	        $(this).removeClass('busy');
	        $(this).addClass('free');
			for (var k = 0; k < table.length; k++) {
	            if (equalDates($(this).attr('id'), table[k].date_from)){
					table[k].date_from = null;
	            }
	        }
			table = killDead(table);
	        table.push({
	            'id' : 0,
	            'repetitor_id' : $('#repetitor_id').val(),
	            'student_id' : 0,
	            'date_from' : idDateString($(this).attr('id')),
	        });
	        console.log(table);
	        tableClick();
	    });
    });
    $('.free').each(function(){
        $(this).unbind();
        $(this).click(function(){
        $(this).removeClass('free');
        $(this).addClass('busy');
        for (var k = 0; k < table.length; k++) {
            if (equalDates($(this).attr('id'), table[k].date_from)){
				table[k].date_from = null;
            }
        }
		table = killDead(table);
		table.push({
            'id' : 0,
            'repetitor_id' : repetitor_id,
            'student_id' : student_id,
            'date_from' : idDateString($(this).attr('id')),
            'subject_id' : null,
        });
        console.log(table);
        tableClick();
        });
    });
}

function weekHeader(){
    var mess = '';
    var d = new Date();
    if (week>0){
        d = new Date(d.getTime() + 60*60*24*1000*7*week);
        $('#prev').show();
    } else{
        $('#prev').hide();
    }
    var week_day =d.getDay();
    if (week_day ==0){
        week_day = 7;
    }
    var s = new Date(d.getTime() + 60*60*24*(7-week_day)*1000);
    var m = new Date(d.getTime() - 60*60*24*(week_day-1)*1000);
    if (s.getMonth() == m.getMonth()){
        mess += m.getDate()+'-'+s.getDate()+' '+MonthByNumber(m.getMonth())+' '+s.getFullYear();

    } else{
        if(s.getFullYear() == m.getFullYear()){
            mess += m.getDate()+' '+MonthByNumber(m.getMonth())+' - '+s.getDate()+' '+MonthByNumber(s.getMonth())+' '+s.getFullYear();
        } else{
            mess += m.getDate()+' '+MonthByNumber(m.getMonth())+' '+m.getFullYear()+' - '+s.getDate()+' '+MonthByNumber(s.getMonth())+' '+s.getFullYear();
        }
    }
    $('#weeks').text(mess);
}
weekHeader();

function tableView(){
    var tab = '';
    var d = new Date();
    if (week>0){
        d = new Date(d.getTime() + 60*60*24*1000*7*week);
    }
    var week_day =d.getDay();
    if (week_day ==0){
        week_day = 7;
    }
    monday = new Date(d.getTime() - 60*60*24*(week_day-1)*1000);
    monday = new Date(monday.getFullYear(), monday.getMonth(), monday.getDate());
    console.log('new monday=',monday);
    for (var i = 0; i <= 23; i++) {
        tab += '<tr>';
        for (var j = 0; j <= 7; j++) {
            if (j==0){
                tab +='<td>'+i+':00';
            }else{
                var now = new Date(monday.getTime() + 60*60*24*1000*(j-1)+60*60*1000*i);
                var find = false;
                var busy = -1;
                var r = false;
                for (var k = 0; k < table.length; k++) {
                    var tDate = new Date(table[k]['date_from']);
                    if (now.getDate() == tDate.getDate() && now.getHours() == tDate.getHours() && now.getMonth() == tDate.getMonth()){
                        find = true;
                        if (table[k].student_id>0){
                            busy = k;
                        }
                    }
                }
                if (find){
                    console.log(now);
                    if (busy == -1){
                        tab +='<td class="free" id='+j+''+i+'>';
                    }else{
                        tab +='<td class="plan" id='+j+''+i+'>';
                    }
                } else{
                    tab +='<td class="plan" id='+j+''+i+'>';
                }
            }
            tab +='</td>';
        }
        tab += '</tr>';
    }
    $('#table').html(tab);
    console.log('table updated w='+week);
	if (student_id > 0){
		tableClick();
	}
}


$.ajax({
    url: baseUrl+'main/getTimeTable',
    type:'post',
	data: 'repetitor_id=' + repetitor_id,
    success: function(data){
        table = JSON.parse(data);
        if (table.length == 0){
        } else{
			for (var i = 0; i < table.length; i++) {
				var d = new Date(table[i].date_from);
				var t = new Date(d.getTime()+1000*60*60*student_zone);
				var tM = (parseInt(t.getMonth())>9) ? t.getMonth()+1 : '0'+(t.getMonth()+1);
	            var tD = (parseInt(t.getDate())>9) ? t.getDate() : '0'+(t.getDate());
	            var tH = (parseInt(t.getHours())>9) ? t.getHours() : '0'+t.getHours();
	            var tmin = (parseInt(t.getMinutes())>9) ? t.getMinutes() : '0'+t.getMinutes();
				table[i].date_from = t.getFullYear()+'-'+tM+'-'+tD+' '+tH+':'+tmin+':00';
			}
        }
        tableView();
    },
});

})})(jQuery)
