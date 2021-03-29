<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class M_fullcalendar extends CI_Model {

    public function __construct(){
        parent::__construct();
  		$this->load->model('M_fullcalendar');
    }

    function fetch_all_event(){
	  $this->db->order_by('id');
	  return $this->db->get('events');
	}

	function insert_event($data)
 	{
  		$this->db->insert('events', $data);
 	}

 	function update_event($data, $id)
 	{
  		$this->db->where('id', $id);
  		$this->db->update('events', $data);
 	}

 	function delete_event($id)
 	{
  		$this->db->where('id', $id);
  		$this->db->delete('events');
 	}

}