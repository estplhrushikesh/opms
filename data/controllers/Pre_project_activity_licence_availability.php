<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pre_project_activity_licence_availability extends MY_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security','project_helper','pre_con_act_quick_nav_helper'));
        $this->load->model('Environmental_clearance_model');
        /*To Check whether logged in */
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        
    }

    public function manage()
    {
        
        $user_id = $this->session->userdata('id');
        $project_id = base64_decode($_REQUEST['project_id']); 
        $data['project_id'] = base64_decode($_REQUEST['project_id']);
        
    $projectData_exist_flag = $this->Environmental_clearance_model->checkProjectExits($project_id);
        
        $data['get_env_clearance'] = $this->Environmental_clearance_model->get_env_clearance($project_id);

    
        $this->form_validation->set_rules('dept_approve', 'Department Approval', 'required'); 
        
           /*** Form Validation Rules***/
        if ($this->form_validation->run() == FALSE) {
            
            
            $this->load->common_template('pre_project_activity/pre_project_activity_licence_availability', $data);

        }
        
        else{ 
        
        
            
        $submit = $this->input->post('submit');
        if($submit == 'Submit'){


            $db_data['project_id'] = $project_id;
            $db_data['dept_approve'] = $_REQUEST['dept_approve'];
            $db_data['dept_budge'] = $_REQUEST['dept_budge'];
            $db_data['dept_stakehold'] = $_REQUEST['dept_stakehold'];
            
          //  $db_data['department_id'] = $_REQUEST['department_id'];
            $db_data['target_date'] = $_REQUEST['target_date'];
          //  $db_data['status_alienation_proposed'] = $_REQUEST['status_alienation_proposed'];
            $db_data['progress_%'] = ($_REQUEST['progress'] == '') ? NULL : $_REQUEST['progress'];
            // $db_data['status_relinquishment_proposal'] = $_REQUEST['status_relinquishment_proposal'];
            // $db_data['progress_land_alienated'] = ($_REQUEST['progress_land_alienated'] == '') ? NULL : $_REQUEST['progress_land_alienated'];
            // $db_data['progress_%'] = ($_REQUEST['progress'] == '') ? NULL : $_REQUEST['progress'];
             $db_data['activity_status'] = $_REQUEST['activity_status'];
           // $db_data['progress_amount_utilised'] = ($_REQUEST['amount_utilised'] == '') ? NULL : $_REQUEST['amount_utilised'];
            // $db_data['progress_amount_utilised'] = ($_REQUEST['amount_utilised'] == '') ? NULL : str_replace(',','',$_REQUEST['amount_utilised']);
            // $db_data['progress_fund_utilised'] = ($_REQUEST['fund_utilised'] == '') ? NULL : $_REQUEST['fund_utilised'];
            // $db_data['remarks'] = $_REQUEST['remarks'];
            $db_data['entered_by'] = $user_id;
            
             // File upload
    	if (!is_dir('uploads/files/env_clearance')) {
                    mkdir('./uploads/files/env_clearance');
                 }
    

    
      $config['upload_path']          = 'uploads/files/env_clearance/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg|JPEG|JPG|PNG|GIF|txt|pdf|doc|docx';
    $config['max_size']             = 2000000;
    
    
    
    
    
    if($_FILES["file_EIA"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_EIA']['name'];
        $this->load->library('upload', $config);
        $file_EIA = $this->upload->do_upload('file_EIA');
        if (!$file_EIA){
            $error = array('error' => $this->upload->display_errors());
               $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_environmental_clearance/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_EIA = $this->upload->data("file_name");
        }
        
            $db_data['file_EIA'] = $file_EIA;
    }
    else {
        
        if (!empty ($_REQUEST['file_EIA_hidden'])) {
            
            $db_data['file_EIA'] = $_REQUEST['file_EIA_hidden'];
            
        }
        
    }
    

    if($_FILES["file_application"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_application']['name'];
        $this->load->library('upload', $config);
        // if($_FILES["file_relinquishment_proposal"]["name"]){
        //     $this->upload->initialize($config);
        // }else{
        //     $this->load->library('upload', $config);
        // }
        $file_application = $this->upload->do_upload('file_application');
        if (!$file_application){
            $error = array('error' => $this->upload->display_errors());
               $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_environmental_clearance/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_application = $this->upload->data("file_name");
        }
        
            $db_data['file_application'] = $file_application;
        
    }
    else {
        
        if (!empty ($_REQUEST['file_application_hidden'])) {
            
            $db_data['file_application'] = $_REQUEST['file_application_hidden'];
            
        }
        
    }
    if($_FILES["file_OSCPCB"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_OSCPCB']['name'];
        $this->load->library('upload', $config);
        // if($_FILES["file_relinquishment_proposal"]["name"]){
        //     $this->upload->initialize($config);
        // }else{
        //     $this->load->library('upload', $config);
        // }
        $file_OSCPCB = $this->upload->do_upload('file_OSCPCB');
        if (!$file_OSCPCB){
            $error = array('error' => $this->upload->display_errors());
               $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_environmental_clearance/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_OSCPCB = $this->upload->data("file_name");
        }
        
            $db_data['file_OSCPCB'] = $file_OSCPCB;
        
    }
    else {
        
        if (!empty ($_REQUEST['file_OSCPCB_hidden'])) {
            
            $db_data['file_OSCPCB'] = $_REQUEST['file_OSCPCB_hidden'];
            
        }
        
    }        
    if($_FILES["file_EC"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_EC']['name'];
        $this->load->library('upload', $config);
        // if($_FILES["file_relinquishment_proposal"]["name"]){
        //     $this->upload->initialize($config);
        // }else{
        //     $this->load->library('upload', $config);
        // }
        $file_EC = $this->upload->do_upload('file_EC');
        if (!$file_EC){
            $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_environmental_clearance/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_EC = $this->upload->data("file_name");
        }
        
            $db_data['file_EC'] = $file_EC;
        
    }
    else {
        
        if (!empty ($_REQUEST['file_EC_hidden'])) {
            
            $db_data['file_EC'] = $_REQUEST['file_EC_hidden'];
            
        }
        
    }
    if($_FILES["file_fund_deposit"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_fund_deposit']['name'];
        $this->load->library('upload', $config);
        // if($_FILES["file_relinquishment_proposal"]["name"]){
        //     $this->upload->initialize($config);
        // }else{
        //     $this->load->library('upload', $config);
        // }
        $file_fund_deposit = $this->upload->do_upload('file_fund_deposit');
        if (!$file_fund_deposit){
            $error = array('error' => $this->upload->display_errors());
               $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_environmental_clearance/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_fund_deposit = $this->upload->data("file_name");
        }
        
            $db_data['file_fund_deposit'] = $file_fund_deposit;
        
    }
    else {
        
        if (!empty ($_REQUEST['file_fund_deposit_hidden'])) {
            
            $db_data['file_fund_deposit'] = $_REQUEST['file_fund_deposit_hidden'];
            
        }
        
    }
  
        if(!empty($projectData_exist_flag)){  //UPDATE
                 
                $env_clearance_id = $data['get_env_clearance'][0]['id'];

                $EE_last_data_update =$this->Environmental_clearance_model->update_env_clearance($db_data,$env_clearance_id);

             }
             
             
             else { //ADD
            
                $EE_last_data =$this->Environmental_clearance_model->save_env_clearance($db_data);
            
             }
        
        
        }
            
                $this->session->set_flashdata('success', 'Pre Construction Activities Data saved successfully');
        
         if($project_id){

                redirect('Pre_project_activity_licence_availability/manage?project_id=' . base64_encode($project_id));
            }
        
        }
        
        
        
    }
    
    
    

}  
 

?>
