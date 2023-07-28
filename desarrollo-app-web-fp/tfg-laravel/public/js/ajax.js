function ajaxJson(url, data,success,error){

    var xmlHttp, formData;

    data._token = dataView.token;

    if (url) {

        xmlHttp = new XMLHttpRequest();
        formData = new FormData();

        Object.keys(data).forEach(function(key){
            formData.append(key, data[key]);
        });
        var data = [];
        for(var pair of formData.entries()) {
            data.push(`{${pair[0]}: ${pair[1]}, type: ${typeof pair[1]}}`);
        }
        console.log({user: data});
        
        xmlHttp.open('POST', url, true);
        xmlHttp.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        xmlHttp.onload = function(){
            var response, typeError;
            response = this.responseText;
            typeError = '';
            if(this.readyState === 4 && this.status === 200){
                if(success && success.constructor == Function){
                    console.log(response);
                    response = JSON.parse(response);
                    success(response);
                }
            } else {
                if(error && error.constructor == Function){
                    error(typeError);
                }
            }
        }, false;
        xmlHttp.send(formData);
    }
}