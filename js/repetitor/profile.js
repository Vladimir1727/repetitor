(function($){$(function(){
var baseUrl = '../';
console.log('repetitor profile 16');

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
        console.log('all OK');
    }
    return false;
});

})})(jQuery)
