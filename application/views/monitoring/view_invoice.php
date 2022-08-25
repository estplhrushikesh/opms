<?php 
    $CI =& get_instance();
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
    //echo "<pre>"; print_r($project_deatail); die;


?>


<?php
  $start    = new DateTime($physical_activity_details[0]['startdate']);
  $start->modify('first day of this month');
  $end      = new DateTime($physical_activity_details[0]['enddate']);
  $end->modify('first day of next month');
  $interval = DateInterval::createFromDateString('1 month');
  $period   = new DatePeriod($start, $interval, $end);
  


$nYear = date('Y', strtotime($physical_activity_details[0]['startdate']));
$bYear = date('Y', strtotime($physical_activity_details[0]['enddate']));
foreach ($period as $month){ 
    $monthsArr[]= $month->format("M");
}
//print_r($monthsArr);
$narr =array_unique($monthsArr);
foreach ($period as $month){ 
    $monthsidArr[]= $month->format("m");
}
$narr_id =array_unique($monthsidArr);
?>
<section class="content">
        <div class="container-fluid">
            <div class="col-md-6">
                <div class="block-header">
                    <h4>Update Financial Progress Of a Project</h4>
                </div>

      
            </div>
            <!-- Basic Examples -->
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
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
                   
                        <div class="card">
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <tbody>
                                            <tr>
                                                <td>Project Name: </td>
                                                <td>
                                                    <?php
                                                    echo $project_deatail[0]['project_name'];
                                                    ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Milestone: </td>
                                                <td>
                                                    <?php
                                                    $work_item_name= $CI->work_item($project_work_item_id);
                                                    echo $work_item_name[0]['work_item_description'];
                                                    ?>
                                                    <input type="hidden" id="project_id" name="project_id" value="<?php echo $project_id; ?>">
                                                    <input type="hidden" id="work_item_id" name="work_item_id" value="<?php echo $project_work_item_id; ?>">
                                                    <input type="hidden" id="activity_id" name="activity_id" value="<?php echo $project_activity[0]['id']; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Deliverable<span style="color: red;"></span>: </td>
                                                <td>
                                                    
                                                         <?php
                                                        $activity=base64_decode($_REQUEST['activity_id']);
                                                        //$project_activity= $CI->get_activity_stage($physical_activity_details['project_activity_id']);
                                                       if($activity==0){echo "All"; }
                                                       else{ 
                                                       echo $project_activity[0]['particulars'];}
                                                        ?>
                                                    
                                                
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Start Date : </td>
                                                <td><?php $from_date = new DateTime($physical_activity_details[0]['startdate']); echo $from_date->format('jS M Y'); ?></td>
                                            </tr>
                                            <tr>
                                                <td>End Date : </td>
                                                <td><?php $end_date = new DateTime($physical_activity_details[0]['enddate']); echo $end_date->format('jS M Y'); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Project Planned Cost: </td>
                                                <td><?php echo number_format($value['planned_tot'],2);?></td>
                                            </tr>
                                            <tr>
                                                <td>Project Paid Value: </td>
                                                <td><?php echo number_format($value['tot'],2);?></td>
                                            </tr>
                                            <tr>
                                                <td>Remaining Balance: </td>
                                                <td><?php echo number_format($value['remaining'],2);?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
</div>
</div>
                    
                       <!--  <div id="activity_extra_data">
                        </div> -->                                
                                                        

           
            <!-- #END# Basic Examples -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>INVOICE</h2>
                    </div>
                    <div class="body">
                        <div class="col-md-6 col-md-offset-3 p-0">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <td> <strong> Invoice No : </strong></td>
                                    <td> <?= $invoice_data[0]['invoice_no']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td> <strong> Invoice Date : </strong></td>
                                    <td>  <?= $invoice_data[0]['invoice_date']; ?></td>
                                </tr>
                                <tr>
                                    <td> <strong> Vendor Name : </strong></td>
                                    <td><?= $invoice_data[0]['bidder_name']; ?> </td>
                                </tr>
                               
                                <tr>
                                    <td> <strong> Invoice Value : </strong></td>
                                    <td><?= $invoice_data[0]['invoice_value']; ?> </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="clearfix"></div>

                   
                


                                            <div class="header">
                            <h2> PAYMENT HISTORY </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tbody>


                                      
                                    
                                    <?php 
                                    if(!empty($paid_details)){

                                   
                                    
                                    foreach($paid_details as $details){
                                        ?>
                                 
                                    <tr>
                                  
                                  <td> <?= $details['paid_date']  ?> </td>
                                        <td>
                                            <table class="table table-bordered table-striped m-b-0">
                                                <thead>
                                                <tr>
                                                    <th> Deliverable </th>
                                                    <th style="padding: 10px 5px;"> Total Amount</th>
                                                    <th style="padding: 10px 5px;"> Paid Amount</th>
                                                    <th style="padding: 10px 5px;"> Due Amount</th>
                                                    <th style="padding: 10px 5px;"> Remarks </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                 <tr>
                                                    <td>  <?php
                                                        //$project_activity= $CI->get_activity_stage($physical_activity_details['project_activity_id']);
                                                       echo $project_activity[0]['particulars'];
                                                        ?>
                                                     </td>
                                                    <td> <i class="fa fa-rupee-sign"></i><?= $invoice_data[0]['invoice_value']?> </td>
                                                    <td> <i class="fa fa-rupee-sign"></i> <?= $details['paid_amount']  ?></td>
                                                    <td> <i class="fa fa-rupee-sign"></i> <?php
                                                    
                                                    $tot_inv=$invoice_data[0]['invoice_value'];
                                                    $tot_paid+=$details['paid_amount'];
                                                    $remaining=$tot_inv-$tot_paid;
                                                    echo $remaining;
                                                    
                                                    ?></td>
                                                    <td><?= $details['remarks']  ?> </td>
                                                </tr>
                                                                                                
                                                
                                                </tbody>
                                            </table>
                                        </td>
                                  
                                  
                                    </tr>
                                    <?php   }
                                    
                                    
                                    }else{
                                        ?>
                                        <tr>No Payement History Available</tr>
                                 <?php  } ?>

                                        </td>
                                    

                             </tbody>
                                </table>
                            </div>
                        </div>
                      
                                    </div>
            </div>




 
        
        </div>
    </section>
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
function getSelectionStart(o) {
    if (o.createTextRange) {
        var r = document.selection.createRange().duplicate()
        r.moveEnd('character', o.value.length)
        if (r.text == '') return o.value.length
        return o.value.lastIndexOf(r.text)
    } else return o.selectionStart
}
//thanks: http://javascript.nwbox.com/cursor_position/
/* function getSelectionStart(o) {
    if (o.createTextRange) {
        var r = document.selection.createRange().duplicate()
        r.moveEnd('character', o.value.length)
        if (r.text == '') return o.value.length
        return o.value.lastIndexOf(r.text)
    } else return o.selectionStart
}
</script>
    <script>
        var activity_id=$('#activity_id').val();  
            var project_id=$('#project_id').val();
            var work_item_id=$('#work_item_id').val();          
            if(activity_id > 0){
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>Monitoring/get_financial_acitivity_plan_data",
                    data: {
                        project_id:project_id, 
                        work_item_id:work_item_id,
                        activity_id:activity_id
                        },
                    dataType: "json",    
                    success: function (msg) {
                        //console.log(msg);
                         $("#act_budget").html(msg.get_activities_budget_amt);
                         $("#act_planned").html(msg.get_activities_planned_amt);
                         $("#act_remain").html(msg.get_activities_remain_amt);
                         $("#act_Weightage").html(msg.get_activities_Weightage);
                    }
                });
            }else{
                $("#act_budget").html('0.00');
                $("#act_planned").html('0.00');
                $("#act_remain").html('0.00'); 
                $("#act_Weightage").html('0.00');     
            }
    </script>

    
<script type="text/javascript">
              $(".mainweightage_key").keyup(function(){
    
                var weightageKeyId = this.id;
                var weightageVal = this.value;
                var agreementCost = '<?php echo $project_aggrement_deatail[0]['agreement_cost']; ?>';
                var result = weightageKeyId.split('_');
                var id = result[1];
                var calamtData = '';
               if(weightageVal){
                    calamtData = (parseFloat(weightageVal, 10) * parseFloat(agreementCost, 10)) / 100;
                    $("#mainamount_"+id).val(calamtData.toFixed(2));
                    maincheck_total();
               } 
            });

              $(".mainamount_key").keyup(function(){
    
                var amountKeyId = this.id;
                var amountVal = this.value;
                //alert(amountVal);
                var agreementCost = '<?php echo $project_aggrement_deatail[0]['agreement_cost']; ?>';
                var result = amountKeyId.split('_');
                var id = result[1];
                var calamtData = '';
               if(amountVal){
                    calamtData = (parseFloat(amountVal, 10) / parseFloat(agreementCost, 10)) * 100;
                    $("#mainweightage_"+id).val(calamtData.toFixed(2));
                    maincheck_total();
               } 
            });
          </script>



    <script type="text/javascript">
        function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
        return false;
    return true;
}
/* 
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
} */

//thanks: http://javascript.nwbox.com/cursor_position/

    </script>


     <script type="text/javascript">

              $(document.body).on("keyup",".weightage_key",function(){
                //alert('hi');
                var weightageKeyId = this.id;
                var weightageVal = this.value;
                var agreementCost = '<?php echo $project_aggrement_deatail[0]['agreement_cost']; ?>';
                var result = weightageKeyId.split('_');
                var id = result[1];
                var calamtData = '';
               if(weightageVal){
                    calamtData = (parseFloat(weightageVal, 10) * parseFloat(agreementCost, 10)) / 100;
                    $("#amountKey_"+id).val(calamtData.toFixed(2));
                    check_total();
               } 
            });

             
                $(document.body).on("keyup",".amount_key",function(){
                    //alert('hi');
                var amountKeyId = this.id;
                var amountVal = this.value;
                
                var agreementCost = '<?php echo $project_aggrement_deatail[0]['agreement_cost']; ?>';
                var result = amountKeyId.split('_');
                var id = result[1];
                // alert(id);
                var calamtData = '';
               if(amountVal){
                    calamtData = (parseFloat(amountVal, 10) / parseFloat(agreementCost, 10)) * 100;
                    //alert(calamtData);
                    $("#weightage_"+id).val(calamtData.toFixed(2));
                    check_total();
               } 
            });



                function check_total(){
            var releasedTotalAmount = 0.00;
            var activityBudgetAmount = $("#activityBudgetAmount").val();
            $('#activity_details').find('.amount_key').each(function(index, element) {
                releasedTotalAmount +=parseFloat(element.value);
                //console.log(earnedTotalAmount);
                $("#releasedTotalAmount").html(releasedTotalAmount.toFixed(2));
            })
            var releasedTotalPercent = 0.00;
            $('#activity_details').find('.weightage_key').each(function(index, element) {
                releasedTotalPercent +=parseFloat(element.value);
                //console.log(earnedTotalAmount);
                $("#releasedTotalPercent").html(releasedTotalPercent.toFixed(2));
            })


        }
          </script>