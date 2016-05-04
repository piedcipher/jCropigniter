<!DOCTYPE html>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css" />
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/0.9.12/css/jquery.Jcrop.min.css" />
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection" />
</head>
 
<body>
    <div class="row">
        <div class="col s12">
            <div style="padding: 5px;" align="center" class="card">
                <div class="row">
                    <center>
                        <label>
                            <h5 style="font-size: 16px; padding: 8px;" class="red-text">
                                <?php
                                   echo $upload_error = $this->session->flashdata('upload_error');
                                ?>
                            </h5>
                        </label>
                    </center>
 
                    <?php
                       $formAttr = array('class' => 'col s12', 'method' => 'post', 'enctype' => 'multipart/form-data');
                        echo form_open('upload/valid_upload\/', $formAttr);
                    ?>
                       
                        <!--Image Upload (Input Element)-->
                        <div class='row'>
                            <div class='file-field input-field col s12'>
                                <div class='btn indigo lighten-1'>
                                    <span>Upload..</span>
                                    <input type='file' name='image' id='image' />
                                </div>
                                <div class='file-path-wrapper'>
                                    <input id='path' name='path' class='file-path validate' type='text' placeholder='Display Image' />
                                </div>
                                <span class='red-text'> <?php echo form_error('path'); ?> </span>
                            </div>
                         </div> <!--<div class='row'> completes here-->
   
                             
                        <!--Image Preview-->
                        <div style='overflow: scroll;' class='row'>
                            <div class='col s12'>
                                <img src="" class="crop" id="dp_preview" />
                                <input type="hidden" id="x" name="x" />
                                <input type="hidden" id="y" name="y" />
                                <input type="hidden" name="x2" id="x2" />
                                <input type="hidden" name="y2" id="y2" />
                                <input type="hidden" id="w" name="w" />
                                <input type="hidden" id="h" name="h" />
                            </div>
                        </div>
   
                        <!--Submit-->
                        <div class='right row'>
                            <button style='margin-right: 24px;' type='submit' name='btn_add_brnd' class='btn btn-large waves-effect indigo'>Add</button>
                        </div>
 
                    <?php echo form_close(); ?>
                </div>
            </div>
         </div>
    </div>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/0.9.12/js/jquery.Jcrop.min.js"></script>
    <script src="main.js"></script>
</body>
</html>