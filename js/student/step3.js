(function($){$(function(){
console.log('step 3 1');
var baseUrl = '../';
var min_sum = $('#min_sum').val();

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

$('#pay').click(function(){
	var sum = parseInt($('#sum').val());
	if (!sum){
		sum = 0;
	}
	if (sum < min_sum){
		errdiag('Предупреждение', 'Вносимая сумма должна быть не менее '+min_sum+' $');
		return false;
	}
});

$('#sum').on('keyup', function(event){
	var sum = parseInt($('#sum').val());
	if (!sum){
		sum = 0;
	}
	console.log(sum);
	$('#sum').val(sum);
});

})})(jQuery)
