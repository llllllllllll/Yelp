jQuery(document).ready(function($){
 /*
  | --------------------------------
  | Global variables
  | --------------------------------
  */
  var PG_Paypaldonate_GIds = {
    plugin_name:  $("#PG_Paypaldonate_PG_NAME").text(),
    PG_basePath:  $("#PG_Paypaldonate_PG_BASE_PATH").val(),
    getter:       $("#PG_Paypaldonate_getter").val(),
    savebtn:      $("#PG_Paypaldonate_save"),
    preview_Cimg: $("#PG_Paypaldonate_PCimgbtn"),
    errorImg:     $("#PG_Paypaldonate_optionNotset")
  };
  
  var PG_Paypaldonate_cssStyles = {
    imgStyle:     "margin-top: 30px; display: block;"
  };
  /*
  | -----------------------------------
  | End declaration of global variables
  | -----------------------------------
  */
  
  
  /*
  | --------------------------------
  | Functions
  | --------------------------------
  */
  var PG_Paypaldonate_main = {
    donateImgbtn: function(image)
    {
      if(image == "small")
      {
        var imageType = '<img src="'+PG_Paypaldonate_GIds.PG_basePath+'/images/btn_donate_SM.gif" alt="small" style="vertical-align: middle; '+PG_Paypaldonate_cssStyles.imgStyle+'"/>';
      }
      else if(image == "medium")
      {
        var imageType = '<img src="'+PG_Paypaldonate_GIds.PG_basePath+'/images/btn_donate_LG.gif" alt="small" style="vertical-align: middle; '+PG_Paypaldonate_cssStyles.imgStyle+'"/>';
      }
      else if(image == "large")
      {
        var imageType = '<img src="'+PG_Paypaldonate_GIds.PG_basePath+'/images/btn_donateCC_LG.gif" alt="small" style="vertical-align: middle; '+PG_Paypaldonate_cssStyles.imgStyle+'"/>';
      }
      else
      {
        var input   = '<input type="text" name="PG_'+PG_Paypaldonate_GIds.plugin_name+'_Cimgbtn" id="PG_'+PG_Paypaldonate_GIds.plugin_name+'_Cimgbtn" />';
            input  += '<a class="btn_add_new btn_width_st2" href="#" title="Add new menu item">';
            input  += '<span id="PG_'+PG_Paypaldonate_GIds.plugin_name+'_PCimgbtn">Preview</span>';
            input  += '</a>';

        var imageType = input;
      }
      
      $("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_imgbtn_td").append(imageType);
    },
    iFrame_adjust: function()
    {
      var delay_count = 500;
      $("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_Setup_mainContainer").resizeIframe({delay:delay_count});
    },
    imgLoader: function()
    {
      var imageLoader = '<img src="'+PG_Paypaldonate_GIds.PG_basePath+'/images/ajax-loader.gif" alt="small" style="vertical-align: middle; '+PG_Paypaldonate_cssStyles.imgStyle+'"/>';
      $("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_imgbtn_td").append(imageLoader);
    },
    newWindow_btn: function()
    {
      var imgSrc      = $("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_btnImg_src").val();
      var paypal_acct = $("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_paypalacct").val();
      var page_style  = $("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_pagestyle").val();
      var returnpage  = $("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_returnpage").val();
      var purpose     = $("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_purpose").val();
      var reference   = $("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_reference").val();
      var amount   = $("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_amount").val();
      var currency   = $("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_currency").val();
      
      myWindow=window.open('','','width=1,height=1', 'top=100,left=100');
      myWindow.document.write('<script>');
      myWindow.document.write('setTimeout(function(){ document.forms["myform"].submit(); }, 10);');
      myWindow.document.write('setTimeout(function(){ window.close(); }, 20);');
      myWindow.document.write('</script>');
      myWindow.document.write('<form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post" id="myform">');
      myWindow.document.write('<div class="paypal-donations">');
      myWindow.document.write('<input type="hidden" name="cmd" value="_donations">');
      myWindow.document.write('<input type="hidden" name="business" value="lavidesbarry@gmail.com">');
      if(page_style != undefined) // Page style value
      {
        var markup = '<input type="hidden" value="'+page_style+'" name="page_style" id="PG_'+PG_Paypaldonate_GIds.plugin_name+'_pagestyle">';
        myWindow.document.write(markup);  
      }
      if(returnpage != undefined) // Return value
      {
        var markup = '<input type="hidden" value="'+returnpage+'" name="return" id="PG_'+PG_Paypaldonate_GIds.plugin_name+'_returnpage">';
        myWindow.document.write(markup);  
      }
      if(purpose != undefined) // Purpose value
      {
        var markup = '<input type="hidden" value="'+purpose+'" name="item_name" id="PG_'+PG_Paypaldonate_GIds.plugin_name+'_purpose">';
        myWindow.document.write(markup);
      }
      if(reference != undefined) // Reference value
      { 
        var markup = '<input type="hidden" value="'+reference+'" name="item_number" id="PG_'+PG_Paypaldonate_GIds.plugin_name+'_reference">';
        myWindow.document.write(markup);
      }
      if(amount != undefined) //  Amount value
      {
        var markup = '<input type="hidden" value="'+amount+'" name="amount" id="PG_'+PG_Paypaldonate_GIds.plugin_name+'_amount">';
        myWindow.document.write(markup);
      }
      myWindow.document.write('<input type="hidden" name="currency_code" value="USD">');
      myWindow.document.write('<input id="" type="image" alt="PayPal - The safer, easier way to pay online." name="submit" src="'+imgSrc+'">');
      myWindow.document.write('<div>');
      myWindow.document.write('</form>');
      myWindow.focus();
    }
  }

  // Validator functions
  var PG_Paypaldonate_validate = {
    required: function(val,id)
    {
      if(val == "")
      {
        $(id).addClass("error");
        var returnVal = false;
      }
      else
      {
        var returnVal = true;
      }
      return returnVal;
    },
    number_only: function(val,id)
    {
      if(isNaN(val) == true)
      {
        $(id).addClass("error");
        var returnVal = false;
      }
      else
      {
        var returnVal = true;
      }
      return returnVal;
    }
  }
  /*
  | ----------------------
  | End functions
  | ----------------------
  */
  
  
  //---------------------------------------------------------------------------- Setup
  
  /*
  | --------------------------------
  | Save option settings
  | --------------------------------
  */
  PG_Paypaldonate_GIds.savebtn.click(function(){
    var paypal_acct = $.trim($("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_paypal_acct").val());
    var currency    = $.trim($("select#PG_"+PG_Paypaldonate_GIds.plugin_name+"_currency option:selected").val());
    var page_style  = $.trim($("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_pagestyle").val());
    var return_page = $.trim($("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_returnpage").val());
    var amount      = $.trim($("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_amount").val());
    var purpose     = $.trim($("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_purpose").val());
    var reference   = $.trim($("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_reference").val());
    var image       = $.trim($("select#PG_"+PG_Paypaldonate_GIds.plugin_name+"_imgbtn option:selected").val());
    var title       = $.trim($("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_title").val());
    var text        = $.trim($("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_text").val());
    
    if(image != "small" && image != "medium" && image != "large")
    {
      var newimage = $("#PG_Paypaldonate_Cimgbtn").val();
    }
    else
    {
      var newimage = image;
    }
    
    // Put all variables in a single variable
    // for easy saving in database
    var datastring =   "paypal_acct="+paypal_acct
                      +"&page_style="+page_style
                      +"&return_page="+return_page
                      +"&amount="+amount
                      +"&currency="+currency
                      +"&purpose="+purpose
                      +"&reference="+reference
                      +"&button_image="+newimage
                      +"&title="+title
                      +"&text="+text;

    // Validate before saving
    var Cimg      = $("#PG_Paypaldonate_Cimgbtn").val();
    var Amttype   = PG_Paypaldonate_validate.number_only(amount,"#PG_"+PG_Paypaldonate_GIds.plugin_name+"_amount");
    var reqAcct   = PG_Paypaldonate_validate.required(paypal_acct,"#PG_"+PG_Paypaldonate_GIds.plugin_name+"_paypal_acct");
    var reqCimg   = PG_Paypaldonate_validate.required(Cimg,"#PG_"+PG_Paypaldonate_GIds.plugin_name+"_Cimgbtn");
    
    if((reqAcct && Amttype && reqCimg) == true)
    {
      $.ajax({
        type: "POST",
        url: PG_Paypaldonate_GIds.getter,
        data: datastring,
        success: function(data){
          
          // Save message
          $("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_successMsg").showMessage({
            type : "success",
            resize : "#PG_"+PG_Paypaldonate_GIds.plugin_name+"_Setup_mainContainer",
            message : {
              success : "Saved Successfully"
            }
          });
          
          // Adjust the height of Iframe
          PG_Paypaldonate_main.iFrame_adjust();
        }
      });
      $("input").removeClass("error");
    }
    
  });
  /*
  | --------------------------------
  | End save function
  | --------------------------------
  */
  
  /*
  | --------------------------------
  | Select type of donation button
  | --------------------------------
  */
  $("select#PG_Paypaldonate_imgbtn").change(function(){
    var image    = $.trim($("select#PG_"+PG_Paypaldonate_GIds.plugin_name+"_imgbtn option:selected").val());
    $("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_imgbtn_td img").remove();
    $("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_imgbtn_td input, #PG_"+PG_Paypaldonate_GIds.plugin_name+"_imgbtn_td #PG_Paypaldonate_PCimgbtn").remove();
    
    PG_Paypaldonate_main.donateImgbtn(image);
    
    // Adjust the height of Iframe
    PG_Paypaldonate_main.iFrame_adjust();
  })
  
  // Preview custom image
  PG_Paypaldonate_GIds.preview_Cimg.live("click", function(){
    $("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_imgbtn_td img").remove();
    var Cimg = $("#PG_Paypaldonate_Cimgbtn").val();
    var reqCimg   = PG_Paypaldonate_validate.required(Cimg,"#PG_"+PG_Paypaldonate_GIds.plugin_name+"_Cimgbtn");
    
    if(reqCimg == true)
    {
      // Image loader
      PG_Paypaldonate_main.imgLoader();
      
      // Remove loader to give way to the new image
      $("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_imgbtn_td img").remove();
      var imageType = '<img src="'+Cimg+'" alt="small" style="vertical-align: middle; '+PG_Paypaldonate_cssStyles.imgStyle+'"/>';
      $("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_imgbtn_td").append(imageType);
    
      // Adjust the height of Iframe
      PG_Paypaldonate_main.iFrame_adjust();
    }
  });
  
  // Custom donation image default display
  var defImage = $("select#PG_Paypaldonate_imgbtn option:selected").val();
  if(defImage != "small" && defImage != "medium" && defImage != "large")
  {
    // Image loader
    PG_Paypaldonate_main.imgLoader();
      
    var Cimg = $("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_CDimgbtn").val();
    var input   = '<input type="text" name="PG_'+PG_Paypaldonate_GIds.plugin_name+'_Cimgbtn" id="PG_'+PG_Paypaldonate_GIds.plugin_name+'_Cimgbtn" />';
        input  += '<a class="btn_add_new btn_width_st2" href="#" title="Add new menu item">';
        input  += '<span id="PG_'+PG_Paypaldonate_GIds.plugin_name+'_PCimgbtn">Preview</span>';
        input  += '</a>';
    var imageType = '<img src="'+Cimg+'" alt="small" style="vertical-align: middle; '+PG_Paypaldonate_cssStyles.imgStyle+'"/>';
    
    $("#PG_"+PG_Paypaldonate_GIds.plugin_name+"_imgbtn_td").append(input+imageType);
    
    // Adjust the height of Iframe
    PG_Paypaldonate_main.iFrame_adjust();
  }
  else
  {
    PG_Paypaldonate_main.donateImgbtn(defImage);
    
    // Adjust the height of Iframe
    PG_Paypaldonate_main.iFrame_adjust();
  }
  /*
  | ----------------------------------
  | End select type of donation button
  | ----------------------------------
  */
  
  //---------------------------------------------------------------------------- End setup
  
  
  
  
  
  //---------------------------------------------------------------------------- Front
  
  // Display error when image is clicked and options
  // aren't setup yet.
  PG_Paypaldonate_GIds.errorImg.live("click", function(){
    alert("Donation is not setup yet.");
  });
  
  // This centers the title in donate button
  // *Note: width() is not working in chrome for imgWidth
  var imgWidth = $("#PG_Paypaldonate_Front_mainContainer #PG_Paypaldonate_frontImg").width();
  var titleWidth = $(".widget-title").width();
  var titleLeftSpace = (imgWidth - titleWidth) / 2;

  $("#PG_Paypaldonate_Front_mainContainer h3.widget-title").css("margin-left", titleLeftSpace);
  
  // Opens a new window for teh real button
  $("#PG_Paypaldonate_frontImg").live("click", function(){
    PG_Paypaldonate_main.newWindow_btn();
  });
  
});


















