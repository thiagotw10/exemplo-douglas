<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Layout {

    function index() {
        global $OUT;
        $CI = & get_instance();

        $output = $CI->output->get_output();

        if (!isset($CI->layout)) {
            $CI->layout = 'default';
        }

        if ($CI->layout != false) {
            if (!preg_match('/(.+).php$/', $CI->layout)) {
                $CI->layout .= '.php';
            }
            $requested = APPPATH . 'views/layouts/' . $CI->layout;
            $default = APPPATH . 'views/layouts/default.php';
            $layout = '';

            if (file_exists($requested)) {
                $layout = $CI->load->file($requested, true);
            } else {
                $layout = $CI->load->file($default, true);
            }

            $view = str_replace("{content}", $output, $layout);

            if (isset($CI->title)) {
                $view = str_replace("{title}", $CI->title, $view);
            } else {
                $view = str_replace("{title}", 'CHAD', $view);
            }

            $scripts = "";
            $styles = "";
            $metas = "";
            if (isset($CI->meta) && count($CI->meta) > 0) {     // Meta Tags
                foreach ($CI->meta as $meta) {
                    $metas .= '<meta ';
                    if (isset($meta['name'])) {
                        $metas .= 'name="' . $meta['name'] . '" ';
                    }
                    if (isset($meta['property'])) {
                        $metas .= 'property="' . $meta['property'] . '" ';
                    }
                    if (isset($meta['content'])) {
                        $metas .= 'content="' . $meta['content'] . '"';
                    }
                    $metas .= '>';
                }
            }
            if (isset($CI->scripts) && count($CI->scripts) > 0) {  // JS files
                foreach ($CI->scripts as $script) {
                    $scripts .= '<script type="text/javascript" src="' . base_url("assets/js/$script.js") . '"></script>';
                }
            }
            if (isset($CI->styles) && count($CI->styles) > 0) {   // CSS files
                foreach ($CI->styles as $style) {
                    $styles .= '<link rel="stylesheet" type="text/css" href="' . base_url("assets/css/$style.css") . '" />';
                }
            }

            $view = str_replace("{metas}", $metas, $view);
            $view = str_replace("{scripts}", $scripts, $view);
            $view = str_replace("{styles}", $styles, $view);

            // Menu
            $active_menu = array(
                'controller' => ($CI->uri->segment(1)) ? $CI->uri->segment(1) : 'home',
                'method' => $CI->uri->segment(2),
                'menu' => isset($CI->menu) ? $CI->menu : '',
                'title' => isset($CI->title) ? $CI->title : 'Nuticin'
            );
            $view = str_replace("{menu}", $CI->load->view('templates/menu', $active_menu, TRUE), $view);
        } else {
            $view = $output;
        }

        $OUT->_display($view);
    }

}
