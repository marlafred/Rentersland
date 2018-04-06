<!DOCTYPE html>
<html>
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container">
        <div class="dropzone" id="dropzoneFileUpload">
        </div>
    </div>
 
  <input type="button" value="Upload" id="now">
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>
 
    <script type="text/javascript">
	  
        Dropzone.autoDiscover = false;
        token = $('meta[name="csrf-token"]').attr('content');
	$(".dropzone").css('background-image',"url('spritemap.png')");
        var myDropzone = new Dropzone("div.drag-area", {
            autoProcessQueue: true,
            url: "{{ route('dropzone.uploads') }}",
            params: {
                _token: token
            }
				
        });
        Dropzone.options.myAwesomeDropzone = {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 2, // MB
            addRemoveLinks: true,
            accept: function(file, done) {
 			
            },
        };
		
        myDropzone.on("success", function(file,response) {
                console.log(response);
                filename = response+'#';						  						  
                $("#upload_images").append(filename);
                $('#submit_ad').click();	
                if(response.html==undefined || response.html==null) {

                }	
        });
		
		
        $(document).ready(function(e) {
            $('#now').on('click',function(e){
                    e.preventDefault();
                      myDropzone.processQueue();  

            });
        });
    </script>
</body>
</html>