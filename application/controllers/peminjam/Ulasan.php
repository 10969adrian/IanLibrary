<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ulasan extends CI_Controller
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

public function index()
{
    $userID = $this->session->userdata('userID');

    $this->db->select('ulasanbuku.*, user.nama, user.foto, buku.judul, buku.cover');
    $this->db->from('ulasanbuku');
    $this->db->join('user', 'user.userID = ulasanbuku.userID', 'left');
    $this->db->join('buku', 'buku.bukuID = ulasanbuku.bukuID', 'left');
    $this->db->where('ulasanbuku.userID', $userID); // hanya ulasan user login
    $this->db->order_by('ulasanbuku.ulasanID', 'DESC');

    $data['ulasan'] = $this->db->get()->result_array();
    $data['judul'] = 'Halaman Review Buku';

    $this->template->load('template', 'peminjam/ulasan', $data);
}

    // 📌 SIMPAN ULASAN (INI YANG DIPAKAI MODAL DI HALAMAN BUKU)
    public function simpan()
    {
        $userID = $this->session->userdata('userID');
        $bukuID = $this->input->post('bukuID');
        $rating = $this->input->post('rating');
        $ulasan = $this->input->post('ulasan');

        // 🔥 CEK: SUDAH PERNAH REVIEW BELUM
        $cek = $this->db->get_where('ulasanbuku', [
            'userID' => $userID,
            'bukuID' => $bukuID
        ])->row();

        if ($cek) {
            $this->session->set_flashdata(
                'notifikasi',
                '<div class="alert alert-warning alert-dismissible">
                    Kamu sudah memberikan ulasan untuk buku ini!
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>'
            );
            redirect('peminjam/buku');
        }

        $this->db->insert('ulasanbuku', [
            'userID' => $userID,
            'bukuID' => $bukuID,
            'rating' => $rating,
            'ulasan' => $ulasan
        ]);

        $this->session->set_flashdata(
            'notifikasi',
            '<div class="alert alert-success alert-dismissible">
                Ulasan berhasil ditambahkan!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>'
        );

        redirect('peminjam/buku');
    }

    // 📌 EDIT ULASAN (HANYA PEMILIK)
    public function edit($id)
    {
        $this->db->select('ulasanbuku.*, buku.cover, buku.judul');
        $this->db->from('ulasanbuku');
        $this->db->join('buku', 'buku.bukuID = ulasanbuku.bukuID');
        $this->db->where('ulasanbuku.ulasanID', $id);

        $data['ulasan'] = $this->db->get()->row();

        if (!$data['ulasan']) {
            show_404();
        }

        $data['judul'] = 'Edit Review';

        $this->template->load('template', 'peminjam/ulasan_edit', $data);
    }

    // 📌 UPDATE ULASAN
    public function update()
    {
        $userID = $this->session->userdata('userID');

        $id = $this->input->post('ulasanID');

        $this->db->where('ulasanID', $id);
        $this->db->where('userID', $userID);
        $this->db->update('ulasanbuku', [
            'rating' => $this->input->post('rating'),
            'ulasan' => $this->input->post('ulasan')
        ]);

        $this->session->set_flashdata(
            'notifikasi',
            '<div class="alert alert-success alert-dismissible" role="alert">
        Ulasan berhasil diupdate!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>'
        );

        redirect('peminjam/ulasan');
    }

    // 📌 HAPUS ULASAN (HANYA PEMILIK)
    // 📌 HAPUS ULASAN (HANYA PEMILIK)
public function hapus($id)
{
    $userID = $this->session->userdata('userID');

    // 🔥 cek apakah ulasan milik user yg login
    $cek = $this->db->get_where('ulasanbuku', [
        'ulasanID' => $id,
        'userID'   => $userID
    ])->row();

    // kalau bukan miliknya
    if (!$cek) {

        $this->session->set_flashdata(
            'notifikasi',
            '<div class="alert alert-danger alert-dismissible" role="alert">
                Hapus ulasan gagal!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>'
        );

        redirect('peminjam/ulasan');
    }

    // 🔥 DELETE DATA
    $this->db->where('ulasanID', $id);
    $this->db->delete('ulasanbuku');

    // 🔥 NOTIF
    $this->session->set_flashdata(
        'notifikasi',
        '<div class="alert alert-success alert-dismissible" role="alert">
            Hapus ulasan berhasil!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>'
    );

    // 🔥 REDIRECT
    redirect('peminjam/ulasan');
}
}