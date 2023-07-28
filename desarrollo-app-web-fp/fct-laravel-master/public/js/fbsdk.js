window.onload = function () {  
    window.fbAsyncInit = function() {
    FB.init({
        appId      : '387027218549306',
        xfbml      : true,
        version    : 'v3.2'
    });
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
  };
  (function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
}
function statusChangeCallback(response){
    console.log('statusChangeCallback');
    console.log(response);
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
  }
function testAPI(){
    FB.api('/me?fields=id,first_name,last_name,email,birthday,picture{url}', function(response){
        if(response && !response.error){
            const user = {
                id: response.id,
                email: response.email,
                firstname: response.first_name,
                lastname: response.last_name,
                birth: response.birthday,
                photo: response.picture.data.url
            }
            console.log("testAPI", user);
            checkUser(JSON.stringify(user));
        }
    });
}
const checkUser = (user) =>{
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "POST",
        url: "https://umamidev.p.w34marketing.com/fblogin",
        data: user,
        dataType: "json",
        success: function (response) {
            console.log("Check user:", response);
        },
        error: function (response) { 
            console.log("Check user:", response);
        }
    });
}