<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller{
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('is_login')==FALSE) {
            redirect('auth');
        }
        if($this->session->userdata('role')=='Peminjam') {
            redirect('home');
        }
    }

    public function index()
    {
        $this->db->from('kategori');
        $this->db->order_by('namaKategori','ASC');
        $kategori = $this->db->get()->result_array();
        $data = array(
            'judul' => 'Halaman Kategori',
            'kategori' => $kategori
        );
        $this->template->load('template', 'admin/kategori_index', $data);
    }

    public function edit($kategoriID)
    {
        $this->db->from('kategori');
        $this->db->where('kategoriID', $kategoriID);
        $kategori = $this->db->get()->row();
        $data = array(
            'judul' => 'Halaman Edit Kategori',
            'kategori' => $kategori
        );
        $this->template->load('template', 'admin/kategori_edit', $data);
    }

    public function simpan()
    {
        $this->db->from('kategori')->where('namaKategori',$this->input->post('namaKategori'));
        $cek = $this->db->get()->row();

        if($cek==NULL){
            $data = array(
                'namaKategori' => $this->input->post('namaKategori')
            );
            $this->db->insert('kategori', $data);
            $this->session->set_flashdata('notifikasi','
            <div class="alert alert-success alert-dismissible" role="alert">
                        Data Berhasil Disimpan!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
            redirect('admin/kategori');
        }else{
            $this->session->set_flashdata('notifikasi','
            <div class="alert alert-danger alert-dismissible" role="alert">
                        Data Gagal Disimpan!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
            redirect('admin/kategori');
        }
    }

    public function update() {
        $data = array(
            'namaKategori' => $this->input->post('namaKategori')
        );
        $where = array(
            'kategoriID'=> $this->input->post('kategoriID'),
        );
        $this->db->update('kategori', $data, $where);
        $this->session->set_flashdata('notifikasi','
            <div class="alert alert-success alert-dismissible" role="alert">
                        Data Berhasil Diupdate!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
        redirect('admin/kategori');
    }

    public function hapus($kategoriID){
        $where = array(
            'kategoriID'=> $kategoriID,
        );
        $this->db->delete('kategori', $where);
       $this->session->set_flashdata('notifikasi','
            <div class="alert alert-success alert-dismissible" role="alert">
                        Data Berhasil Dihapus!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
        redirect('admin/kategori');
    }
}