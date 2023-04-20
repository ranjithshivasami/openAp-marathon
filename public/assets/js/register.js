var UserRegisterSettings = function(){

    function init(){
        initvalidation();
       
    }

    function initvalidation(){
        $('#register-form').validate({
            rules: {
                'name': {
                    required: true
                },
                'email':{
                    required: true
                },
                'password': {
                    required: true
                },
                'password_confirmation': {
                    required: true
                }

                 
                // other validation rules for your form fields
            },
            messages : {
                name: {
                    required: "Username is required"
                },
                email: {
                    required: "Email Id is required"
                },
                password: {
                    required: "Password is required"
                },
                password_confirmation: {
                    required: "Confirm Password is required"
                }  
            }
        });
    }
    return {
        init
    }
}(jQuery);
$(document).ready(function(){
    UserRegisterSettings.init();

});