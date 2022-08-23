<?php  $CI =& get_instance(); ?>

     <link href="<?php echo base_url();?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    
     <link href="<?php echo base_url();?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />

     <link href="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
  
     <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                <?php if($this->session->flashdata('success')){ ?>
                <div class="alert alert-success alert-dismissible text-center fade-message">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } if($this->session->flashdata('danger')){ ?>
                <div class="alert alert-danger alert-dismissible text-center fade-message">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <?php echo $this->session->flashdata('danger'); ?>
                  </div>
                <?php } ?>
                </div>         
        
          </div> 

         <div class="block-header">
            <h4> Tendering - Pre-bid Conference</h4>
        </div>
            
    <!-- Steps start -->      
          <?php
         // project_tendering_steps($project_id);
        ?>
    <!-- Steps end --> 
    <!--    Project_Information -->                   
                  
       <?php
        if(is_numeric($project_id)){
            project_info($project_id);
        }
    
        ?>                   
    <!--    Project_Information End -->  
   
            
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                        <div class="bidder-details-container"  id="bidder_ref_number">

                                           


                                  <div class="card clearfix">
                                     <div class="header">
                                        <h2> Bidder Information </h2>
                                     </div>
                                     
                                     <div class="body">
                                         <table class="table">
                                            <tr>
                                                
                                                <th>Bidder Ref No/Name</th>
                                                
                                                <th>Contact Info</th>
                                                <th>Attachment</th>
                                                </th>
                                                </tr>
                                   <?php
                                     if(!empty($prebid_bidder_details)){
                                    ?>

                                    <?php 
                                      $k = 1;
                                      $get_same_datacnt = count($prebid_bidder_details);
                              
                                      foreach ($prebid_bidder_details as $Tvalue) {
                                    
                            
                                    ?>
                                                <tr>
                                                <tbody>
                                                    <td> <?php echo $Tvalue['bidder_name']; ?></td>
                                                   
                                                    <td><?php echo $Tvalue['bidder_info']; ?></td>
                                                    <td><?php if (!empty($Tvalue['document_name'])) { ?>
                                                    <a href="<?php echo base_url();?>uploads/files/prebid/<?php echo str_replace('_', '', $Tvalue['document_name']); ?>" title="Download" download="<?php echo str_replace(' ', '_', $Tvalue['document_name']); ?>">
                                                      <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                                    </a>
                                                  <?php } ?></td>
                                                </tbody>
                                                </tr>
                                        
                                                <?php } } ?>
                                             
                                              
                                               
                                         </table>
                           
                                    
                                     
                           
                          
                            </div>
                            </div>  

                                 


                                
                                  

                                     

                    </div>
              
                </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                        <div class="card clearfix">
                             <div class="header">
                                 <h2> Attachment-Pre-Bid  </h2>
                             </div>
                            <div class="body clearfix">
                                <div class="clearfix  m-b-15">
                                
                                    
                                    <div class="upload-clarification-container">
                                     <table class="table">
                                        <tr>
                                        <th><b>File name</b></th>
                                        <th> <b>Corrigendum / Addendum Issuance Date</b></th>
                                        </tr>
                                        <?php
                                     if(!empty($prebid_file)){
                                    ?>

                                    <?php 
                                      $k = 1;
                                      $get_same_datacnt2 = count($prebid_file);
                              
                                      foreach ($prebid_file as $filenamevalue) {
                                   ?>
                                        <tr>
                                            <td><p><?php echo $filenamevalue['document_name']; ?></p>
                                                   <?php if (!empty($filenamevalue['document_name'])) { ?>
                                                    <a href="<?php echo base_url();?>uploads/files/prebid/<?php echo str_replace('_', '', $filenamevalue['document_name']); ?>" title="Download" download="<?php echo str_replace(' ', '_', $filenamevalue['document_name']); ?>">
                                                      <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                                    </a>
                                                  <?php } ?></td>
                                            <td><?php echo $filenamevalue['corrigendum_issuance_date']; ?></td>
                                        </tr>
                                        <?php 
                                      } }
                               ?>
                                     </table>
                                
                                   
                                  
                              

                                
                                    

                                
                               
                                

                                <!-- =============== -->
                                

                                </div>
                               
                                </div>

                            </div>
                            
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                        <div class="card clearfix">
                             <div class="header">
                                 <h2> Progress Update </h2>
                             </div>
                            <div class="body clearfix">
                                <div class="clearfix cloneBox1 m-b-15">
                                
                                 <div class="row clearfix">  
                                
                                     <div class="col-md-4" id="prebid_meeting_date">
                                         <div class="col-md-12 p-0">
                                            <p> <b>Prebid Meeting Date</b><span class="col-pink"></span></p>

                                      <p><?php echo ($get_prebid[0]['approval_date'] != '0000-00-00') ? $get_prebid[0]['approval_date'] : '' ?></p>

                                       </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                         <p> <b>Pre-bid Completed</b> </p>
                                         <p><?php if($get_prebid[0]['approval_status']=='Y' ){
                                            echo "Yes";
                                         }else{
                                            echo "No";
                                         }?></p>
                                         
                                         
                                    </div>

                                     <div class="col-md-4">
                                        <p> <b> Remarks </b></p>
                                        <p><?php echo $get_prebid[0]['remarks'] ?></p>
                                      
                                    </div>


                                </div>
                                </div>
                               
                               

                                <div class="clearfix"></div>
                            </div>
                            
                        </div>
                    </div>
    
                  
            <!-- Select -->


        </div>
    </section>
<!-- #Main Content -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

  <!-- Select2 -->
<script src="<?php echo base_url();?>assets/plugins/select2/dist/js/select2.full.min.js"></script>

<script src="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.min.js"></script>
   

<script type="text/javascript">
    $(document).ready(function() {
        $('.fade-message').delay(5000).fadeOut(5000);
    });
</script>


<script type="text/javascript">

    <?php
         if($get_same_datacnt > 1) { ?>
            var divid = <?php echo $get_same_datacnt; ?>;
            <?php
         }
         else {
            ?>
            var divid = 1;
            <?php
         }
    ?>

     //Contact add remove
     
     var optionValues = $("#hidden_state_fetch").html();
     $(".bidder-details-add").click(function () {
         divid++;
         //alert(divid);
        
        $(".bidder-details-container").append('<div id="bidder-details-row"><div class="card clearfix"><div class="body"><div class="row"><div class="col-md-4"><p><b>Bidder Ref No/Name</b><span class="col-pink">*</span></p> <input class="form-control bidderrefno" type="text" name="bidder_name[]" id="biddername_'+divid+'" placeholder="Bidder Name" ></div><div class="col-md-4"><p> <b>Country</b></p> <select class="form-control" name="prebid_country[]" id="country_'+divid+'" onchange="statefunc('+divid+');">'+optionValues+'</select></div><div class="col-md-4"><p> <b>State</b></p><select class="form-control" name="prebid_state[]" id="state_id_'+divid+'"><option value="0">Select..</option></select></div></div><div class="row"><div class="col-md-4"><div class="row"><div class="col-md-4"><p></p> <br/> <select  class="form-control" name="prebid_salutation[]"><option value="0">Select</option><option value="Mr">Mr</option><option value="Mrs">Mrs</option> <option value="Ms">Ms</option></select></div> <div class="col-md-8"> <p> <b>First Name</b> </p> <input class="form-control" type="text" name="prebid_first_name[]" placeholder="First Name"></div></div></div><div class="col-md-4"><div class="row"><div class="col-md-12"><p> <b>Middle Name</b> </p> <input class="form-control" type="text" name="prebid_middle_name[]" placeholder="Middle Name"></div></div></div><div class="col-md-4"><div class="row"> <div class="col-md-12"><p> <b>Last Name</b> </p> <input class="form-control" type="text" name="prebid_last_name[]" placeholder="Last Name"></div> </div></div></div><div class="row"><div class="col-md-4"> <div class="row"><div class="col-md-12"><p> <b>Mobile Number</b> </p><input class="form-control txtQty_'+divid+' mobile-valid_'+divid+'" type="text" name="prebid_mobile[]" id="prebidmobile_'+divid+'" placeholder="Enter Mobile No."></div> </div></div><div class="col-md-4"><div class="row"><p class="col-md-12"><b>Land Phone Number</b> </p> <div class="col-md-4"><input class="form-control txtQty_'+divid+' mobile-valid_'+divid+'" type="text" id="prebidlstd_'+divid+'" name="prebid_std_code[]"  placeholder="STD"></div><div class="col-md-8"><input class="form-control txtQty_'+divid+' mobile-valid_'+divid+'" type="text" name="prebid_land_phone[]" id="prebidlandnum_'+divid+'" placeholder="Enter Land Phone No."></div></div></div><div class="col-md-4"><div class="row"> <div class="col-md-12"><p> <b>Email Address</b> </p> <input class="form-control email_'+divid+'" type="text" name="prebid_email[]" placeholder="Enter Email Id"> </div></div></div></div></div><div class="col-md-12 text-right"><button class="btn btn-default btn-circle waves-effect waves-circle waves-float bidder-details-remove" type="button"><i class="material-icons col-pink">delete</i></button></div></div></div>');
         

$(document).on('input','.mobile-valid_'+divid+'',function(){
    var phone=$('#prebidmobile_'+divid+'').val();
    if(phone.indexOf('0')==0){
     //alert('First number must not be 0');
     swal(" ", "First number must not be 0", "error");
     $('#prebidmobile_'+divid+'').val('');
    }
   if(phone.length>10){
    // alert('Please put 10  digit mobile number');
     swal(" ", "Please put 10  digit mobile number", "error");
     $('#prebidmobile_'+divid+'').val('');
   }

});


$(document).on('input','.mobile-valid_'+divid+'',function(){
    var phone=$('#prebidlandnum_'+divid+'').val();
    if(phone.indexOf('0')==0){
     swal(" ", "First Land line Number must not be 0", "error");
     $('#prebidlandnum_'+divid+'').val('');
    }
   if(phone.length>10){
     swal(" ", "Please put 10  Land line Number", "error");
     $('#prebidlandnum_'+divid+'').val('');
   }

});

$(document).on('input','.mobile-valid_'+divid+'',function(){
    var phone=$('#prebidlstd'+divid+'').val();
    if(phone.length>10){
     swal(" ", "Please put 10 digit STD Code", "error");
     $('#prebidlstd'+divid+'').val('');
   }

});
    //==============

    $('#biddername_'+divid+'').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9&-/_ ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
      }
   });


     $('.txtQty_'+divid+'').keyup(function() {
        var $this = $(this);
        $this.val($this.val().replace(/[^\d.]/g, ''));        
     });

    $('.email_'+divid+'').change(function () {    
    var inputvalues = $(this).val();    
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
    if(!regex.test(inputvalues)){    
    //alert("Enter valid Email ID"); 
    swal(" ", "Enter valid Email Id", "error"); 
    $('.email_'+divid+'').val('');  
    return regex.test(inputvalues);    
        }    
    });
    //===============

    });
    $("body").on("click", ".bidder-details-remove", function() {
    $(this).closest('#bidder-details-row').remove();
    });
    //Upload clarification add remove 
    //var divid = 1;
    $(".upload-clarification-add").click(function () {
       divid++; 
       $(".upload-clarification-container").append('<div id="upload-clarification-row"><div class="col-md-6 p-0"><input class="form-control" type="file" name="prebid_doc[]"  id="uploadFile_'+divid+'"></div><div class="col-md-1 p-0"></div><div class="col-md-3 p-0"><input class="datepicker form-control corrissuedate" type="date" placeholder="Please Choose a Date..." name="corrigendum_issue_date[]" id="corrigendum_date_'+divid+'"></div><div class="col-md-2"><button class="btn btn-default btn-circle waves-effect waves-circle waves-float upload-clarification-remove" type="button"><i class="material-icons col-pink">delete</i></button></div></div>');

//===============

  $('#uploadFile_'+divid+'').change(function () {
        var fileExtension = ['png','pdf','jpg','docs'];
        var MAX_FILE_SIZE = 50 * 1024 * 1024;
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            swal(" ", "Only png,pdf,jpg,docs format is allowed", "error");
            this.value = ''; // Clean field
            return false;
        }
         fileSize = this.files[0].size;
        if (fileSize > MAX_FILE_SIZE) {
           swal(" ", "File must not exceed 50 MB", "error");
            this.value = '';
        } else {
            
        }
    });

  
//===============

    });
    $("body").on("click", ".upload-clarification-remove", function() {
    $(this).closest('#upload-clarification-row').remove();
    });

    
 $(".txtQty").keyup(function() {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));        
});


  $('#biddername').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9&-/_ ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
      }
   });


$(document).ready(function () {        
    
    $(".email").change(function () {    
    var inputvalues = $(this).val();    
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
    if(!regex.test(inputvalues)){    
    //alert("Enter valid Email ID");  
     swal(" ", "Enter valid Email Id", "error");
    $('.email').val('');  
    return regex.test(inputvalues);    
    }    
    });    
    
 });



$(document).on('input','#prebidmobile',function(){
    var phone=$('#prebidmobile').val();
    if(phone.indexOf('0')==0){
     swal(" ", "First number must not be 0", "error");
     $('#prebidmobile').val('');
    }
   if(phone.length>10){
    swal(" ", "Please put 10  digit mobile number", "error");
     $('#prebidmobile').val('');
   }

});


$(document).on('input','#prebidlandnum',function(){
    var phone=$('#prebidlandnum').val();
    if(phone.indexOf('0')==0){
     swal(" ", "First number must not be 0", "error");
     $('#prebidlandnum').val('');
    }
   if(phone.length>10){
    swal(" ", "Please put 10  digit mobile number", "error");
     $('#prebidlandnum').val('');
   }

});

$(document).on('input','#prebidlstd',function(){
    var phone=$('#prebidlstd').val();
   if(phone.length>10){
    swal(" ", "Please put 10  digit STD Code", "error");
     $('#prebidlstd').val('');
   }

});



var biddercount = $(".upload_file").length;

    for (let i = 1; i <= biddercount; i++) {
    $('#uploadFile'+ i).change(function (){
            var fileExtension = ['png','pdf','jpg','docs'];
            var MAX_FILE_SIZE = 50 * 1024 * 1024;
             if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1){
               swal(" ", "Only png,pdf,jpg,docs format is allowed", "error");
                this.value = '';
                return false;
             }
             fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE){
                 swal(" ", "File must not exceed 50 MB", "error");
                    this.value = '';
                } else{
                    
                }
        });
    }

var biddernamecount = $(".bidderrefno").length;
    for (let i = 1; i <= biddernamecount; i++) {

    $('#biddername'+ i).on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9&-/_ ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
     }
   });
}

var biddermobnumbercount = $(".mobile-valid").length;

    for (let i = 1; i <= biddermobnumbercount; i++) {

    $(document).on('input','#prebidmobile'+ i,function(){
        var phone=$('#prebidmobile'+ i).val();
        if(phone.indexOf('0')==0){
        swal(" ", "First number must not be 0", "error");
         $('#prebidmobile'+ i).val('');
        }
       if(phone.length>10){
         swal(" ", "Please put 10  digit mobile number", "error");
         $('#prebidmobile'+ i).val('');
       }

    });
}



var bidderlandnumbercount = $(".mobile-valid").length;

    for (let i = 1; i <= bidderlandnumbercount; i++) {

    $(document).on('input','#prebidlandnum'+ i,function(){
        var phone=$('#prebidlandnum'+ i).val();
        if(phone.indexOf('0')==0){
        swal(" ", "First number must not be 0", "error");
         $('#prebidlandnum'+ i).val('');
        }
       if(phone.length>10){
         swal(" ", "Please put 10  digit mobile number", "error");
         $('#prebidlandnum'+ i).val('');
       }

    });
}



var bidderstdcount = $(".mobile-valid").length;

    for (let i = 1; i <= bidderstdcount; i++) {

    $(document).on('input','#prebidlstd'+ i,function(){
       var phone=$('#prebidlstd'+ i).val();
       if(phone.length>10){
         swal(" ", "Please put 10  digit STD Code", "error");
         $('#prebidlstd'+ i).val('');
       }

    });
}




// ===================

   function checkSubmitStatus( event ){
       $('.error').hide();
       
        $('#bidder_ref_number').find('.bidderrefno').each(function (i, input) {

            var $input = $(input);

            if ($(input).val() == '') {
                $(input).after("<span class='error' style='color:#ff0000'>Please Enter Bidder Ref No/Name.</span>");
                event.preventDefault();
            }

        });

        $('#corr_issue_date').find('.corrissuedate').each(function (i, input) {

            var $input = $(input);

            if ($(input).val() == '') {
                $(input).after("<span class='error' style='color:#ff0000'>Please Enter Corrigendum / Addendum Issuance Date.</span>");
                event.preventDefault();
            }
        });

        var bidconfirm = $('#prebid_conf').val();
        var bidvalue = $('#meeting_date').val();

        if(bidconfirm == 'Y' && bidvalue == '') {
        $('#meeting_date').after("<span class='error' style='color:#ff0000'>Please Enter Prebid Meeting date.</span>");
        event.preventDefault();
        }

       
   }

// ===================
    var maxLength = 250;
    $(document).ready(function(){
        $('#maxremarks').on('keydown keyup change', function(){
            var char = $(this).val();
            var charLength = $(this).val().length;
             if(charLength > maxLength){
                $('#warning-message').text('Length is not valid, maximum '+maxLength+' allowed.');
                $(this).val(char.substring(0, maxLength));
            }else{
                $('#warning-message').text('');
            }
        });
    });

</script>

<script type="text/javascript">
   
    function statefunc(divid) {
    var value = $('#country_'+divid).val();
    
     if (value != 0)
        {
        $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>Pre_bid_conference/getstate_list",
        datatype : 'json',
        data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>","countryId": value },
        
        success: function(data){
             
        var parsed_data = JSON.parse(data);
        $("#state_id_"+divid).empty();
        
          $val_selec ='';
          var listItems= "";

              if(parsed_data.all_states.length > 0){
                $("#state_id_"+divid).append("<option  value='0'>" +'Select  State' + "</option>");
               for (var i = 0; i < parsed_data.all_states.length; i++)
                   {
                        $("#state_id_"+divid).append(
                            "<option  value='" + parsed_data.all_states[i].state_id  + "'>" + parsed_data.all_states[i]. state_name + "</option>");

                          $val_selec ='';
                    } 
                }

                else
                {
                $("#state_id_"+divid).append("<option  value='0'>" +'Select  State' + "</option>");
                
                  $val_selec =''; 
                }

            }
        });
        }
}
</script>

<style type="text/css">
  .error {
    color: red;
    padding-bottom: 10px;
    font-weight: bold;
  }
</style>


