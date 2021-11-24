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


        $this->load->model('cargos_model');
        $list = $this->cargos_model->get(false, false);

        $ids = array();
        $values = array();
        foreach ($list as $entity) {
            array_push($ids, $entity['id']);
            array_push($values, $entity['nome']);
        }
        $this->CARGOS = array_combine($ids, $values);


        
        $this->load->model('grupos_model');
        $listGrupos = $this->grupos_model->get(false, false);

        $idsGrupos = array();
        $valuesGrupos = array();
        foreach ($listGrupos as $entity) {
            array_push($idsGrupos, $entity['id']);
            array_push($valuesGrupos, $entity['nome']);
        }
        $this->GRUPOS = array_combine($idsGrupos, $valuesGrupos);
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
        // print_r($data['usuarios']);

        $this->load->view('usuario/index', $data);
    }

    private function buildform()
    {
        $data['nome'] = $this->input->post('nome');
        $data['email'] = $this->input->post('email');
        $data['senha'] = $this->input->post('senha');
        $data['cpf'] = $this->input->post('cpf');
        $data['cargo_id'] = $this->input->post('cargos');
        $data['grupo_id'] = $this->input->post('grupos');
        $data['cargos'] = $this->CARGOS;
        $data['grupos'] = $this->GRUPOS;

        return $data;
    }

    public function add()
    {
        $this->title = 'Novo Usuário';
        $this->menu = 'usuario';
        $this->scripts = ["../assets/select2/js/select2.full.min", "../assets/select2/js/i18n/pt-BR", 'jquery.mask.min', "custom/usuario/form"];
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
            $data["cargos"] = $this->CARGOS;
            $data['grupos'] = $this->GRUPOS;
        } else {
            $data = $this->buildform();
        }

        $this->title = "Alterar Usuário #$id";
        $this->menu = 'usuario';
        $this->scripts = ["../assets/select2/js/select2.full.min", "../assets/select2/js/i18n/pt-BR", 'jquery.mask.min', "custom/usuario/form"];
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
        $this->form_validation->set_rules('senha', 'Senha', 'trim');
        $this->form_validation->set_rules('cpf', 'CPF', 'trim|required');
        $this->form_validation->set_rules('cargos', 'Cargos', 'trim|required');
        $this->form_validation->set_rules('grupos', 'Grupos', 'trim|required');

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
        $this->load->model('grupousuario_model');

        $sql_data = array(
            'nome' => $this->input->post('nome'),
            'email' => $this->input->post('email'),
            'senha' => $this->input->post('senha'),
            'cargo_id' => $this->input->post('cargos'),
            'grupo_id' => $this->input->post('grupos'),
            'cpf' => preg_replace('/\D+/', '', $this->input->post('cpf')),
        );

        $sql_grupo = array(
            'usuario_id' => $this->session->userdata('user'),
            'grupos_id' => $this->input->post('grupos'),
            
        );

        if (!empty($this->input->post('senha'))) {
            $sql_data['senha'] = $this->input->post('senha');
        }

        if ($usuario_id) {
            $update = $this->usuario_model->update($usuario_id, $sql_data);
            $updateGrupoUsuario = $this->grupousuario_model->update($usuario_id, $sql_grupo);

            if ($update || $updateGrupoUsuario) {
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
            $createGrupoUsuario = $this->grupousuario_model->create($sql_grupo);

            if ($create || $createGrupoUsuario) {
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
