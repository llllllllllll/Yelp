// Functions
var PG_name = (function(){
  
  
    this.pgname = function()
    {
      var pg_name = $("#PG_PG_NAME").text();
      return pg_name;  
    }
  
  
})();


jQuery(document).ready(function($){
  alert(PG_name.pg_name());
});


















