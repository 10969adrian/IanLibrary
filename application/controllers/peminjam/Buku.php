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

        if ($this->session->userdata('role') == 'Admin') {
            redirect('home');
        }

        if ($this->session->userdata('role') == 'Petugas') {
            redirect('home');
        }
    }

    // =========================
    // INDEX BUKU + FILTER
    // =========================
    public function index()
    {
        $this->db->select('buku.*, kategori.namaKategori');
        $this->db->from('buku');
        $this->db->join('kategori', 'kategori.kategoriID = buku.kategoriID', 'left');

        // FILTER JUDUL
        if ($this->input->get('judul') != '') {
            $this->db->like('buku.judul', $this->input->get('judul'));
        }

        // FILTER PENULIS
        if ($this->input->get('penulis') != '') {
            $this->db->like('buku.penulis', $this->input->get('penulis'));
        }

        // FILTER PENERBIT
        if ($this->input->get('penerbit') != '') {
            $this->db->like('buku.penerbit', $this->input->get('penerbit'));
        }

        // FILTER TAHUN
        if ($this->input->get('tahun') != '') {
            $this->db->where('buku.tahunTerbit', $this->input->get('tahun'));
        }

        // 🔥 FIX: STATUS HARUS EXACT (bukan LIKE)
        if ($this->input->get('status') != '') {
            $this->db->where('buku.status', $this->input->get('status'));
        }

        // FILTER KATEGORI
        if ($this->input->get('kategori') != '') {
            $this->db->like('kategori.namaKategori', $this->input->get('kategori'));
        }

        $this->db->order_by('buku.judul', 'ASC');
        $buku = $this->db->get()->result_array();
        foreach ($buku as &$b) {

    $review = $this->db
        ->select('
            ulasanbuku.*,
            user.nama,
            user.foto
        ')
        ->from('ulasanbuku')
        ->join(
            'user',
            'user.userID = ulasanbuku.userID',
            'left'
        )
        ->where(
            'ulasanbuku.bukuID',
            $b['bukuID']
        )
        ->order_by(
            'ulasanbuku.ulasanID',
            'DESC'
        )
        ->get()
        ->result_array();

    $b['reviews'] = $review;

    $b['totalReview'] = count($review);

    if ($b['totalReview'] > 0) {

        $rating = array_column(
            $review,
            'rating'
        );

        $b['ratingRata'] = round(
            array_sum($rating) /
            count($rating),
            1
        );

    } else {

        $b['ratingRata'] = 0;
    }
}

        // kategori untuk dropdown
        $this->db->from('kategori');
        $this->db->order_by('namaKategori', 'ASC');
        $kategori = $this->db->get()->result_array();

        $data = array(
            'judul' => 'Halaman Buku',
            'buku' => $buku,
            'kategori' => $kategori
        );

        $this->template->load('template', 'peminjam/buku', $data);
    }

    // =========================
    // AJUKAN PINJAM
    // =========================
    public function ajukan($bukuID)
    {
        $this->db->from('buku')->where('bukuID', $bukuID);
        $buku = $this->db->get()->row();

        $this->db->from('kategori');
        $this->db->order_by('namaKategori', 'ASC');
        $kategori = $this->db->get()->result_array();

        $data = array(
            'judul' => 'Halaman Pengajuan Pinjam',
            'buku' => $buku,
            'kategori' => $kategori
        );

        $this->template->load('template', 'peminjam/ajukan', $data);
    }

    // =========================
    // PROSES PINJAM
    // =========================
    public function pinjam()
    {
        $data = array(
            'bukuID' => $this->input->post('bukuID'),
            'userID' => $this->session->userdata('userID'),
            'tanggalPeminjaman' => $this->input->post('tanggalPeminjaman'),
            'statusPeminjaman' => 'Proses'
        );

        $this->db->insert('peminjaman', $data);

        $this->session->set_flashdata('notifikasi',
            '<div class="alert alert-success alert-dismissible" role="alert">
                Pengajuan peminjaman berhasil! silahkan tunggu konfirmasi oleh admin.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>'
        );

        redirect('peminjam/buku');
    }
}