<?php

class Dashboard_model extends CI_Model {
	
	  function __construct(){
      parent :: __construct();
      $this->load->database();
    }

   public function get_total_project_count($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id){
      $this->db->select('COUNT(*) AS total_project');
	  
      if($project_sector_id > 0){
        $this->db->where('project_sector', $project_sector_id);  
      }
      if($project_group_id > 0){
        $this->db->where('project_group', $project_group_id);  
      }
    if($project_category_id > 0){
        $this->db->where('project_type', $project_category_id);  
      }
      if($project_area_id > 0){
        $this->db->where('location_id', $project_area_id);  
      }
    if($project_wing_id > 0){
        $this->db->where('wing_id', $project_wing_id);  
      }
      if($project_division_id > 0){
        $this->db->where('division_id', $project_division_id);  
      }
      $query = $this->db->get('project_conceptualisation_stage');
	  //echo $this->db->last_query(); die;
      return $query->result_array();
    }

   
    public function get_ongoing_project_count($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id){
      $this->db->select('project_conceptualisation_stage.*,td.*');
	  if($project_sector_id > 0){
        $this->db->where('project_conceptualisation_stage.project_sector', $project_sector_id);  
      }
      if($project_group_id > 0){
        $this->db->where('project_conceptualisation_stage.project_group', $project_group_id);  
      }
    if($project_category_id > 0){
        $this->db->where('project_conceptualisation_stage.project_type', $project_category_id);  
      }
      if($project_area_id > 0){
        $this->db->where('project_conceptualisation_stage.location_id', $project_area_id);  
      }
    if($project_wing_id > 0){
        $this->db->where('project_conceptualisation_stage.wing_id', $project_wing_id);  
      }
      if($project_division_id > 0){
        $this->db->where('project_conceptualisation_stage.division_id', $project_division_id);  
      }
      $this->db->where('td.approve_status', 'Y');
      $this->db->join('project_aggrement_stage as td', 'project_conceptualisation_stage.id = td.project_id', 'LEFT');
      $query = $this->db->get('project_conceptualisation_stage');
	  //echo $this->db->last_query(); die;
      return $query->result_array();
    }

    public function get_completed_project_count($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id){
      $this->db->select('project_conceptualisation_stage.*,td.*');
	  if($project_sector_id > 0){
        $this->db->where('project_conceptualisation_stage.project_sector', $project_sector_id);  
      }
      if($project_group_id > 0){
        $this->db->where('project_conceptualisation_stage.project_group', $project_group_id);  
      }
    if($project_category_id > 0){
        $this->db->where('project_conceptualisation_stage.project_type', $project_category_id);  
      }
      if($project_area_id > 0){
        $this->db->where('project_conceptualisation_stage.location_id', $project_area_id);  
      }
    if($project_wing_id > 0){
        $this->db->where('project_conceptualisation_stage.wing_id', $project_wing_id);  
      }
      if($project_division_id > 0){
        $this->db->where('project_conceptualisation_stage.division_id', $project_division_id);  
      }
      //$this->db->where('status', 'C'); 
      $this->db->join('project_completed_history as td', 'project_conceptualisation_stage.id = td.project_id', 'RIGHT');
      $query = $this->db->get('project_conceptualisation_stage');
      return $query->result_array();
    }
	
	
    public function get_project_type(){

        $this->db->select('*');
        $this->db->where('status', 'Y');
        $query = $this->db->get('project_type_master');

        return $query->result_array();
    }
    public function get_project_area(  ){

        $this->db->select('*');
        $this->db->where('status', 'Y');
        $query = $this->db->get('area_master');

        return $query->result_array();
    }
    public function get_sector(){

        $this->db->select('*');
        $this->db->where('status', 'Y');
        $query = $this->db->get('sector_master');

        return $query->result_array();
    }
   
    public function get_group(){

        $this->db->select('*');
        $this->db->where('status', 'Y');
        $query = $this->db->get('group_master');

        return $query->result_array();
    }
    public function get_destination($project_area_id ){

        $this->db->select('*');
        $this->db->where('area_id', $project_area_id);
        $this->db->where('status', 'Y');
        $query = $this->db->get('destination_master');

        return $query->result_array();
    }

    public function get_wing(){

        $this->db->select('*');
        $this->db->where('status', 'Y');
        $query = $this->db->get('wing_master');

        return $query->result_array();
    }

    public function get_division(){

        $this->db->select('*');
        $this->db->where('status', 'Y');
        $query = $this->db->get('division_master');

        return $query->result_array();
    }


   public function get_project_budget($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id) {
      $this->db->select('sum(estimate_total_cost) as total_project_budget'); 
	   if($project_sector_id > 0){
        $this->db->where('project_sector', $project_sector_id);  
      }
      if($project_group_id > 0){
        $this->db->where('project_group', $project_group_id);  
      }
    if($project_category_id > 0){
        $this->db->where('project_type', $project_category_id);  
      }
      if($project_area_id > 0){
        $this->db->where('location_id', $project_area_id);  
      }
    if($project_wing_id > 0){
        $this->db->where('wing_id', $project_wing_id);  
      }
      if($project_division_id > 0){
        $this->db->where('division_id', $project_division_id);  
      }
      $query = $this->db->get('project_conceptualisation_stage');
	 // echo $this->db->last_query();
      return $query->result_array();
    }

    public function get_project_expendature($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id) {
		
      $this->db->select('sum(pi.paid_amount) as total_project_expen'); 
	  $this->db->from('project_invoice_payment_history as pi'); 
	    if($project_sector_id > 0){
        $this->db->where('pd.project_sector', $project_sector_id);  
      }
      if($project_group_id > 0){
        $this->db->where('pd.project_group', $project_group_id);  
      }
    if($project_category_id > 0){
        $this->db->where('pd.project_type', $project_category_id);  
      }
      if($project_area_id > 0){
        $this->db->where('pd.location_id', $project_area_id);  
      }
    if($project_wing_id > 0){
        $this->db->where('pd.wing_id', $project_wing_id);  
      }
      if($project_division_id > 0){
        $this->db->where('pd.division_id', $project_division_id);  
      }
	  if(($project_sector_id > 0) || ($project_group_id > 0) || ($project_category_id > 0) || ($project_area_id > 0) || ($project_wing_id > 0) || ($project_division_id > 0)){
        $this->db->join('project_invoice as in', 'pi.invoice_id = in.id', 'LEFT');
        $this->db->join('project_conceptualisation_stage as pd', 'in.project_id = pd.id', 'LEFT');
      }
      //$query = $this->db->get('project_invoice_payment_history');
	  $query = $this->db->get();
	 // echo $this->db->last_query();
      return $query->result_array();
    }
	
	 public function get_project_agreement_amount($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id){

      $this->db->select('sum(td.agreement_cost) as proj_agreement_cost');
      $this->db->from('project_conceptualisation_stage as pd'); 
	   if($project_sector_id > 0){
        $this->db->where('pd.project_sector', $project_sector_id);  
      }
      if($project_group_id > 0){
        $this->db->where('pd.project_group', $project_group_id);  
      }
    if($project_category_id > 0){
        $this->db->where('pd.project_type', $project_category_id);  
      }
      if($project_area_id > 0){
        $this->db->where('pd.location_id', $project_area_id);  
      }
    if($project_wing_id > 0){
        $this->db->where('pd.wing_id', $project_wing_id);  
      }
      if($project_division_id > 0){
        $this->db->where('pd.division_id', $project_division_id);  
      }
      $this->db->join('project_aggrement_stage as td', 'pd.id = td.project_id', 'LEFT');
      $query = $this->db->get();
       // echo $this->db->last_query(); die();
      return $query->result_array(); 
    }
	
	
	

    public function get_project_released_amount($project_id=null) {
      $this->db->select('sum(total_activity_allotted_amount) as total_activity_allotted_amount');
      if(!empty($project_id)){
        $this->db->where('project_id', $project_id);  
      }
      $this->db->where('status', 'Y');
      $query = $this->db->get('project_financial_planning_main');
       // echo $this->db->last_query(); die();
      return $query->result_array();
    }

    public function get_financial_progress_monthly($project_category_id, $project_area_id){
		
		
		$query = $this->db->query("SELECT a.id,a.invoice_date,DATE_FORMAT(a.invoice_date, '%Y-%m') as months, IFNULL(SUM(b.amount), 0) AS total_amnt
    FROM `project_invoice` a
    left join project_invoice_details b on b.invoice_id=a.id 
    
	GROUP BY DATE_FORMAT(a.invoice_date, '%Y-%m')");
	
	
		
		
      return $query->result_array();  
    }
    public function get_financial_released($project_category_id, $project_area_id){
		
		
		$query = $this->db->query("SELECT a.id,a.invoice_date,DATE_FORMAT(b.payment_date, '%Y-%m') as months, IFNULL(SUM(b.paid_amount), 0) AS totalP_amnt
    FROM `project_invoice` a
    join project_invoice_payment_history b on b.invoice_id=a.id 
    
	WHERE   GROUP BY DATE_FORMAT(b.payment_date, '%Y-%m')");
	
      return $query->result_array();  
    }
    public function get_financial_overview($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id){
		
			
			$condition = "";	
			  if($project_sector_id > 0){
        $condition = "AND w.project_sector='$project_sector_id'";  
        $conditionN = "AND pd.project_sector='$project_sector_id'"; 
      }
      if($project_group_id > 0){
        $condition = "AND w.project_group='$project_group_id'"; 
        $conditionN = "AND pd.project_group='$project_group_id'"; 
      }
	  if($project_category_id > 0){
        $condition = "AND w.project_type='$project_category_id'";
        $conditionN = "AND pd.project_type='$project_category_id'";
      }
      if($project_area_id > 0){
        $condition = "AND w.location_id='$project_area_id'";
        $conditionN = "AND pd.location_id='$project_area_id'"; 
      }

	  if($project_wing_id > 0){
        $condition = "AND w.wing_id='$project_wing_id'"; 
        $conditionN = "AND pd.wing_id='$project_wing_id'";
      }

      if($project_division_id > 0){
        $condition = "AND w.division_id='$project_division_id'"; 
        $conditionN = "AND pd.division_id='$project_division_id'";
      }
	  
	  
		$query = $this->db->query("SELECT 
       SUM(claimed) as claimed,
       SUM(released) as released,
       period

FROM (

       SELECT a.id,a.invoice_date,DATE_FORMAT(b.payment_date, '%Y-%m') as period, IFNULL(SUM(b.paid_amount), 0) AS released, 0 as claimed
    FROM `project_invoice` a
    join project_invoice_payment_history b on b.invoice_id=a.id 
    left join project_conceptualisation_stage w on a.project_id=w.id 
    
	WHERE 1=1 $condition GROUP BY DATE_FORMAT(b.payment_date, '%Y-%m')

UNION ALL 

SELECT c.id,c.invoice_date,DATE_FORMAT(c.invoice_date, '%Y-%m') as period, 0 as released, IFNULL(SUM(d.amount), 0) AS claimed
    FROM `project_invoice` c
    left join project_invoice_details d on d.invoice_id=c.id 
    left join project_conceptualisation_stage pd on c.project_id=pd.id 
    
	WHERE 1=1 $conditionN GROUP BY DATE_FORMAT(c.invoice_date, '%Y-%m')
) A
GROUP by period");
	
	
	 //echo $this->db->last_query(); die();
      return $query->result_array();  
    }

    public function get_work_item_budget($project_sector_id, $project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id){


      $this->db->select('pwi.work_item_id, pwi.amount, pwi.status, wim.work_item_description');
      $this->db->from('project_work_items as pwi');
      if($project_sector_id > 0){
        $this->db->where('pd.project_sector', $project_sector_id);  
      }
      if($project_group_id > 0){
        $this->db->where('pd.project_group', $project_group_id);  
      }
    if($project_category_id > 0){
        $this->db->where('pd.project_type', $project_category_id);  
      }
      if($project_area_id > 0){
        $this->db->where('pd.location_id', $project_area_id);  
      }
    if($project_wing_id > 0){
        $this->db->where('pd.wing_id', $project_wing_id);  
      }
      if($project_division_id > 0){
        $this->db->where('pd.division_id', $project_division_id);  
      }
      
      $this->db->where('pwi.status', 'Y');
      if(($project_category_id > 0) || ($project_area_id > 0) || ($project_sector_id > 0) || ($project_group_id > 0) || ($project_wing_id > 0) || ($project_division_id > 0) ){
        $this->db->join('project_conceptualisation_stage as pd', 'pwi.project_id = pd.id', 'LEFT');
      }
      
      $this->db->join('work_item_master as wim', 'pwi.work_item_id = wim.id', 'LEFT');
      $query = $this->db->get();
       //echo $this->db->last_query(); die();
      return $query->result_array(); 
    }

    public function get_work_item_released($project_work_item_id, $project_sector_id, $project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id){
      //SELECT project_work_item_id, IFNULL(SUM(total_activity_allotted_amount), 0) AS total_released FROM project_financial_planning_main WHERE project_work_item_id = 14 AND status = 'Y' GROUP BY project_work_item_id
      $this->db->select('pfpm.project_work_item_id, IFNULL(SUM(pfpm.total_activity_allotted_amount), 0) AS total_released');
      //$this->db->from('project_financial_planning_main');
      $this->db->where('pfpm.project_work_item_id', $project_work_item_id);  
      if($project_sector_id > 0){
        $this->db->where('pd.project_sector', $project_sector_id);  
      }
      if($project_group_id > 0){
        $this->db->where('pd.project_group', $project_group_id);  
      }
    if($project_category_id > 0){
        $this->db->where('pd.project_type', $project_category_id);  
      }
      if($project_area_id > 0){
        $this->db->where('pd.location_id', $project_area_id);  
      }
    if($project_wing_id > 0){
        $this->db->where('pd.wing_id', $project_wing_id);  
      }
      if($project_division_id > 0){
        $this->db->where('pd.division_id', $project_division_id);  
      }
      $this->db->where('pfpm.status', 'Y');
      if(($project_category_id > 0) || ($project_area_id > 0) || ($project_sector_id > 0) || ($project_group_id > 0) || ($project_wing_id > 0) || ($project_division_id > 0) ){
        $this->db->join('project_conceptualisation_stage as pd', 'pfpm.project_id = pd.id', 'LEFT');
      }
      
      $this->db->group_by('pfpm.project_work_item_id');
      $query = $this->db->get('project_financial_planning_main as pfpm');
	  
      // echo $this->db->last_query(); die();
      return $query->result_array();  
    }

   
    public function get_project_details($project_sector_id, $project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id ){
      $this->db->select('project_conceptualisation_stage.*,pa.agreement_date as project_start_date,pa.agreement_end_date as project_end_date');
	  if($project_sector_id > 0){
        $this->db->where('project_conceptualisation_stage.project_sector', $project_sector_id);  
      }
      if($project_group_id > 0){
        $this->db->where('project_conceptualisation_stage.project_group', $project_group_id);  
      }
    if($project_category_id > 0){
        $this->db->where('project_conceptualisation_stage.project_type', $project_category_id);  
      }
      if($project_area_id > 0){
        $this->db->where('project_conceptualisation_stage.location_id', $project_area_id);  
      }
    if($project_wing_id > 0){
        $this->db->where('project_conceptualisation_stage.wing_id', $project_wing_id);  
      }
      if($project_division_id > 0){
        $this->db->where('project_conceptualisation_stage.division_id', $project_division_id);  
      }
	 
      $this->db->where('pa.approve_status', 'Y');
      $this->db->join('project_aggrement_stage as pa', 'pa.project_id = project_conceptualisation_stage.id', 'LEFT');
      $query = $this->db->get('project_conceptualisation_stage');
       // echo $this->db->last_query(); die;
      return $query->result_array();
    }


    public function get_project_details_xhr($project_category_id, $project_area_id){
      //echo "project_category_id: ".$project_category_id;echo "<br>project_area_id: ".$project_area_id; die();
      $this->db->select('project_detail.*');
      if($project_category_id > 0){
        $this->db->where('project_detail.project_type', $project_category_id);  
      }
      if($project_area_id > 0){
        $this->db->where('project_detail.project_area', $project_area_id);  
      }
      $this->db->where('project_detail.status', 'Y');
      //$this->db->where('project_detail.project_id', $project_id);
      $query = $this->db->get('project_detail');
      return $query->result_array();
    }

    function get_user_details($userId){


        $this->db->select('organization_user_details.*,user_designation_master.designation');
        $this->db->from('organization_user_details');
        $this->db->join('user', 'user.id = organization_user_details.user_id','left');
        $this->db->join('user_designation_master', 'user_designation_master.id = organization_user_details.designation_id','left');
        $this->db->where('user.id', $userId);

        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $result = $query->result_array();
        return $result;
    }
    public function getUserLinkedProject($org_user_id)
    {

        $this->db->select('count(project_user.project_id) as total_projects');

        $this->db->from('project_user');
        $this->db->where('project_user.user_id', $org_user_id);
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    public function get_master_module_id(){

        $this->db->select('*');
        $this->db->from('module_master');
        $this->db->where('moduleName', "Master");
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    public function get_master_child_module( $master_module_id = 0){

        $this->db->select('*');
        $this->db->from('module_master');
        $this->db->where('parent_relation_id', $master_module_id);
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    public function check_child_module_permission( $module_id,$user_id ){

        $this->db->select('module_master.moduleLabel,module_master.moduleUrl,module_master.menu_icon');
        $this->db->from('user_role_based_access');
        $this->db->join('module_master', 'module_master.id = user_role_based_access.module_id','left');
        $this->db->where('module_id', $module_id);
        $this->db->where('user_id', $user_id);
        $this->db->where('modify', 1);
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    public function get_parent_module_permission($user_id){

        $this->db->select('module_master.moduleLabel,module_master.menu_icon,module_master.id,module_master.moduleUrl');
        $this->db->from('user_role_based_access');
        $this->db->join('module_master', 'module_master.id = user_role_based_access.module_id','inner');
        $this->db->where('user_role_based_access.modify ', 1);
        $this->db->where('module_master.parent_relation_id ', 0);
        $this->db->where('user_role_based_access.user_id', $user_id);

        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    public function get_first_child_module( $user_id ,$parent_module_id ){

        $this->db->select('module_master.moduleUrl');
        $this->db->from('module_master');
        $this->db->join('user_role_based_access ', 'module_master.id = user_role_based_access.module_id','left');
        $this->db->where('user_role_based_access.modify ', 1);
        $this->db->where('module_master.parent_relation_id ', $parent_module_id);
        $this->db->where('user_role_based_access.user_id', $user_id);
        $this->db->order_by('module_master.id', 'ASC');
        $this->db->limit('1');

        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }
	
    	
    public function get_vendor_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id){
		
		
		  if($project_sector_id > 0){
        $this->db->where('pd.project_sector', $project_sector_id);  
      }
      if($project_group_id > 0){
        $this->db->where('pd.project_group', $project_group_id);  
      }
    if($project_category_id > 0){
        $this->db->where('pd.project_type', $project_category_id);  
      }
      if($project_area_id > 0){
        $this->db->where('pd.location_id', $project_area_id);  
      }
    if($project_wing_id > 0){
        $this->db->where('pd.wing_id', $project_wing_id);  
      }
      if($project_division_id > 0){
        $this->db->where('pd.division_id', $project_division_id);  
      }

        $this->db->select('vendor_master.vendor,project_invoice.vendor_id');
        $this->db->from('project_invoice');
        $this->db->join('vendor_master ', 'vendor_master.id = project_invoice.vendor_id','left');
	  if(($project_sector_id > 0) || ($project_group_id > 0) || ($project_category_id > 0) || ($project_area_id > 0) || ($project_wing_id > 0) || ($project_division_id > 0)){
        $this->db->join('project_conceptualisation_stage as pd', 'project_invoice.project_id = pd.id', 'LEFT');
      }
		
        $this->db->order_by('vendor_master.vendor', 'DESC');
        $this->db->group_by('vendor_master.id');
        $query = $this->db->get();
       // echo $this->db->last_query();
        return $query->result_array();
    }
	
		public function get_invoice_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_destination_id,$vendor_id)
    {
		
			$condition = "";	
			  if($project_sector_id > 0){
        $condition = "AND pd.project_sector='$project_sector_id'";  
      }
      if($project_group_id > 0){
        $condition = "AND pd.project_group='$project_group_id'"; 
      }
	  if($project_category_id > 0){
        $condition = "AND pd.project_type='$project_category_id'";
      }
      if($project_area_id > 0){
        $condition = "AND pd.project_area='$project_area_id'"; 
      }
	  if($project_destination_id > 0){
        $condition = "AND pd.project_destination='$project_destination_id'"; 
      }
 
   $query = $this->db->query("SELECT a.id,a.vendor_id,a.invoice_no,SUM(b.amount) as claimed_amnt 
    FROM `project_invoice` a
    left join project_invoice_details b on b.invoice_id=a.id 
    left join project_conceptualisation_stage pd on a.project_id=pd.id 
	WHERE  a.vendor_id='".$vendor_id."' $condition GROUP BY b.invoice_id");
	
	
	

      // echo $this->db->last_query().'<br><br>'; die;
        $result = $query->result_array();
        return $result;
 
 
	}
	
	
		public function get_invoicereleased_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_destination_id,$vendor_id)
    {
		
			$condition = "";	
			  if($project_sector_id > 0){
        $condition = "AND pd.project_sector='$project_sector_id'";  
      }
      if($project_group_id > 0){
        $condition = "AND pd.project_group='$project_group_id'"; 
      }
	  if($project_category_id > 0){
        $condition = "AND pd.project_type='$project_category_id'";
      }
      if($project_area_id > 0){
        $condition = "AND pd.project_area='$project_area_id'"; 
      }
	  if($project_destination_id > 0){
        $condition = "AND pd.project_destination='$project_destination_id'"; 
      }
 
 
   $query = $this->db->query("SELECT a.id,a.vendor_id,a.invoice_no,SUM(b.paid_amount) as released_amnt 
    FROM `project_invoice` a
    left join project_invoice_payment_history b on b.invoice_id=a.id 
    left join project_conceptualisation_stage pd on a.project_id=pd.id 
	WHERE a.vendor_id='".$vendor_id."' $condition GROUP BY b.invoice_id");
	
	
	

     //echo $this->db->last_query().'<br><br>'; die;
        $result = $query->result_array();
        return $result;
 
 
	}
	
		public function get_sof_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_destination_id)
    {
 
 
 		
			$condition = "";	
			  if($project_sector_id > 0){
        $condition = "AND a.project_sector='$project_sector_id'";  
      }
      if($project_group_id > 0){
        $condition = "AND a.project_group='$project_group_id'"; 
      }
	  if($project_category_id > 0){
        $condition = "AND a.project_type='$project_category_id'";
      }
      if($project_area_id > 0){
        $condition = "AND a.project_area='$project_area_id'"; 
      }
	  if($project_destination_id > 0){
        $condition = "AND a.project_destination='$project_destination_id'"; 
      }
 
	   $query = $this->db->query("SELECT a.id,b.project_id,b.source_of_fund_id,c.name,IFNULL(SUM(b.amount), 0) AS total_amnt
		FROM `project_conceptualisation_stage` a
		left join aa_amount_breakup_details b on b.project_id=a.id 
		left join source_of_fund_master c on c.id=b.source_of_fund_id 
		WHERE b.project_id IS NOT NULL $condition GROUP BY b.source_of_fund_id");
        $result = $query->result_array();
        return $result;
 
 
	}
	
	
	public function get_tenderProject($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_destination_id)
    	{
		$condition = "";	
			  if($project_sector_id > 0){
        $condition = "AND a.project_sector='$project_sector_id'";  
      }
      if($project_group_id > 0){
        $condition = "AND a.project_group='$project_group_id'"; 
      }
	  if($project_category_id > 0){
        $condition = "AND a.project_type='$project_category_id'";
      }
      if($project_area_id > 0){
        $condition = "AND a.project_area='$project_area_id'"; 
      }
	  if($project_destination_id > 0){
        $condition = "AND a.project_destination='$project_destination_id'"; 
      }
 
   $query = $this->db->query("SELECT *
    FROM `project_conceptualisation_stage` a
		left join project_pre_tender_stage b on b.project_id=a.id 
	WHERE b.tender_document_approved='Y' AND a.status='N' $condition ");
    // echo $this->db->last_query().'<br><br>'; die;
        $result = $query->result_array();
        return $result;
 
 
	}
	
	public function get_tenderProjectAA_amount($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_destination_id,$newprojIds)
    	{
			
			$condition = "";	
			  if($project_sector_id > 0){
        $condition = "AND a.project_sector='$project_sector_id'";  
      }
      if($project_group_id > 0){
        $condition = "AND a.project_group='$project_group_id'"; 
      }
	  if($project_category_id > 0){
        $condition = "AND a.project_type='$project_category_id'";
      }
      if($project_area_id > 0){
        $condition = "AND a.project_area='$project_area_id'"; 
      }
	  if($project_destination_id > 0){
        $condition = "AND a.project_destination='$project_destination_id'"; 
      }
 
   $query = $this->db->query("SELECT SUM(a.estimate_total_cost) as aa_amount
    FROM `project_conceptualisation_stage` a
	WHERE a.id IN ($newprojIds) $condition");
     //echo $this->db->last_query().'<br><br>'; die;
        $result = $query->result_array();
        return $result;
 
 
	}
	
	public function get_tenderAA_amount($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_destination_id)
    	{
			
			$condition = "";	
			  if($project_sector_id > 0){
        $condition = "AND a.project_sector='$project_sector_id'";  
      }
      if($project_group_id > 0){
        $condition = "AND a.project_group='$project_group_id'"; 
      }
	  if($project_category_id > 0){
        $condition = "AND a.project_type='$project_category_id'";
      }
      if($project_area_id > 0){
        $condition = "AND a.project_area='$project_area_id'"; 
      }
	  if($project_destination_id > 0){
        $condition = "AND a.project_destination='$project_destination_id'"; 
      }
 
   $query = $this->db->query("SELECT SUM(a.estimate_total_cost) as aa_amounttotal
    FROM `project_conceptualisation_stage` a
	WHERE 1=1 $condition ");
     //echo $this->db->last_query().'<br><br>'; die;
        $result = $query->result_array();
        return $result;
 
 
	}
	
	
	public function get_WOIProject($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_destination_id)
    	{
			$condition = "";	
			  if($project_sector_id > 0){
        $condition = "AND a.project_sector='$project_sector_id'";  
      }
      if($project_group_id > 0){
        $condition = "AND a.project_group='$project_group_id'"; 
      }
	  if($project_category_id > 0){
        $condition = "AND a.project_type='$project_category_id'";
      }
      if($project_area_id > 0){
        $condition = "AND a.project_area='$project_area_id'"; 
      }
	  if($project_destination_id > 0){
        $condition = "AND a.project_destination='$project_destination_id'"; 
      }
 
   $query = $this->db->query("SELECT *
    FROM `project_conceptualisation_stage` a
	WHERE a.status='Y' AND a.id NOT IN (select project_id from project_completed_history where 1=1) $condition ");
     //echo $this->db->last_query().'<br><br>'; die;
        $result = $query->result_array();
        return $result;
 
 
	}
	
	
	public function get_woi_project_cost($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_destination_id,$newprojIds)
    	{
			$condition = "";	
			  if($project_sector_id > 0){
        $condition = "AND a.project_sector='$project_sector_id'";  
      }
      if($project_group_id > 0){
        $condition = "AND a.project_group='$project_group_id'"; 
      }
	  if($project_category_id > 0){
        $condition = "AND a.project_type='$project_category_id'";
      }
      if($project_area_id > 0){
        $condition = "AND a.project_area='$project_area_id'"; 
      }
	  if($project_destination_id > 0){
        $condition = "AND a.project_destination='$project_destination_id'"; 
      }
 
   $query = $this->db->query("SELECT SUM(b.agreement_cost) as total_proj_cost
    FROM `project_conceptualisation_stage` a
    left join project_aggrement_stage b on b.project_id=a.id 
	WHERE b.project_id IN ($newprojIds)  $condition");
     //echo $this->db->last_query().'<br><br>'; die;
        $result = $query->result_array();
        return $result;
 
 
	}
	
	
	public function get_woi_cost($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_destination_id)
    	{
			$condition = "";	
			  if($project_sector_id > 0){
        $condition = "AND a.project_sector='$project_sector_id'";  
      }
      if($project_group_id > 0){
        $condition = "AND a.project_group='$project_group_id'"; 
      }
	  if($project_category_id > 0){
        $condition = "AND a.project_type='$project_category_id'";
      }
      if($project_area_id > 0){
        $condition = "AND a.project_area='$project_area_id'"; 
      }
	  if($project_destination_id > 0){
        $condition = "AND a.project_destination='$project_destination_id'"; 
      }
 
   $query = $this->db->query("SELECT SUM(b.agreement_cost) as woi_proj_cost
    FROM `project_conceptualisation_stage` a
    left join project_aggrement_stage b on b.project_id=a.id 
	WHERE 1=1 $condition");
     //echo $this->db->last_query().'<br><br>'; die;
        $result = $query->result_array();
        return $result;
 
 
	}
	
	public function get_WCProject($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_destination_id)
    	{
			
			
			$condition = "";	
			  if($project_sector_id > 0){
        $condition = "AND b.project_sector='$project_sector_id'";  
      }
      if($project_group_id > 0){
        $condition = "AND b.project_group='$project_group_id'"; 
      }
	  if($project_category_id > 0){
        $condition = "AND b.project_type='$project_category_id'";
      }
      if($project_area_id > 0){
        $condition = "AND b.project_area='$project_area_id'"; 
      }
	  if($project_destination_id > 0){
        $condition = "AND b.project_destination='$project_destination_id'"; 
      }
 
 
   $query = $this->db->query("SELECT a.id as comid,a.completion_certificate_received,a.completion_date,a.assets_res_details,a.gov_app_att,a.asset_register_received,a.assets_res_file,a.remarks,b.*
    FROM `project_completed_history` a
    left join project_conceptualisation_stage b on a.project_id=b.id 
	WHERE 1=1 $condition ");
    //echo $this->db->last_query().'<br><br>'; die;
        $result = $query->result_array();
        return $result;
 
 
	}
	
	public function get_wc_project_cost($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_destination_id,$newwcprojIds)
    	{
			
			
			$condition = "";	
			  if($project_sector_id > 0){
        $condition = "AND a.project_sector='$project_sector_id'";  
      }
      if($project_group_id > 0){
        $condition = "AND a.project_group='$project_group_id'"; 
      }
	  if($project_category_id > 0){
        $condition = "AND a.project_type='$project_category_id'";
      }
      if($project_area_id > 0){
        $condition = "AND a.project_area='$project_area_id'"; 
      }
	  if($project_destination_id > 0){
        $condition = "AND a.project_destination='$project_destination_id'"; 
      }
 
 
   $query = $this->db->query("SELECT SUM(b.agreement_cost) as total_wcproj_cost
    FROM `project_conceptualisation_stage` a
    left join project_aggrement_stage b on b.project_id=a.id 
	WHERE b.project_id IN ($newwcprojIds) $condition");
     //echo $this->db->last_query().'<br><br>'; die;
        $result = $query->result_array();
        return $result;
 
 
	}
	public function get_wc_cost($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_destination_id)
    	{
			
			$condition = "";	
			  if($project_sector_id > 0){
        $condition = "AND a.project_sector='$project_sector_id'";  
      }
      if($project_group_id > 0){
        $condition = "AND a.project_group='$project_group_id'"; 
      }
	  if($project_category_id > 0){
        $condition = "AND a.project_type='$project_category_id'";
      }
      if($project_area_id > 0){
        $condition = "AND a.project_area='$project_area_id'"; 
      }
	  if($project_destination_id > 0){
        $condition = "AND a.project_destination='$project_destination_id'"; 
      }
 
 
   $query = $this->db->query("SELECT SUM(b.agreement_cost) as wc_proj_cost
    FROM `project_conceptualisation_stage` a
    left join project_aggrement_stage b on b.project_id=a.id 
	WHERE 1=1 $condition");
     //echo $this->db->last_query().'<br><br>'; die;
        $result = $query->result_array();
        return $result;
 
 
	}
	
	
	
	public function get_all_project_list($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id ){

        $this->db->select('*');
		if($project_sector_id > 0){
        $this->db->where('project_conceptualisation_stage.project_sector', $project_sector_id);  
      }
      if($project_group_id > 0){
        $this->db->where('project_conceptualisation_stage.project_group', $project_group_id);  
      }
	  if($project_category_id > 0){
        $this->db->where('project_conceptualisation_stage.project_type', $project_category_id);  
      }
      if($project_area_id > 0){
        $this->db->where('project_conceptualisation_stage.location_id', $project_area_id);  
      }
	  if($project_wing_id > 0){
        $this->db->where('project_conceptualisation_stage.wing_id', $project_wing_id);  
      }
      if($project_division_id > 0){
        $this->db->where('project_conceptualisation_stage.division_id', $project_division_id);  
      }
        $query = $this->db->get('project_conceptualisation_stage');
//echo $this->db->last_query().'<br><br>'; die;
        return $query->result_array();
    }



   public function get_all_physical_planning_main($all_ProjId)
    {
		   
        $query = $this->db->query("Select a.*,b.work_item_description from project_physical_planning_main a
  							left join work_item_master b on b.id=a.project_work_item_id
   where a.project_id IN ($all_ProjId) ORDER BY project_id,project_work_item_id,project_activity_id ");

       // $query = $this->db->get('project_physical_planning_main');
        //echo $this->db->last_query().'<br><br>'; die;
        $result = $query->result_array();
        return $result;
    }
  

   public function get_physical_main($proj_id)
    {
 
   /*$query = $this->db->query("SELECT main.project_work_item_id,SUM(main.target) as targetTotal,SUM(main.achieved) as achievedTotal,SUM(main.tilltarget) as tilltargetTotal FROM( SELECT a.id,a.project_id,a.project_work_item_id,a.project_activity_id,a.total_activity_quantity as target,a.total_activity_allotted_quantity as achieved,SUM(b.target_quantity) as tilltarget FROM `project_physical_planning_main` a left join project_physical_planning_detail b on b.project_physical_planning_id=a.id WHERE a.project_id='".$proj_id."' AND b.month_date < NOW() GROUP BY b.project_physical_planning_id ) as main GROUP BY main.project_work_item_id,main.project_activity_id");
 
   $query = $this->db->query("SELECT
    project_work_item_id,
    count(project_activity_id) as cnt_activity,
    SUM(TargetTillDatePercentage) as TargetTillDatePercentageTotal,
    SUM(ActivityAchievedTillDatePercentage) as ActivityAchievedTillDatePercentageTotal,
    SUM(AchievedOverallPercentage) as AchievedOverallPercentageTotal
FROM
(
SELECT
    project_work_item_id,
    project_activity_id,
    targetTotal,
    achievedTotal,
    tilltargetTotal,
    TargetTillDatePercentage,
    round(TargetTillDatePercentage*ActivityAchievedTillDatePercentage/100,2) as ActivityAchievedTillDatePercentage,
    AchievedOverallPercentage
    FROM
    (
        SELECT
            project_work_item_id,
            project_activity_id,
            targetTotal,
            achievedTotal,
            tilltargetTotal,
            round(tilltargetTotal/targetTotal*100,2) as TargetTillDatePercentage,
            if(achievedTotal/tilltargetTotal*100>100, 100, round(achievedTotal/tilltargetTotal*100,2)) as ActivityAchievedTillDatePercentage,
            round(achievedTotal/targetTotal*100,2) as AchievedOverallPercentage  
            FROM
            (
                    SELECT
                        main.project_work_item_id,
                        main.project_activity_id,
                        SUM(main.target) as targetTotal,
                        SUM(main.achieved) as achievedTotal,
                        SUM(main.tilltarget) as tilltargetTotal
                        FROM
                            ( SELECT a.id,a.project_id,
                                    a.project_work_item_id,
                                    a.project_activity_id,
                                    a.total_activity_quantity as target,
                                    a.total_activity_allotted_quantity as achieved,
                                    SUM(b.target_quantity) as tilltarget
                             FROM `project_physical_planning_main` a
                             left join project_physical_planning_detail b
                             on b.project_physical_planning_id=a.id
                             WHERE a.project_id='".$proj_id."'
                             AND b.month_date < NOW()
                             GROUP BY b.project_physical_planning_id
                            )
                        as main
                        GROUP BY main.project_work_item_id, main.project_activity_id
            )
            as summary
            GROUP BY project_work_item_id, project_activity_id
    )
    as consolidated
    GROUP BY project_work_item_id, project_activity_id
    )
    as wisum
    GROUP BY project_work_item_id");*/
	
   $query = $this->db->query("SELECT  
project_work_item_id,
work_item_description,
count(project_work_item_id),
round(sum(Average_WI_Target_till_datepercentage)/(count(project_work_item_id)*100)*100,2) as Average_WI_Target_till_datepercentage,
round(sum(Average_WI_Achieved_till_datepercentage)/(count(project_work_item_id)*100)*100,2) as Average_WI_Achieved_till_datepercentage
FROM
(
SELECT
summary_project_id,
project_work_item_id,
work_item_description,
round(sum(TargetTillDatePercentage)/(count(project_activity_id)*100)*100,2) as Average_WI_Target_till_datepercentage,
round(sum(ActivityAchievedTillDatePercentage)/(count(project_activity_id)*100)*100,2) as Average_WI_Achieved_till_datepercentage

FROM
(
SELECT
summary_project_id,
project_work_item_id,
WI.work_item_description,
project_activity_id,
PI.particulars,
targetTotal,
achievedTotal,
tilltargetTotal,
TargetTillDatePercentage,
round(TargetTillDatePercentage*ActivityAchievedTillDatePercentage/100,2) as ActivityAchievedTillDatePercentage,
AchievedOverallPercentage
FROM
(
SELECT
project_id as summary_project_id,
project_work_item_id,
project_activity_id,
targetTotal,
achievedTotal,
tilltargetTotal,
round(tilltargetTotal/targetTotal*100,2) as TargetTillDatePercentage,
if(achievedTotal/tilltargetTotal*100>100, 100, round(achievedTotal/tilltargetTotal*100,2)) as ActivityAchievedTillDatePercentage,
round(achievedTotal/targetTotal*100,2) as AchievedOverallPercentage  
FROM
(
SELECT
main.project_id,
main.project_work_item_id,
main.project_activity_id,
SUM(main.target) as targetTotal,
SUM(main.achieved) as achievedTotal,
SUM(main.tilltarget) as tilltargetTotal
FROM
( SELECT a.id,a.project_id,
a.project_work_item_id,

a.project_activity_id,
a.total_activity_quantity as target,
a.total_activity_allotted_quantity as achieved,
SUM(b.target_quantity) as tilltarget
FROM `project_physical_planning_main` a
left join project_physical_planning_detail b
on b.project_physical_planning_id=a.id
WHERE a.project_id IN ($proj_id)
AND b.month_date < NOW()
GROUP BY b.project_physical_planning_id
)
as main
GROUP BY main.project_work_item_id, main.project_activity_id, main.project_id
)
as summary
GROUP BY project_work_item_id, project_activity_id
)
as consolidated
left join work_item_master WI on WI.id=project_work_item_id
left join project_pf_activities PI on PI.id=project_activity_id
GROUP BY project_work_item_id, project_activity_id
)
as workitem_average
GROUP BY project_work_item_id, summary_project_id
    )
    as Organization_average
    GROUP BY project_work_item_id");

       // $query = $this->db->get('project_physical_planning_main');
        //echo $this->db->last_query().'<br><br>'; die;
        $result = $query->result_array();
        return $result;
 
 
	} 
	
	public function get_physicaltarget_main($proj_id,$wi_ID)
    {
 
   $query = $this->db->query("SELECT a.id,a.project_id,a.project_work_item_id,a.project_activity_id,a.total_activity_quantity as target,a.total_activity_allotted_quantity as achieved,SUM(b.target_quantity) as tilltarget FROM `project_physical_planning_main` a left join project_physical_planning_detail b on b.project_physical_planning_id=a.id WHERE a.project_id='".$proj_id."' AND a.project_work_item_id='".$wi_ID."' AND b.month_date < NOW() GROUP BY b.project_physical_planning_id");

       // $query = $this->db->get('project_physical_planning_main');
       //echo $this->db->last_query().'<br><br>'; die;
        $result = $query->result_array();
        return $result;
 
 
	}
	
	public function getworkitem($wi_id)
    {
        
		$wi_id = (int)$wi_id;
        $this->db->select('work_item_description');
        $this->db->from('work_item_master');
        $this->db->where('id', $wi_id);
        $query = $this->db->get();
        $result = $query->result_array();
		 return $result[0]['work_item_description'];
		
		
    }
	
	
	    public function get_project_released_quantity($project_id=null) {
      $this->db->select('sum(total_activity_allotted_quantity) as total_activity_allotted_quantity');
      if(!empty($project_id)){
        $this->db->where('project_id', $project_id);  
      }
      $query = $this->db->get('project_physical_planning_main');
      return $query->result_array();
    }
	
	    public function get_project_planned_quantity($project_id=null) {
      $this->db->select('sum(total_activity_quantity) as total_activity_planned_quantity');
      if(!empty($project_id)){
        $this->db->where('project_id', $project_id);  
      }
      $query = $this->db->get('project_physical_planning_main');
      return $query->result_array();
    }
	
	
	
	public function get_project_progress($proj_id)
    {
 
   $query = $this->db->query("select sum(milestone_progress) as project_progress from (select pm.id as milestone_id, pm.milestone as milestone_name,activities_completion.activity_progress, pm.weightage as milestone_weightage, round(IFNULL((activity_progress*pm.weightage)/100,0),2) as milestone_progress  from project_milestone as pm
left JOIN
(SELECT
    milstone_id AS milestone_id_in_activities_table, sum(weightage) as activity_progress from
    project_pf_activities
where completion_status='Y'
and project_id='".$proj_id."'
group by milstone_id) as activities_completion

on activities_completion.milestone_id_in_activities_table=pm.id
where project_id='".$proj_id."') milestone_progress");
   
  
        $result = $query->result_array();
        return $result;
 
 
	}

  function count_all($tbl){
      //$this->db->where($field, $value);
      $query=$this->db->get($tbl);
      $num_rows = $query->num_rows();
      return $num_rows;
    }

    function org_project_overview_count_all($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id){
      if($project_sector_id > 0){
        $this->db->where('project_sector', $project_sector_id);  
      }
      if($project_group_id > 0){
        $this->db->where('project_group', $project_group_id);  
      }
    if($project_category_id > 0){
        $this->db->where('project_type', $project_category_id);  
      }
      if($project_area_id > 0){
        $this->db->where('location_id', $project_area_id);  
      }
    if($project_wing_id > 0){
        $this->db->where('wing_id', $project_wing_id);  
      }
      if($project_division_id > 0){
        $this->db->where('division_id', $project_division_id);  
      }
      $query=$this->db->get('project_conceptualisation_stage');
      $num_rows = $query->num_rows();
      return $num_rows;
    }


  function count_specific_data($tbl,$field,$value){
      $this->db->where($field, $value);
      $query=$this->db->get($tbl);
      $num_rows = $query->num_rows();
      return $num_rows;
    }

    function ad_approval_project_cnt_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id){
        $this->db->from('project_administrative_approval_stage as t1');
        $this->db->join('project_conceptualisation_stage as t2', 't1.project_id = t2.id', 'LEFT');
        if($project_sector_id > 0){
        $this->db->where('t2.project_sector', $project_sector_id);  
      }
      if($project_group_id > 0){
        $this->db->where('t2.project_group', $project_group_id);  
      }
    if($project_category_id > 0){
        $this->db->where('t2.project_type', $project_category_id);  
      }
      if($project_area_id > 0){
        $this->db->where('t2.location_id', $project_area_id);  
      }
    if($project_wing_id > 0){
        $this->db->where('t2.wing_id', $project_wing_id);  
      }
      if($project_division_id > 0){
        $this->db->where('t2.division_id', $project_division_id);  
      }
        
        $this->db->where('t1.approve_status', 'Y');
        $query=$this->db->get();
        $num_rows = $query->num_rows();
        return $num_rows;

    }

    public function tender_published_project_lists($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id)
    {

      $condition = "";  
        if($project_sector_id > 0){
        $condition = "AND project_conceptualisation_stage.project_sector='$project_sector_id'";  
      }
      if($project_group_id > 0){
        $condition = "AND project_conceptualisation_stage.project_group='$project_group_id'"; 
      }
    if($project_category_id > 0){
        $condition = "AND project_conceptualisation_stage.project_type='$project_category_id'";
      }
      if($project_area_id > 0){
        $condition = "AND project_conceptualisation_stage.location_id='$project_area_id'"; 
      }
    if($project_wing_id > 0){
        $condition = "AND project_conceptualisation_stage.wing_id='$project_wing_id'"; 
      }
      if($project_division_id > 0){
        $condition = "AND project_conceptualisation_stage.division_id='$project_division_id'"; 
      }
        $query = $this->db->query("select all_project.project_id,project_name,project_code, all_project.approval_status,project_conceptualisation_stage.estimate_total_cost,district_master.district_name as area_name,project_type_master.project_type,draft_mode from project_conceptualisation_stage 
            left join 
            (
             SELECT project_id,approval_status FROM project_approval 
             WHERE approval_status='Y' AND project_step_no='6'
            ) all_project 
             ON all_project.project_id=id 
             LEFT JOIN district_master ON district_master.id = project_conceptualisation_stage.project_destination 
             LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type 
             WHERE all_project.approval_status='Y' $condition");
        //echo $this->db->last_query(); die;
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }


    function count_total_agreenet_count($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id){
      $this->db->from('project_aggrement_stage as t1');
        $this->db->join('project_conceptualisation_stage as t2', 't1.project_id = t2.id', 'LEFT');
        if($project_sector_id > 0){
        $this->db->where('t2.project_sector', $project_sector_id);  
      }
      if($project_group_id > 0){
        $this->db->where('t2.project_group', $project_group_id);  
      }
    if($project_category_id > 0){
        $this->db->where('t2.project_type', $project_category_id);  
      }
      if($project_area_id > 0){
        $this->db->where('t2.location_id', $project_area_id);  
      }
    if($project_wing_id > 0){
        $this->db->where('t2.wing_id', $project_wing_id);  
      }
      if($project_division_id > 0){
        $this->db->where('t2.division_id', $project_division_id);  
      }
        $query=$this->db->get();
        $num_rows = $query->num_rows();
        return $num_rows;
    }

    function count_total_completed_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id){
      $this->db->from('project_completed_history as t1');
        $this->db->join('project_conceptualisation_stage as t2', 't1.project_id = t2.id', 'LEFT');
        if($project_sector_id > 0){
        $this->db->where('t2.project_sector', $project_sector_id);  
      }
      if($project_group_id > 0){
        $this->db->where('t2.project_group', $project_group_id);  
      }
    if($project_category_id > 0){
        $this->db->where('t2.project_type', $project_category_id);  
      }
      if($project_area_id > 0){
        $this->db->where('t2.location_id', $project_area_id);  
      }
    if($project_wing_id > 0){
        $this->db->where('t2.wing_id', $project_wing_id);  
      }
      if($project_division_id > 0){
        $this->db->where('t2.division_id', $project_division_id);  
      }
        $query=$this->db->get();
        $num_rows = $query->num_rows();
        return $num_rows;

    }


    function fetchAlldata($tbl)
    {
        $this -> db -> select('*');
        $this -> db -> from($tbl);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

    function fetchSingledata($tbl, $fid, $did)
    {
        $this -> db -> select('*');
        $this -> db -> from($tbl);
        $this -> db -> where($fid, $did);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }
	 
   function completed_amt($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id){
    $this->db->select_sum('wim.estimate_total_cost');
        $this->db->from('project_completed_history as cmp');
        $this->db->join('project_conceptualisation_stage as wim', 'cmp.project_id = wim.id', 'LEFT');
        if($project_sector_id > 0){
        $this->db->where('wim.project_sector', $project_sector_id);  
      }
      if($project_group_id > 0){
        $this->db->where('wim.project_group', $project_group_id);  
      }
    if($project_category_id > 0){
        $this->db->where('wim.project_type', $project_category_id);  
      }
      if($project_area_id > 0){
        $this->db->where('wim.location_id', $project_area_id);  
      }
    if($project_wing_id > 0){
        $this->db->where('wim.wing_id', $project_wing_id);  
      }
      if($project_division_id > 0){
        $this->db->where('wim.division_id', $project_division_id);  
      }
        
        $query = $this->db->get()->row(); 
        // echo  $this->db->last_query(); die();
       return $result->amount;

   }


   function fetchconcept_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id){
        $this -> db -> select('*');
        $this -> db -> from('project_conceptualisation_stage');
        if($project_sector_id > 0){
        $this->db->where('project_sector', $project_sector_id);  
      }
      if($project_group_id > 0){
        $this->db->where('project_group', $project_group_id);  
      }
    if($project_category_id > 0){
        $this->db->where('project_type', $project_category_id);  
      }
      if($project_area_id > 0){
        $this->db->where('location_id', $project_area_id);  
      }
    if($project_wing_id > 0){
        $this->db->where('wing_id', $project_wing_id);  
      }
      if($project_division_id > 0){
        $this->db->where('division_id', $project_division_id);  
      }
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }


    function fetchagree_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id){
      $this->db->select('t1.*');
      $this->db->from('project_administrative_approval_stage as t1');
        $this->db->join('project_conceptualisation_stage as t2', 't1.project_id = t2.id', 'LEFT');
        if($project_sector_id > 0){
        $this->db->where('t2.project_sector', $project_sector_id);  
      }
      if($project_group_id > 0){
        $this->db->where('t2.project_group', $project_group_id);  
      }
    if($project_category_id > 0){
        $this->db->where('t2.project_type', $project_category_id);  
      }
      if($project_area_id > 0){
        $this->db->where('t2.location_id', $project_area_id);  
      }
    if($project_wing_id > 0){
        $this->db->where('t2.wing_id', $project_wing_id);  
      }
      if($project_division_id > 0){
        $this->db->where('t2.division_id', $project_division_id);  
      }
      $this->db->where('t1.approve_status', 'Y');
       $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }



    function get_activities_wise_amount($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id){
      $this->db->select('t2.progress_amount_utilised as gov_land_alietion_amt,t3.progress_amount_utilised as pvt_land_direct_amt,t4.progress_amount_utilised as pvt_land_acquisition_amt,t5.progress_amount_utilised as forest_land_amt,t6.progress_amount_utilised as tree_cutting_amt,t7.progress_amount_utilised as electrical_amt,t8.progress_amount_utilised as ph_amt,t9.progress_amount_utilised as rwss_amt,t10.progress_amount_utilised as eviction_amt');
      $this->db->from('project_conceptualisation_stage as t1');
        $this->db->join('pre_construction_activities_govt_land_alienation as t2', 't2.project_id = t1.id', 'LEFT');
        $this->db->join('pre_construction_activities_pvt_land_direct_purchase as t3', 't3.project_id = t1.id', 'LEFT');
        $this->db->join('pre_construction_activities_pvt_land_acquistion as t4', 't4.project_id = t1.id', 'LEFT');
        $this->db->join('pre_construction_activities_forest_land as t5', 't5.project_id = t1.id', 'LEFT');
        $this->db->join('pre_construction_activities_tree_cutting as t6', 't6.project_id = t1.id', 'LEFT');
        $this->db->join('pre_construction_activities_utility_shifting_electrical as t7', 't7.project_id = t1.id', 'LEFT');
        $this->db->join('pre_construction_activities_utility_shifting_ph as t8', 't8.project_id = t1.id', 'LEFT');
        $this->db->join('pre_construction_activities_utility_shifting_rwss as t9', 't9.project_id = t1.id', 'LEFT');
        $this->db->join('pre_construction_activities_encroachment_eviction as t10', 't10.project_id = t1.id', 'LEFT');
        if($project_sector_id > 0){
        $this->db->where('t1.project_sector', $project_sector_id);  
      }
      if($project_group_id > 0){
        $this->db->where('t1.project_group', $project_group_id);  
      }
    if($project_category_id > 0){
        $this->db->where('t1.project_type', $project_category_id);  
      }
      if($project_area_id > 0){
        $this->db->where('t1.location_id', $project_area_id);  
      }
    if($project_wing_id > 0){
        $this->db->where('t1.wing_id', $project_wing_id);  
      }
      if($project_division_id > 0){
        $this->db->where('t1.division_id', $project_division_id);  
      }
      $this->db->where('t1.approve_status', 'Y');
       $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }


}
?>