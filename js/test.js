(function($){$(function(){
console.log('test page 1');
var baseUrl = '../';
var form = 'name=333&time=3';
$.ajax({
    url: baseUrl+'test/ajaxtest',
    type:'post',
    data: form,
    success: function(data){
        console.log('data=', data);
        if (data=='0'){
            console.log('login');
        } else{
            errdiag('Ошибка', data);
        }
    },
});

})})(jQuery)
