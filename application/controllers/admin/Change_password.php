<?php

/**

 * Author: Amirul Momenin

 * Desc:Users Controller

 *

 */
class Change_password extends CI_Controller

{

    function __construct()

    {
        parent::__construct();

        $this->load->helper('url');

        $this->load->helper('form');

        $this->load->library('session');

        $this->load->library('pagination');

        $this->load->library('Customlib');

        $this->load->helper(array(

            'cookie',

            'url'
        ));

        $this->load->database();

        $this->load->model('Users_model');

        if(! $this->session->userdata('validated')){
				redirect('admin/login/index');
		}  
    }

    /**
     * Index Page for this controller.
     */
    function index()

    {
        $limit = 10;

        $data['users'] = $this->Users_model->get_users($this->session->userdata['id']);

        $data['_view'] = 'admin/change_password/form';

        $this->load->view('layouts/admin/body', $data);
    }

    /*
     *
     * Save users
     *
     */
    function save($id = - 1)

    {
        $users = $this->Users_model->get_users($this->session->userdata['id']);

        if ($this->input->post('old_password') != $users['password']) {

            $data['users'] = $this->Users_model->get_users(0);

            $this->session->set_flashdata('msg', 'Old password is not correct');

            redirect('admin/change_password/index');
        }

        $file_picture = "";

        $params = array(

            'password' => $this->input->post('password'),

            'updated_at' => date("Y-m-d H:i:s")
        );

        // update

        if (isset($id) && $id > 0) {

            $data['users'] = $this->Users_model->get_users($id);

            if (isset($_POST) && count($_POST) > 0) {

                $this->Users_model->update_users($id, $params);

                $this->session->set_flashdata('msg', 'Password has been updated successfully');

                redirect('admin/change_password/index');
            } else {

                $data['_view'] = 'admin/change_password/form';

                $this->load->view('layouts/admin/body', $data);
            }
        } // save

        else {

            if (isset($_POST) && count($_POST) > 0) {

                $users_id = $this->Users_model->add_users($params);

                $this->session->set_flashdata('msg', 'Password has been updated successfully');

                redirect('admin/change_password/index');
            } else {

                $data['users'] = $this->Users_model->get_users(0);

                $data['_view'] = 'admin/change_password/form';

                $this->load->view('layouts/admin/body', $data);
            }
        }
    }
}

