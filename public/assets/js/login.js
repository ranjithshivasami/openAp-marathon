var UserloginSettings = function(){

    function init(){
        initvalidation();
       
    }

    function initvalidation(){
        $('#login-form').validate({
            rules: {
                'email':{
                    required: true
                },
                'password': {
                    required: true
                }
                 
                // other validation rules for your form fields
            },
            messages : {
                email: {
                    required: "Email/Username is required"
                },
                password: {
                    required: "Password is required"
                }
            }
        });
    }
    return {
        init
    }
}(jQuery);
$(document).ready(function(){
    UserloginSettings.init();

});