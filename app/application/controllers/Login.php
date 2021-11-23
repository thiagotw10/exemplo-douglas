<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        // Load View
        $this->title = 'Login';
        $this->layout = 'login-bg';
        $this->menu = 'none';

        $data['email'] = '';
        $data['senha'] = '';

        $this->load->view('login', $data);
    }

    public function validate()
    {
        $this->load->model('usuario_model');
        $result = $this->usuario_model->validate($this->input->post('email'), $this->input->post('senha'));

        if ($result && !empty($this->input->post('senha'))) {
            if ($result['deleted'] === 0) {
                $hash = sha1(microtime());
                //$this->session->userdata('user')
                $this->session->set_userdata(array(
                    'logged' => true,
                    'user' => $result['id'],
                    'nome' => $result['nome'],
                    'email' => $result['email'],
                    'current_application' => CURRENT_APP,
                    'hash' => $hash
                ));

                $this->usuario_model->update($result['id'], ['ultimo_acesso' => date('Y-m-d H:i:s'), 'hash' => $hash]);
                redirect('Dashboard');
            } else {
                // Load View
                $this->title = 'Login';
                $this->layout = 'login-bg';
                $this->menu = 'none';
                $data['email'] = $this->input->post('email');
                $data['senha'] = $this->input->post('senha');

                $data['error'] = true;
                $data['error_msg'] = 'Acesso bloqueado temporariamente, favor entra em contato com a empresa contratada.';

                $this->load->view('login', $data);
            }
        } else {
            // Load View
            $this->title = 'Login';
            $this->layout = 'login-bg';
            $this->menu = 'none';
            $data['email'] = $this->input->post('email');
            $data['senha'] = $this->input->post('senha');

            $data['error'] = true;
            $data['error_msg'] = 'Usu&aacute;rio ou senha n&atilde;o conferem.';

            $this->load->view('login', $data);
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('logged');
        $this->session->sess_destroy();
        redirect('Login');
    }

    public function logoutAjax()
    {
        $this->session->unset_userdata('logged');
        $this->session->sess_destroy();
        $this->layout = 'ajax';
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'logout' => true,
            )));
    }
}
