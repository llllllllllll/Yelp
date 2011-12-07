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
  }
}

var constructor = {
  initial_display: function()
  {
    var getter  = defaults.getter();
    var link    = $("ul.PG_"+PG_name()+"_nav li a.on ").attr("href");
    var data    = "link="+link+"&init_display=1";
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

var Serverside = { // Deals with server side applications
  
  save: function(api_keys) // Save 
  {
    if(defaults.records_exist() == "false")
    {
      // If there's no record on both api and option tables,
      // get only the values from api settings, other options
      // records will be inserted from a default values. 
      var data    = "consumer_key="+api_keys["consumer_key"]+"&";
          data    += "consumer_secret="+api_keys["consumer_secret"]+"&";
          data    += "token="+api_keys["token"]+"&";
          data    += "token_secret="+api_keys["token_secret"]+"&";
          data    += "save_type=insert";
    }
    else
    {
      // If there's an existing  records in api
      // table, get the values in setup.php api
      // settings, and other options.
      
      // Get the top 3 categories
      var catgry_len    = $("#show_html_value option").length;
      var catgry_arr    = new Array();
      for(x=1;x<=catgry_len;x++)
      {
        var catgry_vals = $("#show_html_value option:nth-child("+x+")").val();
        catgry_arr["catgry_"+x]    = catgry_vals;
      }
      // Get the default category
      var def_catgry    = $("input[name=PG_"+PG_name()+"_def_category]:checked").val();
      // Get the default rows
      var def_rows      = $("#PG_"+PG_name()+"_rows").val();
      // Get the default template
      var def_template  = $("input[name=PG_"+PG_name()+"_template_color]:checked").val();
      
      // API Keys
      var data    = "consumer_key="+api_keys["consumer_key"]+"&";
          data    += "consumer_secret="+api_keys["consumer_secret"]+"&";
          data    += "token="+api_keys["token"]+"&";
          data    += "token_secret="+api_keys["token_secret"]+"&";
      // Default categories
          data    += "default_category="+def_catgry+"&";
      // Categories
      for(x=1;x<=catgry_len;x++)
      {
          // Concatenate all the categories into one string
          data    += "catgry_"+x+"="+catgry_arr["catgry_"+x]+"&";
      }
          data    += "total_catgry="+catgry_len+"&"; // Total categories
      // Default rows
          data    += "show_rows="+def_rows+"&";
      // Default template
          data    += "template="+def_template+"&";
          data    += "save_type=update";
    }
    var getter  = defaults.getter();
    $.ajax({
        type: "POST",
        url: getter,
        data: data,
        success: function(data){
          if(data == "")
          {
            // Save message if success
            $("#PG_"+PG_name()+"_successMsg").showMessage({
                type : "success",
                resize : "#PG_"+PG_name()+"_Setup_mainContainer",
                message : {
                  success : "Saved Successfully"
                }
            });
          }
          else
          {
            alert("[ERROR]: Settings are not saved.\n"+data);
          }
        }
    });

    // TABS
    //var getter  = defaults.getter();
    //var data    = "url="+link;
    //
    //$.ajax({
    //  type: "POST",
    //  url: getter,
    //  dataType: "json",
    //  data: data,
    //  success: function(data){
    //    var p_count = $("ul.PG_"+PG_name()+"_contentnews li").length;
    //
    //    $("div#PG_"+PG_name()+"_ajaxloader").remove();
    //    $("ul.PG_"+PG_name()+"_contentnews").show();
    //    
    //    for(counter=1;counter<=p_count;counter++)
    //    {
    //      var json_counter = counter - 1;
    //      // Title
    //      var new_title       = "<p class='PG_"+PG_name()+"_title'>"+data["titles"][json_counter]+"</p>";
    //      var title_selector  = "ul.PG_"+PG_name()+"_contentnews li:nth-child("+counter+") div.PG_"+
    //                            PG_name()+"_content p.PG_"+
    //                            PG_name()+"_title";
    //      $(title_selector).replaceWith(new_title);
    //      
    //      // Reviews
    //      var new_review      = "<div class='PG_"+PG_name()+"_rating'>"+data["reviews"][json_counter]+"</div>";
    //      var review_selector = "ul.PG_"+PG_name()+
    //                            "_contentnews li:nth-child("+counter+") div.PG_"+PG_name()+
    //                            "_content div.PG_"+PG_name()+"_rating";
    //      $(review_selector).replaceWith(new_review);
    //      
    //      // Business description
    //      var new_busDesc      = data["bus_desc"][json_counter];
    //      var busDesc_selector = "ul.PG_"+PG_name()+"_contentnews li:nth-child("+counter+") div.PG_"+
    //                            PG_name()+"_content ol";
    //      $(busDesc_selector+" li").remove();
    //      $(busDesc_selector).html(new_busDesc); 
    //    }
    //  }
    //});
    //
    //// Image loader
    //var loader  = "<div id='PG_Yelp_ajaxloader'>";
    //    loader += "<img src='"+defaults.basepath()+"/images/ajax-loader_yelp.gif'>";
    //    loader += "</div>";
    //    
    //$("ul.PG_"+PG_name()+"_contentnews").hide();
    //$("div#PG_"+PG_name()+"_ajaxloader").remove();
    //$("div.PG_"+PG_name()+"_content_wrap").append(loader);
  }
  
}

jQuery(document).ready(function($){
  
  // Front ------------------------
  if($("div#PG_"+PG_name()+"_Front_mainContainer").length > 0)
  {
    // Check if settings are set
    if(defaults.records_exist() != "true")
    {
      $("ul.PG_"+PG_name()+"_nav").remove();
      $("div.PG_"+PG_name()+"_content_wrap").remove();
      $("div#PG_"+PG_name()).append("<span style='margin-top: 10px; display: block; text-align: center;'>Settings are not set yet.</span>");
    }
    
    // Initial display
    constructor.initial_display();
    
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
  }
  
  
  
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
  
  // Save
  $("#PG_"+PG_name()+"_save").click(function(){
    var api_consumer_key    = $.trim($("#PG_"+PG_name()+"_API_consumer_key").val());
    var api_consumer_secret = $.trim($("#PG_"+PG_name()+"_API_consumer_secret").val());
    var api_token           = $.trim($("#PG_"+PG_name()+"_API_token").val());
    var api_token_secret    = $.trim($("#PG_"+PG_name()+"_API_token_secret").val());

    // Put array keys in array so that save could have only one parameter    
    var api_keys = new Array();
    api_keys["consumer_key"]    = api_consumer_key;
    api_keys["consumer_secret"] = api_consumer_secret;
    api_keys["token"]           = api_token;
    api_keys["token_secret"]    = api_token_secret;
    
    // Save API Keys
    Serverside.save(api_keys);
    
    // Prevent page from refreshing
    return false;
  });
  
  // Re-arrange category orders
  $("img.PG_Yelp_move").click(function(){
    var move_val = $(this).attr("alt");
    var curr_opt = $('#show_html_value option:selected');
    
    if(move_val == "Down")
    {
      curr_opt.insertAfter(curr_opt.next());
    }
    else
    {
      curr_opt.insertBefore(curr_opt.prev());
    }
  });
  
  // Reset options but API Keys
  $("#PG_Yelp_reset").click(function(){
    // Default Categories
    $("#PG_"+PG_name()+"_def_general").attr("checked", true);
    // Show rows
    $("#PG_"+PG_name()+"_rows").val("5");
    // Template
    $("#PG_"+PG_name()+"_template_blue").attr("checked", true);
    // Category list
    var slice_catgry  = $("#PG_"+PG_name()+"_categories_hidden").val();
    var catrgy_res    = slice_catgry.split(",");
    var total_ctrgy   = catrgy_res.length;
    
    $("#show_html_value").empty(); // Empty the category list to populate with defaults
    for(x=0;x<total_ctrgy;x++)
    {
      $("#show_html_value").append("<option>"+catrgy_res[x]+"</option>");
    }
  });
  
  
  
});














