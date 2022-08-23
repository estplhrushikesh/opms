<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');



class Pre_Qualification extends MY_Controller
{
	public function __construct()
	{
	parent::__construct();
	$this->load->library('session');
	$this->load->library('pagination');
	// $this->load->library('form_validation');
	$this->load->helper(array('form', 'url', 'security','project_helper','pre_con_act_quick_nav_helper','tendering_stepsbar_helper'));
	$this->load->model('Pre_Qualification_model');

	/*To Check whether logged in */
	$logged_in = $this->session->userdata('is_logged_in');
	if (empty($logged_in)) {
	$this->session->set_flashdata('message', 'You have to log in to access this section');
	redirect('Home');
	}

}



function delete_single_user()
{
   $this->Pre_Qualification_model->delete_single_user($_POST["user_id"]);

}



public function manage(){
		$user_id = $this->session->userdata('id');

		$project_id = base64_decode($_REQUEST['project_id']);
		$data['project_id'] = base64_decode($_REQUEST['project_id']);


		$projectData_exist_flag = $this->Pre_Qualification_model->checkProjectExits($project_id);

		$data['get_technicaleva'] = $this->Pre_Qualification_model->getprequalification($project_id);

		$data['get_technicaevalupdate'] = $this->Pre_Qualification_model->getprequalificationupdate($project_id);

		$data['Pre_Qualification_data'] = $this->Pre_Qualification_model->Pre_Qualification_data($project_id);



		if(!empty($_REQUEST['submit'])){


		$submit = $this->input->post('submit');
		if($submit == 'Submit'){

		$db_data['project_id'] = $project_id;
			if(empty($_REQUEST['approval_date'])){
			$db_data['approval_date'] = '0000-00-00';
		}
		else{
			$db_data['approval_date'] = $_REQUEST['approval_date'];
		}

		if(empty($_REQUEST['approval_status'])){
			$db_data['approval_status'] = 'P';
		}
		else{
			$db_data['approval_status'] = $_REQUEST['approval_status'];
		}
		$db_data['remarks'] = $_REQUEST['remarks'];
		$db_data['entered_by'] = $user_id;



		if(!empty($projectData_exist_flag)){ //UPDATE

		$techeval_id = $data['get_technicaleva'][0]['id'];
		$EE_last_data =$this->Pre_Qualification_model->updatetechnical($db_data,$techeval_id);
		}

		else {
		$EE_last_data =$this->Pre_Qualification_model->savequalification($db_data);//ADD
		}



		$bidder_refno_count = count($_REQUEST['bidder_refno']);
		$bidder_refno = $this->input->post('bidder_refno');
		$tech_score_update = $this->input->post('tech_score_update');
		$tech_qualified = $this->input->post('technical_status');



		for ($i=0; $i < $bidder_refno_count; $i++) {



		$addData = array(
		'project_id' => $project_id,
		'tendering_pre_qualification_id' => $EE_last_data,
		'bidder_ref_no' => $bidder_refno[$i],
		'technical_score' => $tech_score_update[$i],
		'technical_status' => $tech_qualified[$i],
		'entered_by' => $user_id
		);



		if(!empty($projectData_exist_flag)){//UPDATE

		// update
		$techevnupdateid = $data['get_technicaevalupdate'][$i]['id'];
		if(!empty($techevnupdateid)){
			$UaddData = array(
			'project_id' => $project_id,
			'tendering_pre_qualification_id' => $techeval_id,
			'bidder_ref_no' => $bidder_refno[$i],
			'technical_score' => $tech_score_update[$i],
			'technical_status' => $tech_qualified[$i],
			'entered_by' => $user_id
		);

		$this->Pre_Qualification_model->updatetechnicalid($UaddData,$techevnupdateid);
		}



		else{

		$addData1 = array(
			'project_id' => $project_id,
			'tendering_pre_qualification_id' => $techeval_id,
			'bidder_ref_no' => $bidder_refno[$i],
			'technical_score' => $tech_score_update[$i],
			'technical_status' => $tech_qualified[$i],
			'entered_by' => $user_id
		);



    $this->Pre_Qualification_model->addqualification($addData1);


   }
}
	else {

		$this->Pre_Qualification_model->addqualification($addData);
		}
	}
}



 $this->session->set_flashdata('success', 'Pre Qualification saved successfully');



if($project_id){
	redirect('Pre_Qualification/manage?project_id=' . base64_encode($project_id));
	  }
	}
	$this->load->common_template('tendering/pre_qualification',$data);
	}
}

?>