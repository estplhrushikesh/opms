<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
class Monitoring extends MY_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->library('session');
		$this->load->library('pagination');	  
		$this->load->helper('form');
        
        $this->load->model('Monitoring_model');
        $this->load->model('Project_model');
        /*To Check whether logged in */
        $logged_in= $this->session->userdata('is_logged_in');
        if(empty($logged_in)){
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        /*End fo Check whether logged in */
    }
    public function get_activity_all_or_not($pid,$wid){
        //echo $pid;
       // echo $wid;
        //exit;

        return $this->Monitoring_model->activity_all_or_not($pid,$wid);
    }
    
    /* Project List For Monitoring */
    public function project_monitoring_list() {
        $user_id = $this->session->userdata('id');
        $user_type = $this->session->userdata('user_type');
        $circle_id = $this->session->userdata('circle_id');
        $division_id = $this->session->userdata('division_id');

        $data['project_deatail'] = $this->Monitoring_model->get_monitoring_project_list($user_id,$circle_id,$division_id);
    	$this->load->common_template('monitoring/project_monitoring_list',$data);
    }
    /* Project List For Monitoring End*/

    /* Project Destination */
    public function get_destination(){
        $area_id= $_REQUEST['area_id'];
        $destination=$this->Project_model->get_project_destination($area_id);
        $html="";
        //$html.="<option value=''>Select Project Destination</option>";
        foreach($destination as $des){
           $html.="<option value='".$des['id']."'>".$des['name']."</option>";
        }
        echo $html;
        die;
     }
    /* Project Destination End*/ 

    /* Project Type */
     public function project_type($type_id){
        return $this->Project_model->get_project_type($type_id);
     }
    /* Project Type End */   

    /* Project Area */
     public function project_area($area_id){
        return $this->Project_model->get_project_area($area_id);
     }
    /* Project Area End */ 

    /*Financial Monitoring Listing*/
    public function financial_listing(){
        $project_id=base64_decode($_REQUEST['project_id']);
        $project_work_item_id=base64_decode($_REQUEST['project_work_item_id']);
        $data['project_id']=$project_id;
        $data['project_work_item_id']=$project_work_item_id;

        $data['project_deatail'] = $this->Monitoring_model->project_details($project_id);
        $data['project_aggrement_deatail'] = $this->Monitoring_model->get_project_aggrement_details($project_id);
        $data['project_financial_deatail'] = $this->Project_model->get_project_financial_details($project_id);
        $data['project_work_item_detail'] = $this->Project_model->get_project_work_item_details($project_id);

        $data['project_other_setting_detail'] = $this->Project_model->get_project_other_setting_list($project_id);
        $data['work_item_categories'] = $this->Monitoring_model->get_work_item_categories();
        $data['project_progress_location'] = $this->Project_model->get_project_progress_location($project_id);

        $this->load->common_template('monitoring/financial_listing',$data);
     }
     /*Financial Monitoring Listing End*/

    /* Project work item name */
    public function work_item($work_item_id){

        return $this->Project_model->get_work_item_list($work_item_id);
    }
    /* Project work item name End*/ 

    /* Add Project Financial*/
    public function work_activity($activity_id){
        return $this->Project_model->project_activity_name($activity_id);
    }
    /* Add Project Financial End*/

    /*  Financial Monitor */
    public function add_financial_monitoring(){
        $project_id=base64_decode($_REQUEST['project_id']);
        $project_work_item_id=base64_decode($_REQUEST['project_work_item_id']);
        $data['project_id']=$project_id;
        $data['project_work_item_id']=base64_decode($_REQUEST['project_work_item_id']);
        $data['project_deatail'] = $this->Monitoring_model->project_details($project_id);
        $data['project_aggrement_deatail'] = $this->Monitoring_model->get_project_aggrement_details($project_id);
        $data['project_work_item_deatail'] = $this->Project_model->get_project_work_item_details($project_id);
      //  $data['project_activity_detail'] = $this->Monitoring_model->get_project_activity_details($project_id, $project_work_item_id);
        $data['project_activity_detail'] = $this->Monitoring_model->get_project_activity($project_id, $project_work_item_id);

        //echo "<pre>"; print_r($data); die;

        if(!empty($_REQUEST['submit'])){
            
            $totalAllottedAmount = 0;
            $total_target_amt = 0;
            // Updating project_financial_planning_detail and project_financial_planning_main
            foreach($_REQUEST['financialPlanningDetailId'] as $plan => $fin){
                $totalAllottedAmount += str_replace(',','',$_REQUEST['allotted'][$plan]);
            }



            /* Checking this data already exist or not */
            $where_check = array('project_id' => $_REQUEST['project_id'],'project_work_item_id' => $_REQUEST['work_item_id'],'project_activity_id' => $_REQUEST['activity_id']);
           $chk_exist = $this->Monitoring_model->check_table_data_exist_or_not_condition('project_financial_planning_main',$where_check);


           if($chk_exist > 0){
            //For update
            $financial_planning_monitoring_main['total_activity_allotted_amount']=$totalAllottedAmount;
            $financial_planning_monitoring_main['monitored_by']=$this->session->userdata('id');
            $financial_planning_monitoring_main['monitored_on']=Date('Y-m-d');

            $where_main = array('project_id' => $_REQUEST['project_id'],'project_work_item_id' => $_REQUEST['work_item_id'],'project_activity_id' => $_REQUEST['activity_id']);
            $this->Monitoring_model->updateDataCondition('project_financial_planning_main', $financial_planning_monitoring_main, $where_main);

            $main_financial_id = $this->Monitoring_model->get_any_table_specific_data('project_financial_planning_main',$where_main,'id');
           }else{
            //for add

                $financeAddData = array(
                                            'project_id' => $_REQUEST['project_id'], 
                                            'project_work_item_id' => $_REQUEST['work_item_id'], 
                                            'project_activity_id' => $_REQUEST['activity_id'],
                                            'total_activity_allotted_amount' => $totalAllottedAmount, 
                                            'status' => 'Y', 
                                            'created_by' => $this->session->userdata('id'), 
                                            'created_on' => Date('Y-m-d')
                                        );
                $main_financial_id = $this->Monitoring_model->insertDatareturnid($financeAddData,'project_financial_planning_main');

           }

           foreach($_REQUEST['financialPlanningDetailId'] as $key => $val){
                //echo $val; echo "<br>";
            $mnth_name  = $_REQUEST['month'][$key];
            $mnth_date  = $_REQUEST['month_date'][$key];

                if ($_REQUEST['allotted'][$key]==''){
                    $financial_allotted_amount = 0;
                }else{
                    $financial_allotted_amount = str_replace(',','',$_REQUEST['allotted'][$key]);
                }
                $where_detail_check = array('project_id' => $_REQUEST['project_id'],'project_work_item_id' => $_REQUEST['work_item_id'],'project_activity_id' => $_REQUEST['activity_id'],'project_financial_planning_id' => $main_financial_id,'month_name' => $mnth_name);
                $chk_detail = $this->Monitoring_model->check_table_data_exist_or_not_condition('project_financial_planning_detail',$where_detail_check);

                if($chk_detail > 0){
                    //update
                    
                    $financial_planning_monitoring['allotted_amount']=$financial_allotted_amount;
                    $financial_planning_monitoring['monitored_by']=$this->session->userdata('id');
                    $financial_planning_monitoring['monitored_on']=Date('Y-m-d');
                    $this->Monitoring_model->updateDataCondition('project_financial_planning_detail', $financial_planning_monitoring, $where_detail_check);
                }else{
                    $financeDetailsAddData = array(
                                            'project_id' => $_REQUEST['project_id'], 
                                            'project_financial_planning_id' => $main_financial_id, 
                                            'project_work_item_id' => $_REQUEST['work_item_id'], 
                                            'project_activity_id' => $_REQUEST['activity_id'], 
                                            'month_name' => $mnth_name, 
                                            'month_date' => $mnth_date,
                                            'allotted_amount' => $financial_allotted_amount,
                                            'status' => 'Y', 
                                            'created_by' => $this->session->userdata('id'), 
                                            'created_on' => Date('Y-m-d')
                                        );
                $this->Monitoring_model->insertDatareturnid($financeDetailsAddData,'project_financial_planning_detail');
                }

             }
            
              $this->session->set_flashdata('message', 'Financial  Data saved successfully');
            redirect('Monitoring/financial_listing?project_id='.base64_encode($_REQUEST['project_id']).'&project_work_item_id='.base64_encode($_REQUEST['work_item_id']));
        }else{
            $this->load->common_template('monitoring/add_financial_monitoring',$data);
        }
        
    }
    /*  Financial Monitor End*/

    /* Get Project Financial Acitivity Plan Ajax */
    public function get_financial_acitivity_plan_xhr(){
        $project_id= $_REQUEST['project_id'];
        $work_item_id= $_REQUEST['work_item_id'];
        $activity_id= $_REQUEST['activity_id'];
        $arFinancialActivityPlan=$this->Monitoring_model->get_financial_acitivity_plan($project_id, $work_item_id, $activity_id);
        $arActivityBudget=$this->Monitoring_model->get_financial_acitivity_budget($project_id, $work_item_id, $activity_id);
        
        $project_aggrement_deatail = $this->Monitoring_model->get_project_aggrement_details($project_id);
        $agreement_cost = $project_aggrement_deatail[0]['agreement_cost'];
        $financial_activity_details=$this->Monitoring_model->get_financial_act($project_id, $work_item_id, $activity_id);
        $physical_activity_details=$this->Monitoring_model->get_physical_act($project_id, $work_item_id, $activity_id);
        $invoice_list=$this->Monitoring_model->get_invoice_list($project_id, $work_item_id, $activity_id);
       // echo '<pre>';
       // print_r($financial_activity_details);
        //exit;
     
        $html='<div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6 text-right">
        <a href="'. base_url().'Monitoring/add_invoice?project_id='.base64_encode($project_id).'&work_item_id='.base64_encode($work_item_id).'&activity_id='.base64_encode($activity_id).'" class="btn bg-indigo waves-effect pull-right"><i class="fas fa-plus"></i><span> Add Invoice </span>
        </a>
        </div>
     </div> 
        
        <div class="card">
            <div class="body" style="margin-top:10px">
            <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            
        <thead>
            <tr>
                <th style="padding: 10px 5px; width: 100px; text-align: center; vertical-align: middle;">SI No</th>
                <th style="padding: 10px 5px; width: 100px; text-align: center; vertical-align: middle;">Invoice no</th>
                <th style="padding: 10px 5px; width: 100px; text-align: center; vertical-align: middle;">Vendor</th>
                <th style="padding: 10px 5px; width: 200px; text-align: center; vertical-align: middle;">Total Amount(<i class="fa fa-rupee-sign"></i>)</th>
                <th style="padding: 10px 5px; width: 200px; text-align: center; vertical-align: middle;">Paid(<i class="fa fa-rupee-sign"></i>)</th>
                <th style="padding: 10px 5px; width: 200px; text-align: center; vertical-align: middle;">Due(<i class="fa fa-rupee-sign"></i>)</th>
                <th style="padding: 10px 5px; width: 100px; text-align: center; vertical-align: middle;">Action</th>
               
            </tr>
        </thead>
        
        <tbody>';

              
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
    

      $paid_data=$this->Monitoring_model->get_invoice_paid_details($invoice_no);
      $count_paid_invoice=$this->Monitoring_model->count_paid_rows($invoice_no);
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
       
    
      
     $html.='<tr>
        
     <td style="text-align: center; vertical-align: middle;">'.$slNo.'

    
         </td>
         <td style="text-align: center; vertical-align: middle;">'.$invoice_no.'
             
         </td>
         <td style="text-align: center; vertical-align: middle;">'.$bidder_name.'
             
         </td>
         <td style="text-align: right; vertical-align: middle;">'.$total_amount.'</td>
         <td style="text-align: right; vertical-align: middle;">'.$paid_v.'</td>
         <td style="text-align: right; vertical-align: middle;">'.$remaining.'</td>
         <td style="text-align: right; vertical-align: middle; display: flex;
         align-items: center;
         justify-content: space-evenly;" class="one">
         <a href="'. base_url().'Monitoring/view_invoice?project_id='.base64_encode($project_id).'&work_item_id='.base64_encode($work_item_id).'&activity_id='.base64_encode($activity_id).'&invoice_no='.base64_encode($invoice_no).'" style="text-align: right; vertical-align: middle; display: flex;
         align-items: center;
         justify-content: space-evenly; margin:5px 6px;" class="btn bg-blue btn-lg waves-effect"><span>View </span>
         </a>
         <a href="'. base_url().'Monitoring/pay_invoice?project_id='.base64_encode($project_id).'&work_item_id='.base64_encode($work_item_id).'&activity_id='.base64_encode($activity_id).'&invoice_no='.base64_encode($invoice_no).'" style="text-align: right; vertical-align: middle; display: flex;
         align-items: center;
         justify-content: space-evenly; margin:5px 6px;" class="btn bg-orange btn-lg waves-effect"><span> Pay </span>
         </a>';
         if($count_paid_invoice>0){
            $html.='<a href="javascript:void(0);" style="text-align: right; vertical-align: middle; display: flex;
         align-items: center;
         justify-content: space-evenly; margin:5px 6px;" class="btn bg-teal btn-lg waves-effect" disabled><span> Edit </span>
         </a>';
         }else{
            $html.='<a href="'. base_url().'Monitoring/edit_invoice?project_id='.base64_encode($project_id).'&work_item_id='.base64_encode($work_item_id).'&activity_id='.base64_encode($activity_id).'&invoice_id='.base64_encode($invoice_id).'" style="text-align: right; vertical-align: middle; display: flex;
            align-items: center;
            justify-content: space-evenly; margin:5px 6px;" class="btn bg-teal btn-lg waves-effect"><span> Edit </span>
            </a>';
         }
         
     $html.='</td>
 
 
</tr>';
$paid_v=0;
//$remaining=0; 
}
  
   // $project_id= $_REQUEST['project_id'];
   // $work_item_id= $_REQUEST['work_item_id'];
   // $activity_id= $_REQUEST['activity_id'];

        $html.='</tbody>
            </table>
            <div class="col-md-2 col-md-offset-5" style="margin-top: 5px;">
                 </div>
            
            </div>
                            </div>
                        </div>';

        //echo $html;

        $jsonData['html'] =  $html;

       
        echo json_encode($jsonData);


        die;
    }
    public function add_invoice(){
        $project_id=base64_decode($_REQUEST['project_id']);
        $project_work_item_id=base64_decode($_REQUEST['work_item_id']);
        $activity_id=base64_decode($_REQUEST['activity_id']);

        $data['project_id']=base64_decode($_REQUEST['project_id']);;
        $data['project_work_item_id']=base64_decode($_REQUEST['work_item_id']);
        $data['activity_id']=base64_decode($_REQUEST['activity_id']);

        $data['project_deatail'] = $this->Monitoring_model->project_details($project_id);
        $data['project_aggrement_deatail'] = $this->Monitoring_model->get_project_aggrement_details($project_id);
        $data['project_work_item_deatail'] = $this->Project_model->get_project_work_item_details($project_id);
      //  $data['project_activity_detail'] = $this->Monitoring_model->get_project_activity_details($project_id, $project_work_item_id);
        $data['project_activity_detail'] = $this->Monitoring_model->get_project_activity($project_id, $project_work_item_id);
        $data['physical_activity_details']=$this->Monitoring_model->get_physical_act($project_id, $project_work_item_id, $activity_id);
        //echo "<pre>"; print_r($data); die;
        $data['project_activity']=$this->Monitoring_model->get_project_type($activity_id);
        $data['financial_activity_details']=$this->Monitoring_model->get_financial_act($project_id, $project_work_item_id, $activity_id);
        $data['invoice_list']=$this->Monitoring_model->get_invoice_list($project_id, $project_work_item_id, $activity_id);
        //$data['amount_array']=$this->Monitoring_model->get_amount_array($project_id,$project_work_item_id,$activity_id);
        $amount=$this->Monitoring_model->total_paid_amount($project_id,$project_work_item_id,$activity_id);
        $data['amount_array']=$this->Monitoring_model->total_paid_amount($project_id,$project_work_item_id,$activity_id);
        $tot_financial_amount=$this->Monitoring_model->count_tot_amount($project_id,$project_work_item_id,$activity_id);
        $data['bidder_data']=$this->Monitoring_model->get_bidder_data($project_id);
         $tot_financial_amount=$this->Monitoring_model->count_tot_amount($project_id,$project_work_item_id,$activity_id);
         $planned_tot=$tot_financial_amount[0]['financial_amount'];
         $tot=0;

                 foreach($amount as $amt){
                     $tot+=$amt['paid_amount'];
            
                 }
          $remaining=$planned_tot-$tot;
          // echo $remaining;
        $value['planned_tot']=$planned_tot;
        $value['tot']=$tot;
        $value['remaining']=$remaining;
       $data['value']=$value;


        
       if(!empty($_REQUEST['submit'])){
        $paid_amount=$this->Monitoring_model->total_paid_amount($_REQUEST['d'],$_REQUEST['e'],$_REQUEST['f']);
        $invoice_amount=$this->Monitoring_model->total_invoice_amount($_REQUEST['d'],$_REQUEST['e'],$_REQUEST['f']);
       $tot_financial_amount=$this->Monitoring_model->count_tot_amount($_REQUEST['d'],$_REQUEST['e'],$_REQUEST['f']);
       $count_invoice_no=$this->Monitoring_model->count_invoice_no($_REQUEST['invoice_no']);
    //  echo $count_invoice_no;
     // exit;
        $planned_tot=$tot_financial_amount[0]['financial_amount'];
        $tot=0;
                $remaining=0;
                foreach($invoice_amount as $amt){
                    $tot+=$amt['invoice_value'];
                    
                }
                $remaining=$planned_tot-$tot;
               // $remaining=0;
        
        //  echo $remaining;
          //exit;
       //  $count_invoice_row=$this->Monitering_model->get_invoice_row($_REQUEST['invoice_no']);
       if($count_invoice_no==0){
        if($_REQUEST['invoice_value'] <= $remaining){
            $array['project_id']= $_REQUEST['d'];
            $array['work_item_id']=$_REQUEST['e'];
            $array['activity_id']=$_REQUEST['f'];
            $array['invoice_value']=$_REQUEST['invoice_value'];
            $array['invoice_date']=$_REQUEST['invoice_date'];
            $array['invoice_no']=$_REQUEST['invoice_no'];
            $array['bidder_name']=$_REQUEST['bidder_name'];
            //$array['invoice_value']=$_REQUEST['invoice_value'];
            $array['remarks']=$_REQUEST['remarks'];
            
    
            $this->session->set_flashdata('success', 'Invoice Added successfully!');
            $this->Monitoring_model->add_invoice_amount('project_invoice',$array);
    
    // redirect('Monitoring/add_financial_monitoring?project_id='.base64_encode($_REQUEST['d']).'&project_work_item_id='.base64_encode($_REQUEST['e']));
     redirect('Monitoring/add_invoice?project_id='.base64_encode($_REQUEST['d']).'&work_item_id='.base64_encode($_REQUEST['e']).'&activity_id='.base64_encode($_REQUEST['f']));
    
    
          }elseif($remaining==0){
            $this->session->set_flashdata('danger', 'You have already paid your total planned value');
            redirect('Monitoring/add_invoice?project_id='.base64_encode($_REQUEST['d']).'&work_item_id='.base64_encode($_REQUEST['e']).'&activity_id='.base64_encode($_REQUEST['f']));
          }else{
           // echo $tot;
            //exit;
            $this->session->set_flashdata('danger', 'Please Enter amount less than '.$remaining.'  Rs.');
            redirect('Monitoring/add_invoice?project_id='.base64_encode($_REQUEST['d']).'&work_item_id='.base64_encode($_REQUEST['e']).'&activity_id='.base64_encode($_REQUEST['f']));
          }
       }else{
        $this->session->set_flashdata('danger', 'This Invoice No Already Exist!Please Try a New One.');
        redirect('Monitoring/add_invoice?project_id='.base64_encode($_REQUEST['d']).'&work_item_id='.base64_encode($_REQUEST['e']).'&activity_id='.base64_encode($_REQUEST['f']));
       }
      

                    }else{
                        $this->load->common_template('monitoring/add_invoice',$data);
    }
       
    }
    public function invoice_paid_details($invoice_no){
        return $this->Monitoring_model->get_invoice_paid_details($invoice_no); 
    }
    public function paid_rows($invoice_no){
        return $this->Monitoring_model->count_paid_rows($invoice_no);

    }

    public function view_invoice(){
        $project_id=base64_decode($_REQUEST['project_id']);
        $project_work_item_id=base64_decode($_REQUEST['work_item_id']);
        $activity_id=base64_decode($_REQUEST['activity_id']);
        $invoice_no=base64_decode($_REQUEST['invoice_no']);
        $data['project_id']=base64_decode($_REQUEST['project_id']);;
        $data['project_work_item_id']=base64_decode($_REQUEST['work_item_id']);
        $data['activity_id']=base64_decode($_REQUEST['activity_id']);
        $data['invoice_no']=base64_decode($_REQUEST['invoice_no']);

        $data['project_deatail'] = $this->Monitoring_model->project_details($project_id);
        $data['project_aggrement_deatail'] = $this->Monitoring_model->get_project_aggrement_details($project_id);
        $data['project_work_item_deatail'] = $this->Project_model->get_project_work_item_details($project_id);
      //  $data['project_activity_detail'] = $this->Monitoring_model->get_project_activity_details($project_id, $project_work_item_id);
        $data['project_activity_detail'] = $this->Monitoring_model->get_project_activity($project_id, $project_work_item_id);
        $data['physical_activity_details']=$this->Monitoring_model->get_physical_act($project_id, $project_work_item_id, $activity_id);
        //echo "<pre>"; print_r($data); die;
        $data['project_activity']=$this->Monitoring_model->get_project_type($activity_id);
        $data['financial_activity_details']=$this->Monitoring_model->get_financial_act($project_id, $project_work_item_id, $activity_id);
        $data['paid_details']=$this->Monitoring_model->get_invoice_paid_details($invoice_no);
       // $data['amount_array']=$this->Monitoring_model->get_amount_array($project_id,$project_work_item_id,$activity_id);
        $amount=$this->Monitoring_model->total_paid_amount($project_id,$project_work_item_id,$activity_id);
        $data['amount_array']=$this->Monitoring_model->total_paid_amount($project_id,$project_work_item_id,$activity_id);
        $tot_financial_amount=$this->Monitoring_model->count_tot_amount($project_id,$project_work_item_id,$activity_id);

         
        $data['invoice_data']=$this->Monitoring_model->get_invoice_row($invoice_no);

         $invoice_dat=$this->Monitoring_model->get_invoice_row($invoice_no);

        $payment_data=$this->Monitoring_model->get_invoice_paid_details($invoice_no);
       // $data['payment_dat']=$this->Monitoring_model->get_invoice_paid_details($invoice_no);
       
       $tot_payment_data=$this->Monitoring_model->total_paid_amount($project_id,$project_work_item_id,$activity_id);
        $invoice=$invoice_dat[0]['invoice_value'];
        $planned_tot=$planned_tot=$tot_financial_amount[0]['financial_amount'];
         $tot=0;

                 foreach($tot_payment_data as $amt){
                     $tot+=$amt['paid_amount'];
            
                 }
          $remaining=$planned_tot-$tot;
          $invoice_remaining=$invoice-$tot;
          // echo $remaining;
        $value['planned_tot']=$planned_tot;
        $value['tot']=$tot;
        $value['remaining']=$remaining;
       $data['value']=$value;
        $this->load->common_template('monitoring/view_invoice',$data);
    }
    public function activity_name($activity_id){
        return $this->Monitoring_model->get_project_type($activity_id);
    }
    public function pay_invoice(){
        $project_id=base64_decode($_REQUEST['project_id']);
        $project_work_item_id=base64_decode($_REQUEST['work_item_id']);
        $activity_id=base64_decode($_REQUEST['activity_id']);
        $invoice_no=base64_decode($_REQUEST['invoice_no']);
        $data['project_id']=base64_decode($_REQUEST['project_id']);;
        $data['project_work_item_id']=base64_decode($_REQUEST['work_item_id']);
        $data['activity_id']=base64_decode($_REQUEST['activity_id']);
        $data['invoice_no']=base64_decode($_REQUEST['invoice_no']);

        $data['project_deatail'] = $this->Monitoring_model->project_details($project_id);
        $data['project_aggrement_deatail'] = $this->Monitoring_model->get_project_aggrement_details($project_id);
        $data['project_work_item_deatail'] = $this->Project_model->get_project_work_item_details($project_id);
      //  $data['project_activity_detail'] = $this->Monitoring_model->get_project_activity_details($project_id, $project_work_item_id);
        $data['project_activity_detail'] = $this->Monitoring_model->get_project_activity($project_id, $project_work_item_id);
        $data['physical_activity_details']=$this->Monitoring_model->get_physical_act($project_id, $project_work_item_id, $activity_id);
        //echo "<pre>"; print_r($data); die;
        $data['project_activity']=$this->Monitoring_model->get_project_type($activity_id);
        $data['financial_activity_details']=$this->Monitoring_model->get_financial_act($project_id, $project_work_item_id, $activity_id);
        $data['paid_details']=$this->Monitoring_model->get_invoice_paid_details($invoice_no);
       // $data['amount_array']=$this->Monitoring_model->get_amount_array($project_id,$project_work_item_id,$activity_id);
        $amount=$this->Monitoring_model->total_paid_amount($project_id,$project_work_item_id,$activity_id);
        $data['amount_array']=$this->Monitoring_model->total_paid_amount($project_id,$project_work_item_id,$activity_id);
        $tot_financial_amount=$this->Monitoring_model->count_tot_amount($project_id,$project_work_item_id,$activity_id);

         
        $data['invoice_data']=$this->Monitoring_model->get_invoice_row($invoice_no);

         $invoice_dat=$this->Monitoring_model->get_invoice_row($invoice_no);

        $payment_data=$this->Monitoring_model->get_invoice_paid_details($invoice_no);
       // $data['payment_dat']=$this->Monitoring_model->get_invoice_paid_details($invoice_no);
       
       $tot_payment_data=$this->Monitoring_model->total_paid_amount($project_id,$project_work_item_id,$activity_id);
        $invoice=$invoice_dat[0]['invoice_value'];
        $planned_tot=$planned_tot=$tot_financial_amount[0]['financial_amount'];
         $tot=0;

                 foreach($tot_payment_data as $amt){
                     $tot+=$amt['paid_amount'];
            
                 }
          $remaining=$planned_tot-$tot;
          $invoice_remaining=$invoice-$tot;
          // echo $remaining;
        $value['planned_tot']=$planned_tot;
        $value['tot']=$tot;
        $value['remaining']=$remaining;
       $data['value']=$value;
       

/* 
       foreach($payment_data as $amt){
        $tot1+=$amt['paid_amount'];

    }
            $remaining_inv=$invoice-$tot1;
            // echo $remaining;
          //  $value['planned_tot']=$planned_tot;
            $value['tot']=$tot;
            $value['invoice_remaining']=$remaining_inv;
            $data['value']=$value; */


       if(!empty($_REQUEST['submit'])){
        $amount=$this->Monitoring_model->total_paid_amount($_REQUEST['a'],$_REQUEST['b'],$_REQUEST['c']);
       $tot_financial_amount=$this->Monitoring_model->count_tot_amount($_REQUEST['a'],$_REQUEST['b'],$_REQUEST['c']);
        $invoice_data=$this->Monitoring_model->get_invoice_row($_REQUEST['d']);


        $payment_data=$this->Monitoring_model->get_invoice_paid_details($_REQUEST['d']);
        
        //$planned_tot=$tot_financial_amount[0]['financial_amount'];
        $invoice=$invoice_data[0]['invoice_value'];

        $tot=0;

                foreach($payment_data as $amt){
                    $tot+=$amt['paid_amount'];
           
                }
         $remaining=$invoice-$tot;
         // echo $remaining;
       
      if($_REQUEST['paid_amount'] <= $remaining){
        $array['project_id']= $_REQUEST['a'];
        $array['work_item_id']=$_REQUEST['b'];
        $array['activity_id']=$_REQUEST['c'];
        $array['invoice_id']=$_REQUEST['d'];
        $array['paid_amount']=$_REQUEST['paid_amount'];
        $array['due_amount']=$_REQUEST['due_amount'];
        $array['remarks']=$_REQUEST['remarks'];
        $array['paid_date']=$_REQUEST['paid_date'];
        $this->Monitoring_model->add_paid_amount('project_paid_amount',$array);

        $this->session->set_flashdata('success', 'Payment Added Successfully!');
        redirect('Monitoring/pay_invoice?project_id='.base64_encode($_REQUEST['a']).'&work_item_id='.base64_encode($_REQUEST['b']).'&activity_id='.base64_encode($_REQUEST['c']).'&invoice_no='.base64_encode($_REQUEST['d']));
    
      }elseif($remaining==0){
        $this->session->set_flashdata('danger', 'You have already paid your total planned value');
        redirect('Monitoring/pay_invoice?project_id='.base64_encode($_REQUEST['a']).'&work_item_id='.base64_encode($_REQUEST['b']).'&activity_id='.base64_encode($_REQUEST['c']).'&invoice_no='.base64_encode($_REQUEST['d']));
      }else{
       // echo $tot;
        //exit;
        $this->session->set_flashdata('danger', 'Please Enter amount less than or equal to  '.$remaining.'  RS.');
        redirect('Monitoring/pay_invoice?project_id='.base64_encode($_REQUEST['a']).'&work_item_id='.base64_encode($_REQUEST['b']).'&activity_id='.base64_encode($_REQUEST['c']).'&invoice_no='.base64_encode($_REQUEST['d']));
      }

  }else{
      $this->load->common_template('monitoring/pay_invoice',$data);
    }
        
    }
    public function edit_invoice(){
        $project_id=base64_decode($_REQUEST['project_id']);
        $project_work_item_id=base64_decode($_REQUEST['work_item_id']);
        $activity_id=base64_decode($_REQUEST['activity_id']);
        $invoice_id=base64_decode($_REQUEST['invoice_id']);
        $data['project_id']=base64_decode($_REQUEST['project_id']);;
        $data['project_work_item_id']=base64_decode($_REQUEST['work_item_id']);
        $data['activity_id']=base64_decode($_REQUEST['activity_id']);
        $data['invoice_id']=base64_decode($_REQUEST['invoice_id']);


        $data['project_deatail'] = $this->Monitoring_model->project_details($project_id);
        $data['project_aggrement_deatail'] = $this->Monitoring_model->get_project_aggrement_details($project_id);
        $data['project_work_item_deatail'] = $this->Project_model->get_project_work_item_details($project_id);
      //  $data['project_activity_detail'] = $this->Monitoring_model->get_project_activity_details($project_id, $project_work_item_id);
        $data['project_activity_detail'] = $this->Monitoring_model->get_project_activity($project_id, $project_work_item_id);
        $data['physical_activity_details']=$this->Monitoring_model->get_physical_act($project_id, $project_work_item_id, $activity_id);
        //echo "<pre>"; print_r($data); die;
        $data['project_activity']=$this->Monitoring_model->get_project_type($activity_id);
        $data['financial_activity_details']=$this->Monitoring_model->get_financial_act($project_id, $project_work_item_id, $activity_id);

        //$data['amount_array']=$this->Monitoring_model->get_amount_array($project_id,$project_work_item_id,$activity_id);
        $amount=$this->Monitoring_model->total_paid_amount($project_id,$project_work_item_id,$activity_id);
        $data['amount_array']=$this->Monitoring_model->total_paid_amount($project_id,$project_work_item_id,$activity_id);
        $tot_financial_amount=$this->Monitoring_model->count_tot_amount($project_id,$project_work_item_id,$activity_id);
        $data['bidder_data']=$this->Monitoring_model->get_bidder_data($project_id);
         $tot_financial_amount=$this->Monitoring_model->count_tot_amount($project_id,$project_work_item_id,$activity_id);
         $planned_tot=$tot_financial_amount[0]['financial_amount'];
                  
        $data['invoice_data']=$this->Monitoring_model->get_invoice_row_id($invoice_id);
         $tot=0;

                 foreach($amount as $amt){
                     $tot+=$amt['paid_amount'];
            
                 }
          $remaining=$planned_tot-$tot;
          // echo $remaining;
        $value['planned_tot']=$planned_tot;
        $value['tot']=$tot;
        $value['remaining']=$remaining;
       $data['value']=$value;

       //print_r($data['invoice_data']);
      // exit;
        
       if(!empty($_REQUEST['submit'])){
        $paid_amount=$this->Monitoring_model->total_paid_amount($_REQUEST['d'],$_REQUEST['e'],$_REQUEST['f']);
        $invoice_amount=$this->Monitoring_model->total_invoice_amount_update($_REQUEST['d'],$_REQUEST['e'],$_REQUEST['f'],$_REQUEST['iid']);
       $tot_financial_amount=$this->Monitoring_model->count_tot_amount($_REQUEST['d'],$_REQUEST['e'],$_REQUEST['f']);
               
       $data['invoice_data']=$this->Monitoring_model->get_invoice_row_id($_REQUEST['iid']);
        $planned_tot=$tot_financial_amount[0]['financial_amount'];
        $count_invoice_no=$this->Monitoring_model->count_invoice_no_update($_REQUEST['iid'],$_REQUEST['invoice_no']);
        //echo $planned_tot;
                $tot=0;
                $remaining=10;
                foreach($invoice_amount as $amt){
                    $tot+=$amt['invoice_value'];
                    
                }
                //echo $tot;
                //exit;
                $remaining=$planned_tot-$tot;

               // $remaining=0;
        
        //  echo $remaining;
         
       //  $count_invoice_row=$this->Monitering_model->get_invoice_row($_REQUEST['invoice_no']);
       $iid=$_REQUEST['iid'];
     
       if($count_invoice_no==0){
        if($_REQUEST['invoice_value'] <= $remaining ){
       
            $array['project_id']= $_REQUEST['d'];
            $array['work_item_id']=$_REQUEST['e'];
            $array['activity_id']=$_REQUEST['f'];
           // $array['activity_id']=$_REQUEST['f'];
            $array['invoice_value']=$_REQUEST['invoice_value'];
            $array['invoice_date']=$_REQUEST['invoice_date'];
            $array['invoice_no']=$_REQUEST['invoice_no'];
            $array['bidder_name']=$_REQUEST['bidder_name'];
            //$array['invoice_value']=$_REQUEST['invoice_value'];
            $array['remarks']=$_REQUEST['remarks'];
            
          
            
            $this->Monitoring_model->update_invoice_amount('project_invoice',$array,$iid);
    
    
       redirect('Monitoring/add_financial_monitoring?project_id='.base64_encode($_REQUEST['d']).'&project_work_item_id='.base64_encode($_REQUEST['e']));
    
          }elseif($remaining==0){
            $this->session->set_flashdata('danger', 'You have already paid your total planned value');
            redirect('Monitoring/edit_invoice?project_id='.base64_encode($_REQUEST['d']).'&work_item_id='.base64_encode($_REQUEST['e']).'&activity_id='.base64_encode($_REQUEST['f']).'&invoice_id='.base64_encode($_REQUEST['iid']));
          }else{
           // echo $tot;
            //exit;
            $this->session->set_flashdata('danger', 'Please Enter amount less than '.$remaining.'  RS.');
            redirect('Monitoring/edit_invoice?project_id='.base64_encode($_REQUEST['d']).'&work_item_id='.base64_encode($_REQUEST['e']).'&activity_id='.base64_encode($_REQUEST['f']).'&invoice_id='.base64_encode($_REQUEST['iid']));
          }
    
       }else{
         //exit;
         $this->session->set_flashdata('danger', 'This Invoice No already Exist.Pls Try a new one');
         redirect('Monitoring/edit_invoice?project_id='.base64_encode($_REQUEST['d']).'&work_item_id='.base64_encode($_REQUEST['e']).'&activity_id='.base64_encode($_REQUEST['f']).'&invoice_id='.base64_encode($_REQUEST['iid']));
    
       }
      
                    }else{
                        $this->load->common_template('monitoring/edit_invoice',$data);
    }
    }





/*     public function get_activity_stage($activity_id){
        return $this->Monitoring_model->get_project_type($activity_id);
    } */
    /* Get Project Financial Acitivity Plan Ajax Ends */
    public function add_financial_amount(){
        $project_id=base64_decode($_REQUEST['project_id']);
        $project_work_item_id=base64_decode($_REQUEST['work_item_id']);
        $activity_id=base64_decode($_REQUEST['activity_id']);

        $data['project_id']=base64_decode($_REQUEST['project_id']);;
        $data['project_work_item_id']=base64_decode($_REQUEST['work_item_id']);
        $data['activity_id']=base64_decode($_REQUEST['activity_id']);

        $data['project_deatail'] = $this->Monitoring_model->project_details($project_id);
        $data['project_aggrement_deatail'] = $this->Monitoring_model->get_project_aggrement_details($project_id);
        $data['project_work_item_deatail'] = $this->Project_model->get_project_work_item_details($project_id);
      //  $data['project_activity_detail'] = $this->Monitoring_model->get_project_activity_details($project_id, $project_work_item_id);
        $data['project_activity_detail'] = $this->Monitoring_model->get_project_activity($project_id, $project_work_item_id);
        $data['physical_activity_details']=$this->Monitoring_model->get_physical_act($project_id, $project_work_item_id, $activity_id);
        //echo "<pre>"; print_r($data); die;
        $data['project_activity']=$this->Monitoring_model->get_project_type($activity_id);
        $data['financial_activity_details']=$this->Monitoring_model->get_financial_act($project_id, $project_work_item_id, $activity_id);

        //$data['amount_array']=$this->Monitoring_model->get_amount_array($project_id,$project_work_item_id,$activity_id);
        $amount=$this->Monitoring_model->total_paid_amount($project_id,$project_work_item_id,$activity_id);
        $data['amount_array']=$this->Monitoring_model->total_paid_amount($project_id,$project_work_item_id,$activity_id);
        $tot_financial_amount=$this->Monitoring_model->count_tot_amount($project_id,$project_work_item_id,$activity_id);

         $planned_tot=$tot_financial_amount[0]['financial_amount'];
         $tot=0;

                 foreach($amount as $amt){
                     $tot+=$amt['paid_amount'];
            
                 }
          $remaining=$planned_tot-$tot;
          // echo $remaining;
        $value['planned_tot']=$planned_tot;
        $value['tot']=$tot;
        $value['remaining']=$remaining;
       $data['value']=$value;
      //echo "<pre>";
      // print_r($data);
      // exit;
        
        if(!empty($_REQUEST['submit'])){
            $amount=$this->Monitoring_model->total_paid_amount($_REQUEST['a'],$_REQUEST['b'],$_REQUEST['c']);
           $tot_financial_amount=$this->Monitoring_model->count_tot_amount($_REQUEST['a'],$_REQUEST['b'],$_REQUEST['c']);
 
            $planned_tot=$tot_financial_amount[0]['financial_amount'];
            $tot=0;

                    foreach($amount as $amt){
                        $tot+=$amt['paid_amount'];
               
                    }
             $remaining=$planned_tot-$tot;
             // echo $remaining;
           
          if($_REQUEST['paid_amount'] <= $remaining){
            $array['project_id']= $_REQUEST['a'];
            $array['work_item_id']=$_REQUEST['b'];
            $array['activity_id']=$_REQUEST['c'];
            $array['paid_amount']=$_REQUEST['paid_amount'];
            $array['paid_date']=$_REQUEST['paid_date'];
            $this->Monitoring_model->add_paid_amount('project_paid_amount',$array);


       redirect('Monitoring/financial_listing?project_id='.base64_encode($_REQUEST['a']).'&project_work_item_id='.base64_encode($_REQUEST['b']));

          }elseif($remaining==0){
            $this->session->set_flashdata('danger', 'You have already paid your total planned value');
            redirect('Monitoring/add_financial_amount?project_id='.base64_encode($_REQUEST['a']).'&work_item_id='.base64_encode($_REQUEST['b']).'&activity_id='.base64_encode($_REQUEST['c']));
          }else{
           // echo $tot;
            //exit;
            $this->session->set_flashdata('danger', 'Please Enter amount less than '.$remaining.'  RS.');
            redirect('Monitoring/add_financial_amount?project_id='.base64_encode($_REQUEST['a']).'&work_item_id='.base64_encode($_REQUEST['b']).'&activity_id='.base64_encode($_REQUEST['c']));
          }

                        }else{
            $this->load->common_template('monitoring/add_financial_amount',$data);
        }
    }


    function get_financial_acitivity_plan_data(){
        $project_id= $_REQUEST['project_id'];
        $work_item_id= $_REQUEST['work_item_id'];
        $activity_id= $_REQUEST['activity_id'];


        $get_activities_budget_Data = $this->Pf_planning_model->get_project_activity_list($project_id,$activity_id);
        $get_activities_planned_data = $this->Pf_planning_model->get_project_activity_wise_total_activity_planned_amt($project_id,$activity_id);

        $project_aggrement_deatail = $this->Pf_planning_model->get_project_aggrement_details($project_id);

        

        $agreement_cost = $project_aggrement_deatail[0]['agreement_cost'];

        $jsonData['get_activities_budget_amt'] = number_format($get_activities_budget_Data[0]['amount'],2);
        $jsonData['get_activities_planned_amt'] = number_format($get_activities_planned_data[0]['total_budget_amount'],2);

        $remaining_amt = $get_activities_budget_Data[0]['amount'] - $get_activities_planned_data[0]['total_budget_amount'];
        $jsonData['get_activities_remain_amt'] = number_format($remaining_amt,2);
        $weightage_val = ($get_activities_budget_Data[0]['amount'] / $agreement_cost) * 100;
        $jsonData['get_activities_Weightage'] = number_format($weightage_val,2);
        
        echo json_encode($jsonData);


        die;

    }
    /* Physical Monitoring Listing*/
    public function physical_listing(){
        $project_id=base64_decode($_REQUEST['project_id']);
        $project_work_item_id=base64_decode($_REQUEST['project_work_item_id']); 
        $data['project_id']=$project_id;
        $data['project_work_item_id']=$project_work_item_id;
        $data['project_deatail'] = $this->Monitoring_model->project_details($project_id);
        $data['project_aggrement_deatail'] = $this->Monitoring_model->get_project_aggrement_details($project_id);
        $data['project_financial_deatail'] = $this->Project_model->get_project_financial_details($project_id);
        $data['project_work_item_detail'] = $this->Project_model->get_project_work_item_details($project_id);
        $this->load->common_template('monitoring/physical_listing',$data);
    }
    /* Physical Monitoring Listing End*/

    /* Project work item physical target*/
    public function work_item_physical_target($project_id,$work_item_id){
        return $this->Project_model->get_work_item_physical_target($project_id,$work_item_id);          
    }
    /* Project work item physical target End*/

    /*Get unit*/
    public function get_unit($unit_id){
        return $this->Project_model->get_unit_detail($unit_id);
    }
    /*Get unit End*/

    /*  Physical Monitoring */
    public function add_physical_monitoring(){
        $project_id=base64_decode($_REQUEST['project_id']);
        $project_work_item_id=base64_decode($_REQUEST['project_work_item_id']);
        $data['project_id']=$project_id;
        $data['project_work_item_id']=base64_decode($_REQUEST['project_work_item_id']);
        $data['project_deatail'] = $this->Monitoring_model->project_details($project_id);
        $data['project_aggrement_deatail'] = $this->Monitoring_model->get_project_aggrement_details($project_id);
        $data['project_work_item_deatail'] = $this->Project_model->get_project_work_item_details($project_id);
        $data['project_activity_detail'] = $this->Monitoring_model->get_project_physical_activity_details($project_id, $project_work_item_id);

        //echo "<pre>"; print_r($data); die;

        if(!empty($_REQUEST['submit'])){
            //echo "<pre>"; print_r($_REQUEST); die;
            $totalAllottedQuantity = 0;
            // Updating project_physical_planning_detail and project_physical_planning_main
            foreach($_REQUEST['physicalPlanningDetailId'] as $key => $val){
                //echo $val; echo "<br>";
                $physical_planning_monitoring['allotted_quantity']=$_REQUEST['allotted'][$key];
                $physical_planning_monitoring['modified_by']=$this->session->userdata('id');
                $physical_planning_monitoring['modified_on']=Date('Y-m-d');
                $where = array('id' => $val);
                if($this->Monitoring_model->updateDataCondition('project_physical_planning_detail', $physical_planning_monitoring, $where)){
                    $totalAllottedQuantity += $_REQUEST['allotted'][$key];    
                }
            }

            // Now Update project_financial_planning_main
            $physical_planning_monitoring_main['total_activity_allotted_quantity']=$totalAllottedQuantity;
            $physical_planning_monitoring_main['modified_by']=$this->session->userdata('id');
            $physical_planning_monitoring_main['modified_on']=Date('Y-m-d');
            $where_main = array('project_id' => $_REQUEST['project_id'],'project_work_item_id' => $_REQUEST['work_item_id'],'project_activity_id' => $_REQUEST['activity_id']);
            $this->Monitoring_model->updateDataCondition('project_physical_planning_main', $physical_planning_monitoring_main, $where_main);

            redirect('Monitoring/physical_listing?project_id='.base64_encode($_REQUEST['project_id']).'&project_work_item_id='.base64_encode($_REQUEST['work_item_id']));
        }else{
            $this->load->common_template('monitoring/add_physical_monitoring',$data);
        }
        
    }
    /*  Physical Monitoring End*/

    /* Get Project Physical Acitivity Plan Ajax */
    public function get_physical_acitivity_plan_xhr(){
        $project_id= $_REQUEST['project_id'];
        $work_item_id= $_REQUEST['work_item_id'];
        $activity_id= $_REQUEST['activity_id'];
        $arPhysicalActivityPlan=$this->Monitoring_model->get_physical_acitivity_plan($project_id, $work_item_id, $activity_id);

        $arActivityBudget=$this->Monitoring_model->get_physical_acitivity_budget($project_id, $work_item_id, $activity_id);
        //echo "<pre>"; print_r($arActivityBudget);echo '</pre>'; die();
        $activityBudgetQuantity = $arActivityBudget[0]['total_activity_quantity'];
        $activityAllottedQuantity = $arActivityBudget[0]['total_activity_allotted_quantity'];
        //$activityBudgetQuantity = $arActivityBudget[0]['activity_quantity_unit_id'];
        $unitDetailsAr = $this->get_unit($arActivityBudget[0]['activity_quantity_unit_id']);
        //echo "<pre>"; print_r($unitDetailsAr);echo '</pre>'; die();
        $unitName = $unitDetailsAr[0]['unit_name'];

        $html='<div class="card">
            <div class="body ">
            <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <input type="hidden" class="form-control" name="activityTargetQuantity" id="activityTargetQuantity" value="'.$activityBudgetQuantity.'"/>
                <thead>
                    <tr>
                        <th style="padding: 10px 5px; width: 40px; text-align: center; vertical-align: middle;">Sl No</th>
                        <th style="padding: 10px 5px; width: 200px; text-align: center; vertical-align: middle;">Months</th>
                        <th style="padding: 10px 5px; width: 150px; text-align: center; vertical-align: middle;">Target Quantity</th>
                        <th style="padding: 10px 5px; width: 150px; text-align: center; vertical-align: middle;">Achieved Quantity</th>
                    </tr>
                </thead>
                
                <tbody>';

        $physicalPlanningMonthFlag = true;
        $totalTargetTillDate = 0;
        $totalAlottedTillDate = 0;
        foreach ($arPhysicalActivityPlan as $key => $val) {
            //echo "<pre>"; print_r($val); die(); 
            //echo "Curremt Month & Year: ".date('M Y'); die();
            $slNo = $key+1;
            $monthName = $val['month_name'];
            $physicalPlanningDetailId = $val['id'];
            $targetQuantity = $val['target_quantity'];
            if(!empty($val['allotted_quantity'])){
                $allottedQuantity = $val['allotted_quantity'];
            }else{
                $allottedQuantity = "";
            }

            $unid_id=$this->Project_model->get_unit_detail($val['unit_id']);


            $totalAlottedTillDate = $totalAlottedTillDate+$allottedQuantity;

            if($physicalPlanningMonthFlag){
                $html.='<tr>
                    <td style="text-align: center; vertical-align: middle;">'.$slNo.'</td>
                    <td style="text-align: center; vertical-align: middle;">'.$monthName.'
                        <input type="hidden" class="form-control" name="physicalPlanningDetailId[]" value="'.$physicalPlanningDetailId.'"/>
                        <input type="hidden" class="form-control" name="month[]" value="'.$monthName.'"/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">'.$targetQuantity .' '.$unid_id[0]['unit_name'].' 
                        <input type="hidden" class="form-control" placeholder="Cost" name="target[]" value="'.$targetQuantity.'" />
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="text" class="form-control pull-left" placeholder="Achieved" name="allotted[]" style="width: 60%; margin-left:30px;" value="'.$allottedQuantity.'" /> <label class="pull-left" style="margin-left:5px;margin-top: 5px;">'.$unid_id[0]['unit_name'].'</label></td>
                </tr>';
            }
            

            if(date('M Y') == $monthName){
                $physicalPlanningMonthFlag = false;    
            }

        }

        $html.='</tbody>
            </table>
            <div class="col-md-2 col-md-offset-5" style="margin-top: 5px;">
                    <input type="submit" name="submit" value="ADD" class="btn bg-indigo waves-effect" />
                    <a href="javascript:window.history.back();" title="Go back to previous page"  class="btn bg-indigo waves-effect"><span> BACK </span></a>
            </div>
            
            </div>
                            </div>
                        </div>';

        
        $jsonData['html'] =  $html;
        $activityRemainingQuantity = $activityBudgetQuantity - $activityAllottedQuantity;
        $html_additional_data='<div class="card">
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="summaryTable">
                        <tbody>
                            <tr>
                                <td width="45%">Activity Quantity : </td>
                                <td width="50%">'.number_format(round($activityBudgetQuantity,2)).' '.$unitName.'</td>
                            </tr>
                            <tr>
                                <td width="45%">Activity Remaining Quantity : </td>
                                <td width="50%">'.number_format(round($activityRemainingQuantity,2)).' '.$unitName.'</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>';
        $jsonData['html_additional_data'] =  $html_additional_data;   
        echo json_encode($jsonData);                


        //echo $html;
        die;
    }
    /* Get Project Financial Acitivity Plan Ajax Ends */

    /* Getting Project Financial Progress Details */
    public function project_financial_progress_details($project_id){
        $project_released_amount_ar = $this->Monitoring_model->get_project_released_amount($project_id);
        $project_planned_amount_ar = $this->Monitoring_model->get_project_planned_amount($project_id);
        $project_earend_amount_ar = $this->Monitoring_model->get_project_earned_amount($project_id);

        $project_financial_details_ar['released'] = $this->IND_money_format(empty($project_released_amount_ar[0]['total_activity_allotted_amount'])?0:$project_released_amount_ar[0]['total_activity_allotted_amount']);
        $project_financial_details_ar['planned'] = $this->IND_money_format(empty($project_planned_amount_ar[0]['total_activity_planned_amount'])?0:$project_planned_amount_ar[0]['total_activity_planned_amount']);
        $project_financial_details_ar['project_completion_percentage'] = round((($project_released_amount_ar[0]['total_activity_allotted_amount'] * 100)/$project_planned_amount_ar[0]['total_activity_planned_amount']),2);
       $project_activities_total_value = $this->Monitoring_model->get_project_activities_total_value($project_id);

       $project_agrreement_data = $this->Monitoring_model->get_project_aggrement_details($project_id);

      if($project_earend_amount_ar[0]['total_activity_earned_amount'] > 0){
        $project_financial_details_ar['project_financial_completion_percentage'] = round(($project_earend_amount_ar[0]['total_activity_earned_amount'] / $project_agrreement_data[0]['agreement_cost'] ) * 100,2);
      }else{
        $project_financial_details_ar['project_financial_completion_percentage'] = 0.00;
      }

        
      
        return $project_financial_details_ar; //die();
    }
    /* #END Getting Project Financial Progress Details */

    /* Getting Project physical Progress Details */
    public function project_physical_progress_details($project_id){
        $project_released_quantity_ar = $this->Monitoring_model->get_project_released_quantity($project_id);
        $project_planned_quantity_ar = $this->Monitoring_model->get_project_planned_quantity($project_id);
        //echo "<pre>"; print_r($project_released_quantity_ar); die();
        
        $project_physical_details_ar['released_quantity'] = empty($project_released_quantity_ar[0]['total_activity_allotted_quantity'])?0:$project_released_quantity_ar[0]['total_activity_allotted_quantity'];

        $project_physical_details_ar['planned_quantity'] = empty($project_planned_quantity_ar[0]['total_activity_planned_quantity'])?0:$project_planned_quantity_ar[0]['total_activity_planned_quantity'];

        $project_physical_details_ar['project_physical_completion_percentage'] = round((($project_released_quantity_ar[0]['total_activity_allotted_quantity'] * 100)/$project_planned_quantity_ar[0]['total_activity_planned_quantity']),2);

        // echo "<br>Planned: ".$project_financial_details_ar['planned']; 
        // echo "<br>released: ".$project_financial_details_ar['released'];
        // echo "<br>project_completion_percentage: ".$project_financial_details_ar['project_completion_percentage'];
        // die();
        return $project_physical_details_ar; //die();
    }
    /* #END Getting Project physical Progress Details */

    public function work_item_financial_details($project_id, $work_item_id){
        $work_item_financial_details_ar = $this->Monitoring_model->get_work_item_financial_details($project_id, $work_item_id);
        return $work_item_financial_details_ar;    
        //echo "work_item_financial_details_ar: <pre>"; print_r($work_item_financial_details_ar); die();
    }

    public function no_to_words($no)
    {
        if ($no == 0) {
            return ' ';

        } else {
            $n = strlen($no); // 7
            //echo "length: ".$n; //die();
            switch ($n) {
                case 3:
                    $val = $no / 100;
                    $val = round($val, 2);
                    $finalval = $val . " Hundred";
                    break;
                case 4:
                    $val = $no / 1000;
                    $val = round($val, 2);
                    $finalval = $val . " Thousand";
                    break;
                case 5:
                    $val = $no / 1000;
                    $val = round($val, 2);
                    $finalval = $val . " Thousand";
                    break;
                case 6:
                    $val = $no / 100000;
                    $val = round($val, 2);
                    $finalval = $val . " Lakh";
                    break;
                case 7:
                    $val = $no / 100000;
                    $val = round($val, 2);
                    $finalval = $val . " Lakh";
                    break;
                case 8:
                    $val = $no / 10000000;
                    $val = round($val, 2);
                    $finalval = $val . " Cr.";
                    break;
                case 9:
                    $val = $no / 10000000;
                    $val = round($val, 2);
                    $finalval = $val . " Cr.";
                    break;

                default:
                    $val = $no / 10000000;
                    $val = round($val, 2);
                    $finalval = $val . " Crore";
            }
            return $finalval;

        }
    }

    function qno_to_words($no)
    {
        //$no = (int) $no;
        echo "no: ".$no;
        if($no == 0) {
            return ' ';

        }else {
            $n =  strlen($no); // 7
            switch ($n) {
                case 3:
                    $val = $no/100;
                    $val = round($val, 2);
                    $finalval =  $val ." hundred";
                    break;
                case 4:
                    $val = $no/1000;
                    $val = round($val, 2);
                    $finalval =  $val ." thousand";
                    break;
                case 5:
                    $val = $no/1000;
                    $val = round($val, 2);
                    $finalval =  $val ." thousand";
                    break;
                case 6:
                    $val = $no/100000;
                    $val = round($val, 2);
                    $finalval =  $val ." lakh";
                    break;
                case 7:
                    $val = $no/100000;
                    $val = round($val, 2);
                    $finalval =  $val ." lakh";
                    break;
                case 8:
                    $val = $no/10000000;
                    $val = round($val, 2);
                    $finalval =  $val ." crore";
                    break;
                case 9:
                    $val = $no/10000000;
                    $val = round($val, 2);
                    $finalval =  $val ." crore";
                    break;

                default:
                    $val = $no/10000000;
                    $val = round($val, 2);
                    $finalval =  $val ." crore";
                    break;
            }
            //return $finalval;

        }
        echo "final val: ".$finalval; die();
    }

    function IND_money_format($number){        
        $decimal = (string)($number - floor($number));
        $money = floor($number);
        $length = strlen($money);
        $delimiter = '';
        $money = strrev($money);
 
        for($i=0;$i<$length;$i++){
            if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$length){
                $delimiter .=',';
            }
            $delimiter .=$money[$i];
        }
 
        $result = strrev($delimiter);
        $decimal = preg_replace("/0\./i", ".", $decimal);
        $decimal = substr($decimal, 0, 3);
 
        if( $decimal != '0'){
            $result = $result.$decimal;
        }
 
        return $result;
    }




    /*=============== New Changes on 30-07-2021 ================== */

    function financial_monitoring_list(){
        $user_id = $this->session->userdata('id');
        $user_type = $this->session->userdata('user_type');
        $circle_id = $this->session->userdata('circle_id');
        $division_id = $this->session->userdata('division_id');
        
        $data['project_deatail'] = $this->Monitoring_model->get_monitoring_project_list($user_id,$circle_id,$division_id);
        $this->load->common_template('monitoring/financial_monitoring_list',$data);
    }


    function get_work_item_budget_amount($project_id, $work_item_id){
        $budget_amount = 0;
        $main_result = $this->Monitoring_model->project_financial_planning_main_result($project_id, $work_item_id);

        if(is_array($main_result)){
            foreach($main_result as $res){
                //$activity_id = $res->project_activity_id;
                //$activity_amount = $this->Monitoring_model->project_activity_amount_data($project_id, $activity_id);
                $budget_amount += $res->total_activity_budget_amount;
            }
        }

        return $budget_amount;

    }


    function get_work_item_earned_amount($project_id, $work_item_id){
        $earned_amount = 0;
        $main_result = $this->Monitoring_model->project_financial_planning_main_result($project_id, $work_item_id);

        if(is_array($main_result)){
            foreach($main_result as $res){
                //$activity_id = $res->project_activity_id;
                //$earned_amountdata = $this->Monitoring_model->project_activity_earned_amount_data($project_id,$work_item_id, $activity_id);

                $earned_amount += $res->total_activity_earned_amount;
            }
        }

        return $earned_amount;

    }



    /*  Earned Financial Monitor */
    public function earned_financial_progress(){
        $project_id=base64_decode($_REQUEST['project_id']);
        $project_work_item_id=base64_decode($_REQUEST['project_work_item_id']);
        $data['project_id']=$project_id;
        $data['project_work_item_id']=base64_decode($_REQUEST['project_work_item_id']);
        $data['project_deatail'] = $this->Monitoring_model->project_details($project_id);
        $data['project_aggrement_deatail'] = $this->Monitoring_model->get_project_aggrement_details($project_id);
        $data['project_work_item_deatail'] = $this->Project_model->get_project_work_item_details($project_id);
        //$data['project_activity_detail'] = $this->Monitoring_model->get_project_activity_details($project_id, $project_work_item_id);
        $data['project_activity_detail'] = $this->Monitoring_model->get_project_physical_activity_details($project_id,$project_work_item_id);
        $arPhysicalActivityPlan=$this->Monitoring_model->get_physical_acitivity_plan($project_id, $work_item_id, $activity_id);

       // echo "<pre>"; print_r($data['project_activity_detail']); die;

        if(!empty($_REQUEST['submit'])){
            
           // $totalEarnedAmount = 0;
            // Updating project_financial_planning_detail and project_financial_planning_main
            /* foreach($_REQUEST['financialPlanningDetailId'] as $plan => $fin){
                $totalEarnedAmount += str_replace(',','',$_REQUEST['allotted'][$plan]); 
                
            } */



            /* Checking this data already exist or not *///
            $where_check = array('project_id' => $_REQUEST['project_id'],'project_work_item_id' => $_REQUEST['work_item_id'],'project_activity_id' => $_REQUEST['activity_id']);
           $chk_exist = $this->Monitoring_model->check_table_data_exist_or_not_condition('project_physical_planning_main',$where_check);


           if($chk_exist > 0){
            //For update
            //$financial_planning_monitoring_main['total_activity_allotted_amount']=$totalAllottedAmount;
           // $financial_planning_monitoring_main['total_activity_earned_amount']=$totalEarnedAmount;
          //  $financial_planning_monitoring_main['monitored_by']=$this->session->userdata('id');
           // $financial_planning_monitoring_main['monitored_on']=Date('Y-m-d');
            $financial_planning_monitoring_main['activity_status']=$_REQUEST['activity_status'];
            $financial_planning_monitoring_main['startdate']=$_REQUEST['project_start_date'];
            $financial_planning_monitoring_main['enddate']=$_REQUEST['project_end_date'];

            $where_main = array('project_id' => $_REQUEST['project_id'],'project_work_item_id' => $_REQUEST['work_item_id'],'project_activity_id' => $_REQUEST['activity_id']);
            $this->Monitoring_model->updateDataCondition('project_physical_planning_main', $financial_planning_monitoring_main, $where_main);

            $main_financial_id = $this->Monitoring_model->get_any_table_specific_data('project_physical_planning_main',$where_main,'id');
           }else{
            //for add

                $financeAddData = array(
                                             'project_id' => $_REQUEST['project_id'], 
                                            'project_work_item_id' => $_REQUEST['work_item_id'], 
                                            'project_activity_id' => $_REQUEST['activity_id'], 
                                            //'total_activity_budget_amount' => $_REQUEST['activityBudgetAmount'], 
                                            //'total_activity_earned_amount' => $totalEarnedAmount, 
                                            //'total_activity_allotted_amount' => $totalAllottedAmount, 
                                            'status' => 'Y',

                                            'activity_status'=> $_REQUEST['activity_status'],
                                            'created_by' => $this->session->userdata('id'), 
                                            'created_on' => Date('Y-m-d')
                                        );
                $main_financial_id = $this->Monitoring_model->insertDatareturnid($financeAddData,'project_physical_planning_main');

           }
     

           $where_detail_check = array('project_id' => $_REQUEST['project_id'],'project_work_item_id' => $_REQUEST['work_item_id'],'project_activity_id' => $_REQUEST['activity_id'],'project_physical_planning_id' => $main_financial_id);
           $chk_detail = $this->Monitoring_model->check_table_data_exist_or_not_condition('project_physical_planning_detail',$where_detail_check);

           if($chk_detail > 0){
               //update
              // $financial_planning_monitoring['earned_amount']=$financial_allotted_amount;
               $financial_planning_monitoring['activity_status']=$_REQUEST['activity_status'];
              // $financial_planning_monitoring['project_start_date']=$_REQUEST['project_start_date'];
              // $financial_planning_monitoring['project_end_date']=$_REQUEST['project_end_date'];
              // $financial_planning_monitoring['activity_staus']=$_REQUEST['activity_status'];
               $financial_planning_monitoring['monitored_by']=$this->session->userdata('id');
               $financial_planning_monitoring['monitored_on']=Date('Y-m-d');
               $this->Monitoring_model->updateDataCondition('project_physical_planning_detail', $financial_planning_monitoring, $where_detail_check);
           }else{
               $financeDetailsAddData = array(
                                       'project_id' => $_REQUEST['project_id'], 
                                       'project_physical_planning_id' => $main_financial_id, 
                                       'project_work_item_id' => $_REQUEST['work_item_id'], 
                                       'project_activity_id' => $_REQUEST['activity_id'], 
                                       'project_start_date' => $_REQUEST['project_start_date'], 
                                       'project_end_date' => $_REQUEST['project_end_date'], 
                                      // 'month_date' => $mnth_date,
                                       //'earned_amount'=> $financial_allotted_amount,
                                       'activity_status' => $_REQUEST['activity_status'], 
                                       'created_by' => $this->session->userdata('id'), 
                                       'created_on' => Date('Y-m-d')
                                   );
           $this->Monitoring_model->insertDatareturnid($financeDetailsAddData,'project_physical_planning_detail');
           }















/* 
           foreach($_REQUEST['financialPlanningDetailId'] as $key => $val){
                //echo $val; echo "<br>";
            $mnth_name  = $_REQUEST['month'][$key];
            $mnth_date  = $_REQUEST['month_date'][$key];

                if ($_REQUEST['allotted'][$key]==''){
                    $financial_allotted_amount = 0;
                }else{
                    $financial_allotted_amount = str_replace(',','',$_REQUEST['allotted'][$key]);
                }
                $where_detail_check = array('project_id' => $_REQUEST['project_id'],'project_work_item_id' => $_REQUEST['work_item_id'],'project_activity_id' => $_REQUEST['activity_id'],'project_financial_planning_id' => $main_financial_id,'month_name' => $mnth_name);
                $chk_detail = $this->Monitoring_model->check_table_data_exist_or_not_condition('project_financial_planning_detail',$where_detail_check);

                if($chk_detail > 0){
                    //update
                    $financial_planning_monitoring['earned_amount']=$financial_allotted_amount;
                    
                    $financial_planning_monitoring['monitored_by']=$this->session->userdata('id');
                    $financial_planning_monitoring['monitored_on']=Date('Y-m-d');
                    $this->Monitoring_model->updateDataCondition('project_financial_planning_detail', $financial_planning_monitoring, $where_detail_check);
                }else{
                    $financeDetailsAddData = array(
                                            'project_id' => $_REQUEST['project_id'], 
                                            'project_financial_planning_id' => $main_financial_id, 
                                            'project_work_item_id' => $_REQUEST['work_item_id'], 
                                            'project_activity_id' => $_REQUEST['activity_id'], 
                                            'month_name' => $mnth_name, 
                                            'month_date' => $mnth_date,
                                            'earned_amount'=> $financial_allotted_amount,
                                            'status' => 'Y', 
                                            'created_by' => $this->session->userdata('id'), 
                                            'created_on' => Date('Y-m-d')
                                        );
                $this->Monitoring_model->insertDatareturnid($financeDetailsAddData,'project_financial_planning_detail');
                }
            } */
            
            $this->session->set_flashdata('message', 'Financial  Data saved successfully');
            redirect('Monitoring/financial_listing?project_id='.base64_encode($_REQUEST['project_id']).'&project_work_item_id='.base64_encode($_REQUEST['work_item_id']));
        }else{
            $this->load->common_template('monitoring/earned_financial_progress_view',$data);
        }
        
    }




     /* Get Project Financial Earned Acitivity Plan Ajax */
    public function get_earned_financial_acitivity_plan_xhr(){
        $project_id= $_REQUEST['project_id'];
        $work_item_id= $_REQUEST['work_item_id'];
        $activity_id= $_REQUEST['activity_id'];
        $arFinancialActivityPlan=$this->Monitoring_model->get_financial_acitivity_plan($project_id, $work_item_id, $activity_id);
        $arActivityBudget=$this->Monitoring_model->get_financial_acitivity_budget($project_id, $work_item_id, $activity_id);
        
        $project_aggrement_deatail = $this->Monitoring_model->get_project_aggrement_details($project_id);
        $agreement_cost = $project_aggrement_deatail[0]['agreement_cost'];
        $physical_activity_details=$this->Monitoring_model->get_physical_act($project_id, $work_item_id, $activity_id);
       // echo $project_id;
       // echo $work_item_id;
       // echo $activity_id;
          //print_r($physical_activity_details);
         // exit;
        $html='';
        $html='<div class="card">
            <div class="body ">
            <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
        <thead>
            <tr>
                
                <th style="padding: 10px 5px; width: 250px; text-align: center; vertical-align: middle;">Start Date</th>
                <th style="padding: 10px 5px; width: 250px; text-align: center; vertical-align: middle;">End Date</th>
                <th style="padding: 10px 5px; width: 350px; text-align: center; vertical-align: middle;">Status</th>
                
                
                
            </tr>
        </thead>
        
        <tbody>';
        $html.='<tr>
        
        <td style="text-align: center; vertical-align: middle;">'.$physical_activity_details[0]['startdate'].'
           
            <input type="hidden" class="form-control" name="project_start_date" value="'.$physical_activity_details[0]['startdate'].'"/>
            <input type="hidden" class="form-control" name="project_end_date" value="'.$physical_activity_details[0]['enddate'].'"/>
        </td>
        <td style="text-align: center; vertical-align: middle;">'.$physical_activity_details[0]['enddate'].'</td>
        <td style="text-align: right; vertical-align: middle;">
        
                         <select name="activity_status" class="form-control"><option';
                         if($physical_activity_details[0]['activity_status']=="YES"){
                             $html.=' '.'selected';
                             //echo $html;
                         }else{
                            $html.='';
                         }
                           $html.='>YES</option>';
                            $html.='<option';
                            if($physical_activity_details[0]['activity_status']=="NO"){
                                $html.=' '.'selected';
                            }else{
                                $html.='';
                            }
                           $html.='>NO</option>
                        </select></td>
        
        
    </tr>';
    /* $html.='<tr>
            <td style="text-align: center; vertical-align: middle;"></td>
            <td style="text-align: center; vertical-align: middle;"><strong>Total</strong></td>
            <td style="text-align: center; vertical-align: middle;">'.number_format($total_target_amount_percent,2).'</td>
            <td style="text-align: right; vertical-align: middle;">'.number_format($total_target_amount,2).'</td>
            
            
            <td style="text-align: right; vertical-align: middle;"><span id="earnedTotalPercent"></span></td>
            <td style="text-align: right; vertical-align: middle;"><span id="earnedTotalAmount"></span></td>
        </tr>'; */
        $html.='</tbody>
        </table>
        <div class="col-md-2 col-md-offset-5" style="margin-top: 5px;">
                <input type="submit" name="submit" value="ADD" class="btn bg-indigo waves-effect" />
                <a href="javascript:window.history.back();" title="Go back to previous page" class="btn bg-indigo waves-effect"><span> BACK </span></a>
        </div>
        
        </div>
                        </div>
                    </div>';

        $financialPlanningMonthFlag = true;

        $total_target_amount = 0.00;
        $total_target_amount_percent = 0.00;
      /*   foreach ($arFinancialActivityPlan as $key => $val) {
            //echo "<pre>"; print_r($val); die(); 
            //echo "Curremt Month & Year: ".date('M Y'); die();
            $slNo = $key+1;
            $monthName = $val['month_name'];
            $monthDate = $val['month_date'];
            $financialPlanningDetailId = $val['id'];

            if(!empty($val['target_amount'])){
            $target_amount = $val['target_amount'];
            }else{
               $target_amount = 0.00; 
            }
            $total_target_amount = $total_target_amount + $target_amount;

            $target_amount_percent = ($target_amount / $agreement_cost) * 100;

            $total_target_amount_percent = $total_target_amount_percent + $target_amount_percent;



            if(!empty($val['earned_amount'])){
            $earned_amount = $val['earned_amount'];
            }else{
               $earned_amount = 0.00; 
            }
            

            $earned_amount_percent = ($earned_amount / $agreement_cost) * 100;

            
            
            
            


          /*   if($financialPlanningMonthFlag){
               
            }
             */

          /*   if(date('M Y') == $monthName){
                $financialPlanningMonthFlag = false;    
            } */

        

        

        //echo $html;

        $jsonData['html'] =  $html;

        $total_activity_budget_amount = $arActivityBudget[0]['total_activity_budget_amount'];
        $total_activity_budget_amount_percent = ($total_activity_budget_amount / $agreement_cost) * 100;
        $total_activity_earned_amount = $arActivityBudget[0]['total_activity_earned_amount'];
        $total_activity_earned_amount_percent = ($total_activity_earned_amount / $agreement_cost) * 100;
        
        $remaining_amount = $total_activity_budget_amount - $total_activity_earned_amount;
        $remaining_amount_percent = ($remaining_amount / $agreement_cost) * 100;
        $html_additional_data='<div class="card">
        <div class="body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="summaryTable">
                    <tbody>
                    <tr>
                                    <td width="45%">Project Cost: </td>
                                    <td width="50%">'.number_format($agreement_cost,2).' <i class="fa fa-rupee-sign"></i></td>
                                </tr>
                    <tr>
                                    <td width="45%">Planned Value: 
                                    <input type="hidden" class="form-control" id="total_activity_budget_amount" value="'.$total_activity_budget_amount.'"/>
                                    </td>
                                    <td width="50%">'.number_format($total_activity_budget_amount,2).' <i class="fa fa-rupee-sign"></i> ('.number_format($total_activity_budget_amount_percent,2).' %)</td>
                                </tr>
                                <tr>
                                    <td width="45%">Earned Value: </td>
                                    <td width="50%">'.number_format($total_activity_earned_amount,2).' <i class="fa fa-rupee-sign"></i> ('.number_format($total_activity_earned_amount_percent,2).' %)</td>
                                </tr>
                                <tr>
                                    <td width="45%">Remaining Value : </td>
                                    <td width="50%">'.number_format(($remaining_amount),2).' <i class="fa fa-rupee-sign"></i> ('.number_format($remaining_amount_percent,2).' %)</td>
                                </tr>
                                </tbody>
                </table>
            </div>
        </div>
        </div>';
        $jsonData['html_additional_data'] =  $html_additional_data;   
        
        echo json_encode($jsonData);


        die;
    }


    function get_project_total_data($project_id){
        return $project_total_data = $this->Monitoring_model-> get_project_total_data($project_id);
    }


    function get_project_work_item_activity_table()
    {
        
        $project_id = $_REQUEST['project_id'];
        $work_item_type_id = $_REQUEST['work_item_type_id'];

        // Get Project Work Item details
        $project_work_item_details_ar = array();
        $data['project_work_item_details'] = $this->Monitoring_model->get_project_work_items($project_id, $work_item_type_id);
        
      

        //Total Project Cost
         $project_total_cst = $this->Monitoring_model->get_total_project_cost($project_id);

        $financial_activity_ar = array();

        if (!empty($data['project_work_item_details'])) {
            foreach ($data['project_work_item_details'] as $keyWI => $valueWI) {
                //echo "<pre>"; print_r($valueWI);
                $project_work_item_details_ar[$keyWI]['work_item_id'] = $valueWI['work_item_id'];
                $project_work_item_details_ar[$keyWI]['work_item_name'] = $valueWI['work_item_description'];

                 $work_item_id = $valueWI['work_item_id'];
                
                $data['physical_activity'] = $this->Monitoring_model->get_financial_activity_data($project_id, $work_item_id);
                
                if (!empty($data['physical_activity'])) {

                    foreach ($data['physical_activity'] as $keyActivity => $valueActivity) {

                        // Getting Activity Financial Details
                        $data['financial_activity_details'] = $this->Monitoring_model->get_financial_activity_details($project_id, $work_item_id, $valueActivity['project_activity_id'], $start_date, $end_date);
                        
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['activity_id'] = $valueActivity['project_activity_id'];
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['activity_name'] = $valueActivity['activity_name'];
                        
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['Planned_Value'] = $valueActivity['Planned_Value'];
                        
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['Earned_Value'] = $valueActivity['Earned_Value'];
                        
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['Paid_Value'] = $valueActivity['Paid_Value'];
                        
                        
                        

                    }
                }


            }
        

            $html = '';
            if (!empty($project_work_item_details_ar)) {
                foreach ($project_work_item_details_ar as $key => $value) {

                    $accordian_id = $key + 1;
                    $work_item_name = $value['work_item_name'];
                    $work_item_id = $value['work_item_id'];

                    $html .= '<div class="panel panel-col-teal">
                    <div class="panel-heading" role="tab" id="heading' . $accordian_id . '">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_2" href="#collapse' . $accordian_id . ' "aria-expanded="false" aria-controls="collapse">
                            <i class="fas fa-align-justify"></i> ' . $work_item_name . '
                            </a>
                        </h4>
                    </div>
                    <div id="collapse' . $accordian_id . '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading' . $accordian_id . '">
                        <div class="panel-body p-5" style="font-size: 11px">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Sl No</th>
                                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Activity Name</th>';

                       // $html .= '<th colspan = "2" style = "text-align: center; vertical-align: middle;" > Financial</th >';
                    $html .= '<th rowspan="2" style="text-align: center; vertical-align: middle;">Start</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Duration (Month)</th>
                                    </tr><tr class="bg-blue-grey">';
                        $html .= '<th style="text-align: center; vertical-align: middle;">Finish Date</th>
                                            <th style="text-align: center; vertical-align: middle;">Weightage (%)</th>';
                    

                    $html .= '<th style="text-align: center; vertical-align: middle;">Value <br>(<i class="fa fa-rupee-sign"></i>)</th>
                        <th style="text-align: center; vertical-align: middle;">Earned Value <br>(<i class="fa fa-rupee-sign"></i>)</th>
                        <th style="text-align: center; vertical-align: middle;">Actual Cost <br>(%)</th>
                        <th style="text-align: center; vertical-align: middle;">Actual Cost <br>(<i class="fa fa-rupee-sign"></i>)</th>
                                            </tr></thead><tbody>';
                    //echo '<pre>'; print_r($value['activity_details']);
                    // die();
                    if (!empty($value['activity_details'])) {
                        foreach ($value['activity_details'] as $keyActivity => $valueActivity) {

                            $sl = $keyActivity + 1;
                            $activity_name = $valueActivity['activity_name'];
                            $activity_id = $valueActivity['activity_id'];
                            $val_total_planned = number_format($valueActivity['Planned_Value'], 2);
                            $val_total_earned = number_format($valueActivity['Earned_Value'], 2);
                            $val_total_paid = number_format($valueActivity['Paid_Value'], 2);
                            
                            //start date
                            $start_date = $this->Monitoring_model->get_project_startdate($project_id,$work_item_id,$activity_id);
                            
                            $start_dateview = date('M Y', strtotime($start_date[0]['month_date']));
                            
                            //finish date
                            $finish_date = $this->Monitoring_model->get_project_finishdate($project_id,$work_item_id,$activity_id);
                            $finish_dateview = date('M Y', strtotime($finish_date[0]['month_date']));
                            
                            
                            
                            $duration="";
                            $ts1 = strtotime($start_date[0]['month_date']);
                            $ts2 = strtotime($finish_date[0]['month_date']);
                            
                            $year1 = date('Y', $ts1);
                            $year2 = date('Y', $ts2);
                            
                            $month1 = date('m', $ts1);
                            $month2 = date('m', $ts2);
                            
                            $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
                            $calM = $diff+1;
                            if ($calM <= "1") {
                            $duration= $calM." Month";
                            }
                            else
                            {
                            $duration= $calM." Months";                             
                            }
                            
                            $weightage =  round(($valueActivity['Planned_Value']/$project_total_cst * 100), 2) ;
                            //Progress Status %
                            $progress =  round(($valueActivity['Earned_Value']/$project_total_cst * 100), 2) ;
                            //Actual Cost % 
                            $actual_cost =  round(($valueActivity['Paid_Value']/$project_total_cst * 100), 2) ;
                            
                            

                       
                            $html .= '<tr style="text-align: center; vertical-align: middle;">
                                                    <td>' . $sl . '</td>
                                                    <td >' . $activity_name . '</td>';
                                $html .= '<td >' . $start_dateview . '</td>
                                         <td >' . $duration . '</td>';
                            $html .= '<td >' . $finish_dateview . '</td>
                                     <td >' . $weightage . '</td>
                                     <td >' . $val_total_planned . '</td>';
                                     $html .= '<td >' . $val_total_earned . '</td>
                                     <td >' . $actual_cost . '</td>
                                     <td >' . $val_total_paid . '</td>
                                   </tr>';
                        }
                    } else {
                        //$html .='<tr colspan="5"><td>No Data Available</td></tr>';
                        $html .= '<tr ><td colspan="9">No Data Available</td></tr>';
                    }


                    $html .= '</tbody>
                            </table>
                        </div>
                    </div>
                </div>';

                }
            }


        /* close all data show table */

        } else {
            $html .= 'No Data Available';
        }

        //echo "<br>project_work_item_details_ar: <pre>"; print_r($project_work_item_details_ar); die();
        echo $html;
        die();
    }

}
?>