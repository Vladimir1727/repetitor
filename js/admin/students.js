(function($){$(function(){
console.log('admin students 1');
var baseUrl = '../';

function deldiag(id){
	$( "#deldialog" ).remove();
	$('body').append('<div id="deldialog" title="Удалить ученика?"><form action="changeStudent" method="post"><button id="del" name="del" type="submit" class="ui-button ui-corner-all ui-widget">Удалить</button><input id="del_id" type="hidden" value='+id+' name="id"></form><button id="cancel" class="ui-button ui-corner-all ui-widget">Отмена</button></div>');
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
            var id = $(this).parent().find('input').val();
            deldiag(id);
            $('#cancel').click(function(){
                $('#deldialog').dialog('close');
            });
            return false;
        });
    });
}

addClick();

})})(jQuery)
