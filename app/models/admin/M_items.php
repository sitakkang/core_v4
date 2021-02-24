<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class M_items extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    function list_items($data)
	{
		$query = $this->db->query('SELECT id,item_number, item_name FROM items');
		if(empty($data)){
			foreach($query->result() as $id) {
				echo '<option value="'.$id->id.'">'.$id->item_name.'</option>';
			}
		}else{
			foreach($query->result() as $id) {
				if($data == $id->id){
					echo '<option value="'.$id->id.'" selected="selected">'.$id->item_name.'</option>';
				}else{
					echo '<option value="'.$id->id.'">'.$id->item_name.'</option>';
				}
			}
		}
	}
}