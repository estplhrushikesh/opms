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


       <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
                        <div class="card">
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <tbody>
                                        <tr>
                                        <?php
                                               $tot=0;
                                               foreach($invoice_list as $inv){
                                                $tot+=$inv['invoice_value'];
                                               }
                                               $remaining=$value['planned_tot']-$tot;

                                          ?>
                                                <td style="width:50%;">Total Invoice Created: </td>
                                                <td style="width:50%;"><?php echo number_format($tot,2);?></td>
                                            </tr>
                                            <tr>
                                                <td style="width:50%;">Remaining Value: </td>
                                                <td style="width:50%;"><?php echo number_format($remaining,2);?></td>
                                            </tr>
                                            <!-- <tr></tr> -->
                                      <!-- <tr> -->
                                            
                                        </tbody>
                                    </table>
                         


                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                         <tr> 
                                   
                                            <th style="padding: 10px 5px; width: 100px; text-align: center; vertical-align: middle;">SI No</th>
                                            <th style="padding: 10px 5px; width: 100px; text-align: center; vertical-align: middle;">Invoice no</th>
                                            <th style="padding: 10px 5px; width: 100px; text-align: center; vertical-align: middle;">Vendor</th>
                                            <th style="padding: 10px 5px; width: 200px; text-align: center; vertical-align: middle;">Total Amount(<i class="fa fa-rupee-sign"></i>)</th>
                
              
               
                                        </tr>
                                        <?php
                                        //$html;
                                        $paid_v=0;
        $remaining=0;
       // $f='';
        foreach ($invoice_list as $key => $val) {
    //echo "<pre>"; print_r($val); die(); 
    //echo "Curremt Month & Year: ".date('M Y'); die();
    $slNo = $key+1;
    $invoice_no = $val['invoice_no'];
    $invoice_date = $val['invoice_date'];
    $bidder_name = $val['bidder_name'];
    $total_amount=$val['invoice_value'];
    $invoice_id=$val['id'];
    

    //  $paid_data=$this->Monitoring_model->get_invoice_paid_details($invoice_no);
      $paid_data=$CI->invoice_paid_details($invoice_no);
     // $count_paid_invoice=$this->Monitoring_model->count_paid_rows($invoice_no);
      $count_paid_invoice=$CI->paid_rows($invoice_no);
      //print_r($paid_data);
       if(!empty($paid_data)){
        foreach($paid_data as $dat){
            //$f='hiiii';
            $paid_v+=$dat['paid_amount'];
            //if(!empty($dat['paid_amount'])){
                $remaining=$total_amount-$paid_v;
           //// }else{
                
            }
            
    
          }else{
            $remaining=$total_amount;
          }
       
    ?>
      
     <tr>
        
         <td style="text-align: center; vertical-align: middle;"><?= $slNo ?>
        </td>
         <td style="text-align: center; vertical-align: middle;"><?= $invoice_no ?>
             
         </td>
         <td style="text-align: center; vertical-align: middle;"><?= $bidder_name ?>
             
         </td>
         <td style="text-align: right; vertical-align: middle;"><?= $total_amount ?></td>
         
         
 
 
</tr>
<?php
$paid_v=0;
//$remaining=0; 
}

?>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>
</div>
<div class="row clearfix ">
            <div class="col-md-6">
                <div class="block-header">
                    <h4>ADD INVOICE DETAILS  </h4>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Sample Project 1 </h2>
                    </div>
                    <?php echo form_open('Monitoring/add_invoice',array('name'=> 'add_project_amount','id'=>'add_project_amount')) ?>
                    <div class="body">
                 

                        <div class="section_clone">
                            <div class="row clearfix cloneBox1">

                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge" style="vertical-align:middle; padding-top:8px;"> Invoice No : </label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-line">
                                        <input type="hidden" id="project_id" name="d" value="<?php echo $project_id; ?>">
                                                    <input type="hidden" id="e" name="e" value="<?php echo $project_work_item_id; ?>">
                                                    <input type="hidden" id="f" name="f" value="<?php echo $activity_id; ?>">
                                              
                                            <input type="text" id="invoice_no" name="invoice_no" class="form-control" placeholder="Invoice No">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class=" input-xlarge" style="vertical-align:middle; padding-top:8px;"> Invoice Date : </label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <input type="text" id="invoice_date" name="invoice_date" class="datepicker form-control" placeholder="Invoice Date" data-dtp="dtp_MLfId">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge" style="vertical-align:middle; padding-top:8px;"> Amount (₹): </label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <input type="text" id="total_invoice_amount"  name="invoice_value" class="form-control txtQty" placeholder="Claimed Amount">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge" style="vertical-align:middle; padding-top:8px;"> Vendor's Name : </label>
                                    </div>
                                    <div class="col-md-4">
                                    <input type="text" id="total_invoice_amount"  value="<?= $bidder_data[0]['successful_bidder_ref_no'] ?>" name="bidder_name" class="form-control" readonly placeholder="Bidder Name">
                                    </div>
                                </div>

                              


                                <div class="col-sm-12">
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge" style="vertical-align:middle; padding-top:8px;">
                                            Remarks, if any :
                                        </label>
                                    </div>

                                    <div class="col-md-10">
                                        <div class="form-line">
                                            <textarea name="remarks" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            

                            <div class="row">
                             
                             <div class="col-md-12 align-center">
                                 <a href="<?php echo base_url().'Monitoring/add_financial_monitoring?project_id='.base64_encode($project_id).'&project_work_item_id='.base64_encode($project_work_item_id)?>" class="btn btn-warning waves-effect">Back</a>
                                  <button class="btn btn-primary waves-effect "name="submit"  value="ADD"  type="submit">Add</button>
                                 
                             </div>
                         </div>
                        
                        </div>
                        
                    </div>
                    </form>
                </div>
            </div>





       <!--  </div> -->           
                       <!--  <div id="activity_extra_data">
                        </div> -->                                
                                                        

           
            <!-- #END# Basic Examples -->




 
        
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

$(".txtQty").keyup(function() {
        var $this = $(this);
        $this.val($this.val().replace(/[^\d.]/g, ''));        
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