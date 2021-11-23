<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Usuario extends CI_Controller
{
    private $error = false;
    

    public function __construct()
    {
        parent::__construct();

        if (!$this->usercontrol->hasPermission('Usuario')) {
            redirect('Dashboard');
        }
    }

    public function index()
    {

        $this->load->model('usuario_model');
        $this->load->helper('usuario');
        $this->title = "Usuário";
        $this->menu = 'Usuários';
        $this->scripts = ['custom/usuario/index'];

        $data['c_nome'] = $this->input->get('c_nome');
        $data['c_valor'] = $this->input->get('c_valor');
        $data['c_campo'] = $this->input->get('c_campo');
        $data['c_paginaAtual'] = $this->input->get('c_paginaAtual');
        $data['c_limite'] = $this->input->get('c_limite');

        $data['c_paginas'] = $this->usuario_model->get_count($data);
        $data['usuarios'] = $this->usuario_model->get(false, $data);
        print_r($data['usuarios']);

        $this->load->view('usuario/index', $data);
    }

    private function buildform()
    {
        $data['nome'] = $this->input->post('nome');
        $data['email'] = $this->input->post('email');
        $data['senha'] = $this->input->post('senha');
        $data['cpf'] = $this->input->post('cpf');

        return $data;
    }

    public function add()
    {
        $this->title = 'Novo Usuário';
        $this->menu = 'usuario';
        $this->scripts = ["../assets/select2/js/select2.full.min", "../assets/select2/js/i18n/pt-BR", 'jquery.mask.min', "../js/custom/usuario/form"];
        $this->styles = ["../assets/select2/css/select2.min", "../assets/select2/css/select2-bootstrap.min"];

        $data = $this->buildform();

        if ($this->error) {
            $data['error'] = $this->error;
        }

        $this->load->view('usuario/form', $data);
    }

    public function edit($id, $hasError = false)
    {
        $this->load->model('usuario_model');
        if ($hasError == false) {
            $data = $this->usuario_model->get($id);
        } else {
            $data = $this->buildform();
        }

        $this->title = "Alterar Usuário #$id";
        $this->menu = 'usuario';
        $this->scripts = ["../assets/select2/js/select2.full.min", "../assets/select2/js/i18n/pt-BR", 'jquery.mask.min', "../js/custom/usuario/form"];
        $this->styles = ["../assets/select2/css/select2.min", "../assets/select2/css/select2-bootstrap.min"];

        if ($this->error) {
            $data['error'] = $this->error;
        }
        $this->load->view('usuario/form', $data);
    }

    public function remove()
    {
        $id = $this->input->get('id');
        $this->load->model('usuario_model');
        $updated = $this->usuario_model->update($id, ['deleted' => 1]);
        $this->layout = 'ajax';
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                $updated
            )));
    }

    public function save()
    {
        $usuario_id = $this->input->post('id');
        $this->load->helper('usuario');

        $this->load->library('form_validation');
        if (!$usuario_id || $this->input->post('email') !== $this->input->post('email_check')) {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[usuario.email]',
            array('is_unique' => 'Esse %s já está cadastrado.'));
        } else {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        }
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
        $this->form_validation->set_rules('senha', 'Senha', 'trim|required');
        $this->form_validation->set_rules('cpf', 'CPF', 'trim|required');

        if ($this->form_validation->run() === false) {
            $this->error = validation_errors();
            if ($usuario_id) {
                $this->edit($usuario_id, true);
            } else {
                $this->add();
            }
            return;
        }

        $this->load->model('usuario_model');

        $sql_data = array(
            'nome' => $this->input->post('nome'),
            'email' => $this->input->post('email'),
            'senha' => $this->input->post('senha'),
            'cpf' => preg_replace('/\D+/', '', $this->input->post('cpf')),
        );

        if (!empty($this->input->post('senha'))) {
            $sql_data['senha'] = $this->input->post('senha');
        }

        if ($usuario_id) {
            $update = $this->usuario_model->update($usuario_id, $sql_data);

            if ($update) {
                $data['title'] = "Sucesso";
                $data['msg'] = "Usuário alterado com sucesso !!";
                $data['controller'] = "Usuario";
                $this->load->view('success/sucesso', $data);
            } else {
                $data['title'] = "Erro";
                $data['msg'] = "Usuário não pode ser alterado";
                $this->load->view('error/cli/erro_geral', $data);
            }
        } else {
            $create = $this->usuario_model->create($sql_data);

            if ($create) {
                $data['title'] = "Sucesso";
                $data['msg'] = "Usuário cadastrado com sucesso !!";
                $data['controller'] = "Usuario";
                $this->load->view('success/sucesso', $data);
            } else {
                $data['title'] = "Erro";
                $data['msg'] = "Usuário não pode ser cadastrado";
                $this->load->view('errors/cli/erro_geral', $data);
            }
        }

    }
}
