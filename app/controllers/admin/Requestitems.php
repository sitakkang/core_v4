<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Requestitems extends CI_Controller {

    public $dir_v = 'admin/requestitems/';
	public $dir_m = 'admin/';
	public $dir_l = 'admin/';

    public function __construct(){
        parent::__construct();
        $this->m_auth->check_login();
        $this->load->model($this->dir_m.'m_requestitems');
        $this->load->library($this->dir_l.'l_requestitems');
    }

    function index()
    {
        $data['css'] = array(
            'lib/datatables/dataTables.bootstrap.min.css'
        );
        $data['js'] = array(
            'lib/datatables/datatables.min.js',
            'lib/datatables/dataTables.bootstrap.min.js',
            'src/js/admin/requestitems.js'
        );
        $data['panel'] = '<i class="fa fa-items"></i> &nbsp;<b>Data Request Items</b>';
        $this->l_skin->config($this->dir_v.'view', $data);
    }

    function table()
    {
        $get_all = $this->db->query('SELECT a.request_number,a.date,a.user,a.status FROM request_items a');

        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $data = array();
        $i = 1;
        foreach($get_all->result() as $id) {
            $data[] = array(
                "DT_RowId" => $id->request_number,
                "0" => $i++,
                "1" => $id->request_number,
                "2" => $id->date,
                "3" => $id->user,
                "4" => $id->status,
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
        $data=[];
        $data['css'] = array(
            'lib/datatables/dataTables.bootstrap.min.css'
        );
        $data['js'] = array(
            'lib/datatables/datatables.min.js',
            'lib/datatables/dataTables.bootstrap.min.js',
            'src/js/admin/requestitems.js'
        );
        
        $data['panel'] = '<i class="fa fa-items"></i> &nbsp;<b>Data Request items</b>';
        $this->l_skin->config($this->dir_v.'add',$data);
    }

    function act_add()
    {
        $this->form_validation->set_rules('request_number', 'Request Number', 'trim|required|is_unique[request_items.request_number]');
        $this->form_validation->set_rules('user', 'User', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $notif['notif'] = validation_errors();
            $notif['status'] = 1;
            echo json_encode($notif);
        }else{
            $request_number = $this->input->post('request_number');
            $date = $this->input->post('date');
            $user = $this->input->post('user');
            $status = $this->input->post('status');
            $data = array(
                    'request_number' => $request_number,
                    'date' => $date,
                    'status' => $status,
                    'user' => $user,
                );
            $this->db->insert('request_items', $data);
            $notif['lastid'] = $this->db->insert_id();
            $notif['notif'] = 'Data Request Items '.$this->input->post('request_number').' berhasil disimpan !';
            $notif['status'] = 2;
            echo json_encode($notif);
        }
    }

    function edit($id)
    {
        $data=[];
        // $data_id = $this->input->get('id');
        $result_header = $this->db->query('SELECT a.request_number,a.date,a.user,a.status FROM request_items a WHERE a.request_number='.$id.' LIMIT 1');
        $data['header_table'] = $result_header->row();
        $result_header = $this->db->query('SELECT a.items,a.items_unit,a.items_brands,a.items_type,a.total FROM request_items_detail a WHERE a.request_items='.$id.'');
        $data['detail_table'] = $result_header->row();
        $data['css'] = array(
            'lib/datatables/dataTables.bootstrap.min.css'
        );
        $data['js'] = array(
            'lib/datatables/datatables.min.js',
            'lib/datatables/dataTables.bootstrap.min.js',
            'src/js/admin/requestitems.js'
        );
        
        $data['panel'] = '<i class="fa fa-items"></i> &nbsp;<b>Data Request items</b>';
        $data['panel_detail'] = '<i class="fa fa-items"></i> &nbsp;<b>Data items</b>';
        $this->l_skin->config($this->dir_v.'edit',$data);
    }

    function table_edit($id)
    {
        $get_all = $this->db->query('SELECT a.id,a.items_unit,a.items_brands,a.items_type,a.total FROM request_items_detail a WHERE a.request_items='.$id.'');

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
                "1" => $id->items,
                "2" => $id->items_brands,
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
}