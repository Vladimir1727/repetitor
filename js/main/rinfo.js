(function($){$(function(){
var baseUrl = '../../';
var table = 0;
var monday =0;
var week = 0;
var myStudent = false;
var repetitor_id = $('#repetitor_id').val();
var student_id = $('#student_id').val();
var dates = [];
var student = $('#student').val();
var d = new Date();
var utc = - d.getTimezoneOffset()/60;
var student_zone = 0;
var delta = 0;
if ($('#zone_type').val() == 'none'){
	student_zone = utc;
	delta = student_zone - utc;
} else{
	student_zone = $('#student_zone').val();
	delta = student_zone - utc;
}

if ($('#zone_type').val() == 'none'){
	if (utc>0){
		$('#s_zone').text('UTC +'+utc);
	} else{
		$('#s_zone').text('UTC '+utc);
	}
}

function checkDate(i,j){
	var wday = j;
	var hour = i;
	var cDate = new Date(monday.getTime()+60*60*1000*24*(wday-2)+60*60*1000*hour);
    var d = new Date();
    var zone = student_zone;
    var utc = - d.getTimezoneOffset()/60;
    var realTime = new Date(d.getTime() + (zone-utc)*60*60*1000);
    var addDate = new Date(cDate.getTime() + 60*60*24*1000+ 1000*60*30);
    if (addDate.getTime() < realTime.getTime()){
		console.log('false', hour);
		console.log('r=', realTime);
		console.log('a=', addDate);
		console.log('/////////////////');
        return false;
    } else{
        return true;
    }
}

console.log('rinfo 1.1');

function stringToDate(s){
	if ( s == null) return false;
	if (s.length > 19){
		return new Date(s.substr(0,4), parseInt(s.substr(6,2))-1, s.substr(9,2), s.substr(12,2), s.substr(15,2), s.substr(18,2));
	} else{
		return new Date(s.substr(0,4), parseInt(s.substr(5,2))-1, s.substr(8,2), s.substr(11,2), s.substr(14,2), s.substr(17,2));
	}
}

getTimeTable();

function getTimeTable(week = 0){
    $.ajax({
        url: baseUrl+'main/getTimeTable',
        type:'post',
        data:'repetitor_id='+repetitor_id+'&week=' + week,
        success: function(data){
            table = JSON.parse(data);
            if (table.length == 0){
                console.log('empty');
            } else{
				for (var i = 0; i < table.length; i++) {
					if(table[i].date_from.length > 19){
						var s = table[i].date_from;
						table[i].date_from = s.substr(0,5) + s.substr(6);
					}
					var r = table[i].date_from;
					var d = stringToDate(table[i].date_from);
					var t = new Date(d.getTime()+1000*60*60*student_zone);
					var tM = (parseInt(t.getMonth()+1)>9) ? t.getMonth()+1 : '0'+(t.getMonth()+1);
		            var tD = (parseInt(t.getDate())>9) ? t.getDate() : '0'+(t.getDate());
		            var tH = (parseInt(t.getHours())>9) ? t.getHours() : '0'+t.getHours();
		            var tmin = (parseInt(t.getMinutes())>9) ? t.getMinutes() : '0'+t.getMinutes();
					table[i].date_from = t.getFullYear()+'-'+tM+'-'+tD+' '+tH+':'+tmin+':00';
				}
            }
            tableView();
        },
    });
}

$('#next').click(function(){
    week++;
    weekHeader();
    getTimeTable(week);
    return false;
});

$('#prev').click(function(){
    week = (week>0) ? week-1 : 0;
    weekHeader();
    getTimeTable(week);
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
        'year' : parseInt(addDate.getFullYear()),
        'month' : parseInt(addDate.getMonth())+1,
        'day' : parseInt(addDate.getDate()),
        'hour' : parseInt(addDate.getHours()),
        'min' : parseInt(addDate.getMinutes()),
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
	        'year' : parseInt(dateStr.substr(0,4)),
	        'month' : parseInt(dateStr.substr(6,2)),
	        'day' : parseInt(dateStr.substr(9,2)),
	        'hour' : parseInt(dateStr.substr(12,2)),
	        'min' : parseInt(dateStr.substr(15,2)),
	    };
	} else{
	    var t={
	        'year' : parseInt(dateStr.substr(0,4)),
	        'month' : parseInt(dateStr.substr(5,2)),
	        'day' : parseInt(dateStr.substr(8,2)),
	        'hour' : parseInt(dateStr.substr(11,2)),
	        'min' : parseInt(dateStr.substr(14,2)),
	    };
	}
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
	$('.free').each(function(){
        $(this).unbind();
        $(this).click(function(){
	        if (student_id == 0){
				var id = $(this).attr('id');
				var d = getDateByid(id);
				var t = d.getTime()-1000*60*60*student_zone;
				var link = 'student/step1/' + repetitor_id;
				document.location = '/index.php/main/remember?link='+link;
			}else{
				var id = $(this).attr('id');
				var d = getDateByid(id);
				var t = d.getTime()-1000*60*60-1000*60*60*student_zone;
				dates.push(t);
				$(this).removeClass('free');
				$(this).addClass('busy');
				$(this).text(student + ' ID ' + student_id);
				console.log(dates);
				for (var i = 0; i < table.length; i++) {
					if (equalDates(id, table[i].date_from)) {
						table[i].student_id = student_id;
					}
				}
				console.log(table);
				tableClick();
			}
	    });
    });
	$('.busy').each(function(){
		$(this).unbind();
		$(this).click(function(){
			console.log('click busy');
			var id = $(this).attr('id');
			var d = getDateByid($(this).attr('id'));
			var t = d.getTime()-1000*60*60*student_zone;
			$(this).removeClass('busy');
			$(this).addClass('free');
			$(this).text('');
			var temp = [];
			for (var i=0; i< dates.length; i++){
				if (dates[i] != t){
					temp.push(dates[i]);
				}
			}
			dates = temp;
			for (var i = 0; i < table.length; i++) {
				if (equalDates(id, table[i].date_from)) {
					table[i].student_id = 0;
				}
			}
			console.log(dates);
			console.log(table);
		$(this).unbind();
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
	var realTime = new Date();
    if (week>0){
        d = new Date(d.getTime() + 60*60*24*1000*7*week);
    }
    var week_day = d.getDay();
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
					var tDate = stringToDate(table[k].date_from);
					/////////
                    if (now.getTime() == tDate.getTime() && checkDate(i,j)==true){
                        find = true;
						if (table[k].student_id>0){
                            busy = k;
							if (table[k].student_id == student_id){
								myStudent = true;
							} else{
								myStudent = false;
							}
                        }
                    }
                }
                if (find){
                    if (busy == -1){
                        tab +='<td class="free" id='+j+''+i+'>';
                    }else{
						if (myStudent){
							tab +='<td class="busy" id='+j+''+i+'>' + student + ' ID ' + student_id;
						} else{
							tab +='<td class="plan" id='+j+''+i+'>';
						}
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
		tableClick();
}


// $.ajax({
//     url: baseUrl+'main/getTimeTable',
//     type:'post',
// 	data: 'repetitor_id=' + repetitor_id,
//     success: function(data){
//         table = JSON.parse(data);
//         if (table.length == 0){
//         } else{
// 			for (var i = 0; i < table.length; i++) {
// 				if(table[i].date_from.length > 19){
// 					var s = table[i].date_from;
// 					table[i].date_from = s.substr(0,5) + s.substr(6);
// 				}
// 				var r = table[i].date_from;
// 				var d = stringToDate(table[i].date_from);
// 				var t = new Date(d.getTime()+1000*60*60*student_zone);
// 				var tM = (parseInt(t.getMonth()+1)>9) ? t.getMonth()+1 : '0'+(t.getMonth()+1);
// 	            var tD = (parseInt(t.getDate())>9) ? t.getDate() : '0'+(t.getDate());
// 	            var tH = (parseInt(t.getHours())>9) ? t.getHours() : '0'+t.getHours();
// 	            var tmin = (parseInt(t.getMinutes())>9) ? t.getMinutes() : '0'+t.getMinutes();
// 				table[i].date_from = t.getFullYear()+'-'+tM+'-'+tD+' '+tH+':'+tmin+':00';
// 			}
//         }
//         tableView();
//     },
// });

$('#next_step, #step_one').click(function(){
	if (dates.length >0){
		for (var i = 0; i < dates.length; i++) {
			var inp = '<input type="hidden" name="date[]" value='+dates[i]+'>';
			$('#step_form').append(inp);
		}
		$('#step_form').trigger('submit');
	} else{
		// if (student_id>0){
		// 	document.location = 'main/student/step1/'+repetitor_id;
		// } else{
		// 	return true;
		// }
		return true;
	}
	return false;
});

$('#send_feed').click(function(){
	if ($('#about').val().trim().length>1000){
		errdiag('Предупреждение', 'отзыв должен быть не более 1000 символов');
		return false;
	}
});

})})(jQuery)
