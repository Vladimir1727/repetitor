(function($){$(function(){
var baseUrl = '../';
console.log('repetitor free');

function tables(subject_id=0){
	$.ajax({
		url: baseUrl+'Repetitor/getFree',
		type:'post',
		data: 'subject_id=' + subject_id,
		success: function(data){
			var tab = JSON.parse(data);
			$('#c_new').text(tab.requests.length);
			$('#c_old').text(tab.accepted.length);
			var list ='';
			for (var i = 0; i < tab.requests.length; i++) {
				list += '<aside>';
	            list += '<div>';
	            list += '<p>';
	            var c = tab.requests[i].created_at;
	            list += '<p>'+c.substr(8,2)+'.'+c.substr(5,2)+'.'+c.substr(0,4)+'</p>';
	            list += '<p>'+c.substr(11,2)+':'+c.substr(14,2);
	            list += '</p>';
	            list += '<h5>Откликнулись: '+tab.requests[i].req+'</h5>';
	            list += '</div>';
	            list += '<div>';
	            list += '<p>';
	            list += tab.requests[i].subject;
	            list += '</p>';
	            list += '</div>';
	            list += '<div>';
	            list += '<p>';
	            list += tab.requests[i].student_name;
	            list += '</p>';
	            list += '<p>';
	            list += 'ID '+tab.requests[i].student_id;
	            list += '</p>';
	            list += '</div>';
	            list += '<div>';
	            list += '<p>';
	            list += tab.requests[i].about;
	            list += '</p>';
	            list += '</div>';
	            list += '<div>';
	            list += '<p>';
	            list += tab.requests[i].about_time;
	            list += '</p>';
	            list += '</div>';
	            list += '<div>';
	            list += '<button class="ok">Откликнуться</button>';
	            list += '<button class="del">Отклонить</button>';
	            list += '<input type="hidden" name="id" value='+tab.requests[i].id+'>';
	            list += '</div>';
	            list += '</aside>';
			}
			$('#table_new').html(list);
			var list ='';
			for (var i = 0; i < tab.accepted.length; i++) {
				list += '<aside>';
				list += '<div>';
				list += '<p>';
				var c = tab.accepted[i].created_at;
				list += '<p>'+c.substr(8,2)+'.'+c.substr(5,2)+'.'+c.substr(0,4)+'</p>';
				list += '<p>'+c.substr(11,2)+':'+c.substr(14,2);
				list += '</p>';
				list += '<h5>Откликнулись: '+tab.accepted[i].req+'</h5>';
				list += '</div>';
				list += '<div>';
				list += '<p>';
				list += tab.accepted[i].subject;
				list += '</p>';
				list += '</div>';
				list += '<div>';
				list += '<p>';
				list += tab.accepted[i].student_name;
				list += '</p>';
				list += '<p>';
				list += 'ID '+tab.accepted[i].student_id;
				list += '</p>';
				list += '</div>';
				list += '<div>';
				list += '<p>';
				list += tab.accepted[i].about;
				list += '</p>';
				list += '</div>';
				list += '<div>';
				list += '<p>';
				list += tab.accepted[i].about_time;
				list += '</p>';
				list += '</div>';
				list += '<div>';
				list += '<a href="chat?id='+tab.accepted[i].student_id+'" class="mess">Чат с учеником</a>';
	            list += '<button class="del">Отклонить</button>';
	            list += '<input type="hidden" name="id" value='+tab.accepted[i].id+'>';
				list += '</div>';
				list += '</aside>';
			}
			$('#table_old').html(list);
			addClick();
		}
	});
}

function deldiag(id){
	$( "#deldialog" ).remove();
	var body = '<div id="deldialog" title="Отклонить заявку?">';
	body += '<form action="delFree" method="post">';
	body += '<button id="del" name="del" type="submit" class="ui-button ui-corner-all ui-widget">Отклонить</button>';
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
     $('#cancel').click(function(){
         $('#deldialog').dialog('close');
     });
}

function acceptdiag(id){
	$( "#deldialog" ).remove();
	var body = '<div id="deldialog" title="Откликнуться на заявку?">';
	body += '<form action="acceptFree" method="post">';
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
     $('#cancel').click(function(){
         $('#deldialog').dialog('close');
     });
}

function addClick(){
	$('button.ok').click(function(){
	    var id = $(this).parent().find('input[name="id"]').val();
	    acceptdiag(id);
	    return false;
	});
	$('button.mess').click(function(){
	    var id = $(this).parent().find('input[name="id"]').val();
	    return false;
	});
	$('button.del').click(function(){
	    var id = $(this).parent().find('input[name="id"]').val();
	    deldiag(id);
	    return false;
	});
}

addClick();

$('#subject_id').change(function(){
	var subject_id = $('#subject_id').val();
	if (subject_id>0){
		tables(subject_id);
	}
});

})})(jQuery)
