<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Itemsunit extends CI_Controller {

    public $dir_v = 'admin/itemsunit/';
	public $dir_m = 'admin/';
	public $dir_l = 'admin/';

    public function __construct(){
        parent::__construct();
        $this->m_auth->check_login();
        $this->load->model($this->dir_m.'m_itemsunit');
        $this->load->library($this->dir_l.'l_itemsunit');
    }

    function index()
    {
        $data['css'] = array(
            'lib/datatables/dataTables.bootstrap.min.css'
        );
        $data['js'] = array(
            'lib/datatables/datatables.min.js',
            'lib/datatables/dataTables.bootstrap.min.js',
            'src/js/admin/itemsunit.js'
        );
        $data['panel'] = '<i class="fa fa-items"></i> &nbsp;<b>Data Items Unit</b>';
        $this->l_skin->config($this->dir_v.'view', $data);
    }

    function table()
    {
        $get_all = $this->db->query('SELECT a.id,a.name,a.description FROM items_unit a');

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
                "1" => $id->name,
                "2" => $id->description,
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
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|is_unique[items_unit.description]');
        if ($this->form_validation->run() == FALSE){
            $notif['notif'] = validation_errors();
            $notif['status'] = 1;
            echo json_encode($notif);
        }else{
            $name = $this->input->post('name');
            $description = $this->input->post('description');
            $data = array(
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                );
            $this->db->insert('items_unit', $data);
            $notif['lastid'] = $this->db->insert_id();
            $notif['notif'] = 'Data Items Unit '.$this->input->post('name').' berhasil disimpan !';
            $notif['status'] = 2;
            echo json_encode($notif);
        }
    }

    function edit()
    {
        $data_id = $this->input->get('id');
        $result_id = $this->db->query('SELECT id,name,description FROM items_unit WHERE id='.$data_id.' LIMIT 1');
        $data['id'] = $result_id->row();
        $this->load->view($this->dir_v.'edit', $data);
    }

    function act_edit()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|is_unique[items_unit.description]');
        if ($this->form_validation->run() == FALSE){
            $notif['notif'] = validation_errors();
            $notif['status'] = 1;
            echo json_encode($notif);
        }else{
            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description')
            );
            $this->db->where('id', $id);
            $this->db->update('items_unit', $data);
            $notif['notif'] = 'Data Items Unit '.$this->input->post('name').' berhasil diubah !';
            $notif['status'] = 2;
            echo json_encode($notif);
        }
    }

    function act_del()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('items_Unit');
        $notif['notif'] = 'Data items Unit '.$this->input->post('name').' berhasil di hapus !';
        $notif['status'] = 2;
        echo json_encode($notif);
    }
}