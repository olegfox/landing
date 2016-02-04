/**
 * Created by root on 04.02.16.
 */
$(function(){
   if($('#submitBack').length > 0) {
       $('#submitBack').click(function(){
           alert("fdgfg");
           $(this).parent().append('<input type="hidden" name="back" value="true">');
       });
   }
});