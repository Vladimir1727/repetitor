(function($){$(function(){
var baseUrl = '../';
console.log('repetitor profile 1');
var proc = 0.3;
/*$('#slide').click(function(){
    $('#slide ul').slideToggle();
});*/

$('#rep-online').click(function(){
    var s = $('#rep-online');
    if (s.hasClass('on')){
        s.removeClass('on');
        s.addClass('off');
    } else {
        s.removeClass('off');
        s.addClass('on');
    }
});

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
    var ver = verify([
        ['first_name', 'name'],
        ['last_name', 'name'],
        ['email', 'email'],
        ['password', 'pass'],
        ['password2', 'pass'],
        ['skype', 'name']
    ]);
    if (ver){
        rUpdate({
            'first_name' : $('#first_name').val().trim(),
            'last_name' : $('#last_name').val().trim(),
            'father_name' : $('#father_name').val().trim(),
            'phone': $('#phone').val().trim(),
            'tzone_id' : $('#tzone_id').val(),
            'skype' : $('#skype').val().trim(),
            'email' : $('#email').val().trim(),
            'password' : $('#password').val().trim(),
        });
    }
    return false;
});

$('#price').on('keyup',function(){
    var v = parseInt($('#price').val());
    if (v > 0){

        $('#sprice').val(parseInt(v*(1+proc)));
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
            if (data != 'false'){
                var d = JSON.parse(data);
                $('#subject_id option').each(function(){
                    if ($(this).val() == d.subject_id){
                        $(this).attr('selected','selected');
                    } else{
                        $(this).removeAttr('selected');
                    }
                });
                $('#lang_id option').each(function(){
                    if ($(this).val() == d.lang_id){
                        $(this).attr('selected','selected');
                    } else{
                        $(this).removeAttr('selected');
                    }
                });
                //d.ages[i]
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
                $('#lang_id option').each(function(){
                        $(this).removeAttr('selected');
                });
                $('input[name="age_id[]"]').each(function(){
                            $(this).removeAttr('checked');
                });
                $('input[name="specialization_id[]"]').each(function(){
                            $(this).removeAttr('checked');
                });
                $('input[name="level_id[]"]').each(function(){
                            $(this).removeAttr('checked');
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
    if (link.substr(0,24)!='https://www.youtube.com/'){
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
    if (university.lenght<3 || university.lenght>256 ){
        err = true;
        mess = 'Некорректное название ВУЗа <br>';
    }
    if (specialty.lenght<3 || specialty.lenght>256 ){
        err = true;
        mess = 'Некорректное название специальности <br>';
    }
    if (uni_year == 0){
        err = true;
        mess = 'Нужно выбрать год окончания <br>';
    }
    if (experience == -1){
        err = true;
        mess = 'Нужно выбрать колличесво лет опыта <br>';
    }
    if (degree_id == 0){
        err = true;
        mess = 'Нужно выбрать ученую степень <br>';
    }
    if (exp_comment.lenght<5 || exp_comment.lenght>256 ){
        err = true;
        mess = 'Некорректный комментарий <br>';
    }
    if (err){
        errdiag('Предупреждение', err);
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
    if (paypal.length>0){
        rUpdate({
            'paypal' : paypal
        });
    }
    if (paypal.length>0){
        rUpdate({
            'yandex' : yandex
        });
    }
    if (paypal.length>0 && yandex.length>0){
        rUpdate({
            'yandex' : yandex,
            'paypal' : paypal
        });
    } else if (paypal.length>0) {
        rUpdate({
            'paypal' : paypal
        });
    } else if (yandex.length>0) {
        rUpdate({
            'yandex' : yandex
        });
    } else{
        errdiag('Предупреждение', 'введите хотя бы один способ оплаты');
    }
    return false;
});

})})(jQuery)
