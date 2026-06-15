<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_login') == FALSE) {
            redirect('auth');
        }
        if ($this->session->userdata('role') == 'Peminjam') {
            redirect('home');
        }
    }

    public function index()
    {
        $this->db->select('buku.*, kategori.namaKategori');
        $this->db->from('buku');
        $this->db->join('kategori', 'kategori.kategoriID = buku.kategoriID', 'left');

        if ($this->input->get('judul') != '') {
            $this->db->like('buku.judul', $this->input->get('judul'));
        }

        if ($this->input->get('penulis') != '') {
            $this->db->like('buku.penulis', $this->input->get('penulis'));
        }

        if ($this->input->get('penerbit') != '') {
            $this->db->like('buku.penerbit', $this->input->get('penerbit'));
        }

        if ($this->input->get('tahun') != '') {
            $this->db->where('buku.tahunTerbit', $this->input->get('tahun'));
        }

        if ($this->input->get('status') != '') {
            $this->db->where('buku.status', $this->input->get('status'));
        }

        if ($this->input->get('kategori') != '') {
            $this->db->where('kategori.namaKategori', $this->input->get('kategori'));
        }

        $this->db->order_by('buku.judul', 'ASC');
        $buku = $this->db->get()->result_array();

        $this->db->from('kategori');
        $this->db->order_by('namaKategori', 'ASC');
        $kategori = $this->db->get()->result_array();

        $data = array(
            'judul' => 'Halaman Buku',
            'buku' => $buku,
            'kategori' => $kategori
        );

        $this->template->load('template', 'admin/buku_index', $data);
    }

    public function edit($bukuID)
    {
        $this->db->from('buku')->where('bukuID', $bukuID);
        $buku = $this->db->get()->row();

        $this->db->from('kategori')->order_by('namaKategori', 'ASC');
        $kategori = $this->db->get()->result_array();

        $data = array(
            'judul' => 'Halaman Edit Buku',
            'buku' => $buku,
            'kategori' => $kategori
        );

        $this->template->load('template', 'admin/buku_edit', $data);
    }

    public function simpan()
    {
        $this->db->from('buku')->where('judul', $this->input->post('judul'));
        $cek = $this->db->get()->row();

        if ($cek == NULL) {

            $config['upload_path'] = './sneat/assets/upload/cover/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $config['file_name'] = time();

            $this->load->library('upload');
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('cover')) {
                $cover = NULL;
            } else {
                $cover = $this->upload->data('file_name');
            }

            $data = array(
                'cover' => $cover,
                'judul' => $this->input->post('judul'),
                'penulis' => $this->input->post('penulis'),
                'penerbit' => $this->input->post('penerbit'),
                'tahunTerbit' => $this->input->post('tahunTerbit'),
                'kategoriID' => $this->input->post('kategoriID'), // 🔥 TAMBAH
                'status' => 'Tersedia'
            );

            $this->db->insert('buku', $data);

            $this->session->set_flashdata('notifikasi', '
            <div class="alert alert-success alert-dismissible" role="alert">
                        Data Berhasil Disimpan!
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      </div>');
            redirect('admin/buku');

        } else {

            $this->session->set_flashdata('notifikasi', '
            <div class="alert alert-danger alert-dismissible" role="alert">
                        Data Gagal Disimpan!
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      </div>');
            redirect('admin/buku');
        }
    }

    public function update()
    {
        $config['upload_path'] = './sneat/assets/upload/cover/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048;
        $config['file_name'] = time();

        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('cover')) {
            $cover = $this->input->post('cover_lama');
        } else {
            $buku = $this->db->get_where('buku', ['bukuID' => $this->input->post('bukuID')])->row();
            if ($buku && $buku->cover) {
                @unlink('./sneat/assets/upload/cover/' . $buku->cover);
            }
            $cover = $this->upload->data('file_name');
        }

        $data = array(
            'cover' => $cover,
            'judul' => $this->input->post('judul'),
            'penulis' => $this->input->post('penulis'),
            'penerbit' => $this->input->post('penerbit'),
            'tahunTerbit' => $this->input->post('tahunTerbit'),
            'kategoriID' => $this->input->post('kategoriID'), // 🔥 TAMBAH
        );

        $where = array(
            'bukuID' => $this->input->post('bukuID'),
        );

        $this->db->update('buku', $data, $where);

        $this->session->set_flashdata('notifikasi', '
        <div class="alert alert-success alert-dismissible" role="alert">
                    Data Berhasil Diupdate!
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                  </div>');
        redirect('admin/buku');
    }

    public function hapus($bukuID)
    {
        $buku = $this->db->get_where('buku', ['bukuID' => $bukuID])->row();

        if ($buku && $buku->cover) {
            @unlink('./sneat/assets/upload/cover/' . $buku->cover);
        }

        $this->db->delete('buku', ['bukuID' => $bukuID]);

        $this->session->set_flashdata('notifikasi', '
        <div class="alert alert-success alert-dismissible" role="alert">
                    Data Berhasil Dihapus!
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                  </div>');
        redirect('admin/buku');
    }
}
