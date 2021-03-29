<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fullcalendar extends CI_Controller {

    public $dir_v = 'admin/fullcalendar/';
	public $dir_m = 'admin/';
	public $dir_l = 'admin/';

    public function __construct(){
        parent::__construct();
        $this->m_auth->check_login();
        $this->load->model($this->dir_m.'M_fullcalendar');
        $this->load->library($this->dir_l.'L_fullcalendar');
    }

    function index()
    {
        $data['css'] = array(
            'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css',
            'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css',
        );
        $data['js'] = array(
            'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js',
            'src/js/admin/fullcalendar.js'
        );
        $data['panel'] = '<i class="fa fa-items"></i> &nbsp;<b>Data Calendar</b>';
        $this->l_skin->config($this->dir_v.'view', $data);
    }

    function load()
    {
        $event_data = $this->M_fullcalendar->fetch_all_event();
        foreach($event_data->result_array() as $row)
        {
            $data[] = array(
            'id' => $row['id'],
            'title' => $row['title'],
            'start' => $row['start_event'],
            'end' => $row['end_event']
            );
        }
        echo json_encode($data);
    }

    function insert()
    {
        if($this->input->post('title')){
            $data = array(
                'title'  => $this->input->post('title'),
                'start_event'=> $this->input->post('start'),
                'end_event' => $this->input->post('end')
            );
            $this->M_fullcalendar->insert_event($data);
        }
    }

    function update(){
        if($this->input->post('id')){
            $data = array(
            'title'   => $this->input->post('title'),
            'start_event' => $this->input->post('start'),
            'end_event'  => $this->input->post('end')
            );
            $this->M_fullcalendar->update_event($data, $this->input->post('id'));
        }
    }

    function delete(){
        if($this->input->post('id')){
            $this->M_fullcalendar->delete_event($this->input->post('id'));
        }
    }
}