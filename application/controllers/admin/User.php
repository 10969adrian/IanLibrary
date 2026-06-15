<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('is_login') == FALSE) {
            redirect('auth');
        }
        if($this->session->userdata('role')!='Admin') {
            redirect('home');
        }
    }

    public function index()
    {
        $this->db->from('user')->order_by('nama','ASC');
        $user = $this->db->get()->result_array();

        $data = [
            'judul' => 'Halaman User',
            'user'  => $user
        ];

        $this->template->load('template', 'admin/user_index', $data);
    }

    public function edit($userID)
    {
        $user = $this->db->get_where('user', ['userID' => $userID])->row();

        $data = [
            'judul' => 'Halaman Edit User',
            'user'  => $user
        ];

        $this->template->load('template', 'admin/user_edit', $data);
    }

    public function simpan()
    {
        $username = $this->input->post('username');

        $cek = $this->db->get_where('user', ['username' => $username])->row();

        if($cek == NULL){

            $data = [
                'username' => $username,
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'nama'     => $this->input->post('nama'),
                'alamat'   => $this->input->post('alamat'),
                'email'    => $this->input->post('email'),
                'no_hp'    => $this->input->post('no_hp'),
                'role'     => $this->input->post('role'),
                'foto'     => NULL
            ];

            $this->db->insert('user', $data);

            redirect('admin/user');
        }

        redirect('admin/user');
    }

    public function update()
{
    $config['upload_path']   = './sneat/assets/upload/user/';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['max_size']      = 2048;
    $config['file_name']     = time();

    $this->load->library('upload');
    $this->upload->initialize($config);

    $userID    = $this->input->post('userID');
    $foto_lama = $this->input->post('foto_lama');

    // cek upload foto
    if ($this->upload->do_upload('foto')) {

        $upload = $this->upload->data('file_name');

        // hapus foto lama kalau ada
        if (!empty($foto_lama) && file_exists('./sneat/assets/upload/user/'.$foto_lama)) {
            unlink('./sneat/assets/upload/user/'.$foto_lama);
        }

        $foto = $upload;

    } else {
        $foto = $foto_lama;
    }

    // 🔥 ambil data lama kalau username kosong (biar anti NULL)
    $userLama = $this->db->get_where('user', ['userID' => $userID])->row();

    $data = [
        'username' => $this->input->post('username') ?: $userLama->username,
        'nama'     => $this->input->post('nama'),
        'email'    => $this->input->post('email'),
        'no_hp'    => $this->input->post('no_hp'),
        'alamat'   => $this->input->post('alamat'),
        'foto'     => $foto
    ];

    $this->db->where('userID', $userID);
    $this->db->update('user', $data);

    redirect('admin/user');
}

    public function hapus($userID)
    {
        $user = $this->db->get_where('user', ['userID'=>$userID])->row();

        if($user->foto && file_exists('./sneat/assets/upload/user/'.$user->foto)){
            unlink('./sneat/assets/upload/user/'.$user->foto);
        }

        $this->db->delete('user', ['userID'=>$userID]);

        redirect('admin/user');
    }

    public function kartu($userID)
{
    $user = $this->db->get_where('user', [
        'userID' => $userID
    ])->row();

    $data = [
        'user' => $user
    ];

    $this->load->view('kartu_anggota', $data);
}
}