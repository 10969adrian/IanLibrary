<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('is_login') == FALSE) {
            redirect('auth');
        }

        if ($this->session->userdata('role') != 'Peminjam') {
            redirect('home');
        }
    }

    // 📌 RIWAYAT PEMINJAMAN
    public function index()
    {
        $userID = $this->session->userdata('userID');

        $judul  = $this->input->get('judul');
        $status = $this->input->get('status');

        $this->db->select('peminjaman.*, buku.judul');
        $this->db->from('peminjaman');
        $this->db->join('buku', 'buku.bukuID = peminjaman.bukuID', 'left');

        $this->db->where('peminjaman.userID', $userID);

        // filter judul
        if (!empty($judul)) {
            $this->db->like('buku.judul', $judul);
        }

        // filter status
        if (!empty($status)) {
            $this->db->where('peminjaman.statusPeminjaman', $status);
        }

        $this->db->order_by('peminjaman.tanggalPeminjaman', 'DESC');

        $data['riwayat'] = $this->db->get()->result_array();

        $data['judul'] = 'Halaman Riwayat Peminjaman';

        $this->template->load('template', 'peminjam/riwayat', $data);
    }

    // 📌 AJUKAN PEMINJAMAN
    public function ajukan($bukuID)
    {
        $userID = $this->session->userdata('userID');

        // cek buku sedang dipinjam
        $this->db->where('bukuID', $bukuID);
        $this->db->where('statusPeminjaman', 'Dipinjam');

        if ($this->db->get('peminjaman')->row()) {

            $this->session->set_flashdata('notifikasi',
                '<div class="alert alert-danger">
                    Buku sedang dipinjam!
                </div>');

            redirect('peminjam/buku');
        }

        // cek user sudah ajukan buku ini
        $this->db->where('userID', $userID);
        $this->db->where('bukuID', $bukuID);
        $this->db->where('statusPeminjaman', 'Proses');

        if ($this->db->get('peminjaman')->row()) {

            $this->session->set_flashdata('notifikasi',
                '<div class="alert alert-danger alert-dismissible" role="alert">
                    Kamu sudah mengajukan peminjaman buku ini!
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>');

            redirect('peminjam/buku');
        }

        // cek user masih punya peminjaman aktif
        $this->db->where('userID', $userID);

        $this->db->where_in('statusPeminjaman', [
            'Proses',
            'Dipinjam',
            'Pengembalian Diajukan'
        ]);

        if ($this->db->get('peminjaman')->row()) {

            $this->session->set_flashdata('notifikasi',
                '<div class="alert alert-warning alert-dismissible" role="alert">
                    Selesaikan peminjamanmu dulu!
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>');

            redirect('peminjam/peminjaman');
        }

        // insert peminjaman
        $this->db->insert('peminjaman', [

            'userID' => $userID,

            'bukuID' => $bukuID,

            'tanggalPeminjaman' => date('Y-m-d'),

            // 🔥 future feature denda
            'tanggalJatuhTempo' => date('Y-m-d', strtotime('+7 days')),

            'statusPeminjaman' => 'Proses'
        ]);

        $this->session->set_flashdata('notifikasi',
            '<div class="alert alert-success alert-dismissible" role="alert">
                Pengajuan peminjaman berhasil!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>');

        redirect('peminjam/peminjaman');
    }

    // 📌 BATALKAN PEMINJAMAN
    public function batal($id)
    {
        $this->db->where('peminjamanID', $id);

        $this->db->where('statusPeminjaman', 'Proses');

        $this->db->update('peminjaman', [
            'statusPeminjaman' => 'Dibatalkan'
        ]);

        $this->session->set_flashdata('notifikasi',
            '<div class="alert alert-success alert-dismissible" role="alert">
                Pembatalan pengajuan peminjaman berhasil!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>');

        redirect('peminjam/peminjaman');
    }

    // 📌 AJUKAN PENGEMBALIAN
    public function ajukan_kembali($id)
    {
        $userID = $this->session->userdata('userID');

        // cek peminjaman milik user
        $this->db->where('peminjamanID', $id);

        $this->db->where('userID', $userID);

        $this->db->where('statusPeminjaman', 'Dipinjam');

        $cek = $this->db->get('peminjaman')->row();

        if (!$cek) {

            $this->session->set_flashdata('notifikasi',
                '<div class="alert alert-danger">
                    Data tidak valid!
                </div>');

            redirect('peminjam/peminjaman');
        }

        // update jadi pengajuan pengembalian
        $this->db->where('peminjamanID', $id);

        $this->db->update('peminjaman', [

            'statusPeminjaman' => 'Pengembalian Diajukan'

        ]);

        $this->session->set_flashdata('notifikasi',
            '<div class="alert alert-info alert-dismissible">
                Pengajuan pengembalian berhasil dikirim!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>'
        );

        redirect('peminjam/peminjaman');
    }
}