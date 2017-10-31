(function($){$(function(){
console.log('step 3 1');
var baseUrl = '../';
var min_sum = $('#min_sum').val();

function get_check(id){//проверка ckeckbox элементов
	var c = $('#'+id);
	if (c.prop('checked')){
		return 1;
	} else {
		return 0;
	}
}

function save_pay(next_form, form_ex){
	$.ajax({
		url: baseUrl+'student/saveExercises',
		type:'post',
		data: $('#pay_form').serialize(),
		success: function(ex_id){
				$(form_ex).val(ex_id);
				$('#main_ex').val(ex_id);
				$(next_form).trigger('submit');
		}
	});
}

$('#pay').click(function(){
	var sum = parseInt($('#sum').val());
	if (!sum){
		sum = 0;
	}
	if (sum < min_sum){
		errdiag('Предупреждение', 'Вносимая сумма должна быть не менее '+min_sum+' $');
		return false;
	} else{
		if (get_check('paypal')){
			$('#paypalAmmount').val(sum);
			save_pay('#paypal_form','#paypal_ex_id');
			return false;
		} else{
			if (get_check('card')){
				$('#paypal_form').append('<input type="hidden" name="landing_page" value="billing">');
				$('#paypalAmmount').val(sum);
				save_pay('#paypal_form','#paypal_ex_id');
			} else{
				//YANDEX
				sum = Math.round(sum *59);
				$.ajax({
					url: baseUrl+'student/saveExercises',
					type:'post',
					data: $('#pay_form').serialize(),
					success: function(ex_id){
						var yan = '<iframe src="https://money.yandex.ru/quickpay/shop-widget?writer=seller&label='+ex_id+'&targets=%D0%97%D0%B0%20%D1%83%D1%81%D0%BB%D1%83%D0%B3%D0%B8%20%D1%80%D0%B5%D0%BF%D0%B5%D1%82%D0%B8%D1%82%D0%BE%D1%80%D0%B0&targets-hint=&default-sum='+sum+'&button-text=11&payment-type-choice=on&mobile-payment-type-choice=on&hint=&successURL=https://tutor.reallanguage.club/index.php/student/getYandex&quickpay=shop&account=410011776472684" width="450" height="225" frameborder="0" allowtransparency="true" scrolling="no"></iframe>';
						$('#main').html(yan);
					}
				});
			}
			//$('#yandex_sum').val(sum*59); //активировать позже
			return false;
		}
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
