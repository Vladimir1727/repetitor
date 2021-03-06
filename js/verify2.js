function verify(arr){//функция проверки формы
	var f=true;
	var pass_err=false;
	var pass='';
	for (var i = arr.length - 1; i >= 0; i--){
		test=$("#"+arr[i][0]);
		if (test.val().length>0) test.val(test.val().trim());
		var reg=0;
		if (arr[i][1]=='login') reg=test.val().search(/[a-zA-Z_0-9]{2,}/);
		if (arr[i][1]=='name') reg=test.val().search(/[a-zA-Z_0-9а-яА-Я єіїЄІЇ]{3,16}/);
		if (arr[i][1]=='text') reg=test.val().search(/.{5,}/);
		if (arr[i][1]=='tel') reg=test.val().search(/\+38 \([0-9]{3}\) [0-9]{3}-[0-9]{2}-[0-9]{2}/);
		if (arr[i][1]=='num') reg=test.val().search(/\d{1,}/);
		if (arr[i][1]=='email') reg=test.val().search(/\w+@+\w+\.\w{2,5}/i);
        if (arr[i][1]=='date') reg=test.val().search(/^\d{4}-\d{2}-\d{2}$/i);
        if (arr[i][1]=='float') reg=test.val().search(/^\d{2}\.\d{1,}$/i);
		if (arr[i][1]=='pass'){
			reg=test.val().search(/\w{3,}/);
			if (pass=='') pass=test.val();
				else{
					if (pass!=test.val()){
						pass_err=true;
					}
				}
			}
		if (arr[i][1]=='email') reg=test.val().search(/\w{3,}/);
		if (test.val().length<1 || test.val()=="0" || reg==-1 || pass_err==true){
			test.css({"border":"1px red solid"})
			f=false;
		}
		else test.css({"border":"1px #ccc solid"});
	}
if (f==true) return true; else return false;
}

function errdiag(mtype, message){
	$( "#dialog" ).remove();
	$('body').append('<div id="dialog" title="'+mtype+'"><p>'+message+'</p></div>');
	$( "#dialog" ).dialog({
		  autoOpen: true,
		  show: {
			effect: "fade",
			duration: 500
		  },
		  hide: {
			  effect: "fade",
			  duration: 500
		  }
		});
}

function verify2(arr){
	var f=true;
	var pass_err=false;
	var pass='';
	for (var i = arr.length - 1; i >= 0; i--){
		test = arr[i][0].trim();
		if (test.length==0) return false;
		var reg=0;
		if (arr[i][1]=='login') reg=test.search(/[a-zA-Z_0-9]{2,}/);
		if (arr[i][1]=='name') reg=test.search(/[a-zA-Z_0-9а-яА-Я єіїЄІЇ]{3,16}/);
		if (arr[i][1]=='text') reg=test.search(/.{5,}/);
		if (arr[i][1]=='tel') reg=test.search(/\+38 \([0-9]{3}\) [0-9]{3}-[0-9]{2}-[0-9]{2}/);
		if (arr[i][1]=='num') reg=test.search(/\d{1,}/);
		if (arr[i][1]=='email') reg=test.search(/\w+@+\w+\.\w{2,5}/i);
        if (arr[i][1]=='date') reg=test.search(/^\d{4}-\d{2}-\d{2}$/i);
        if (arr[i][1]=='float') reg=test.search(/^\d{2}\.\d{1,}$/i);
		if (arr[i][1]=='pass'){
			reg = test.search(/\w{4,}/);
			if (pass == '') pass = test;
				else{
					if (pass != test){
						pass_err=true;
					}
				}
			}
		if (test.length<1 || test == "0" || reg==-1 || pass_err==true){
			errdiag("Предупреждение", "Некорректные данные");
			f=false;
		}
	}
return f;
}

function mask(id){
    var inp=document.getElementById(id);
    var old="+(";
    var exs = {
        '0': '',
        '1': '\\+',
        '2': '\\+\\(',
        '3': '\\+\\(\\d{1}',
        '4': '\\+\\(\\d{2}',
        '5': '\\+\\(\\d{3}',
        '6': '\\+\\(\\d{3}\\)',
        '7': '\\+\\(\\d{3}\\) ',
        '8': '\\+\\(\\d{3}\\) \\d{1}',
        '9': '\\+\\(\\d{3}\\) \\d{2}',
        '10': '\\+\\(\\d{3}\\) \\d{3}',
        '11': '\\+\\(\\d{3}\\) \\d{4}',
        '12': '\\+\\(\\d{3}\\) \\d{5}',
        '13': '\\+\\(\\d{3}\\) \\d{6}',
        '14': '\\+\\(\\d{3}\\) \\d{7}',
		'15': '\\+\\(\\d{3}\\) \\d{8}',
		'16': '\\+\\(\\d{3}\\) \\d{9}',
		'17': '\\+\\(\\d{3}\\) \\d{10}',
		'18': '\\+\\(\\d{3}\\) \\d{11}',
		'19': '\\+\\(\\d{3}\\) \\d{12}',
		'20': '\\+\\(\\d{3}\\) \\d{13}',
    };
    inp.onfocus = function(){
        if (inp.value==''){
            inp.value = old;
        }
    }
	inp.onkeyup = function(event){
        if (inp.value.search(exs[inp.value.length])==-1){
			inp.value=old;
        }
        if (event.keyCode!=8){
            if (inp.value.length<3){
                inp.value="+(";
            }
            if (inp.value.length==5){
                inp.value+=") ";
            }
            if (inp.value.length>20){
                inp.value=old;
            }
        }
        old = inp.value;
    }
}
