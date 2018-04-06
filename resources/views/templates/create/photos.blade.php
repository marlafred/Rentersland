<div class="row">
    <span class="step-label">Photos</span>
    <div class="content">
        <div class="form-group col-sm-8">
            <label>Featured Image</label>
            <ul class="img-list-style text-muted">
                <li>Featured Image make your listing more prominant.</li>
                <li>Accepted formats are .jpg, .jpeg, .gif & .png.</li>
                <li>File size must be less than 2MB</li>
            </ul>
            <input type="file" class="" id="featured_image" name="featured_image" accept="image/*" class="btn btn-default" onchange="document.getElementById('img_preview').src = window.URL.createObjectURL(this.files[0])" />
        </div>
        <div class="form-group col-sm-4">
            @if(isset($listing->featured_image) and $listing->featured_image!='')
            <img src="{{ asset('uploads/small_thumbs/'.$listing->featured_image) }}" class="" width="125px" height="125px" /><br>
            <a href="javascript:void(0);" class="remove_img"><span class="text-danger"><i class="fa fa-trash"></i> Remove</span></a>
            <input type="hidden" name="exist_featured" value="{{ $listing->featured_image }}">
            @endif
        </div>
        
        <div class="clearfix"></div>

        <div class="form-group col-sm-12" style="margin-top:20px;">
            <div class="form-group col-sm-6">
                <img id="img_preview" alt="your image" width="200" height="200" src="{{asset('images/no-image-small.png')}}" />
                <img id="no_img" style="display:none;" alt="your image" width="200" height="200" src="{{asset('images/no-image-small.png')}}" />
            </div>
            <div class="form-group col-sm-6">
               <span id="" onclick="rotateImage()"> Rotate <!--<i class="fa fa-refresh"></i>--></span>
                <span id="del_preview_img" onclick="del_preview_img()"> Delete <!--<i class="fa fa-trash"></i>--></span><br>
                <label>Caption </label><br>
                <input type="text" name="caption" id="">
            </div>
        </div>
        
        <div class="clearfix"></div>

        <div class="form-group col-sm-12">
            <label>Gallary Images:</label>
            <ul class="img-list-style text-muted">
                <li>Minimum 5 and Maximum 20 Photos!</li>
                <li>Ensure the building is properly visible from multiple angles</li>
                <li>Accepted formats are .jpg, .jpeg, .gif & .png.</li>
                <!--<li>File size must be less than 2MB</li>-->
            </ul>

            @if(isset($listing->listingimages) and count($listing->listingimages) > 0)

                <div class="row">
                    <?php $i= 0; ?>
                    @foreach ($listing->listingimages as $images)    
                        <div class="col-sm-4 col-md-4 form-group">
                            <img src="{{ asset('uploads/large_thumbs/'.$images->image) }}" class="imgs" width="100%" height="128px" id="imgs_r-{{$images->id}}" style="margin-bottom:30px;margin-top:25px;" />
                            <a href="javascript:void(0);" class="remove_img"><span class="text-danger"><i class="fa fa-trash"></i> Remove</span></a>
                            <input type="hidden" name="exist_images[]" value="{{ $images->image }}">
                            <span onclick="rotateImgs('imgs_r-{{$images->id}}')" style="color:#a94442;"> <i class="fa fa-refresh"></i> Rotate </span>
                        </div>
                        <?php $i++; ?>
                        @if($i==3)
                            <div class="clearfix"></div>
                        @endif
                     @endforeach
                </div>

            @endif
            <div id="upload_images" style="display:none;"></div>
            <input type="hidden" name="listing_images" class="ad_images" value="" >
            <div class="dropzone drag-area" id="dropzoneFileUpload">
            
            </div>
                        
        </div>
        
    </div>
</div>

<script>
var count=0;
function del_preview_img(){
    document.getElementById('img_preview').src=document.getElementById('no_img').src;
    $('#featured_image').val('');
    count=0;
       
$('#img_preview').animate({ transform: 0 }, {
step: function(now,fx) {
$(this).css({
'-webkit-transform':'rotate('+now+'deg)', 
'-moz-transform':'rotate('+now+'deg)',
'transform':'rotate('+now+'deg)'
});
}
});
}
    var degree=0;
 function rotateImage() {
     count=count+1;
     if(count==1){
        degree=90;    
     }
     else if(count==2){
         degree=180;
     }
     else if(count==3){
         degree=270;
     }
     else{
         degree=0;
         count=0;
     }
     
$('#img_preview').animate({ transform: degree }, {
step: function(now,fx) {
$(this).css({
'-webkit-transform':'rotate('+now+'deg)', 
'-moz-transform':'rotate('+now+'deg)',
'transform':'rotate('+now+'deg)'
});
}
});
}
    
  var count1=0;
    function rotateImgs(img_id) {    
          count1=count1+1;
     if(count1==1){
        degree=90;    
     }
     else if(count1==2){
         degree=180;
     }
     else if(count1==3){
         degree=-90;
     }
     else{
         degree=0;
         count1=0;
     }
      
      //  $("#"+img_id).css({transform:'rotate(180deg)'});
  
$("#"+img_id).animate({ transform: degree }, {
step: function(now,fx) {
$(this).css({
'-webkit-transform':'rotate('+now+'deg)', 
'-moz-transform':'rotate('+now+'deg)',
'transform':'rotate('+now+'deg)'
});
}
});
   
}
    
/*  Dropzone.options.newsDropzone= {
            init: function () {
                this.on("click", function (file, response) {
                    alert(response); // or alert(file.xhr.response);
                })
            }
        };*/
</script>