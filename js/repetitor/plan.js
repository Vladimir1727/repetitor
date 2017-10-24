(function($){$(function(){
var baseUrl = '../';
console.log('plan 9');
var table = 0;
var monday =0;
var week = 0;
var students = 0;
var copyt = [];
var repetitor_id = $('#repetitor_id').val();
var student_id = $('#student_id').val();
var student_name = $('#student_name').val();
var old = 0;

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

$('#save').click(function(){
    console.log(JSON.stringify(table));
    $.ajax({
        url: baseUrl+'repetitor/saveTimeTable',
        type:'post',
        data: 'table=' + JSON.stringify(table) + '&subject_id=' + $('#subject').val(),
        success: function(data){
            if (data == 0){
                errdiag('Сохранение', 'Расписание сохранено');
            } else{
                errdiag('Ошибка', data);
            }
        },
    });
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
        'month' : (parseInt(addDate.getMonth()+1)>9) ? addDate.getMonth()+1 : '0'+(addDate.getMonth()+1),
        'day' : (parseInt(addDate.getDate())>9) ? addDate.getDate()+'' : '0'+(addDate.getDate()),
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
	if (dateStr.length > 19){
		var t={
	        'year' : dateStr.substr(0,4),
	        'month' : dateStr.substr(6,2),
	        'day' : dateStr.substr(9,2),
	        'hour' : dateStr.substr(12,2),
	        'min' : dateStr.substr(15,2),
	    };
	} else{
	    var t={
	        'year' : dateStr.substr(0,4),
	        'month' : dateStr.substr(5,2),
	        'day' : dateStr.substr(8,2),
	        'hour' : dateStr.substr(11,2),
	        'min' : dateStr.substr(14,2),
	    };
	}
    return t;
}

function equalDates(id, dateStr){
    var d1 = ObjDate(id);
    var d2 = getFromTable(dateStr);
    if (d1.year == d2.year && d1.month == d2.month && d1.hour == d2.hour &&d1.day == d2.day &&d1.min == d2.min){
        return true;
    } else{
        return false;
    }
}

function stringToDate(s){
	if ( s == null) return false;
	if (s.length > 19){
		return new Date(s.substr(0,4), parseInt(s.substr(6,2))-1, s.substr(9,2), s.substr(12,2), s.substr(15,2), s.substr(18,2));
	} else{
		return new Date(s.substr(0,4), parseInt(s.substr(5,2))-1, s.substr(8,2), s.substr(11,2), s.substr(14,2), s.substr(17,2));
	}
}

function objToStr(t){
    console.log(t);
    console.log(t.min);
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

function checkDate(checkTime){
    var d = new Date();
    var zone = $('#zone').val();
    var utc = - d.getTimezoneOffset()/60;
    var realTime = new Date(d.getTime() + (zone-utc)*60*60*1000);
    var addDate = new Date(checkTime.getTime() + 60*60*24*1000);
    if (addDate.getTime() < realTime.getTime()){
        errdiag('Ошибка','Нельзя изменить прошлое');
        return false;
    } else{
        return true;
    }
}

function tableClick(){
    $('.planed').each(function(){
        $(this).unbind();
        $(this).click(function(){
            var code = $(this).attr('id');
            var wday = code.substr(0,1);
            var hour = code.substr(1);
            var addDate = new Date(monday.getTime()+60*60*1000*24*(wday-2)+60*60*1000*hour);
            if (checkDate(addDate) == false){
                return false;
            }
            $(this).removeClass('planed');
            $(this).addClass('busy');
            $(this).text(student_name+' ID '+student_id);
            table.push({
                'id' : 0,
                'repetitor_id' : repetitor_id,
                'student_id' : student_id,
                'date_from' : idDateString($(this).attr('id')),
                'subject_id' : $('#subject').val(),
            });
            console.log(table);
            tableClick();
        });
    });
    $('.free').each(function(){
        $(this).unbind();
        $(this).click(function(){
            var code = $(this).attr('id');
            var wday = code.substr(0,1);
            var hour = code.substr(1);
            var addDate = new Date(monday.getTime()+60*60*1000*24*(wday-2)+60*60*1000*hour);
            if (checkDate(addDate) == false){
                return false;
            }
        $(this).removeClass('free');
        $(this).addClass('busy');
        $(this).text(student_name+' ID '+student_id);
        for (var k = 0; k < table.length; k++) {
            if (equalDates($(this).attr('id'),table[k].date_from)){
                console.log('find free');
                table[k].date_from = null;
            }
        }
        table = killDead(table);
        table.push({
            'id' : 0,
            'repetitor_id' : repetitor_id,
            'student_id' : student_id,
            'date_from' : idDateString($(this).attr('id')),
            'subject_id' : $('#subject').val(),
        });
        console.log(table);
        tableClick();
        });
    });
    $('.busy').each(function(){
        $(this).unbind();
        $(this).click(function(){
            var code = $(this).attr('id');
            var wday = code.substr(0,1);
            var hour = code.substr(1);
            var addDate = new Date(monday.getTime()+60*60*1000*24*(wday-2)+60*60*1000*hour);
            if (checkDate(addDate) == false){
                return false;
            }
            var find = false;
            for (var k = 0; k < table.length; k++) {
                if (equalDates($(this).attr('id'),table[k].date_from) && table[k].student_id == student_id){
                    find = k;
                }
            }
            if (find){
                $(this).removeClass('busy');
                console.log('MY STUDENT!');
                table[find].date_from = null;
                table = killDead(table);
                    $(this).addClass('free');
                    table.push({
                        'id' : 0,
                        'repetitor_id' : repetitor_id,
                        'student_id' : 0,
                        'date_from' : idDateString($(this).attr('id')),
                    });

                $(this).text('');
            } else{
                console.log('other student');
            }
            console.log(table);
            tableClick();
        });
    });
}

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
                    var tDate = stringToDate(table[k]['date_from']);
                    if (now.getDate() == tDate.getDate() && now.getHours() == tDate.getHours() && now.getMonth() == tDate.getMonth()){
                        find = true;
                        if (table[k].student_id>0){
                            busy = k;
                        }
                    }
                }
                if (find){
                    if (busy == -1){
                        tab +='<td class="free" id='+j+''+i+'>';
                    }else{
                        tab +='<td class="busy" id='+j+''+i+'>';
                        tab +=table[busy].student+' ID '+table[busy].student_id;
                    }
                } else{
                    tab +='<td class="planed" id='+j+''+i+'>';
                }
            }
            tab +='</td>';
        }
        tab += '</tr>';
    }
    $('#table').html(tab);
    console.log('table updated w='+week);
    tableClick();
}

$.ajax({
    url: baseUrl+'repetitor/getTimeTable',
    type:'post',
    success: function(data){
        table = JSON.parse(data);
        if (table.length == 0){
            console.log('empty');
        } else{

        }
        tableView();

    },
});

})})(jQuery)
