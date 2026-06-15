<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Koleksi extends CI_Controller
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
    // INDEX KOLEKSI (TABLE STYLE)
    // =========================
    public function index()
    {
        $userID = $this->session->userdata('userID');

        $this->db->select('
            koleksipribadi.koleksiID,
            koleksipribadi.bukuID,
            buku.cover,
            buku.judul,
            buku.penulis,
            buku.penerbit,
            buku.tahunTerbit,
            buku.status,
            kategori.namaKategori
        ');
        $this->db->from('koleksipribadi');
        $this->db->join('buku', 'buku.bukuID = koleksipribadi.bukuID');
        $this->db->join('kategori', 'kategori.kategoriID = buku.kategoriID', 'left');
        $this->db->where('koleksipribadi.userID', $userID);

        // FILTER (biar konsisten kayak buku)
        if ($this->input->get('judul')) {
            $this->db->like('buku.judul', $this->input->get('judul'));
        }

        if ($this->input->get('penulis')) {
            $this->db->like('buku.penulis', $this->input->get('penulis'));
        }

        if ($this->input->get('kategori')) {
            $this->db->like('kategori.namaKategori', $this->input->get('kategori'));
        }

        if ($this->input->get('penerbit')) {
            $this->db->like('buku.penerbit', $this->input->get('penerbit'));
        }

        if ($this->input->get('tahun')) {
            $this->db->where('buku.tahunTerbit', $this->input->get('tahun'));
        }

        $this->db->order_by('koleksipribadi.koleksiID', 'DESC');

        $koleksi = $this->db->get()->result_array();

foreach ($koleksi as &$b) {

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

        $data = array(
            'judul' => 'Halaman Buku Favorit',
            'koleksi' => $koleksi
        );

        $this->template->load('template', 'peminjam/koleksi', $data);
    }

    public function tambah($bukuID)
{
    $userID = $this->session->userdata('userID');

    if (!$userID) {
        redirect('auth');
    }

    // CEK DUPLIKAT
    $cek = $this->db->get_where('koleksipribadi', [
        'userID' => $userID,
        'bukuID' => $bukuID
    ])->row();

    if (!$cek) {
        $this->db->insert('koleksipribadi', [
            'userID' => $userID,
            'bukuID' => $bukuID
        ]);

        $this->session->set_flashdata('notifikasi',
            '<div class="alert alert-success alert-dismissible">
                Berhasil ditambahkan ke favorit!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>'
        );
    } else {
        $this->session->set_flashdata('notifikasi',
            '<div class="alert alert-warning alert-dismissible">
                Sudah ada di favorit!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>'
        );
    }

    redirect('peminjam/buku');
}

    // =========================
    // HAPUS FAVORIT (ONLY ACTION)
    // =========================
    public function hapus($id)
    {
        $this->db->where('koleksiID', $id);
        $this->db->delete('koleksipribadi');

        $this->session->set_flashdata('notifikasi',
            '<div class="alert alert-success alert-dismissible">
                Berhasil dihapus dari favorit!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>'
        );

        redirect('peminjam/koleksi');
    }
}