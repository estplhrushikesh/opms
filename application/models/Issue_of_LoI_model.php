<?php

class Issue_of_LoI_model extends CI_Model {
	
   function __construct(){
      parent :: __construct();
      $this->load->database();
    }

   public function saveissueofloa($data) {
    $insert = $this->db->insert('tendering_issue_of_loa', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }

    public function checkProjectExits( $project_id,$table_name = 'tendering_issue_of_loa'){
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return count($return) > 0 ? true : false;
    }
  
   public function getissueofloa($projectid) {
      $this->db->select('*');
      $this->db->where('tendering_issue_of_loa.project_id', $projectid);
      $query = $this->db->get('tendering_issue_of_loa');
      return $query->result_array();
   }

   public function updateissueofloa($data,$issueofloa_id){
      $this->db->where('id', $issueofloa_id);
      $this->db->update('tendering_issue_of_loa', $data);
      return TRUE;
   }

   // public function fetchissueofloa($project_id){
   //     $this->db->select('*');
   //     $this->db->where('tendering_negotiation_bidder_details.project_id', $project_id);
   //     $this->db->where('negotiation_status =', 'Y' );
   //     $query = $this->db->get('tendering_negotiation_bidder_details');
   //     return $query->result_array();
   // }

   public function fetchissueofloa($project_id){
       

      
       $this->db->select('tendering_tender_bidder_details.*,tendering_technical_evalution_bidder_details.bidder_ref_no as bidder_name,tendering_technical_evalution_bidder_details.id as bidderid');

       $this->db->join('tendering_technical_evalution_bidder_details','tendering_technical_evalution_bidder_details.id = tendering_tender_bidder_details.bidder_id');

     
       $this->db->where('tendering_tender_bidder_details.project_id', $project_id);
       $this->db->where('negotiation_status =', 'Y' );
       $query = $this->db->get('tendering_tender_bidder_details');
       return $query->result_array();
   }

   public function fetchnegoofloa($project_id){
        $this->db->select('tendering_tender.*,tendering_tender.approval_date as date');

        $this->db->where('tendering_tender.project_id', $project_id);
        $this->db->where('approval_status =', 'Y' );
        $query = $this->db->get('tendering_tender');
        return $query->result_array();



        }
	
}