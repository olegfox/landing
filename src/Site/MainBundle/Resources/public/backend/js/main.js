/**
 * Created by root on 04.02.16.
 */
$(function(){
   $('#submitBack').click(function(){
       $(this).parent().append('<input type="hidden" name="back" value="true">');
   });
});