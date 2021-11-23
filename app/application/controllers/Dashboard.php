<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->usercontrol->hasPermission('Dashboard')) {
            redirect('Login');
        }
    }

    public function index()
    {
        $this->title = 'Dashboard';
        $this->menu = 'Dashboard';
        $this->scripts = ['jquery.waypoints.min', 'counterUp', 'custom/dashboard/index'];
        $this->styles = ['card'];
        
        $this->load->view('dashboard');
    }

}
