(function($){$(function(){
var baseUrl = '../';
console.log('student profile 1');


$('#student-online').click(function(){
    var s = $('#student-online');
    if (s.hasClass('on')){
        s.removeClass('on');
        s.addClass('off');
    } else {
        s.removeClass('off');
        s.addClass('on');
    }
});


})})(jQuery)
