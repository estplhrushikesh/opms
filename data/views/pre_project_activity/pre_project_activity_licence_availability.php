    
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
                          <span class="label">Pre Project Activities</span>
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
                  
<?php echo form_open_multipart('Pre_project_activity_licence_availability/manage', array('name' => 'Pre_project_activity_licence_availability','id' => 'Pre_project_activity_licence_availability')); ?>
<input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" />


			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Licence Availability </h2>
                        </div>

                        <div class="body">
                   <!--         <div class="row clearfix m-b-30"> 
                            <div class="col-md-4">
                                <p>
                                    <b>Utility Shifting ( PH / RWSS )  <span class="col-pink">* </span></b>
                                </p>
                                 <select class="form-control show-tick">
                                    <option>Select PH/RWSS</option>
                                    <option>PH</option>
                                    <option>RWSS</option>
                                </select>
                            </div>
                           </div> -->
                            
                            <div class="row clearfix">
                              <!-- here -->
                              <div class="col-md-4">
                                    <p>
                                        <b>Department Approval <span class="col-pink">*</span></b>
                                    </p>
                                    
                                    <input type="hidden" name="landalination_id" value="<?php echo $get_env_clearance[0]['id'] ?>">
                                    
                                    <input class="form-control"  name="dept_approve" id="dept_approve" type="text" value="<?php if(empty($get_env_clearance)){ echo set_value('dept_approve'); }?><?php echo $get_env_clearance[0]['dept_approve'] ?>"  placeholder="Department Approval">
                                    <input type="hidden" id="total_area_hidden">
                                    <?php echo form_error('dept_approve', '<div class="error">', '</div>'); ?>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>Department Budget <span class="col-pink">*</span></b>
                                    </p>
                                    
                                  
                                    
                                    <input class="form-control"  name="dept_budge" id="dept_budge" type="text" value="<?php if(empty($get_env_clearance)){ echo set_value('dept_budge'); }?><?php echo $get_env_clearance[0]['dept_budge'] ?>"  placeholder="Department Budget">
                                    <input type="hidden" id="total_area_hidden">
                                    <?php echo form_error('dept_budge', '<div class="error">', '</div>'); ?>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>Department Stake Holder <span class="col-pink">*</span></b>
                                    </p>
                                    
                                  
                                    
                                    <input class="form-control"  name="dept_stakehold" id="dept_stakehold" type="text" value="<?php if(empty($get_env_clearance)){ echo set_value('dept_stakehold'); }?><?php echo $get_env_clearance[0]['dept_stakehold'] ?>"  placeholder="Department Stake Holder">
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
                                     <input type="text" name="target_date" value="<?php if(empty($get_env_clearance)){ echo set_value('target_date'); }?><?php echo $get_env_clearance[0]['target_date'] ?>" class="datepicker form-control" placeholder="Please choose a date...">
                                </div>

                           </div>
                        </div>
               <!-- Location Details Start-->
                   
                       
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
                                     <input class="form-control txtQty limittxt_progress" name="progress" type="text" value="<?php if(empty($get_env_clearance)){ echo set_value('progress'); }?><?php echo $get_env_clearance[0]['progress_%'] ?>" placeholder="Progress">
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Activities Status </b>
                                    </p>
                                     <select class="form-control show-tick" name="activity_status">
                                        <option value="Yes" <?php echo set_select('activity_status','Yes', ( !empty($get_env_clearance[0]['activity_status']) &&
                                      $get_env_clearance[0]['activity_status'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('activity_status','No', ( !empty($get_env_clearance[0]['activity_status']) &&
                                      $get_env_clearance[0]['activity_status'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                    </select>
                                </div>
                            </div>
                             
                              
                             
                          </div>
                            
                          <div class="col-md-12  align-center">
                          <a href="<?php echo base_url();?>project_list/pip_pre_construction_activities" class="btn btn-warning waves-effect">CANCEL</a>
                              <button class="btn btn-primary waves-effect " name="submit" id="submit_btn" value="Submit"  type="submit">
                              <?php echo (empty($get_env_clearance)) ? 'SAVE' : 'Update' ?>
                            </button>

                           </div>
                           <div class="clearfix"></div>   
                        
                      </div>

                    </div>
                 </div>
               

            <!-- Select -->
            </div>
            </div>
        </div>
    </section>

    <script src="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.min.js"></script>
    <!-- #Main Content -->
  <script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);
      });



      for(let i=1; i<= 5; i++) {
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