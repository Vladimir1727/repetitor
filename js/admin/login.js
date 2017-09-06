(function($){$(function(){
console.log('admin login 3');
var baseUrl = '';
$('#logform').submit(function(){
    var ver = verify2([
        $('#pass').val().trim()
    ]);
    if (ver == true){
        var form = $(this).serialize();
        $.ajax({
            url: baseUrl+'admin/trylogin',
            type:'post',
            data: 'pass='+$('#pass').val().trim(),
            success: function(data){
                console.log('data=', data);
                if (data == '0'){
                    console.log('login');
                    document.location = '/index.php/admin/main';
                } else{
                    errdiag('Ошибка', data);
                }
            },
        });

    }
    return false;
});

})})(jQuery)
