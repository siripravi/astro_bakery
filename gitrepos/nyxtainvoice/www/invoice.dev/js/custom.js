jQuery().ready(function(){ 
jQuery(".jtable th").each(function(){
 
 jQuery(this).addClass("ui-state-default");
 
  });
jQuery(".jtable td").each(function(){
 
 jQuery(this).addClass("ui-widget-content");
 
  });
jQuery(".jtable tr").hover(
     function()
     {
     jQuery(this).children("td").addClass("ui-state-hover");
     },
     function()
     {
     jQuery(this).children("td").removeClass("ui-state-hover");
     }
    );
jQuery(".jtable tr").click(function(){
   
  jQuery(this).children("td").toggleClass("ui-state-highlight");
  });
 
}); 