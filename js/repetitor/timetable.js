(function($){$(function(){
var baseUrl = '../';
console.log('repetitor timetable 2');
var table = 0;
var monday =0;
var week = 0;
var students = 0;

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
        data: 'table='+JSON.stringify(table),
        success: function(data){
            if (data == 0){
                errdiag('Сохранение', 'Расписание сохранено');
            } else{
                errdiag('Ошибка', data);
            }
        },
    });
});

$('#search').keyup(function(){
    var f = $('#search').val().trim();
    var find = false;
    var div = '<div id="students">';
    for (var i = 0; i < students.length; i++) {
        if ((students[i].id.indexOf(f)>-1 || students[i].first_name.indexOf(f)>-1) && f.length>0){
            console.log(students[i].first_name);
            find = true;
            div += '<p>'+students[i].first_name+' ID <span>'+students[i].id+'</span></p>';
        }
    }
    div += '</div>';
    $('#students').remove();
    if (find){
        $('#search').after(div);
        $('#students p').each(function(){
            $(this).click(function(){
                var id=$(this).find('span').text();
                document.location = '/index.php/repetitor/plan?id='+id;
            });
        });
    } else{

    }
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

function tableClick(){
    $('.plan').each(function(){
        $(this).unbind();
        $(this).click(function(){
            var code = $(this).attr('id');
            var wday = code.substr(0,1);
            var hour = code.substr(1);
            var addDate = new Date(monday.getTime()+60*60*1000*24*(wday-2)+60*60*1000*hour);
            $(this).removeClass('plan');
            $(this).addClass('free');
            var tM = (parseInt(addDate.getMonth())>9) ? addDate.getMonth()+1 : '0'+(addDate.getMonth()+1);
            var tD = (parseInt(addDate.getDate())>9) ? addDate.getDate()+1 : '0'+(addDate.getDate()+1);
            var tH = (parseInt(addDate.getHours())>9) ? addDate.getHours() : '0'+addDate.getHours();
            var tmin = (parseInt(addDate.getMinutes())>9) ? addDate.getMinutes() : '0'+addDate.getMinutes();
            console.log('parse TH=',parseInt(addDate.getHours()));
            table.push({
                'id' : 0,
                'repetitor_id' : $('#repetitor_id').val(),
                'date_from' : addDate.getFullYear()+'-'+tM+'-'+tD+' '+tH+':'+tmin+':00',
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
        var addDate = new Date(monday.getTime()+60*60*1000*24*(wday-1)+60*60*1000*hour);
        $(this).removeClass('free');
        $(this).addClass('plan');
        var busy = -1;
        for (var k = 0; k < table.length; k++) {
            var tDate = new Date(table[k]['date_from']);
            if (addDate.getDay() == tDate.getDay() && addDate.getHours() == tDate.getHours()){
                busy = k;
            }
        }
        if (busy>-1){
            var temp = [];
            for (var i = 0; i < table.length; i++) {
                if (i != busy){
                    temp.push(table[i]);
                }else{
                    if (table[i].id >0 ){
                        table[i].date_from = null;
                        temp.push(table[i]);
                    }
                }
            }
            table = temp;
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
                        tab +='<td class="busy" id='+j+''+i+'>';
                        tab +=table[busy].student+' ID '+table[busy].student_id;
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
    tableClick();
}

$.ajax({
    url: baseUrl+'repetitor/getTimeTable',
    type:'post',
    success: function(data){
        //console.log(data);
        table = JSON.parse(data);
        if (table.length == 0){
            console.log('empty');
        } else{
            //console.log('making table');
        }
        tableView();
    },
});

$.ajax({
    url: baseUrl+'repetitor/getStudents',
    type:'post',
    success: function(data){
        students = JSON.parse(data);
        console.log(students);
        if (students.length == 0){
            console.log('empty');
        } else{
            console.log('students loaded');
        }
        tableView();
    },
});

})})(jQuery)
