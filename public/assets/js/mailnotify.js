var UserEmailSettings = function(){

    function init(){
        initmailnotify();
       
    }
    function initmailnotify(){
        $('#getMailInfo').on('click', function(){
            $.ajax({
              url: '/getMailInfo',
              method: 'GET',
              success: function(response){
                console.log(response);
                $("#mailcontent tbody").empty(); // clear existing data

                var sentimentValues = response;
                var sentimentValuesHtml = '';
                if (sentimentValues.length === 0) {
                  var row = $("<tr><td colspan='2'>No data available</td></tr>");
                  $("#mailcontent").append(row);
                } else {
                  $.each(sentimentValues, function(index, item) {
                    var email =item.from;

                    var emailParts = email.split("<");
                    var name = emailParts[0].trim();
                    var address = emailParts[1].replace(">", "").trim();
                    var emailLink = "<span title='" + email + "'>" + name + " &lt;" + address + "&gt;</span>";
                    var row = $("<tr><td>" + emailLink + "</td><td>" + item.sentiment + "</td></tr>");
                    $("#mailcontent").append(row);
                  });
                }
              },
              error: function(error) {
              console.log(error);
              }
                          });
          });
    }
    
    return {
        init
    }
}(jQuery);
$(document).ready(function(){
    UserEmailSettings.init();

});