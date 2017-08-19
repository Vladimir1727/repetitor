(function($){$(function(){
var baseUrl = '../';
console.log('repetitor profile 11');

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
                console.log('update OK');
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

})})(jQuery)
