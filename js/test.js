(function($){$(function(){
console.log('test 11/08 1');
var baseUrl = '../';
/*var form = 'name=333&time=3';
$.ajax({
    url: baseUrl+'test/ajaxtest',
    type:'post',
    data: form,
    success: function(data){
        console.log('data=', data);
        if (data=='0'){
            console.log('login');
        } else{
            errdiag('Ошибка', data);
        }
    },
});*/

$('#add-photo-but').click(function(){//нажата кнопка добавить фото
        $('#add-file').trigger('click');
	return false;
});

$('#add-file').on('change',function(){//получена картинка
	var files = this.files;
	var data = new FormData();
    $.each( files, function( key, value ){
        data.append( key, value );
    });
    //var f = data.get(0)
    //console.log(f.name);
    $.ajax({
		url: baseUrl+'test/adddoc',
		type: 'POST',
		data: data,
        processData: false,
        contentType: false,
		success: function(rdata){
			//var img='<li><img src="/'+rdata+'" alt="document-photo"></li>';
			//$('#photos').html(img);
            console.log(rdata);
		},
        error: function(xhr, ajaxOptions, thrownError){
            var err = xhr.responseText;
            var reg = /<p>Message: ([^<]{1,})/;
            var errMess = reg.exec(err)
            errdiag('Ошибка', errMess[1]);
        }
	});
});

})})(jQuery)
