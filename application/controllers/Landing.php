<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

    public function index()
    {
        // 🔥 buku terbaru
        $this->db->order_by('bukuID', 'DESC');
        $buku = $this->db->get('buku')->result_array();

        // 🔥 kategori
        $kategori = $this->db->get('kategori')->result_array();

        // 🔥 ulasan (INGET: tabel kamu ulasanbuku, bukan ulasan 😤)
        $this->db->select('u.*, b.cover, usr.nama');
        $this->db->from('ulasanbuku u');
        $this->db->join('buku b', 'b.bukuID = u.bukuID');
        $this->db->join('user usr', 'usr.userID = u.userID');
        $this->db->order_by('u.ulasanID', 'DESC');
        $ulasan = $this->db->get()->result_array();

        $data = [
            'judul'    => 'Halaman Landing',
            'buku'     => $buku,
            'kategori' => $kategori,
            'ulasan'   => $ulasan
        ];

        // 🔥 pakai template frontend kamu
        $this->template->load('frontend', 'landing', $data);
    }

    public function dashboard()
{
    // ambil 12 bulan terakhir
    $query = $this->db->query("
        SELECT 
            MONTH(tanggalPeminjaman) AS bulan,
            COUNT(*) AS total
        FROM peminjaman
        WHERE tanggalPeminjaman >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
        GROUP BY MONTH(tanggalPeminjaman)
        ORDER BY MONTH(tanggalPeminjaman)
    ");

    $result = $query->result();

    // isi default 12 bulan biar gak bolong
    $dataBulanan = array_fill(0, 12, 0);

    foreach ($result as $row) {
        $index = (int)$row->bulan - 1;
        $dataBulanan[$index] = (int)$row->total;
    }

    $data['chartPeminjaman'] = $dataBulanan;

    $this->load->view('dashboard', $data);
}
}