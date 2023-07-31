@extends('layouts.master')
@section('title', 'IcloudEMS - import file')

@section('content')

    <div class="d-flex flex-wrap align-content-center justify-content-center bg-light" style="height:300px">
        <div class="p-2 " >
            <!-- File upload form -->
            <form id="uploadForm" enctype="multipart/form-data" >
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="hidden" id="filename" name="filename" value="">
                        <input type="file" id="fileInput" required  name="file" class="form-control form-control-sm" accept=".csv" style="border:none">
                        <div class="input-group-btn" >
                            <button type="submit" name="submit" class="btn btn-primary">UPLOAD</button>
                        </div>
                        
                    </div>

                    <!-- Progress bar -->
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>


                    <!-- Display upload status -->
                    <div id="uploadStatus"></div>
                </div>
                
            </form>



        </div>
    </div>
    <!-- ajax call -->
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // File upload via Ajax
            $("#uploadForm").on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = ((evt.loaded / evt.total) * 100);
                                $(".progress-bar").width(percentComplete.toFixed() + '%');
                                $(".progress-bar").html(percentComplete.toFixed() +'%');
                            }
                        }, false);
                        return xhr;
                    },
                    type: 'POST',
                    url: "{{route('csvimport.store')}}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function(){
                        $(".progress-bar").width('0%');
                        $('#uploadStatus').html('<img src="images/loading.gif"/> file uploading ...');
                    },
                    error:function(){
                        $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
                    },
                    success: function(resp){
                        console.log(resp);
                        if(resp == 'ok'){
                            $('#uploadForm')[0].reset();
                            $('#uploadStatus').html('<p style="color:#28A74B;">File has uploaded successfully!</p>');
                        }else if(resp == 'err'){
                            $('#uploadStatus').html('<p style="color:#EA4335;">Please select a valid file to upload.</p>');
                        }
                    }
                });
            });
            
            // File type validation
            $("#fileInput").change(function(){
                $(".progress-bar").width('0%');
                $('#uploadStatus').html('');
                var allowedTypes = ['text/csv'];
                var file = this.files[0];
                var fileType = file.type;
                if(!allowedTypes.includes(fileType)){
                    alert('Please select a valid file (CSV FILE).');
                    $("#fileInput").val('');
                    return false;
                }
            });
        });
    </script>
@stop

