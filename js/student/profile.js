(function($){$(function(){
var baseUrl = '../';
console.log('student profile 1');


mask('phone');

function sUpdate(data){
    $.ajax({
        url: baseUrl+'student/update',
        type:'post',
        data: 'data='+JSON.stringify(data),
        success: function(data){
            if (data=='0'){
                errdiag('Сохранение', 'профиль обновлён');
            } else{
                errdiag('Ошибка', data);
            }
        },
    });
}

$('#save_profile').click(function(){
    var first_name = $('#first_name').val().trim();
    var last_name = $('#last_name').val().trim();
    var father_name = $('#father_name').val().trim();
    var tzone_id = $('#tzone_id').val();
    var phone = $('#phone').val().trim();
    var skype = $('#skype').val().trim();
    var email = $('#email').val().trim();
    var password = $('#password').val().trim();
    var password2 = $('#password2').val().trim();
    var err = false;
    var mess = '';
    if (first_name.length<2 || first_name.length>256){
        err = true;
        mess += 'Некорректное имя <br>';
    }
    if (last_name.length<2 || last_name.length>256){
        err = true;
        mess += 'Некорректная фамилия <br>';
    }
    console.log(tzone_id);
    if (tzone_id ==99){
        err = true;
        mess += 'Выберите часовой пояс <br>';
    }
    if (skype.search(/\w{4,}/)==-1){
        err = true;
        mess += 'Некорректный Skype <br>';
    }
    if (email.search(/\w+@+\w+\.\w{2,5}/i)==-1){
        err = true;
        mess += 'Некорректный Email <br>';
    }
    if (password.search(/\w{4,}/)==-1){
        err = true;
        mess += 'Некорректный пароль <br>';
    }
    if (password!=password2){
        err = true;
        mess += 'Пароли не совпадают <br>';
    }

    if (err){
        errdiag('Предупреждение', mess);
    } else{
        sUpdate({
            'first_name' :  first_name,
            'last_name' :  last_name,
            'father_name' :  father_name,
            'tzone_id' :  tzone_id,
            'phone' :  phone,
            'skype' :  skype,
            'email' :  email,
            'password' :  password,
            'status' : 1,
        });
    }
    return false;
});

$('#load_avatar').click(function(){
        $('#add-file').trigger('click');
	return false;
});

$('#add-file').on('change',function(){//получена картинка
	var files = this.files;
	var data = new FormData();
    $.each( files, function( key, value ){
        data.append( key, value );
    });
    $('#avatar-profile').html('<img src="../../img/wait.gif" alt="avarat">');
    $.ajax({
		url: baseUrl+'student/addavatar',
		type: 'POST',
		data: data,
        processData: false,
        contentType: false,
		success: function(rdata){
            console.log(rdata);
            var img = '<img src="../../images/'+rdata+'" alt="avarat">';
            $('#avatar-profile').html(img);
            $('#avatar-main').html(img);
		},
        error: function(xhr, ajaxOptions, thrownError){
            var err = xhr.responseText;
            console.log(err);
        }
	});
});

var tzone_start = false;
var zones = [];
$.ajax({
    url: baseUrl+'main/getTimeZones',
    type: 'POST',
    success: function(data){
        zones = JSON.parse(data);
    },
});
$('#tzone_id').click(function(){
    $('#tzone_id option').each(function(){
        var rTime = new Date();
        var utc = -rTime.getTimezoneOffset()/60;
        var id = $(this).val();
        var z = 0;
        if (id<99){
            for (var i = 0; i < zones.length; i++) {
                if (zones[i].id == id){
                    z = zones[i].zone_time;
                }
            }
            var oTime = new Date(rTime.getTime()+(z-utc)*60*60*1000);
            var span = '';
            if (oTime.getHours()<10){
                span += '0' + oTime.getHours() + ':';
            } else{
                span += oTime.getHours() + ':';
            }
            if (oTime.getMinutes()<10){
                span += '0' + oTime.getMinutes();
            } else{
                span += oTime.getMinutes();
            }
            var text = span + ' ';
            if (tzone_start){
                text +=  $(this).text().substr(5);
            } else{
                text +=  $(this).text();
            }
            $(this).before().text(text);
        }
    });
    tzone_start = true;
});


})})(jQuery)
