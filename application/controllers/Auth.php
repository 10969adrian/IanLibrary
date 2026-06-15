<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller{
	public function index()
	{
		$data = array(
			'judul' => 'Halaman Login',
		);
		$this->load->view('login', $data);
	}
	public function register(){
		$data = array(
			'judul' => 'Halaman Register',
		);
		$this->load->view('register', $data);
	}

	public function profile()
    {
        $this->db->from('user');
		$this->db->where('userID', $this->session->userdata('userID'));
        $user = $this->db->get()->row();
        $data = array(
            'judul' => 'Halaman Profile',
            'user' =>   $user
        );
        $this->template->load('template', 'profile', $data);
    }

	public function password()
    {
        $data = array(
            'judul' => 'Halaman Ubah Password',
        );
        $this->template->load('template', 'password', $data);
    }

	public function update() {
            $data = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'email' => $this->input->post('email'),
            'no_hp' => $this->input->post('no_hp')
            );
             $where = array(
                'userID'=> $this->input->post('userID'),
            );
            $this->db->update('user', $data, $where);
			$this->session->set_userdata($data);
            $this->session->set_flashdata('notifikasi','
            <div class="alert alert-success alert-dismissible" role="alert">
                        Data Berhasil Diupdate!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
            redirect('auth/profile');
    }

	public function updatePassword(){
		$username = $this->session->userdata('username');
		$passwordBaru = $this->input->post('passwordBaru');
		$passwordKonf = $this->input->post('passwordKonf');

		$this->db->from('user')->where('username', $username);
		$passwordDatabase = $this->db->get()->row()->password;
		if($passwordBaru<>$passwordKonf){
			$this->session->set_flashdata('notifikasi','
            <div class="alert alert-danger alert-dismissible" role="alert">
                        Konfirmasi password tidak sama!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
            redirect('auth/password');
		}else{
			$data = array('password'=>$passwordBaru, );
			$where = array('username'=>$username,);
			$this->db->update('user',$data,$where);
            $this->session->set_flashdata('notifikasi','
            <div class="alert alert-success alert-dismissible" role="alert">
                        Password berhasil diganti!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
            redirect('auth/password');
		}
	}
	public function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$this->db->from('user')->where('username', $username);
		$data= $this->db->get()->row();
		if($data==NULL){
			$this->session->set_flashdata('notifikasi','
            <div class="alert alert-danger alert-dismissible" role="alert">
                        Username salah!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
            redirect('auth');
		}else if($data->password==$password){
			//berhasil login
			$data = array(
			'is_login' => TRUE,
			'username' => $data->username,
			'userID' => $data->userID,
			'nama' => $data->nama,
			'alamat' => $data->alamat,
			'email' => $data->email,
            'no_hp' => $this->input->post('no_hp'),
			'role' => $data->role
            );
			$this->session->set_userdata($data);
			redirect('home');
		}else{
			$this->session->set_flashdata('notifikasi','
            <div class="alert alert-danger alert-dismissible" role="alert">
                        Password salah!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
            redirect('auth');
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('auth');
	}

	public function simpan()
    {
        $this->db->from('user')->where('username',$this->input->post('username'));
        $cek = $this->db->get()->row();
        var_dump($cek);
        if($cek==NULL){
            $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'email' => $this->input->post('email'),
            'no_hp' => $this->input->post('no_hp'),
            'role' => 'Peminjam'
            );
            $this->db->insert('user', $data);
            $this->session->set_flashdata('notifikasi','
            <div class="alert alert-success alert-dismissible" role="alert">
                        Berhasil register!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
            redirect('auth');
        }else{
            $this->session->set_flashdata('notifikasi','
            <div class="alert alert-danger alert-dismissible" role="alert">
                        Gagal register!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
            redirect('auth/register');
        }
    }
}