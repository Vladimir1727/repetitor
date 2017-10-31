(function($){$(function(){
var baseUrl = '../';
console.log('repetitor profile 12');
var proc = 0.3;
var can_mess = '';
/*$('#slide').click(function(){
    $('#slide ul').slideToggle();
});*/

function deldiag(){
	$( "#deldialog" ).remove();
	$('body').append('<div id="deldialog" title="Удалить профиль репетитора?"><form action="deleteRepetitor" method="post"><button id="del" name="del" type="submit" class="ui-button ui-corner-all ui-widget">Удалить</button></form><button id="cancel" class="ui-button ui-corner-all ui-widget">Отмена</button></div>');
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

function warp(block){
    $('section.warp aside').each(function(){
        $(this).hide();
    });
    $(block).show();
    $('main.rep-profile section.menu li a').each(function(){
        $(this).removeClass('active');
    });
    $(block+'-but').addClass('active');
}

function rUpdate(data){
    $.ajax({
        url: baseUrl+'repetitor/update',
        type:'post',
        data: 'data='+JSON.stringify(data),
        success: function(data){
            console.log(data);
            if (data=='0'){
                errdiag('Сохранение', 'профиль обновлён');
            } else{
                errdiag('Ошибка', data);
            }
        },
    });
}

// rUpdate({
//     'first_name':'Vv',
//     'last_name':'Dd'
// });

$('#present-but').click(function(){
    warp('#present');
    return false;
});

$('#personal-but').click(function(){
    warp('#personal');
    return false;
});

$('#subject-but').click(function(){
    warp('#subject');
    return false;
});

$('#pay-but').click(function(){
    warp('#pay');
    return false;
});

$('#edu-but').click(function(){
    warp('#edu');
    return false;
});

$('#docs-but').click(function(){
    warp('#docs');
    return false;
});

$('#status-but').click(function(){
    warp('#status');
    return false;
});

$('#save_personal').click(function(){
    var correct = true;
    var first_name = $('#first_name').val().trim();
    var last_name = $('#last_name').val().trim();
    var skype = $('#skype').val().trim();
    var email = $('#email').val().trim();
    var password = $('#password').val().trim();
    var password2 = $('#password2').val().trim();
    var mess = '';
    if (first_name.search(/[a-zA-Z_0-9а-яА-Я]{3,16}/i) == -1){
        correct = false;
        mess += 'некорректное имя <br>';
    }
    if (last_name.search(/[a-zA-Z_0-9а-яА-Я]{3,16}/i) == -1){
        correct = false;
        mess += 'некорректная фамилия <br>';
    }
    if (skype.search(/[a-zA-Z_0-9]{2,}/i) == -1){
        correct = false;
        mess += 'некорректный Skype <br>';
    }
    if (email.search(/\w+@+\w+\.\w{2,5}/i) == -1){
        correct = false;
        mess += 'некорректный Email <br>';
    }
    if (password.search(/\w{3,}/) == -1 || password != password2){
        correct = false;
        mess += 'некорректный пароль <br>';
    }
    if (correct){
        rUpdate({
            'first_name' : first_name,
            'last_name' : last_name,
            'father_name' : $('#father_name').val().trim(),
            'phone': $('#phone').val().trim(),
            'tzone_id' : $('#tzone_id').val(),
            'skype' : skype,
            'email' : email,
            'password' : password,
        });
    } else{
        errdiag('Ошибка', mess);
    }
    return false;
});

$('#price').on('keyup',function(){
    var v = parseInt($('#price').val());
    if (v > 0){
        $('#sprice').val(Math.round(v*(1+proc)));
    } else{
        $('#sprice').val('');
    }
});

$('#save_subject').click(function(){
    var f = $('#subject_form').serializeArray();
    var sp = false;
    var age = false;
    var level = false;
    var price = false;
    var lang = false;
    var sub = false;
    for (i = 0; i < f.length; i++){
        if (f[i].name == "specialization_id[]") sp = true;
        if (f[i].name == "age_id[]") age = true;
        if (f[i].name == "level_id[]") level = true;
        if (f[i].name == "price" && parseInt(f[i].value)>0) price = true;
        if (f[i].name == "lang_id" && parseInt(f[i].value)>0) lang = true;
        if (f[i].name == "subject_id" && parseInt(f[i].value)>0)  sub = true;
    }

    if (sp == false || age == false || level == false || price == false || lang == false || sub == false){
        var mess = "";
        if (sp == false) mess += "Выберите хотя бы одну специализацию <br>";
        if (age == false) mess += "Выберите хотя бы одну возрастную категорию <br>";
        if (level == false) mess += "Выберите хотя бы один уровень <br>";
        if (price == false) mess += "Цена указана неверно <br>";
        if (lang == false) mess += "Выберите родной язык <br>";
        if (sub == false) mess += "Выберите предмет <br>";
        errdiag("Предупреждение", mess);
    } else{
        console.log($('#subject_form').serialize());
        $.ajax({
            url: baseUrl+'repetitor/updateSubject',
            type:'post',
            data: $('#subject_form').serialize(),
            success: function(data){
                if (data=='0'){
                    errdiag('Сохранение', 'профиль обновлён');
                } else{
                    errdiag('Ошибка', data);
                }
            },
            error: function(data){
                console.log(data);
            }
        });
    }
    return false;
});

$('#new_sub').click(function(){
    $('label.sradio').each(function(){
        $(this).slideDown();
    });
    $('#new_sub').hide();
    return false;
});

$('#sub1').click(function(){
    loadSubject(1);
});

$('#sub2').click(function(){
    loadSubject(2);
});

function loadSubject(sub){
    $.ajax({
        url: baseUrl+'repetitor/loadSubject',
        type:'post',
        data: 'subject='+sub,
        success: function(data){
            console.log(data);
            if (data != 'false'){
                var d = JSON.parse(data);
                $('#subject_id option').each(function(){
                    if ($(this).val() == d.subject_id){
                        $(this).attr('selected','selected');
                        $(this).prop( "selected", true );
                    } else{
                        $(this).removeAttr('selected');
                        $(this).prop( "selected", false );
                    }
                });
                $('#lang_id option').each(function(){
                    if ($(this).val() == d.lang_id){
                        $(this).attr('selected','selected');
                    } else{
                        $(this).removeAttr('selected');
                    }
                });
                $('input[name="age_id[]"]').each(function(){
                    var find = false;
                    for(i = 0; i<d.ages.length;i++){
                        if (d.ages[i] == $(this).val()){
                            find = true;
                        }
                    }
                    if (find){
                        $(this).prop( "checked", true );
                    }else{
                        $(this).prop( "checked", false );
                    }
                });
                $('input[name="specialization_id[]"]').each(function(){
                    var find = false;
                    for(i = 0; i<d.spec.length;i++){
                        if (d.spec[i] == $(this).val()){
                            find = true;
                        }
                    }
                    if (find){
                        $(this).prop( "checked", true );
                    }else{
                        $(this).prop( "checked", false );
                    }
                });
                $('input[name="level_id[]"]').each(function(){
                    var find = false;
                    for(i = 0; i<d.levels.length;i++){
                        if (d.levels[i] == $(this).val()){
                            find = true;
                        }
                    }
                    if (find){
                        $(this).prop( "checked", true );
                    }else{
                        $(this).prop( "checked", false );
                    }
                });
                $('#price').val(d.price);
                $('#sprice').val(parseInt(d.price*(1+proc)));
            } else {
                $('#subject_id option').each(function(){
                        $(this).removeAttr('selected');
                });
                $('input[name="age_id[]"]').each(function(){
                            $(this).prop( "checked", false );
                });
                $('input[name="specialization_id[]"]').each(function(){
                            $(this).prop( "checked", false );
                });
                $('input[name="level_id[]"]').each(function(){
                            $(this).prop( "checked", false );
                });
                $('#price').val('');
                $('#sprice').val('');
            }
        },
        error: function(data){
            console.log(data);
        }
    });
}

loadSubject(1);

$('#save_present').click(function(){
    var err = false;
    var about = $('#about').val().trim();
    var link = $('#link').val();
    var mess = '';
    if (about.length<5 || about.length>400){
        mess += 'Текст описания должен быть более пяти и до 400 символов <br>';
        err = true;
    }
    if (link.substr(0,24)!='https://www.youtube.com/' && link!=''){
        mess += 'Ссылка должна быть на youtube <br>';
    }
    if (err){
        errdiag('Предупреждение', mess);
    } else{
        //about = about.replace(/\n/gi, '<br>');
        rUpdate({
            'about' : about,
            'link' : link,
        });
    }
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
		url: baseUrl+'repetitor/addavatar',
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

$('#load1').click(function(){
        $('#add-file1').trigger('click');
	return false;
});

$('#add-file1').on('change',function(){//получена картинка
	var files = this.files;
	var data = new FormData();
    $.each( files, function( key, value ){
        data.append( key, value );
    });
    data.append('pos', 1);
    saveDoc(data, 1);
});

$('#load2').click(function(){
        $('#add-file2').trigger('click');
	return false;
});

$('#add-file2').on('change',function(){//получена картинка
	var files = this.files;
	var data = new FormData();
    $.each( files, function( key, value ){
        data.append( key, value );
    });
    data.append('pos', 2);
    saveDoc(data, 2);
});

function saveDoc(data, pos){
    $('#load_block'+pos).html('<img src="../../img/wait.gif" alt="avarat">');
    $.ajax({
		url: baseUrl+'repetitor/adddoc',
		type: 'POST',
		data: data,
        processData: false,
        contentType: false,
		success: function(rdata){
            errdiag("Сохранение", 'Документ сохранён');
            var img = '<img src="../../images/'+rdata+'" alt="document">';
            $('#load_block'+pos).html(img);
		},
        error: function(xhr, ajaxOptions, thrownError){
            var err = xhr.responseText;
            console.log(err);
        }
	});
}

$('#save_edu').click(function(){
    var university = $('#university').val().trim();
    var specialty = $('#specialty').val().trim();
    var uni_year = $('#uni_year').val();
    var experience = $('#experience').val();
    var degree_id = $('#degree_id').val();
    var exp_comment = $('#exp_comment').val().trim();
    var err = false;
    var mess = '';
    console.log(university.length);
    if (university.length<3 || university.length>256 ){
        err = true;
        mess += 'Некорректное название ВУЗа <br>';
    }
    if (specialty.length<3 || specialty.length>256 ){
        err = true;
        mess += 'Некорректное название специальности <br>';
    }
    if (uni_year == 0){
        err = true;
        mess += 'Нужно выбрать год окончания <br>';
    }
    if (experience == -1){
        err = true;
        mess += 'Нужно выбрать колличесво лет опыта <br>';
    }
    if (degree_id == 0){
        err = true;
        mess += 'Нужно выбрать ученую степень <br>';
    }
    if (exp_comment.length<5 || exp_comment.length>400 ){
        err = true;
        mess += 'Неккоректное описание опыта <br>';
    }
    if (err){
        errdiag('Предупреждение', mess);
    } else{
        rUpdate({
            'university' : university,
            'specialty' : specialty,
            'uni_year' : uni_year,
            'experience' : experience,
            'degree_id' : degree_id,
            'exp_comment' : exp_comment,
        });
    }
    return false;
});

$('#save_pay').click(function(){
    var paypal = $('#paypal').val().trim();
    var yandex = $('#yandex').val().trim();
    var master = $('#master').val().trim();
    if (paypal.length>0){
        rUpdate({
            'paypal' : paypal
        });
    }
    if (yandex.length>0){
        rUpdate({
            'yandex' : yandex
        });
    }
    if (master.length>0){
        rUpdate({
            'master' : master
        });
    }
    if (paypal.length==0 && yandex.length==0 && master.length==0){
        errdiag('Предупреждение', 'введите хотя бы один способ оплаты');
    }
    return false;
});

mask('phone');

$('#save_status').click(function(){
    var del = $('#delete_status').prop('checked');
    var pas = $('#passive_status').prop('checked');
    if (del == true){
        deldiag();
    } else{
        if (pas == true){
            rUpdate({
                'activity' : 0
            });
        } else{
            rUpdate({
                'activity' : 1
            });
        }
    }
    return false;
});

var can_save = false;

var checker = setInterval(function() {
    can_save = true;
    var first_name = $('#first_name').val().trim();
    var last_name = $('#last_name').val().trim();
    var skype = $('#skype').val().trim();
    var email = $('#email').val().trim();
    var password = $('#password').val().trim();
    var password2 = $('#password2').val().trim();
    var about = $('#about').val().trim();
    var subject_id = $('#subject_id').val();
    var lang_id = $('#lang_id').val();
    var price = $('#price').val().trim();
    var yandex = $('#yandex').val().trim();
    var master = $('#master').val().trim();
    var paypal = $('#paypal').val().trim();
    var university = $('#university').val().trim();
    var specialty = $('#specialty').val().trim();
    var uni_year = $('#uni_year').val();
    var experience = $('#experience').val();
    var degree_id = $('#degree_id').val();
    var exp_comment = $('#exp_comment').val().trim();
    can_mess = '';
    //check
    if (first_name.search(/[a-zA-Z_0-9а-яА-Я]{3,16}/i) == -1){
        can_save = false;
        // console.log('first_name error');
        can_mess += 'Некорректное имя репетитора <br>';
    }
    if (last_name.search(/[a-zA-Z_0-9а-яА-Я]{3,16}/i) == -1){
        can_save = false;
        // console.log('last_name error');
        can_mess += 'Некорректная фамилия<br>';
    }
    if (skype.search(/[a-zA-Z_0-9]{2,}/i) == -1){
        can_save = false;
        // console.log('skype error');
        can_mess += 'Некорректный skype<br>';
    }
    if (email.search(/\w+@+\w+\.\w{2,5}/i) == -1){
        can_save = false;
        // console.log('email error');
        can_mess += 'Некорректный  e-mail<br>';
    }
    if (password.search(/\w{3,}/) == -1){
        can_save = false;
        // console.log('password error');
        can_mess += 'Некорректный пароль<br>';
    }
    if (password != password2){
        can_save = false;
        // console.log('password error');
        can_mess += 'Пароли не совпадают<br>';
    }
    if (about.length < 3 || about.length > 400){
        can_save = false;
        // console.log('about error');
        can_mess += 'Некорректное описание репетитора<br>';
    }
    if (subject_id == 0){
        can_save = false;
        // console.log('subject_id error');
        can_mess += 'Не выбран предмет<br>';
    }
    if (lang_id == 0){
        can_save = false;
        // console.log('lang_id error');
        can_mess += 'Не выбран родной язык репетитора<br>';
    }
    if (price.search(/\d{1,5}/i) == -1){
        can_save = false;
        // console.log('price error');
        can_mess += 'Некорректная цена за урок<br>';
    }
    if ( (yandex.length < 3 || yandex.length > 400) && (paypal.length < 3 || paypal.length > 400) && (master.length < 3 || master.length > 400)){
        can_save = false;
        // console.log('pay error');
        can_mess += 'Некорректные платёжные реквизиты <br>';
    }
    if (university.search(/[a-zA-Z_0-9а-яА-Я ]{3,16}/i) == -1){
        can_save = false;
        // console.log('university error');
        can_mess += 'Некорректный ВУЗ <br>';
    }
    if (specialty.search(/[a-zA-Z_0-9а-яА-Я ]{3,16}/i) == -1){
        can_save = false;
        // console.log('specialty error');
        can_mess += 'Некорректная Специальность <br>';
    }
    if (uni_year.search(/\d{1,3}/i) == -1){
        can_save = false;
        // console.log('uni_year error');
        can_mess += 'Год окончания не выбран<br>';
    }
    if (experience.search(/\d{1,3}/i) == -1){
        can_save = false;
        // console.log('experience error');
        can_mess += 'Опыт не выбран<br>';
    }
    if (degree_id.search(/\d{1,3}/i) == -1){
        can_save = false;
        // console.log('degree_id error');
        can_mess += 'Не выбрана ученая степень <br>';
    }
    if (exp_comment.length < 3 || exp_comment.length > 400){
        can_save = false;
        // console.log('exp_comment error');
        can_mess += 'Некорректное описание опыта работы<br>';
    }
    var f = $('#subject_form').serializeArray();
    var sp = false;
    var age = false;
    var level = false;
    for (i = 0; i < f.length; i++){
        if (f[i].name == "specialization_id[]") sp = true;
        if (f[i].name == "age_id[]") age = true;
        if (f[i].name == "level_id[]") level = true;
    }
    if (sp == false || age == false || level == false){
        can_save = false;
        can_mess += 'Не заполнены данные по предмету<br>';
    }
    //end check
    if (can_save){
        $('#send_profile').removeAttr('disabled');
        $('#send_profile').prop('disabled', false);
        clearInterval(checker);
    } else{
        //errdiag('Ошибка', mess);
    }
}, 1000);

$('#send_profile').click(function(){
    if ($('#send_profile').hasClass('off')){
        return false;
    }
    if (can_save){
        rUpdate({
            'status' : 1
        });
        $('#send_profile').text('Профиль находится на рассмотрении');
        $('#send_profile').addClass('off');
        $('#send_profile').addClass('dark');
    } else{
        console.log('NO');
        errdiag('Ошибка', can_mess);
    }
    return false;
});

//clearInterval(checker);

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
