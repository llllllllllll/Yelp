// Functions
// Plugin name
var PG_name = (function(){  
    this.name = function()
    {
      var pg_name = $("#PG_PG_NAME").text();
      return pg_name;  
    }
})();


jQuery(document).ready(function($){
  
  // Selected tab animation
  $("ul.PG_Yelp_nav li a").click(function(){
    var style = $(this).attr("class");

    $("ul.PG_Yelp_nav li a").removeClass("on off");
    $("ul.PG_Yelp_nav li a").addClass("off");
    $(this).removeClass("off");
    $(this).addClass("on");
  });
  
});


















