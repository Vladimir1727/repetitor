(function($){$(function(){
var baseUrl = '../';
console.log('admin free 1.1');

function deldiag(id){
	$( "#deldialog" ).remove();
	var body = '<div id="deldialog" title="Удалить заявку?">';
	body += '<form action="delFree" method="post">';
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
     $('#cancel').click(function(){
         $('#deldialog').dialog('close');
     });
}

function acceptdiag(id){
	$( "#deldialog" ).remove();
	var body = '<div id="deldialog" title="Подтвердить заявку?">';
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

function editdiag(id, about, about_time){
	$( "#deldialog" ).remove();
	var body = '<div id="deldialog" title="Удалить заявку?">';
	body += '<form action="editFree" method="post">';
	body += '<input type="hidden" value='+id+' name="id">';
    body += '<textarea name="about">'+about+'</textarea>';
    body += '<textarea name="about_time">'+about_time+'</textarea>';
    body += '<button id="del" name="del" type="submit" class="ui-button ui-corner-all ui-widget">Изменить</button>';
    body += '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button id="cancel" class="ui-button ui-corner-all ui-widget">Отмена</button>';
    body += '</form>';
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
         return false;
     });
}

$('button.ok').click(function(){
    var id = $(this).parent().find('input[name="id"]').val();
    acceptdiag(id);
    return false;
});

$('button.mess').click(function(){
    var id = $(this).parent().find('input[name="id"]').val();
    var about = $(this).parent().find('input[name="about"]').val();
    var about_time = $(this).parent().find('input[name="about_time"]').val();
    editdiag(id, about, about_time);
    return false;
});

$('button.del').click(function(){
    var id = $(this).parent().find('input[name="id"]').val();
    deldiag(id);
    return false;
});

$('button.show').click(function(){
	var id = $(this).parent().find('input[name="id"]').val();
	$.ajax({
        url: baseUrl+'admin/getFreeRepetitors',
        type:'post',
        data: 'free_id=' + id,
        success: function(data){
			var repetitors = JSON.parse(data);
			console.log(repetitors);
			$( "#deldialog" ).remove();
			var body = '<div id="deldialog" title="Репетиторы">';
			for (var i = 0; i < repetitors.length; i++) {
				if (repetitors[i].first_name == null){
					repetitors[i].first_name = 'Без имени';
				}
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
