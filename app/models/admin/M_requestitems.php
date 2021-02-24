<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class M_requestitems extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    function select_user($data)
	{
		$query = $this->db->query('SELECT * FROM conf_users ORDER BY id_user');
		if(empty($data)){
			foreach($query->result() as $id) {
				echo '<option value="'.$id->id_user.'">'.$id->fullname.'</option>';
			}
		}else{
			foreach($query->result() as $id) {
				if(strstr($data, $id->id_user) != FALSE){
					echo '<option value="'.$id->id_user.'" selected="selected">'.$id->fullname.'</option>';
				}else{
					echo '<option value="'.$id->id_user.'">'.$id->fullname.'</option>';
				}
			}
		}
	}
}