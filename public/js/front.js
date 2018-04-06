$(document).ready(function(){
    var base_url = $('#base_url').val();
    
    $(document).on('keypress','.number',function(event) {
	  if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
		event.preventDefault();
	  }
    });
	
    $(document).on('focus','.reset', function(){
            if($(this).val()==0){
                $(this).val('');
            }	
    }); 
    
    $('#newsletterForm').on('submit', function(){
        var data = $(this).serialize();
        var element = $(this).find('.news-response');
        element.html('<i class="fa fa-spinner fa-spin"></i>');
        
        $.ajax({
                url: base_url+'/submit-newsletetr',
                data: data,
                type: 'POST',
                success: function(data){
                    element.html(data);
                }, error:function(){
                    element.html('<span class="text-danger">Error in processing request..!!</span>');
                }
            });
        
    });
    
    
});