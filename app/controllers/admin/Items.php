<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items extends CI_Controller {

    public $dir_v = 'admin/items/';
	public $dir_m = 'admin/';
	public $dir_l = 'admin/';

    public function __construct(){
        parent::__construct();
        $this->m_auth->check_login();
        $this->load->model($this->dir_m.'M_items');
        $this->load->library($this->dir_l.'M_items');
    }

    function index()
    {
        $data['css'] = array(
            'lib/datatables/dataTables.bootstrap.min.css'
        );
        $data['js'] = array(
            'lib/datatables/datatables.min.js',
            'lib/datatables/dataTables.bootstrap.min.js',
            'src/js/admin/items.js'
        );
        $data['panel'] = '<i class="fa fa-items"></i> &nbsp;<b>Data Items</b>';
        $this->l_skin->config($this->dir_v.'view', $data);
    }

    function table()
    {
        $get_all = $this->db->query('SELECT a.id,a.item_number,a.item_name FROM items a');

        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $data = array();
        $i = 1;
        foreach($get_all->result() as $id) {
            $data[] = array(
                "DT_RowId" => $id->id,
                "0" => $i++,
                "1" => $id->item_number,
                "2" => $id->item_name,
            );
         }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $get_all->num_rows(),
            "recordsFiltered" => $get_all->num_rows(),
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    function add()
    {
        $this->load->view($this->dir_v.'add');
    }

    // ACTION POST
    function act_add()
    {
        $this->form_validation->set_rules('item_number', 'Item Number', 'trim|required|min_length[4]|is_unique[items.item_number]');
        $this->form_validation->set_rules('item_name', 'Item Name', 'trim|required|min_length[4]');
        if ($this->form_validation->run() == FALSE){
            $notif['notif'] = validation_errors();
            $notif['status'] = 1;
            echo json_encode($notif);
        }else{
            $item_number = $this->input->post('item_number');
            $item_name = $this->input->post('item_name');
            $data = array(
                    'item_number' => $this->input->post('item_number'),
                    'item_name' => $this->input->post('item_name'),
                );
            $this->db->insert('items', $data);
            $notif['lastid'] = $this->db->insert_id();
            $notif['notif'] = 'Data Items '.$this->input->post('item_number').' berhasil disimpan !';
            $notif['status'] = 2;
            echo json_encode($notif);
        }
    }

    function edit()
    {
        $data_id = $this->input->get('id');
        $result_id = $this->db->query('SELECT id,item_number,item_name FROM items WHERE id='.$data_id.' LIMIT 1');
        $data['id'] = $result_id->row();
        $this->load->view($this->dir_v.'edit', $data);
    }

    function act_edit()
    {
        $id = $this->input->post('id');
        $item_number = $this->input->post('item_number');
        $item_name = $this->input->post('item_name');
        $this->form_validation->set_rules('item_name', 'Item Name', 'trim|required|min_length[4]');
        if ($this->form_validation->run() == FALSE){
            $notif['notif'] = validation_errors();
            $notif['status'] = 1;
            echo json_encode($notif);
        }else{
            $data = array(
                'item_number' => $this->input->post('item_number'),
                'item_name' => $this->input->post('item_name')
            );
            $this->db->where('id', $id);
            $this->db->update('items', $data);
            $notif['notif'] = 'Data Items '.$this->input->post('item_name').' berhasil diubah !';
            $notif['status'] = 2;
            echo json_encode($notif);
        }
    }

    function act_del()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('items');
        $notif['notif'] = 'Data items '.$this->input->post('item_name').' berhasil di hapus !';
        $notif['status'] = 2;
        echo json_encode($notif);
    }


}