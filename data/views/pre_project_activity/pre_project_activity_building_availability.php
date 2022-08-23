    <?php $CI =& get_instance();?>
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
                <h4>Pre Project Initiation </h4>
            </div>
            
          <!-- Steps start -->
         <div class="card clearfix">
          <div class="col-md-12">
            <div class="row ">
                <ul class="stepper stepper-horizontal p-l-10 p-r-10 m-b-0" >
                    
                    <li class="completed">
                          <span class="circle"><i class="fas fa-file"></i></span>
                          <span class="label">Concept Creation</span>
                    </li>
                    <li class="completed">
                          <span class="circle"><i class="fas fa-braille"></i></span>
                          <span class="label">DPR</span>
                    </li>
                    <li class="completed">
                          <span class="circle"><i class="fas fa-check"></i></span>
                          <span class="label">Administrative Approval</span>
                    </li>
                    <li class="active">
                          <span class="circle"><i class="fas fa-adjust"></i></span>
                          <span class="label">Pre Construction Activities</span>
                    </li>
                    
                    <li class="gray">
                          <span class="circle"><i class="fas fa-list"></i></span>
                          <span class="label">Tender</span>
                    </li>
                    
                    
                </ul>
               </div>
             </div>
           </div>         
            
    <!-- Steps end -->     
            
   
   <?php
    if(is_numeric($project_id)){
        project_info($project_id);
    }

    ?> 
                   
 <!--    Project_Information End -->  
            
            
             
 <!-- Quick Nav   -->
            
  <?php project_quick_nav($project_id);  ?>  
            
<!-- Quick Nav end -->           
                     
<?php echo form_open_multipart('Pre_project_activity_building_availability/manage', array('name' => 'Pre_consttruction_activity_government_land_alienation','id' => 'Pre_consttruction_activity_government_land_alienation')); ?>
    <input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" />
			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Building Availability </h2>
                        </div>

                        <div class="body">
                            <div class="row clearfix">
                               <div class="col-md-4">
                                    <p>
                                        <b>Department Approval <span class="col-pink">*</span></b>
                                    </p>
                                    
                                    <input type="hidden" name="landalination_id" value="<?php echo $get_utility_elec[0]['id'] ?>">
                                    
                                    <input class="form-control"  name="dept_approve" id="dept_approve" type="text" value="<?php if(empty($get_utility_elec)){ echo set_value('dept_approve'); }?><?php echo $get_utility_elec[0]['dept_approve'] ?>"  placeholder="Department Approval">
                                    <input type="hidden" id="total_area_hidden">
                                    <?php echo form_error('dept_approve', '<div class="error">', '</div>'); ?>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>Department Budget <span class="col-pink">*</span></b>
                                    </p>
                                    
                                  
                                    
                                    <input class="form-control"  name="dept_budge" id="dept_budge" type="text" value="<?php if(empty($get_utility_elec)){ echo set_value('dept_budge'); }?><?php echo $get_utility_elec[0]['dept_budge'] ?>"  placeholder="Department Budget">
                                    <input type="hidden" id="total_area_hidden">
                                    <?php echo form_error('dept_budge', '<div class="error">', '</div>'); ?>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>Department Stake Holder <span class="col-pink">*</span></b>
                                    </p>
                                    
                                  
                                    
                                    <input class="form-control"  name="dept_stakehold" id="dept_stakehold" type="text" value="<?php if(empty($get_utility_elec)){ echo set_value('dept_stakehold'); }?><?php echo $get_utility_elec[0]['dept_stakehold'] ?>"  placeholder="Department Stake Holder">
                                    <input type="hidden" id="total_area_hidden">
                                    <?php echo form_error('dept_stakehold', '<div class="error">', '</div>'); ?>
                                </div>
                                
                                <!-- <div class="col-md-4">
                                    <p>
                                        <b>Department Budget</b>
                                    </p>
                                    <input class="form-control chronly" name="department_id" type="text" value="" placeholder="Department Budget">
                                </div> -->

                                
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Department Go Live Target Date </b>
                                    </p>
                                    <?php echo form_error('target_date', '<div class="error">', '</div>'); ?>
                                     <input type="text" name="target_date" value="<?php if(empty($get_utility_elec)){ echo set_value('target_date'); }?><?php echo $get_utility_elec[0]['target_date'] ?>" class="datepicker form-control" placeholder="Please choose a date...">
                                </div>

                             </div>
                        </div>
                    </div>
                        
                        
                    
                    
                  
                        
                      <div class="card">   
                        <div class="header">
                          <h2> Status Of Progress</h2>
                        </div>
                        
                        <div class="body"> 
                          <div class="cloneBox1 m-b-15">
                            <div class="row clearfix">
                               

                               <div class="col-md-4">
                                    <p>
                                        <b>Progress %</b>
                                    </p>
                                    <?php echo form_error('progress', '<div class="error">', '</div>'); ?>
                                     <input class="form-control txtQty limittxt_progress" name="progress" type="text" value="<?php if(empty($get_utility_elec)){ echo set_value('progress'); }?><?php echo $get_utility_elec[0]['progress_%'] ?>" placeholder="Progress">
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Activities Status </b>
                                    </p>
                                     <select class="form-control show-tick" name="activity_status">
                                        <option value="Yes" <?php echo set_select('activity_status','Yes', ( !empty($get_utility_elec[0]['activity_status']) &&
                                      $get_utility_elec[0]['activity_status'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('activity_status','No', ( !empty($get_utility_elec[0]['activity_status']) &&
                                      $get_utility_elec[0]['activity_status'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                    </select>
                                </div>
                            </div>
                             
                              
                             
                          </div>
                            
                          <div class="col-md-12  align-center">
                          <a href="<?php echo base_url();?>project_list/pip_pre_construction_activities" class="btn btn-warning waves-effect">CANCEL</a>
                              <button class="btn btn-primary waves-effect " name="submit" id="submit_btn" value="Submit"  type="submit">
                              <?php echo (empty($get_utility_elec)) ? 'SAVE' : 'Update' ?>
                            </button>

                           </div>
                           <div class="clearfix"></div>   
                        
                      </div>

                    </div>
                 </div>
                

            <!-- Select -->
            </div>
        </form>

            <!-- Select -->
            </div>
        </div>
    </section>
    <!-- #Main Content -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

  <!-- Select2 -->
<script src="<?php echo base_url();?>assets/plugins/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.min.js"></script>
    <?php
          if(empty($utility_location_data)){
            $cnt6 = 1;
          }else{
              $cnt6 = $get_same_datacnt;
            }
          ?>
          
<script type="text/javascript">
</script>
            <script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);
    
   var dividcnt = <?php echo $cnt6; ?>;
   
   var i = <?php echo $cnt6; ?>;
for (i = 1; i <= <?php echo $cnt6; ?>; i++) {
   
//$('#tehsil_id_'+i).select2({dropdownAutoWidth : true});
$('#ulb_id_'+i).select2({dropdownAutoWidth : true});
  
}
    
});

 $("#poles_tobe_shifted").keyup(function() {
    //alert($(this).val());
    var poles_tobe_shifted_area = $(this).val();
    $("#poles_tobe_shifted_hidden").val(poles_tobe_shifted_area);
    //alert(poles_tobe_shifted_area);
  });   
  
  $(".txtQty").keyup(function() {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));        
});
var ex_val = $('.limittxt_progress').val();
if(ex_val > 100) {
    $('.limittxt_progress').val('0');
}
$('.limittxt_progress').keyup(function(){
  if ($(this).val() > 100){
    alert("No numbers above 100");
    $(this).val(ex_val);
  }
});

//valication for Total Area To be Alienated 
$('#progress_noof_poles_shifted').keyup(function(){
 var curval = $(this).val();
 //alert(curval);
  var hidden_area = $("#poles_tobe_shifted_hidden").val();
  if(hidden_area == '') {
     hidden_area = $("#poles_tobe_shifted").val();
  }
  if ( parseInt(curval) > parseInt(hidden_area) ){
    alert("Number of Poles Shifted should less than Total Poles To be Shifted");
    $(this).val(0);
  }
});


</script>

<script type="text/javascript">

  
   var divid = <?php echo $cnt6; ?>;
   //alert(divid);
   var optionValues = $("#hidden_dist_fetch").html();

      $('#container1').on('click','#newField_' + divid, function () {
        divid++;
        var ndiv = divid -1;
          var newthing = '<div id="newAdd_'+divid+'"><div class="col-md-12 p-0 mt-10px"><div class="col-md-3"><div class=""><select name="dist_id[]" id="dist_id_'+divid+'" class="form-control" onchange="tehsilFunc('+divid+');">' + optionValues + '</select></div></div><div class="col-md-3"><div class=""><select name="division_id[]" id="division_id_'+divid+'"  class="form-control" onchange="discomFunc('+divid+');"></select></div></div><div class="col-md-3"><div class=""><select class="form-control select2" id="ulb_id_'+divid+'" name="discom_id['+ndiv+'][]" multiple="multiple" style="width: 100%;"></select></div></div><div class="col-md-3"><div class="text-left"><button type="button" id="removefld_'+divid+'" data-id="'+divid+'" name="submit" class="btn btn-default btn-circle remove waves-effect  waves-float mt-25px"><i class="material-icons remove col-pink">delete</i></button></div></div></div>';
      
      
                    

         $('#container1').append(newthing);
         $('.select2').select2();
    });
  

    $('#container1').on('click','.remove', function (e) {
        e.preventDefault();
        var $this = $(this);
        var id = $this.data('id');
        //$(this).parent().remove();
       $('#newAdd_'+id).remove();

        //var nextvar = $('#newAdd_'+id).next().attr('name');

        //$("#ulb_id_").next().attr('name');

        //alert('delete called');

    });
    
   
$('#tehsil_id_1').select2({dropdownAutoWidth : true});
$('#ulb_id_1').select2({dropdownAutoWidth : true});

</script>

<script type="text/javascript">
  function tehsilFunc(divid) {
    var value = $('#dist_id_'+divid).val();
$("#ulb_id_"+divid).empty();
if (value != 0)
    {
    $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>Pre_consttruction_activity_utility_shifting_electrical/getelectrical_divison",
    datatype : 'json',
    data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>","distId": value },
    
    success: function(data){
      //alert(data);

      
      
      
                            var parsed_data = JSON.parse(data);
                            $("#division_id_"+divid).empty();
                            
                              $val_selec ='';
                            var listItems= "";
                    //alert(parsed_data.all_divison.length);
                    if(parsed_data.all_divison.length > 0)
                    {

                               $("#division_id_"+divid).append("<option value=0>Please select Division</option>");
                               for (var i = 0; i < parsed_data.all_divison.length; i++)
                                      {
                    $("#division_id_"+divid).append("<option value='" + parsed_data.all_divison[i].id  + "'>" + parsed_data.all_divison[i]. division_name + "</option>");
                    $('#xamwise_subjectlist').html('').prepend();
                      $val_selec ='';
                                      } 
                    }
                    else
                    {
                    $("#division_id_"+divid).append("<option  value=''>" +'Select Another Division' + "</option>");
                    
                      $val_selec =''; 
                    }
                              
                            
      }
    });
    }
}

 function discomFunc(divid) {
    var value = $('#division_id_'+divid).val();
$("#ulb_id_"+divid).empty();
if (value != 0)
    {
    $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>Pre_consttruction_activity_utility_shifting_electrical/getdiscom_list",
    datatype : 'json',
    data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>","division_id": value },
    
    success: function(data){

      
      
                            var parsed_data = JSON.parse(data);
                            
                            
                              $val_selec ='';
                            var listItems= "";
                    if(parsed_data.all_discom.length > 0)
                    {
                      $("#ulb_id_"+divid).empty();
                               for (var i = 0; i < parsed_data.all_discom.length; i++)
                                      {
                    $("#ulb_id_"+divid).append("<option  value='" + parsed_data.all_discom[i].id  + "'>" + parsed_data.all_discom[i]. discom_name + "</option>");
                      $val_selec ='';
                                      } 
                    }
                    else
                    {
                    $("#ulb_id_"+divid).append("<option  value=''>" +'All Discom' + "</option>");
                    
                      $val_selec =''; 
                    }
                              
                            
      }
    });
    }
}

      for(let i=1; i<= 4; i++) {
       $('#uploadFile'+i).change(function () {
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
    }

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
            <style type="text/css">
      .error {
        color: red;
        padding-bottom: 10px;
        font-weight: bold;
      }
    </style>