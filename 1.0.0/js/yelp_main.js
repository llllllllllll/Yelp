// Functions
var PG_name = (function(){  // Plugin name
    return function()
    {
      var pg_name = $("#PG_PG_NAME").text();
      return pg_name;
    }
})();

var defaults = { // Default values
  getter: function()
  {
    var getter_val = $("#PG_Yelp_getter").val();
    return getter_val;
  }
}

var Serverside = { // Deals with server side applications
  
  curl: function(link)
  {
    var getter  = defaults.getter();
    var data    = "url="+link;
    
    $.ajax({
      type: "POST",
      url: getter,
      data: data,
      success: function(data){
        alert(data);
      }
    });
  }
  
}

jQuery(document).ready(function($){
  
  // Front ---------------------------------------------------------------------
  
  // Tab
  $("ul.PG_Yelp_nav li a").click(function(){
    // Selected tab animation
    var style = $(this).attr("class");

    $("ul.PG_Yelp_nav li a").removeClass("on off");
    $("ul.PG_Yelp_nav li a").addClass("off");
    $(this).removeClass("off");
    $(this).addClass("on");
    
    // Fetch datas
    var link        = $(this).attr("href");
    Serverside.curl(link);
    
    // Prevent page from refreshing
    return false; 
  });
  
});


















