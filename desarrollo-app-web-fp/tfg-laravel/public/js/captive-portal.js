addEventOnLoad(function(){
    $('.ui.checkbox').checkbox();
    $('.ui.dropdown').dropdown();
    $('#formClient').form({
        inline: true,
        fields: {
            name: {
                identifier: 'name',
            },
            surname: {
                identifier: 'surname',
            },
            email: {
                identifier: 'email',
            },
            gender: {
                identifier: 'gender',
            },
            birthdate: {
                identifier: 'birthdate',
            },
            acceptConditionsMinor: {
                identifier: 'acceptConditionsMinor',
            },
            acceptConditions: {
                identifier: 'acceptConditions',
            },
        },
        onSuccess : function(){
                console.log('---');
	    		$('input[type="text"]').removeClass('error');
	    		$('label').removeClass('error');
	        		
        		
	    		if ($("#clientName").val() == "")
	    		{
    				$("#clientName").addClass('error');
	    			alert(window.dataView.form.validations.name.empty);
	    			return false;
	    		}
	    		else if ($("#clientName").val().length < 2)
	    		{
    				$("#clientName").addClass('error');
	    			alert(window.dataView.form.validations.name.minLength);
	    			return false;
	    		}
	    		else if ($("#clientName").val().length > 30)
	    		{
    				$("#clientName").addClass('error');
	    			alert(window.dataView.form.validations.name.maxLength);
	    			return false;
	    		}
	    		

	    		if ($("#clientSurnames").val() == "")
	    		{
    				$("#clientSurnames").addClass('error');
	    			alert(window.dataView.form.validations.surname.empty);
	    			return false;
	    		}
	    		else if ($("#clientSurnames").val().length < 2)
	    		{
    				$("#clientSurnames").addClass('error');
	    			alert(window.dataView.form.validations.surname.minLength);
	    			return false;
	    		}
	    		else if ($("#clientSurnames").val().length > 30)
	    		{
    				$("#clientSurnames").addClass('error');
	    			alert(window.dataView.form.validations.surname.maxLength);
	    			return false;
	    		}
	    		
	    		if ($("#clientEmail").val() == "")
    			{
    				$("#clientEmail").addClass('error');
	    			alert(window.dataView.form.validations.email.empty);
	    			return false;
    			}
	    		else if (!validateEmail($("#clientEmail").val()))
	    		{
    				$("#clientEmail").addClass('error');
	    			alert(window.dataView.form.validations.email.email);
	    			return false;
	    		}
	    		
	    		if ($("#clientBirthdate").val() == "")
	    		{
    				$("#clientBirthdate1").addClass('error');
	    			alert(window.dataView.form.validations.birthdate.empty);
	    			return false;
	    		}
	    		else
	    		{
	    			if (new Date($("#clientBirthdate").val()) == 'Invalid Date')
	    			{
	    				$("#clientBirthdate1").addClass('error');
	    				alert(window.dataView.form.validations.birthdate.format);
		    			return false;
	    			}
	    		}
	    		
	    		if (parseInt($("#clientGender").val()) != 1 && parseInt($("#clientGender").val()) != 2)
    			{
	    			alert(window.dataView.form.validations.gender.empty);
	    			return false;
    			}
	    		
	    		var v_date = new Date($("#clientBirthdate").val());
	    		if ((new Date().getFullYear() - v_date.getFullYear() < 18) && (!$("#acceptConditionsMinor").is(":checked")))
	    		{
	    			$("label[for='acceptConditionsMinor']").addClass('error');
	    			alert(window.dataView.form.validations.acceptConditionsMinor.checked);
	    			return false;
	    		}
	    		
            window.dataForm = {
                    'name': $("#clientName").val()!="" ? $("#clientName").val() : window.dataForm.name,
                    'surname' : $("#clientSurnames").val()!="" ? $("#clientSurnames").val() : window.dataForm.surname,
                    'email': $("#clientEmail").val()!="" ? $("#clientEmail").val() : window.dataForm.email,
                    'gender' : $("#clientGender").val()!="" ? parseInt($("#clientGender").val()) : window.dataForm.gender,
                    'birthdate' : $("#clientBirthdate").val()!="" ? $("#clientBirthdate").val() : window.dataForm.birthdate,
                    'acceptConditions' : $("#acceptConditions").is(":checked") ? "on" : "off",
                    //'acceptConditionsMinor' : 'false'
            };
            console.log(window.dataForm);
            
            registerCliente();
            return true;
        },
    });
    function validateEmail() {
        if ($("#clientEmail").val() == "")
        {
            $("#clientEmail").addClass('error');
            alert(window.dataView.form.validations.email.empty);
            return false;
        }
        else if (!validateFieldEmail($("#clientEmail").val()))
        {
            $("#clientEmail").addClass('error');
            alert(window.dataView.form.validations.email.email);
            return false;
        }
        
        return true;
    }
    function validateFieldEmail(email) {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }
    
    $('.ui.calendarDate').calendar({
        monthFirst: false,
        ampm: false,
        type: 'date',
        today: false,
        firstDayOfWeek: 1,
        //text: dataView.calendar,
        initialDate: new Date(),
        formatter: {
            date: function (date, settings) {
                if (!date) return '';
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();
                if (new Date().getFullYear() - year >= 18){$('#checkboxCoditionsMinor').hide()}
                else{$('#checkboxCoditionsMinor').show()}; 
                return year + '-' + month + '-' + day;
            }
        }
    });
    $('#conditions').click(function () { 
        toggleModal('modalConditions');
    });
    $('.inhotel , #acceptConditions').change(function (e) {
        if($("input[name='inhotel']:checked").val() == '0'){
            $('#numRoomdiv').show();
        }
        else if($("input[name='inhotel']:checked").val() == '1'){
            $('#numRoomdiv').hide();
            $('#numRoom').val('');
        }
        if($("input[name='inhotel']").is(":checked") && $('#acceptConditions').is(":checked")){
            if($("input[name='inhotel']:checked").val() == '0'){
                $('#numRoom').blur(function () {
                    console.log($('#numRoom').val());
                    if(!$('#numRoom').val()){
                        $('#numRoom').addClass('error');
                        alert('Rellena este campo');
                    }
                    else{
                        $('#selectLogin').slideDown(500);
                        $("html, body").delay(200).animate({scrollTop: $('#selectLogin').offset().top }, 2000);
                    }
                })
            }else{
                $('#selectLogin').slideDown(500);
                $("html, body").delay(200).animate({scrollTop: $('#selectLogin').offset().top }, 2000);
            }
        }
    });
    $('#loginbyform').click(function (e) { 
        e.preventDefault();
        $('#formClient').slideToggle(500);
        $("html, body").animate({scrollTop: $('#formClient').offset().top }, 1000);
    });
});

function registerCliente(){

    toggleModal('modalValidatingData'); 

    success = (function(response){
        var params;
        console.log(response);
        params = {
            'username': response.parameters.username,
            'password': response.parameters.password,
            'mac': response.parameters.mac,
            'ip': response.parameters.ip,
            'link-login': response.parameters.link_login,
            'link-orig': response.parameters.link_orig,
            'error': response.parameters.error,
            'chap-id': response.parameters.chap_id,
            'chap-challenge': response.parameters.chap_challenge,
            'link-login-only': response.parameters.link_login_only,
            'link-orig-esc': response.parameters.link_orig_esc,
            'mac-esc': response.parameters.mac_esc,
            'popup': response.parameters.popup,
            'login': response.parameters.login,
            'demo': response.parameters.demo,
        };
        console.log(parameters);
        setTimeout(function(){
            window.location.href = dataView.routes.captive_portal + '/' + dataView.data.parameters.guid + '/success';
        }, 2000);
    });


    ajaxJson(dataView.routes.register_clientele, window.dataForm, success);

}