<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Grupos_model extends CI_Model
{

    private $table = 'grupo';

    public function get($id = false, $consulta = false)
    {
        // $this->db->where('deleted', 0);
        if ($id) {
            $this->db->where('id', $id);
        }

        if ($consulta) {
            if (!empty($consulta['c_campo'])) {
                $this->db->like($consulta['c_campo'], $consulta['c_valor']);
            }

            $paginaAtual = empty($consulta['c_paginaAtual']) ? 1 : $consulta['c_paginaAtual'];
            $paginaAtual--;
            $limite = empty($consulta['c_limite']) ? 10 : $consulta['c_limite'];

            $this->db->limit($limite, $paginaAtual * $limite);
        }

        $this->db->order_by('nome', 'asc');
        $get = $this->db->get($this->table);

        if ($id) {
            return $get->row_array();
        }

        return $get->result_array();
        
    }

    public function create($data)
    {
        // $data['senha'] = password_hash($data['senha'], PASSWORD_ARGON2I);

        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        // if (isset($data['senha'])) {
        //     $data['senha'] = password_hash($data['senha'], PASSWORD_ARGON2I);
        // }

        $this->db->where('id', $id);
        $update = $this->db->update($this->table, $data);
        return $update;
    }

    // public function validate($email, $senha)
    // {
    //     $this->db->where('email', $email);
    //     $query = $this->db->get($this->table);
    //     if ($query->num_rows() > 0) {
    //         $usuario = $query->row_array();
    //         if (password_verify($senha, $usuario['senha'])) {
    //             return $usuario;
    //         }
    //     }
    //     return array();
    // }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    public function get_count($consulta = false)
    {
        $this->db->select('count(*) as count')->where('deleted', 0);

        if ($consulta) {
            if (!empty($consulta['c_campo'])) {
                $this->db->like($consulta['c_campo'], $consulta['c_valor']);
            }
        }

        $get = $this->db->get($this->table)->row_array();
        if ($consulta) {
            return ceil($get['count'] / (empty($consulta['c_limite']) ? 10 : $consulta['c_limite']));
        } else {
            return $get['count'];
        }
    }

}
