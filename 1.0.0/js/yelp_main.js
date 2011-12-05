// Functions
var PG_name = (function(){  // Plugin name
    return function()
    {
      var pg_name = $("#PG_PG_NAME").val();
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
  },
  
  records_exist: function()
  {
    var records_exist = $("#PG_"+PG_name()+"_records_exist").val();
    return records_exist;
    //.css("disabled", "disabled");
  }
}

var Serverside = { // Deals with server side applications
  
  curl: function(link) // Curl function
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
          // Title
          var new_title       = "<p class='PG_"+PG_name()+"_title'>"+data["titles"][json_counter]+"</p>";
          var title_selector  = "ul.PG_"+PG_name()+"_contentnews li:nth-child("+counter+") div.PG_"+
                                PG_name()+"_content p.PG_"+
                                PG_name()+"_title";
          $(title_selector).replaceWith(new_title);
          
          // Reviews
          var new_review      = "<div class='PG_"+PG_name()+"_rating'>"+data["reviews"][json_counter]+"</div>";
          var review_selector = "ul.PG_"+PG_name()+
                                "_contentnews li:nth-child("+counter+") div.PG_"+PG_name()+
                                "_content div.PG_"+PG_name()+"_rating";
          $(review_selector).replaceWith(new_review);
          
          // Business description
          var new_busDesc      = data["bus_desc"][json_counter];
          var busDesc_selector = "ul.PG_"+PG_name()+"_contentnews li:nth-child("+counter+") div.PG_"+
                                PG_name()+"_content ol";
          $(busDesc_selector+" li").remove();
          $(busDesc_selector).html(new_busDesc); 
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
  
  // Front ------------------------
  
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
  
  
  // Setup-------------------------
  // Initial
  // Check if there's an existing records
  // in the database
  if(defaults.records_exist() == "false")
  {
    // If there's non, disable some functionality settings

    // Default Categories
    $("#PG_"+PG_name()+"_def_general").attr("disabled", true);
    $("#PG_"+PG_name()+"_def_specific").attr("disabled", true);
    // Empty Category list
    $("#show_html_value").empty();
    // Disable Show Rows
    $("#PG_"+PG_name()+"_rows").attr("disabled", true);
    // Disable template option
    $("#PG_"+PG_name()+"_template_blue").attr("disabled", true);
    $("#PG_"+PG_name()+"_template_gray").attr("disabled", true);
  }
  
  
  $("#PG_"+PG_name()+"_save").click(function(){
    // Save message
    $("#PG_"+PG_name()+"_successMsg").showMessage({
        type : "success",
        resize : "#PG_"+PG_name()+"_Setup_mainContainer",
        message : {
          success : "Saved Successfully"
        }
    });
    
    // Prevent page from refreshing
    return false;
  });
  
});





