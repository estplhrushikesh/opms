<?php

class pre_Qualification_model extends CI_Model {
	
	  function __construct(){
	      parent :: __construct();
	      $this->load->database();
      }

  public function savequalification($data) {
    
    $insert = $this->db->insert('tendering_pre_qualification', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
     }

  public function updatetechnical($data,$techeval_id) {
      $this->db->where('id', $techeval_id);
      $this->db->update('tendering_pre_qualification', $data);
      return TRUE;
    }

    public function delete_single_user($user_id)
     {

            $this->db->delete('tendering_pre_qualification_bidder_details', array('id' => $user_id));
            // $this->db->delete('tendering_financial_evalution_bidder_details', array('bidder_ref_no' => $user_id));
            // $this->db->delete('tendering_negotiation_bidder_details', array('bidder_id' => $user_id));

    }

 public function getprequalificationupdate($projectid) {
    $this->db->select('*');
    $this->db->where('tendering_pre_qualification_bidder_details.project_id', $projectid);
    $query = $this->db->get('tendering_pre_qualification_bidder_details');
    return $query->result_array();
}



public function updatetechnicalid($data,$techevnupdateid) {
    $this->db->where('id', $techevnupdateid);
    $this->db->update('tendering_pre_qualification_bidder_details', $data);
    return TRUE;
}

    
    public function getprequalification($projectid) {
      $this->db->select('*');
      $this->db->where('tendering_pre_qualification.project_id', $projectid);
      $query = $this->db->get('tendering_pre_qualification');
      return $query->result_array();
   }

   public function checkProjectExits( $project_id,$table_name = 'tendering_pre_qualification'){
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return count($return) > 0 ? true : false;
    }

  public function Pre_Qualification_data($project_id){
      $this->db->select('*');
      $this->db->where('tendering_pre_qualification_bidder_details.project_id', $project_id);
      $query = $this->db->get('tendering_pre_qualification_bidder_details');
      return $query->result_array();
    }

    public function addqualification($data){

        $insert = $this->db->insert('tendering_pre_qualification_bidder_details', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }


   

    
}
