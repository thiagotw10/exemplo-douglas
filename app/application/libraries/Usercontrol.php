<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Usercontrol
{

    private $CI;
    private $userHash = false;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function hasPermission($controller, $method = false)
    {

        if ($this->CI->session->userdata('current_application') != get_defined_constants()['CURRENT_APP']) {
            return false;
        }

        if (!$this->CI->session->userdata('logged')) {
            return false;
        }

        $this->CI->load->model('usuario_model');
        $this->userHash = $this->CI->usuario_model->get($this->CI->session->userdata('user'))['hash'];

        if ($this->userHash !== $this->CI->session->userdata('hash')) {
            $this->CI->session->set_flashdata('anotherDevice', true);
        }

        switch ($controller) {
            case 'Dashboard':
                return true;
                break;
            case 'Funcao':
            case 'Usuario':
               return true;
                break;
        }

        return false;
    }

}
