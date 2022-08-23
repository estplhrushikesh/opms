<?php $CI =& get_instance();
$work_item_name= $CI->work_item($project_work_item_id);
$financial_budget= $CI->get_financial_budget($project_id,$project_work_item_id);
$financial_planned=$CI->work_item_financial_planned_amount($project_id,$project_work_item_id,$project_activity_id);


 
?>
<section class="content">
        <div class="container-fluid">
          <div class="col-md-6">
            <div class="block-header">
              <h4>Financial Budget</h4>
             
            </div>
          </div>
          <div class="col-md-6" style="text-align: right;">
              <?php 
                     $pro_activity_cnt = $CI->count_data_against_project('project_pf_activities','project_id',$project_id,'status','Y');
                     $pro_work_item_cnt = $CI->count_data_against_project('project_work_items','project_id',$project_id,'status','Y');

                    ?>

                    <div class="notification">
                      <a href="<?php echo base_url();?>pf_planning/project_work_item?project_id=<?php echo base64_encode($project_id);?>" class="btn btn-warning waves-effect" title="Milestone"><i class="fas fa-cubes"></i> Milestone</a>
                      <?php if($pro_work_item_cnt > 0){ ?>
                      <span class="label-count2 bg-blue"><?php echo $pro_work_item_cnt; ?></span>
                      <?php } ?>
                      </div>

                      <div class="notification">
                      <a href="<?php echo base_url();?>pf_planning/project_activity?project_id=<?php echo base64_encode($project_id);?>" class="btn btn-success waves-effect" title="Deliverables"><i class="fas fa-boxes"></i> Deliverables</a>
                      <?php if($pro_activity_cnt > 0){ ?>
                      <span class="label-count2 bg-blue"><?php echo $pro_activity_cnt; ?></span>
                  <?php } ?>
                      </div>

                      

                      <a href="<?php echo base_url();?>pf_planning/project_planning?project_id=<?php echo base64_encode($project_id);?>#planning" class="btn btn-primary waves-effect" title="Planning"><i class="fas fa-sliders-h"></i> Planning</a>
            </div>


                <!-- Alert Message -->
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
    <?php if($this->session->flashdata('message')){ ?>
        <div class="alert alert-success alert-dismissible text-center fade-message">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php } if($this->session->flashdata('danger')){ ?>
        <div class="alert alert-danger alert-dismissible text-center fade-message">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <?php echo $this->session->flashdata('danger'); ?>
          </div>
      <?php } ?>
        </div>        
        
    </div>
    <!-- End Alert Message -->
          
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                    <div class="body">
                      <div class="table-responsive">
                          <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <tbody>
                                        <tr>
                                            <td width="40%"><strong>Project Name : </strong></td>
                                            <td><?php echo $project_deatail[0]['project_name'];?></td>
                                        </tr>
                                        <?php 
                                          $project_area= $CI->project_area($project_deatail[0]
                                            ['project_area']);
                                          $project_type= $CI->project_type($project_deatail[0]
                                            ['project_type']);

                                        ?>
                                        <!-- <tr>
                                            <td><strong>Location : </strong></td>
                                            <td><?php echo $project_area[0]['name'];?></td>
                                        </tr> -->
                                        <tr>
                                            <td><strong>Type : </strong></td>
                                            <td><?php echo $project_type[0]['project_type'];?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Project Cost (<i class="fas fa-rupee-sign"> </i>) : </strong></td>
                                            <td><?php echo number_format($project_aggrement_deatail[0]['agreement_cost'],2);?></td>
                                        </tr>
                                        <tr>
                                        <th scope="row">Start Date:</th>
                                        <td><?php $from_date = new DateTime($project_aggrement_deatail[0]['project_start_date']); echo $from_date->format('jS M Y'); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">End Date:</th>
                                        <td><?php $from_date = new DateTime($project_aggrement_deatail[0]['project_end_date']); echo $from_date->format('jS M Y'); ?></td>
                                    </tr>
                                        <tr>
                                            <td><strong>Milestone Name: </strong></td>
                                            <td><?php echo $work_item_name[0]['work_item_description'];?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Project Planned Value (<i class="fas fa-rupee-sign"> </i>) : </strong></td>
                                            <td><?php 
                                            $planned_value=$CI->planned_value($project_id);
                                            
                                            
                                            echo number_format($planned_value['total'],2);?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Project Remaining Value (<i class="fas fa-rupee-sign"> </i>) : </strong></td>
                                            <td><?php echo number_format($planned_value['remaining'],2);?></td>
                                        </tr>
                                        
                            </tbody>
                          </table>
                
                      </div>
                    </div>
            
                   
                  </div>    
          <div class="block-header">
           <h4>Financial Planning for Milestone <?php echo $work_item_name[0]['work_item_description'];?></h4>
          </div>

         <!--  ======================== -->
         
          <div class="card">
                        <div class="header">
                          <h2>Add a Financial Activity</h2>
                        </div>
                        <div class="body">
                          <?php echo form_open('pf_planning/add_financial_planning',array('name'=> 'add_financial_planning','id'=>'add_financial_planning')); ?>
                              <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                   
                                    <thead>
                                        <tr>
                                            <th>Milestone  Name:<span style="color: red;">*</span> 
                                            </th>
                                            <th>Deliverables<span style="color: red;">*</span> </th>
                                            <th>Planned (%):<span style="color: red;">*</span> 
                                            </th>
                                            <th>Planned Value (<i class="fa fa-rupee-sign"></i>)<span style="color: red;">*</span> </th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                            <input type="hidden" id ="project_id" name="project_id" value="<?php echo ($project_id); ?>">
                                            <input type="hidden" id="project_work_item_id" name="project_work_item_id" value="<?php echo ($project_work_item_id); ?>">

                                            <input type="text" class="form-control" name="milestone_name" value="<?php echo $work_item_name[0]['work_item_description'];?>">
                                            <input type="hidden" name="" value="<?php echo $work_item_name[0]['id'];?>"> 


                                        </td>
                                             

                                            <td> 
                                            <?php $count= $CI->get_activity_all_or_not($project_id,$project_work_item_id); 
                                                //  $count_row= $CI->get_deliverable_row($project_id,$project_work_item_id);
                                                  $count_physical=$CI->get_activity_all_or_not_physical($project_id,$project_work_item_id);
                                               ?>
                                                  
                                              <select class="form-control" name="deliverable_name" id="activity_id" required>
                                              <option value="">Select Activity</option>
                                              <?php if($count_physical>0){
                                                     if($count>0){

                                                     }else{
                                                      ?>
                                                        <option value="0">All</option>
                                                   <?php  }
                                                ?>
                                               
                                                <?php }else{

                                                  if($count>0){

                                                      
                                                  }else{
                                                    foreach($fetch_deliverables as $deliverable)
                                               
                                                    {
                                                     echo '<option value="'.$deliverable['id'].'">'.$deliverable['particulars'].'</option>';
                                                    }
                                                    ?>

                                              <?php    }
                                                }
                                               ?>
                                              
                                               
                                               <?php
                                                  
                                                  
                                          
                                              
                                               ?>  
                                             
                                            
                                              </select>
                                            </td>

                                            <td>

                                            <input type="text" class="form-control" placeholder="Weightage" name="weightage" id="weightage" onkeypress="return validateFloatKeyPress(this,event);" value="<?php echo $financial_deliverable_details['financial_amount'];?>" /></td>

                                            <td><input type="text" class="form-control" placeholder="Planned Value" name="amount" onkeypress="return validateFloatKeyPress(this,event);" id="amount"  pattern="[+-]?([0-9]*[.])?[0-9]+" value="<?php 
                                            if(!empty($project_activity_detail_edit[0]['amount']))
                                            {echo number_format($project_activity_detail_edit[0]['amount'],2);}
                                            else{echo "";}?>"/></td>

                                            
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="col-md-2 col-md-offset-5" style="margin-top: 5px;">
                                   <input type="submit" name="submit" value="SAVE" class="btn bg-indigo waves-effect" />
                                   <a href="javascript:window.history.back();" title="Go back to previous page"  class="btn bg-indigo waves-effect"><span> BACK </span></a>
                                </div>
                              </div>
                            </form>
                        </div>
                    </div>


            

            <div class="card">
             <div class="body">
                <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                   <thead>
                                        <tr>
                                            <th style="text-align: center; width: 40px">Sl No</th>
                                            <th style="text-align: center; width: 175px">Milestone </th>
                                            <th style="text-align: center; width: 175px">Deliverables </th>
                                            <th style="text-align: center; width: 40px">Planned (%)</th>
                                            <th style="text-align: center; width: 40px">Planned Value (<i class="fa fa-rupee-sign"></i>)</th>
                                            
                                            <!-- <th style="text-align: center; width: 80px; " >Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($project_financial_activity_deatail)){ 

                                        $i=1;
                                         foreach($project_financial_activity_deatail as 
                                                  $activity_deatail){

                                         ?>

                                          <tr>
                                            
                                            <td ><?php echo $i;?></td>
                                            <td><?php echo $activity_deatail['milestone_name'];?></td>
                                            <td><?php if($activity_deatail['particulars'] == ""){
                                                         echo "All"; 
                                                   }else{
                                                       echo $activity_deatail['particulars'];
                                            } ?></td>
                                            <td><?php echo $activity_deatail['weightage'];?></td>
                                            <td><?php echo $activity_deatail['financial_amount'];?></td>
                                            <!-- <td></td> -->
                                          </tr>

                                       <?php $i++;} }else{?> 
                                         <tr>
                                            <td colspan="6">No Data Found</td>
                                         </tr>
                                       <?php } ?>
                                    </tbody>
                                </table>

                </div>
                
              </div>
          </div>




          <!--  ======================== -->
          <!-- <div class="card">
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                      <thead>
                          <tr>
                              <th style="text-align: center;">Sl No</th>
                              <th style="text-align: center;">Work Activity</th>
                              <th style="text-align: center;">Cost</th>
                              <th style="text-align: center;">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                              <?php if(!empty($project_activity_deatail)){
                               $i=1;
                               foreach($project_activity_deatail as $activity_deatail){

                                $project_activity_id=$activity_deatail['id'];

                                $financial_detail=$CI->get_financial_main($project_id,$project_work_item_id,$project_activity_id);
                              ?>
                              <tr>
                                <td><?php echo $i;?></td>
                                <td>
                                  <a href="#" data-toggle="modal" data-target="#exampleModal" style="color: #555" onclick="get_activity_wise_workitem_breakup('<?php echo $project_id;?>','<?php echo $activity_deatail['id'];?>','<?php echo $activity_deatail['particulars'];?>')"><?php echo $activity_deatail['particulars'];?></a>
                                </td>
                                <td align="right"><?php echo number_format($financial_detail[0]['total_activity_budget_amount'],2);?></td>
                                
                                <td>
                                <?php if(!empty($financial_detail)){ ?>
                                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="get_activity_details('<?php echo $project_id; ?>','<?php echo $project_work_item_id; ?>','<?php echo $project_activity_id; ?>','<?php echo $activity_deatail['particulars']; ?>','<?php echo $work_item_name[0]['work_item_description'];?>')">VIEW DETAILS</button>
                                  <a href="<?php echo base_url(); ?>pf_planning/add_financial_planning?project_id=<?php echo $_REQUEST['project_id'];?>&project_work_item_id=<?php echo base64_encode($project_work_item_id); ?>&project_activity_id=<?php echo base64_encode($project_activity_id); ?>&project_financial_id=<?php echo base64_encode($financial_detail[0]['id']); ?>" class="m-r-10"> <i class="fas fa-edit"></i> </a>
                                  <a href="<?php echo base_url(); ?>pf_planning/delete_financial_planning?project_id=<?php echo base64_encode($project_id); ?>&project_work_item_id=<?php echo base64_encode($project_work_item_id); ?>&activity_id=<?php echo base64_encode($project_activity_id); ?>&project_financial_id=<?php echo base64_encode($financial_detail[0]['id']); ?>" class="col-black" onclick="return confirm('All PV, EV, AC data related to selected Activity will be deleted and cannot be reverted back!\n Are you want to sure?')"> <i class="fas fa-trash"></i> </a>
                                <?php }else{ ?>
                                    <a href="<?php echo base_url(); ?>pf_planning/add_financial_planning?project_id=<?php echo $_REQUEST['project_id'];?>&project_work_item_id=<?php echo base64_encode($project_work_item_id); ?>&project_activity_id=<?php echo base64_encode($project_activity_id); ?>"  class="btn btn-primary"><span>CREATE FINANCIAL PLAN</span></a>
                                <?php } ?>

                                </td>
                              </tr>
                                        <?php 
                                               $i++;
                                             }
                                        ?>
                                        
                                       <?php }else{?> 
                                         <tr>
                                            <td colspan="4">No Data Found</td>
                                         </tr>
                                       <?php } ?>
                                    </tbody>
                    </table>
                                
                 

                </div>
            </div>
          </div> -->
                    
                </div>
            </div>
            <!-- #END# Basic Examples -->

        </div>
    </section>

    


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body" style="max-height: 400px; overflow: auto;"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">

      function get_activity_wise_workitem_breakup(project_id,activity_id,activity_name){      
        $.ajax({
          type: "POST",
          url: "<?php echo base_url();?>pf_planning/get_workitem_wise_breakup", 
          data: {project_id: project_id,activity_id: activity_id,activity_name:activity_name,type:"financial"},
          success: function(data) {
            $('.modal-body').html(data);
          }
        });
      }

      function get_activity_details(project_id,work_item_id,activity_id,activity_name,workitem_name){      
        $.ajax({
          type: "POST",
          url: "<?php echo base_url();?>pf_planning/get_activity_month_details", 
          data: {project_id: project_id,work_item_id: work_item_id,activity_id:activity_id,activity_name:activity_name,workitem_name:workitem_name},
          success: function(data) {
            $('.modal-body').html(data);
          }
        });
      }



    </script>


            <!-- Alert Page js for hide alert  -->
<script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);

});
</script>




<!-- ENd Alert Page js for hide alert  -->

<script type="text/javascript">
    $(document).ready(function(){
  $("#weightage").keyup(function(){
    var calamt = 0.00;
    var weightage = this.value;
    var agreementcost = '<?php echo $project_aggrement_deatail[0]['agreement_cost']; ?>'
    if(weightage){
        calamt = (parseFloat(agreementcost, 10) / 100) * parseFloat(weightage, 10);
        //console.log(calamt);
        $("#amount").val(calamt);
    }
  });

  $("#amount").keyup(function(){
    var get_cal_amt = this.value;
    var nweitage = 0.00;
  var agreementcost = '<?php echo $project_aggrement_deatail[0]['agreement_cost']; ?>'
  if(get_cal_amt){
        nweitage = (parseFloat(get_cal_amt, 10) / parseFloat(agreementcost, 10)) * 100;
        //console.log(calamt);
        $("#weightage").val(nweitage.toFixed(2));
    }
  });

  var get_cal_amt = $("#amount").val();
  var nweitage = 0.00;
  var agreementcost = '<?php echo $project_aggrement_deatail[0]['agreement_cost']; ?>'
  if(get_cal_amt){
        nweitage = (parseFloat(get_cal_amt, 10) / parseFloat(agreementcost, 10)) * 100;
        //console.log(calamt);
        $("#weightage").val(nweitage.toFixed(2));
    }

});
</script>
<script>
    function allowNumbersOnly(e) {
        var code = (e.which) ? e.which : e.keyCode;
        if (code > 31 && (code < 48 || code > 57)) {
            e.preventDefault();
        }
    }

    function validateFloatKeyPress(el, evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    var number = el.value.split('.');
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    //just one dot
    if(number.length>1 && charCode == 46){
         return false;
    }
    //get the carat position
    var caratPos = getSelectionStart(el);
    var dotPos = el.value.indexOf(".");
    if( caratPos > dotPos && dotPos>-1 && (number[1].length > 1)){
        return false;
    }
    return true;
}

//thanks: http://javascript.nwbox.com/cursor_position/
function getSelectionStart(o) {
    if (o.createTextRange) {
        var r = document.selection.createRange().duplicate()
        r.moveEnd('character', o.value.length)
        if (r.text == '') return o.value.length
        return o.value.lastIndexOf(r.text)
    } else return o.selectionStart
}
</script>

<script>
    
    $("#activity_id").change(function(){
            var activity_id=$('#activity_id').val();  
            var project_id=$('#project_id').val();
            var project_work_item_id=$('#project_work_item_id').val();
            var weightage=$('#weightage').val();          
            if(activity_id > 0){
                //$("#activity_details").html('<p>Processing...</p>');
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>pf_planning/get_earned_financial_deliverable_data",
                    data: {
                        project_id:project_id, 
                        project_work_item_id:project_work_item_id,
                        activity_id:activity_id,
                        weightage:weightage
                        },
                    dataType: "json",    
                    success: function (msg) {
                       // console.log(msg);
                        $("#activity_details").html(msg.html);
                        
                      
                    }

                });
            }else{
                $("#activity_details").html('');    
            }
             
        });
</script>



