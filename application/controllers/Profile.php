<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('is_login') == FALSE){
            redirect('auth');
        }
    }

    // 📌 halaman profile
    public function index()
    {
        $userID = $this->session->userdata('userID');

        $user = $this->db->get_where('user', ['userID'=>$userID])->row();

        $data = [
            'judul' => 'Halaman Profile',
            'user'  => $user
        ];

        $this->template->load('template', 'profile', $data);
    }

    // 📌 update profile (INI YANG KAMU MAU)
    public function update()
    {
        $config['upload_path']   = './sneat/assets/upload/user/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048;
        $config['file_name']     = time();

        $this->load->library('upload');
        $this->upload->initialize($config);

        $userID    = $this->session->userdata('userID'); // 🔥 dari session (lebih aman)
        $foto_lama = $this->input->post('foto_lama');

        // upload foto
        if ($this->upload->do_upload('foto')) {

            $upload = $this->upload->data('file_name');

            if (!empty($foto_lama) && file_exists('./sneat/assets/upload/user/'.$foto_lama)) {
                unlink('./sneat/assets/upload/user/'.$foto_lama);
            }

            $foto = $upload;

        } else {
            $foto = $foto_lama;
        }

        $data = [
            'nama'   => $this->input->post('nama'),
            'email'  => $this->input->post('email'),
            'no_hp'  => $this->input->post('no_hp'),
            'alamat' => $this->input->post('alamat'),
            'foto'   => $foto
        ];

        $this->db->where('userID', $userID);
        $this->db->update('user', $data);

        // update session biar langsung refresh
        $this->session->set_userdata($data);

        $this->session->set_flashdata('notifikasi', '
        <div class="alert alert-success alert-dismissible">
            Profile berhasil diupdate!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>');

        redirect('profile');
    }

    public function kartu()
{
    $userID = $this->session->userdata('userID');

    $user = $this->db->get_where('user', [
        'userID' => $userID
    ])->row();

    $data = [
        'user' => $user
    ];

    $this->load->view('kartu_anggota', $data);
}
}