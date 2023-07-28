window.onload = function () {
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '387027218549306',
            status     : true,
            cookie     : true,
            xfbml      : true,
            version    : 'v3.3'
        });
        FB.getLoginStatus(function(response) {
            if(response.status == 'connected'){
                FB.logout(function (e) {
                    window.location = location;
                })
            }else{
                statusChangeCallback(response);
            }
          });
    };
    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        var lang = $('meta[name="language"]').attr('content');
        console.log(lang);
        js.src = "https://connect.facebook.net/"+lang+"/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
}
function statusChangeCallback(response){
    console.log('statusChangeCallback');
    if (response.status === 'connected') {
        console.log('Logged In');
        testAPI();
    } else {
        console.log('Not Logged In');
    }
}
function checkLoginState() {
    FB.getLoginStatus(function(response) {

        statusChangeCallback(response);
    });
};
function testAPI(){
    FB.api('/me?fields=id,first_name,last_name,email,birthday,gender', function(response){
        if(response && !response.error){
        	let birth = '1980-01-01';
        	let email = response.first_name+'@w34marketing.com';
        	let gender = 1;
        	
    		if (typeof response.email != 'undefined')
    		{
    			email = response.email;
    		}
        	
    		if (typeof response.gender != 'undefined')
    		{
    			gender = (response.gender == "male") ? 1 : 2;
    		}
        	
    		if (typeof response.email != 'undefined')
    		{
    			let birthday = response.birthday.split("/");
            	birth = [birthday[2], birthday[0], birthday[1]].join("-");
    		}
        
            
            window.dataForm = {
                'name': response.first_name,
                'surname' : response.last_name,
                'email': email,
                'gender' : gender,
                'birthdate' : birth,
            };
            
            registerCliente();
        }
    });
}