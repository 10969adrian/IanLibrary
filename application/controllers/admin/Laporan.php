<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller
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
        $dari = $this->input->get('dari');
        $sampai = $this->input->get('sampai');
        $status = $this->input->get('status');

        $this->db->select('peminjaman.*, buku.judul, user.nama');
        $this->db->from('peminjaman');

        $this->db->join('buku', 'buku.bukuID = peminjaman.bukuID', 'left');
        $this->db->join('user', 'user.userID = peminjaman.userID', 'left');

        if (!empty($dari) && !empty($sampai)) {
            $this->db->where('DATE(peminjaman.tanggalPeminjaman) >=', $dari);
            $this->db->where('DATE(peminjaman.tanggalPeminjaman) <=', $sampai);
        }

        if (!empty($status)) {
            $this->db->where('peminjaman.statusPeminjaman', $status);
        }

        $this->db->order_by('peminjaman.peminjamanID', 'DESC');

        $data['laporan'] = $this->db->get()->result_array();
        $data['judul'] = 'Halaman Laporan Peminjaman';

        $this->template->load('template', 'admin/laporan', $data);
    }

    public function print()
    {
        $dari = $this->input->get('dari');
        $sampai = $this->input->get('sampai');
        $status = $this->input->get('status');

        $this->db->select('peminjaman.*, buku.judul, user.nama');
        $this->db->from('peminjaman');
        $this->db->join('buku', 'buku.bukuID = peminjaman.bukuID', 'left');
        $this->db->join('user', 'user.userID = peminjaman.userID', 'left');

        if (!empty($dari) && !empty($sampai)) {
            $this->db->where('DATE(peminjaman.tanggalPeminjaman) >=', $dari);
            $this->db->where('DATE(peminjaman.tanggalPeminjaman) <=', $sampai);
        }

        if (!empty($status)) {
            $this->db->where('peminjaman.statusPeminjaman', $status);
        }

        $data['laporan'] = $this->db->get()->result_array();

        $this->load->view('admin/laporan_print', $data);
    }
}
