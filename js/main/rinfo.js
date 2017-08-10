(function($){$(function(){

console.log('5');

$('.switch').each(function(){
	$(this).parent().next('div').hide();
	$(this).click(function(){
		if ($(this).hasClass('switch-down')){
			$(this).removeClass('switch-down');
			$(this).addClass('switch-up');
			$(this).parent().next('div').slideDown();
		} else{
			$(this).removeClass('switch-up');
			$(this).addClass('switch-down');
			$(this).parent().next('div').slideUp();
		}
	})
});

})})(jQuery)
