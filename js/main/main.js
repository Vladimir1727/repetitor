(function($){$(function(){

console.log('start main');
$('#main-but').click(function(){
    var list = $('#menu-list');
    if (list.hasClass('off')){
        console.log('open');
        list.slideDown(700);
        list.removeClass('off');
        list.addClass('on');
    } else {
        console.log('close');
        list.slideUp(700);
        list.removeClass('on');
        list.addClass('off');
    }
});

})})(jQuery)
