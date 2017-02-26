jQuery(document).ready(function($){
  $("#check-all").change(function(){
    $('#data tbody input:checkbox').not(this).prop('checked', this.checked);
  });
})