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
    var getter_val = $("#PG_"+PG_name()+"_getter").val();
    return getter_val;
  },
  
  basepath: function()
  {
    var basepath_val = $("#PG_"+PG_name()+"_basepath").val();
    return basepath_val;
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
      dataType: "json",
      data: data,
      success: function(data){
        var p_count = $("ul.PG_"+PG_name()+"_contentnews li").length;

        $("div#PG_"+PG_name()+"_ajaxloader").remove();
        $("ul.PG_"+PG_name()+"_contentnews").show();
        
        for(counter=1;counter<=p_count;counter++)
        {
          var json_counter = counter - 1;
          var new_title     = "<p class='PG_"+PG_name()+"_title'>"+data[json_counter]+"</p>";
          $("ul.PG_"+PG_name()+"_contentnews li:nth-child("+counter+") div.PG_"+PG_name()+"_content p.PG_"+PG_name()+"_title").replaceWith(new_title);
        }
      }
    });
    

    
    // Image loader
    var loader  = "<div id='PG_Yelp_ajaxloader'>";
        loader += "<img src='"+defaults.basepath()+"/images/ajax-loader_yelp.gif'>";
        loader += "</div>";
        
    $("ul.PG_"+PG_name()+"_contentnews").hide();
    $("div#PG_"+PG_name()+"_ajaxloader").remove();
    $("div.PG_"+PG_name()+"_content_wrap").append(loader);
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


















