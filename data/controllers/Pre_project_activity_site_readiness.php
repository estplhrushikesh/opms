<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pre_project_activity_site_readiness extends MY_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security','project_helper','pre_con_act_quick_nav_helper'));
        $this->load->model('Utility_shifting_ph_model');
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
        $data['districts'] = $this->Utility_shifting_ph_model->fetch_district();
        
        
    $projectData_exist_flag = $this->Utility_shifting_ph_model->checkProjectExits($project_id);
        
        $data['utility_ph'] = $this->Utility_shifting_ph_model->get_utili_ph($project_id);
        $data['utility_ph_location'] = $this->Utility_shifting_ph_model->utilityph_location_data($project_id);
    
        $this->form_validation->set_rules('dept_approve', 'Department Approval', 'required'); 
        
           /*** Form Validation Rules***/
        if ($this->form_validation->run() == FALSE) {
            
            
           $this->load->common_template('pre_project_activity/pre_project_activity_site_readiness', $data);

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
        if (!is_dir('uploads/files/shifting_ph')) {
                    mkdir('./uploads/files/shifting_ph');
                 }      
    

    
      $config['upload_path']          = 'uploads/files/shifting_ph/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg|JPEG|JPG|PNG|GIF|txt|pdf|doc|docx';
    $config['max_size']             = 2000000;
    
    
    
    
    
    if($_FILES["file_joint_verification"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_joint_verification']['name'];
        $this->load->library('upload', $config);
        $file_joint_verification = $this->upload->do_upload('file_joint_verification');
        if (!$file_joint_verification){
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_utility_shifting_ph/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_joint_verification = $this->upload->data("file_name");
        }
        
            $db_data['file_joint_verification'] = $file_joint_verification;
    }
    else {
        
        if (!empty ($_REQUEST['file_joint_verification_hidden'])) {
            
            $db_data['file_joint_verification'] = $_REQUEST['file_joint_verification_hidden'];
            
        }
        
    }
    

    if($_FILES["file_fund_for_utility_shifting"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_fund_for_utility_shifting']['name'];
        $this->load->library('upload', $config);
        // if($_FILES["file_relinquishment_proposal"]["name"]){
        //     $this->upload->initialize($config);
        // }else{
        //     $this->load->library('upload', $config);
        // }
        $file_fund_for_utility_shifting = $this->upload->do_upload('file_fund_for_utility_shifting');
        if (!$file_fund_for_utility_shifting){
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_utility_shifting_ph/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_fund_for_utility_shifting = $this->upload->data("file_name");
        }
        
            $db_data['file_fund_for_utility_shifting'] = $file_fund_for_utility_shifting;
        
    }
    else {
        
        if (!empty ($_REQUEST['file_fund_for_utility_shifting_hidden'])) {
            
            $db_data['file_fund_for_utility_shifting'] = $_REQUEST['file_fund_for_utility_shifting_hidden'];
            
        }
        
    }
    if($_FILES["file_tender_awarded"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_tender_awarded']['name'];
        $this->load->library('upload', $config);
        // if($_FILES["file_relinquishment_proposal"]["name"]){
        //     $this->upload->initialize($config);
        // }else{
        //     $this->load->library('upload', $config);
        // }
        $file_tender_awarded = $this->upload->do_upload('file_tender_awarded');
        if (!$file_tender_awarded){
            $error = array('error' => $this->upload->display_errors());
             $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_utility_shifting_ph/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_tender_awarded = $this->upload->data("file_name");
        }
        
            $db_data['file_tender_awarded'] = $file_tender_awarded;
        
    }
    else {
        
        if (!empty ($_REQUEST['file_tender_awarded_hidden'])) {
            
            $db_data['file_tender_awarded'] = $_REQUEST['file_tender_awarded_hidden'];
            
        }
        
    }        
  
        if(!empty($projectData_exist_flag)){  //UPDATE
                 
                $utility_ph_id = $data['utility_ph'][0]['id'];

                $EE_last_data_update =$this->Utility_shifting_ph_model->update_utili_ph($db_data,$utility_ph_id);

             }
             
             
             else { //ADD
            
                $EE_last_data =$this->Utility_shifting_ph_model->saveutilityshiftingph($db_data);
            
             }

     //location update

            if (!empty($data['utility_ph_location'])) {
                
               $del_location_data =$this->Utility_shifting_ph_model->deleteUtility_ph_location($project_id);
                        
            }

          $dist_id_count = count($_REQUEST['dist_id']);
          $dist_id_arr = $this->input->post('dist_id');
          $ulb_id_arr = $this->input->post('ulb_id');
          $phd_id_arr = $this->input->post('phd_id');

        for ($i=0; $i < $dist_id_count; $i++) { 
              
          if(!empty($phd_id_arr[$i]))
            {
            $a_id = implode(",", $phd_id_arr[$i]);
            if($a_id != ''){
            $phd_id = $a_id;
            }else{
            $phd_id = 0;
            }
                }
        else {
                    $phd_id = 0; 
                }
           
               if($dist_id_arr[$i] != 0) {
        
                    $addData = array(
                    'project_id' => $project_id, 
                    'relation_id' => $EE_last_data,
                    'district_id' => $dist_id_arr[$i], 
                    'ulb_id' => $ulb_id_arr[$i],
                    'ph_division_id' => $phd_id,
                    'entered_by' => $user_id
                );


         if(!empty($projectData_exist_flag)){  //UPDATE
         
        $utility_ph_id = $data['utility_ph'][0]['id'];
        
                    $UaddData = array(
                    'project_id' => $project_id, 
                    'relation_id' => $utility_ph_id,
                    'district_id' => $dist_id_arr[$i], 
                    'ulb_id' => $ulb_id_arr[$i],
                    'ph_division_id' => $phd_id,
                    'entered_by' => $user_id
                );
          
        
    $this->Utility_shifting_ph_model->addutility_ph_location($UaddData);
         }
         else
         {
        
    $this->Utility_shifting_ph_model->addutility_ph_location($addData);
        
         }
 }
                
            }
        
        
        
    }
            
                $this->session->set_flashdata('success', 'Pre Construction Activities Data saved successfully');
        
         if($project_id){

                redirect('Pre_project_activity_site_readiness/manage?project_id=' . base64_encode($project_id));
            }
        
        }
        
        
        
    }
    
    function getelectrical_divison(){
        $dist_id = $this->input->post('distId');
    if($dist_id!=''){
        $data['all_divison'] = $this->Utility_shifting_ph_model->fetch_divison($dist_id);
        echo  json_encode($data);
    }else{
                    
    }
    }
    function getdiscom_list(){
        $dist_id = $this->input->post('dist_id');
        if($dist_id != ''){
            $data['all_discom'] = $this->Utility_shifting_ph_model->discom_listing($dist_id);
        echo  json_encode($data);
        }else{

        }
    }
    function getph_divison() {

        $ulb_id = $this->input->post('ulb_id');
        if($ulb_id != ''){
            $data['all_phdivision'] = $this->Utility_shifting_ph_model->fetch_ph_divison($ulb_id);
        echo  json_encode($data);
        }else{

        }

    }
    
  function getselulb($district_id,$ulb_id) {
 

    if($district_id != 0 || $ulb_id != 0) {

       $selulbs = $this->Utility_shifting_ph_model->fetch_ulb($district_id);

            foreach ($selulbs as $key) {

                if($key->ulb_id == $ulb_id) {
                     $s = 'selected';
                 }
                 else {
                     $s = '';
                 }

                  $r .= '<option value="'.$key->ulb_id.'" '.$s.'>'.$key->ulb_name.'</option>';
               
            }

       }

       else {
        $r = '';
      }

      echo $r;

  } 

  function get_phd_data($ulb_id,$ph_division_id){
    $r = '';
    if($ph_division_id != 0 || $ph_division_id != ''){

    
    $ph_division_id_n = str_replace(":",",",$ph_division_id);
    $ph_division_id_arr = explode(',', $ph_division_id_n);
    $all_ph_division = $this->Utility_shifting_ph_model->fetch_ph_division($ulb_id);
    if(is_array($all_ph_division)){
      foreach ($all_ph_division as $key) {
        if(in_array($key->id, $ph_division_id_arr)){
          $s = 'selected';
        }else{
          $s = '';
        }
        $r .= '<option value="'.$key->id.'" '.$s.'>'.$key->ph_division_name.'</option>';
      }
    }

    }else{
      $r = '';
    }

    echo $r;
  }

}  
 

?>
