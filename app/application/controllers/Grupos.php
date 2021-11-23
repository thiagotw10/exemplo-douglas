<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Grupos extends CI_Controller
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

        $this->load->model('grupos_model');
        $this->load->helper('usuario');
        $this->title = "Grupos";
        $this->menu = 'Grupos';
        $this->scripts = ['custom/usuario/index'];

        $data['c_nome'] = $this->input->get('c_nome');
        $data['c_valor'] = $this->input->get('c_valor');
        $data['c_campo'] = $this->input->get('c_campo');
        $data['c_paginaAtual'] = $this->input->get('c_paginaAtual');
        $data['c_limite'] = $this->input->get('c_limite');

        $data['c_paginas'] = $this->grupos_model->get_count($data);
        $data['grupos'] = $this->grupos_model->get(false, $data);
        

        $this->load->view('grupos/index', $data);
    }

    private function buildform()
    {
        $data['resumo'] = $this->input->post('resumo');
        $data['texto'] = $this->input->post('texto');
        $data['usuario_id'] = $this->input->post('usuario_id');

        return $data;
    }

    public function add()
    {
        $this->title = 'Novo grupo';
        $this->menu = 'grupos';
        $this->scripts = ["../assets/select2/js/select2.full.min", "../assets/select2/js/i18n/pt-BR", 'jquery.mask.min', "../js/custom/usuario/form"];
        $this->styles = ["../assets/select2/css/select2.min", "../assets/select2/css/select2-bootstrap.min"];

        $data = $this->buildform();

        if ($this->error) {
            $data['error'] = $this->error;
        }

        $this->load->view('grupos/form', $data);
    }

    public function edit($id, $hasError = false)
    {
        $this->load->model('grupos_model');
        if ($hasError == false) {
            $data = $this->grupos_model->get($id);
        } else {
            $data = $this->buildform();
        }

        $this->title = "Alterar Grupos #$id";
        $this->menu = 'grupo';
        $this->scripts = ["../assets/select2/js/select2.full.min", "../assets/select2/js/i18n/pt-BR", 'jquery.mask.min', "../js/custom/usuario/form"];
        $this->styles = ["../assets/select2/css/select2.min", "../assets/select2/css/select2-bootstrap.min"];

        if ($this->error) {
            $data['error'] = $this->error;
        }
        

        $this->load->view('grupos/form', $data);
    }

    public function remove()
    {
        $id = $this->input->get('id');
        $this->load->model('grupos_model');
        $updated = $this->grupos_model->update($id, ['deleted' => 1]);
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
       
        $this->form_validation->set_rules('resumo', 'Resumo', 'trim|required');
        $this->form_validation->set_rules('texto', 'Texto', 'trim|required');
        $this->form_validation->set_rules('usuario_id', 'Usuario_id', 'trim|required');

        if ($this->form_validation->run() === false) {
            $this->error = validation_errors();
            if ($usuario_id) {
                $this->edit($usuario_id, true);
            } else {
                $this->add();
            }
            return;
        }

        $this->load->model('grupos_model');

        $sql_data = array(
            'resumo' => $this->input->post('resumo'),
            'texto' => $this->input->post('texto'),
            'usuario_id' => $this->session->userdata('user'),
            
        );

       
        if ($usuario_id) {
            $update = $this->grupos_model->update($usuario_id, $sql_data);

            if ($update) {
                $data['title'] = "Sucesso";
                $data['msg'] = "Usuário alterado com sucesso !!";
                $data['controller'] = "Grupos";
                $this->load->view('success/sucesso', $data);
            } else {
                $data['title'] = "Erro";
                $data['msg'] = "Usuário não pode ser alterado";
                $this->load->view('error/cli/erro_geral', $data);
            }
        } else {
            $create = $this->cargos_model->create($sql_data);

            if ($create) {
                $data['title'] = "Sucesso";
                $data['msg'] = "Usuário cadastrado com sucesso !!";
                $data['controller'] = "Grupos";
                $this->load->view('success/sucesso', $data);
            } else {
                $data['title'] = "Erro";
                $data['msg'] = "Usuário não pode ser cadastrado";
                $this->load->view('errors/cli/erro_geral', $data);
            }
        }

    }
}
