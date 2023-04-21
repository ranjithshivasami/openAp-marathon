var UserEmailSettings = function(){

    function init(){
        initSelect2();
        initvalidation();
       
    }

   function initSelect2(){
   
        $("#mail-server").select2({placeholder: "Select a mail server",tags: true});
        $("#protocol").select2();
        $("#port").select2();
        $('input.timepicker').timepicker({    timeFormat: 'HH:mm:ss',
   });

    }
    function initvalidation(){
        $('#email-settings-form').validate({
            rules: {
                'primary_email': {
                    required: true
                },
                'password': {
                    required: true
                },
                'confirm_password': {
                    required: true
                },
                'start_time': {
                    required: true
                },
                'end_time': {
                    required: true
                },
                'secondary_email': {
                    required: true
                }
                 
                // other validation rules for your form fields
            },
            messages : {
                primary_email: {
                    required: "Primary Email is required"
                },
                password: {
                    required: "Password is required"
                },
                confirm_password: {
                    required: "Confirm Password is required"
                },
                start_time: {
                    required: "Start Time is required"
                },
                end_time: {
                    required: "End Time is required"
                },
                secondary_email: {
                    required: "Secondary Email is required"
                }
            }
        });
    }
    return {
        init
    }
}(jQuery);
$(document).ready(function(){
    UserEmailSettings.init();

});