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

        if ($this->session->userdata('role') == 'Peminjam') {
            redirect('home');
        }
    }

    public function index()
    {
        $judul = $this->input->get('judul');
        $status = $this->input->get('status');
        $nama = $this->input->get('nama');

        $this->db->select('peminjaman.*, buku.judul, user.nama');
        $this->db->from('peminjaman');

        $this->db->join('buku', 'buku.bukuID = peminjaman.bukuID', 'left');

        $this->db->join('user', 'user.userID = peminjaman.userID', 'left');

        if (!empty($judul)) {
            $this->db->like('buku.judul', $judul);
        }

        if (!empty($status)) {
            $this->db->where('peminjaman.statusPeminjaman', $status);
        }

        if (!empty($nama)) {
            $this->db->like('user.nama', $nama);
        }

        $this->db->order_by('peminjaman.peminjamanID', 'DESC');

        $data['riwayat'] = $this->db->get()->result_array();
        $data['judul'] = 'Halaman Riwayat Peminjaman';

        $this->template->load('template', 'admin/peminjaman', $data);
    }

    public function terima($id)
    {
        $data = $this->db->get_where('peminjaman', [
            'peminjamanID' => $id
        ])->row_array();

        $buku = $this->db->get_where('buku', [
            'bukuID' => $data['bukuID']
        ])->row_array();

        if ($buku['status'] == 'Dipinjam') {
            $this->session->set_flashdata(
                'notifikasi',
                '<div class="alert alert-danger">Buku sedang dipinjam!</div>'
            );
            redirect('admin/peminjaman');
        }

        $this->db->where('peminjamanID', $id);
        $this->db->where('statusPeminjaman', 'Proses');
        $this->db->update('peminjaman', [
            'statusPeminjaman' => 'Dipinjam'
        ]);

        $this->db->where('bukuID', $data['bukuID']);
        $this->db->update('buku', [
            'status' => 'Dipinjam'
        ]);

        $this->session->set_flashdata(
            'notifikasi',
            '<div class="alert alert-success alert-dismissible">
                Pengajuan diterima!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>'
        );

        redirect('admin/peminjaman');
    }

    public function tolak($id)
    {
        $this->db->where('peminjamanID', $id);
        $this->db->where('statusPeminjaman', 'Proses');
        $this->db->update('peminjaman', [
            'statusPeminjaman' => 'Ditolak'
        ]);

        $this->session->set_flashdata(
            'notifikasi',
            '<div class="alert alert-danger alert-dismissible">
                Pengajuan ditolak!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>'
        );

        redirect('admin/peminjaman');
    }

    public function kembalikan($id)
    {

        $data = $this->db->get_where('peminjaman', [
            'peminjamanID' => $id
        ])->row_array();

        // hitung denda
        $jatuhTempo = strtotime($data['tanggalJatuhTempo']);
        $hariIni = strtotime(date('Y-m-d'));

        $telat = 0;

        if ($hariIni > $jatuhTempo) {
            $telat = floor(
                ($hariIni - $jatuhTempo) / (60 * 60 * 24)
            );
        }

        $denda = $telat * 2000;

        $this->db->where('peminjamanID', $id);
        $this->db->where('statusPeminjaman', 'Pengembalian Diajukan');
        $this->db->update('peminjaman', [
            'statusPeminjaman' => 'Dikembalikan',
            'tanggalPengembalian' => date('Y-m-d'),
            'denda' => $denda
        ]);

        $this->db->where('bukuID', $data['bukuID']);
        $this->db->update('buku', [
            'status' => 'Tersedia'
        ]);

        $this->session->set_flashdata(
            'notifikasi',
            '<div class="alert alert-success alert-dismissible">
            Buku berhasil dikonfirmasi kembali!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>'
        );

        redirect('admin/peminjaman');
    }
}<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller
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

    // 📌 LIST DATA PEMINJAMAN
    public function index()
{
    $judul  = $this->input->get('judul');
    $status = $this->input->get('status');
    $nama   = $this->input->get('nama');

    $this->db->select('peminjaman.*, buku.judul, user.nama');
    $this->db->from('peminjaman');

    // JOIN BUKU
    $this->db->join('buku', 'buku.bukuID = peminjaman.bukuID', 'left');

    // JOIN USER (FIX SESUAI DB KAMU)
    $this->db->join('user', 'user.userID = peminjaman.userID', 'left');

    // FILTER JUDUL BUKU
    if (!empty($judul)) {
        $this->db->like('buku.judul', $judul);
    }

    // FILTER STATUS
    if (!empty($status)) {
        $this->db->where('peminjaman.statusPeminjaman', $status);
    }

    // FILTER NAMA USER 
    if (!empty($nama)) {
        $this->db->like('user.nama', $nama);
    }

    $this->db->order_by('peminjaman.peminjamanID', 'DESC');

    $data['riwayat'] = $this->db->get()->result_array();
    $data['judul']   = 'Halaman Riwayat Peminjaman';

    $this->template->load('template', 'admin/peminjaman', $data);
}

    // TERIMA
    public function terima($id)
    {
        $data = $this->db->get_where('peminjaman', [
            'peminjamanID' => $id
        ])->row_array();

        $buku = $this->db->get_where('buku', [
            'bukuID' => $data['bukuID']
        ])->row_array();

        if ($buku['status'] == 'Dipinjam') {
            $this->session->set_flashdata('notifikasi',
                '<div class="alert alert-danger">Buku sedang dipinjam!</div>');
            redirect('admin/peminjaman');
        }

        $this->db->where('peminjamanID', $id);
        $this->db->where('statusPeminjaman', 'Proses');
        $this->db->update('peminjaman', [
            'statusPeminjaman' => 'Dipinjam'
        ]);

        $this->db->where('bukuID', $data['bukuID']);
        $this->db->update('buku', [
            'status' => 'Dipinjam'
        ]);

        $this->session->set_flashdata('notifikasi',
            '<div class="alert alert-success alert-dismissible">
                Pengajuan diterima!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>');

        redirect('admin/peminjaman');
    }

    // ❌ TOLAK
    public function tolak($id)
    {
        $this->db->where('peminjamanID', $id);
        $this->db->where('statusPeminjaman', 'Proses');
        $this->db->update('peminjaman', [
            'statusPeminjaman' => 'Ditolak'
        ]);

        $this->session->set_flashdata('notifikasi',
            '<div class="alert alert-danger alert-dismissible">
                Pengajuan ditolak!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>');

        redirect('admin/peminjaman');
    }
    
    // 🔄 KEMBALIKAN
    public function kembalikan($id)

    {
        
    $data = $this->db->get_where('peminjaman', [
        'peminjamanID' => $id
    ])->row_array();

    // hitung denda
    $jatuhTempo = strtotime($data['tanggalJatuhTempo']);
    $hariIni    = strtotime(date('Y-m-d'));

    $telat = 0;

    if($hariIni > $jatuhTempo){
        $telat = floor(
            ($hariIni - $jatuhTempo) / (60 * 60 * 24)
        );
    }

    $denda = $telat * 2000;

    // hanya dari pengajuan pengembalian
    $this->db->where('peminjamanID', $id);
    $this->db->where('statusPeminjaman', 'Pengembalian Diajukan');
    $this->db->update('peminjaman', [
        'statusPeminjaman' => 'Dikembalikan',
        'tanggalPengembalian' => date('Y-m-d'),
        'denda' => $denda
    ]);

    // update buku jadi tersedia
    $this->db->where('bukuID', $data['bukuID']);
    $this->db->update('buku', [
        'status' => 'Tersedia'
    ]);

    $this->session->set_flashdata('notifikasi',
        '<div class="alert alert-success alert-dismissible">
            Buku berhasil dikonfirmasi kembali!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>'
    );

    redirect('admin/peminjaman');
}
}
