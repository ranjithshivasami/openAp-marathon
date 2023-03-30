var UserEmailSettings = function(){

    function init(){
        initSelect2();
        
    }

   function initSelect2(){
   
        $("#mail-server").select2({placeholder: "Select a mail server",tags: true});
        $("#protocol").select2();
        $("#port").select2();
    }
    return {
        init
    }
}(jQuery);
$(document).ready(function(){
    UserEmailSettings.init();
});