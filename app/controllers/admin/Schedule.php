<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule extends CI_Controller {

    public $dir_v = 'admin/schedule/';
	public $dir_m = 'admin/';
	public $dir_l = 'admin/';

    public function __construct(){
        parent::__construct();
        $this->m_auth->check_login();
        $this->load->model($this->dir_m.'m_schedule');
        $this->load->library($this->dir_l.'l_schedule');
    }

    function index()
    {
        $data['css'] = array();
        $data['js'] = array();
        $data['panel'] = '<i class="fa fa-laptop"></i> &nbsp;<b>Title Panel</b>';
        $this->l_skin->main($this->dir_v.'view', $data);
    }
}