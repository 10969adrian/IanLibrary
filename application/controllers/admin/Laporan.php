<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // 🔐 cek login
        if ($this->session->userdata('is_login') == FALSE) {
            redirect('auth');
        }

        // 🔐 hanya admin
        if ($this->session->userdata('role') == 'Peminjam') {
            redirect('home');
        }
    }

    // 📊 HALAMAN LAPORAN
    public function index()
    {
        $dari   = $this->input->get('dari');
        $sampai = $this->input->get('sampai');
        $status = $this->input->get('status');

        $this->db->select('peminjaman.*, buku.judul, user.nama');
        $this->db->from('peminjaman');

        // JOIN
        $this->db->join('buku', 'buku.bukuID = peminjaman.bukuID', 'left');
        $this->db->join('user', 'user.userID = peminjaman.userID', 'left');

        // 📅 FILTER TANGGAL
        if (!empty($dari) && !empty($sampai)) {
            $this->db->where('DATE(peminjaman.tanggalPeminjaman) >=', $dari);
            $this->db->where('DATE(peminjaman.tanggalPeminjaman) <=', $sampai);
        }

        // 📌 FILTER STATUS
        if (!empty($status)) {
            $this->db->where('peminjaman.statusPeminjaman', $status);
        }

        $this->db->order_by('peminjaman.peminjamanID', 'DESC');

        $data['laporan'] = $this->db->get()->result_array();

        // 🧠 penting buat template Sneat kamu
        $data['judul'] = 'Halaman Laporan Peminjaman';

        $this->template->load('template', 'admin/laporan', $data);
    }

    // 🖨 PRINT VERSION (opsional kalau mau pisah halaman print)
    public function print()
    {
        $dari   = $this->input->get('dari');
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

        // tanpa template biar clean buat print
        $this->load->view('admin/laporan_print', $data);
    }
}