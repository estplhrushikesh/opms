<?php

class Project_tender_publishing_model extends CI_Model
{

    function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }
	
	
	
	    public function checkProjectExits( $project_id,$table_name = 'project_tender_stage'){
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return count($return) > 0 ? true : false;
    }
	 public function getProjectTenderDetails( $project_id ){

        $this->db->select('*');
        $this->db->from('project_tender_stage');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }
		    /*get Specific field data*/
   function getSpecificdata($table,$field,$get_id,$specifc_field){
        $this->db->select($specifc_field);
        $this->db->from($table);
        $this->db->where($field, $get_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
            return $row[$specifc_field];
        } 
   }
   
	
    public function addProjectTenderPublishing($data)
    {
        $insert = $this->db->insert('project_tender_stage', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }
    public function get_tender_publishing_event($project_id){
        $this->db->select('*');
        $this->db->from('tender_publishing_event_shedule');
        $this->db->where('project_id', $project_id);
       
        $query = $this->db->get();
        $return = $query->result_array();
        return $return;
    }
    function addProject_tender_publishing_event($data){
        $insert = $this->db->insert('tender_publishing_event_shedule', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }
    function remove_tender_publishing_event_data($project_id){

        $this->db->where('project_id', $project_id);
        $this->db->delete('tender_publishing_event_shedule');
    }
    function rap_publication($project_id){
        $this->db->select('*');
        $this->db->from('tender_publishing_event_shedule');
        $this->db->where('project_id', $project_id);
        $this->db->where('event_type', 'rap_publication');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }
    function last_prebid_query($project_id){
        $this->db->select('*');
        $this->db->from('tender_publishing_event_shedule');
        $this->db->where('project_id', $project_id);
        $this->db->where('event_type', 'last_date_of_pre_bid_query');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }
    function prebid_meeting($project_id){
        $this->db->select('*');
        $this->db->from('tender_publishing_event_shedule');
        $this->db->where('project_id', $project_id);
        $this->db->where('event_type', 'prebid_meeting');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }
    function last_date_of_publishing_corrigendum($project_id){
        $this->db->select('*');
        $this->db->from('tender_publishing_event_shedule');
        $this->db->where('project_id', $project_id);
        $this->db->where('event_type', 'last_date_of_publishing_corrigendum');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }
    function last_date_of_receipt_of_tender_document($project_id){
        $this->db->select('*');
        $this->db->from('tender_publishing_event_shedule');
        $this->db->where('project_id', $project_id);
        $this->db->where('event_type', 'last_date_of_receipt_of_tender_document');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }
    function opening_of_general_bid($project_id){
        $this->db->select('*');
        $this->db->from('tender_publishing_event_shedule');
        $this->db->where('project_id', $project_id);
        $this->db->where('event_type', 'opening_of_general_bid');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }
    function publication_of_qualified_bidders_of_general_bid($project_id){
        $this->db->select('*');
        $this->db->from('tender_publishing_event_shedule');
        $this->db->where('project_id', $project_id);
        $this->db->where('event_type', 'publication_of_qualified_bidders_of_general_bid');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }
    function evaluation_of_general_bid($project_id){
        $this->db->select('*');
        $this->db->from('tender_publishing_event_shedule');
        $this->db->where('project_id', $project_id);
        $this->db->where('event_type', 'evaluation_of_general_bid');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }
    function evaluation_of_technical_bid($project_id){
        $this->db->select('*');
        $this->db->from('tender_publishing_event_shedule');
        $this->db->where('project_id', $project_id);
        $this->db->where('event_type', 'evaluation_of_technical_bid');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }
    function presentation_schedule($project_id){
        $this->db->select('*');
        $this->db->from('tender_publishing_event_shedule');
        $this->db->where('project_id', $project_id);
        $this->db->where('event_type', 'presentation_schedule');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }
    function publication_of_technically_qualified_bidders($project_id){
        $this->db->select('*');
        $this->db->from('tender_publishing_event_shedule');
        $this->db->where('project_id', $project_id);
        $this->db->where('event_type', 'publication_of_technically_qualified_bidders');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }
    function opening_of_financials($project_id){
        $this->db->select('*');
        $this->db->from('tender_publishing_event_shedule');
        $this->db->where('project_id', $project_id);
        $this->db->where('event_type', 'opening_of_financials');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }
    function evaluation_of_financial_bids($project_id){
        $this->db->select('*');
        $this->db->from('tender_publishing_event_shedule');
        $this->db->where('project_id', $project_id);
        $this->db->where('event_type', 'evaluation_of_financial_bids');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }
    function declaration_of_results($project_id){
        $this->db->select('*');
        $this->db->from('tender_publishing_event_shedule');
        $this->db->where('project_id', $project_id);
        $this->db->where('event_type', 'declaration_of_results');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }
	    public function getFiles( $project_id , $table_name){

        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return;
    }
	
	    /*Delete data from database common function*/
    function deleteData($fid, $did, $tbl)
    {
        $this -> db -> where($fid, $did);
        $this -> db -> delete($tbl);
        if ( $this->db->affected_rows() == 1 ) { return TRUE; }
        else {return FALSE;}
    }
	
	   public function updateProjectTenderPunlishingDetails($data,$project_id )
    {
        $this->db->where('project_id', $project_id);
        return $this->db->update('project_tender_stage', $data);
    }
	
	    function insertAllData($data = array(), $tbl)
    {
      $insert = $this->db->insert($tbl, $data);
      if($insert){ return true; }
      else{ return false; }
    }

	
	
	/*========================================================================*/


   

}

?>
