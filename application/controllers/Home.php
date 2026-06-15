<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('is_login') == FALSE) {
            redirect('auth');
        }
    }

    public function index()
    {

        $this->db->select('
buku.*,
kategori.namaKategori
');

        $this->db->from('buku');

        $this->db->join(
            'kategori',
            'kategori.kategoriID = buku.kategoriID',
            'left'
        );

        $this->db->order_by('bukuID', 'DESC');

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

        $data['buku'] = $buku;

        $this->db->from('kategori');
        $this->db->order_by('namaKategori', 'ASC');
        $data['kategori'] = $this->db->get()->result_array();

        $this->db->select('ulasanbuku.*, user.nama, user.foto, buku.cover, buku.judul');
        $this->db->from('ulasanbuku');
        $this->db->join('user', 'user.userID = ulasanbuku.userID', 'left');
        $this->db->join('buku', 'buku.bukuID = ulasanbuku.bukuID', 'left');
        $this->db->order_by('ulasanbuku.ulasanID', 'DESC');
        $this->db->limit(10);
        $data['ulasan'] = $this->db->get()->result_array();

        $besok = date('Y-m-d', strtotime('+1 day'));

        $this->db->select('peminjaman.*, buku.judul');
        $this->db->from('peminjaman');
        $this->db->join('buku', 'buku.bukuID = peminjaman.bukuID');

        $this->db->where(
            'peminjaman.userID',
            $this->session->userdata('userID')
        );

        $this->db->where(
            'peminjaman.statusPeminjaman',
            'Dipinjam'
        );

        $this->db->where("
            DATE_ADD(peminjaman.tanggalPeminjaman, INTERVAL 7 DAY) = '$besok'
        ");

        $data['notifJatuhTempo'] = $this->db->get()->result_array();

        $today = date('Y-m-d');

        $this->db->select('peminjaman.*, buku.judul');
        $this->db->from('peminjaman');
        $this->db->join('buku', 'buku.bukuID = peminjaman.bukuID');

        $this->db->where(
            'peminjaman.userID',
            $this->session->userdata('userID')
        );

        $this->db->where(
            'peminjaman.statusPeminjaman',
            'Dipinjam'
        );

        $this->db->where("
            DATE_ADD(peminjaman.tanggalPeminjaman, INTERVAL 7 DAY) < '$today'
        ");

        $data['notifTerlambat'] = $this->db->get()->result_array();


        $userID = $this->session->userdata('userID');

        $this->db->where('userID', $userID);
        $data['totalDipinjam'] =
            $this->db->count_all_results('peminjaman');

        $this->db->where('userID', $userID);
        $data['totalFavorit'] =
            $this->db->count_all_results('koleksipribadi');

        $this->db->where('userID', $userID);
        $data['totalReviewUser'] =
            $this->db->count_all_results('ulasanbuku');

        $this->db->where('userID', $userID);
        $this->db->where('statusPeminjaman', 'Dikembalikan');
        $data['totalSelesai'] =
            $this->db->count_all_results('peminjaman');

        $data['totalBuku'] =
            $this->db->count_all('buku');

        $data['totalKategori'] =
            $this->db->count_all('kategori');

        $data['totalUser'] =
            $this->db->count_all('user');

        $data['totalReviewAdmin'] =
            $this->db->count_all('ulasanbuku');

        $this->db->where(
            'statusPeminjaman',
            'Dipinjam'
        );

        $data['totalPeminjamanAktif'] =
            $this->db->count_all_results('peminjaman');

        $this->db->select('
    buku.*,
    kategori.namaKategori,
    AVG(ulasanbuku.rating) as rating_rata,
    COUNT(ulasanbuku.ulasanID) as jumlah_review
');

        $this->db->from('buku');

        $this->db->join(
            'kategori',
            'kategori.kategoriID = buku.kategoriID',
            'left'
        );

        $this->db->join(
            'ulasanbuku',
            'ulasanbuku.bukuID = buku.bukuID',
            'left'
        );

        $this->db->group_by('buku.bukuID');

        $this->db->order_by('rating_rata', 'DESC');
        $this->db->order_by('jumlah_review', 'DESC');

        $this->db->limit(10);

        $rekomendasi = $this->db->get()->result_array();

        foreach ($rekomendasi as &$r) {

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
                    $r['bukuID']
                )
                ->order_by(
                    'ulasanbuku.ulasanID',
                    'DESC'
                )
                ->get()
                ->result_array();

            $r['reviews'] = $review;

            $r['totalReview'] = count($review);

            if ($r['totalReview'] > 0) {

                $rating = array_column(
                    $review,
                    'rating'
                );

                $r['ratingRata'] = round(
                    array_sum($rating) /
                    count($rating),
                    1
                );

            } else {

                $r['ratingRata'] = 0;
            }
        }

        $data['rekomendasi'] = $rekomendasi;

        $data['judul'] = 'Halaman Dashboard';

        $this->template->load(
            'template',
            'dashboard',
            $data
        );

    }

    public function simpan()
    {
        $userID = $this->session->userdata('userID');
        $bukuID = $this->input->post('bukuID');
        $rating = $this->input->post('rating');
        $ulasan = $this->input->post('ulasan');

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
            redirect('ulasan');
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

        redirect('home');
    }

}<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('is_login') == FALSE) {
            redirect('auth');
        }
    }

    public function index() {

        // 📚 DATA BUKU
        // 📚 DATA BUKU
$this->db->select('
buku.*,
kategori.namaKategori
');

$this->db->from('buku');

$this->db->join(
'kategori',
'kategori.kategoriID = buku.kategoriID',
'left'
);

$this->db->order_by('bukuID', 'DESC');

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

$data['buku'] = $buku;

        // 🗂️ DATA KATEGORI
        $this->db->from('kategori');
        $this->db->order_by('namaKategori', 'ASC');
        $data['kategori'] = $this->db->get()->result_array();

        $this->db->select('ulasanbuku.*, user.nama, user.foto, buku.cover, buku.judul');
        $this->db->from('ulasanbuku');
        $this->db->join('user', 'user.userID = ulasanbuku.userID', 'left');
        $this->db->join('buku', 'buku.bukuID = ulasanbuku.bukuID', 'left');
        $this->db->order_by('ulasanbuku.ulasanID', 'DESC');
        $this->db->limit(10);
        $data['ulasan'] = $this->db->get()->result_array();
    
        // 🔥 REMINDER JATUH TEMPO (H-1)
        $besok = date('Y-m-d', strtotime('+1 day'));

        $this->db->select('peminjaman.*, buku.judul');
        $this->db->from('peminjaman');
        $this->db->join('buku', 'buku.bukuID = peminjaman.bukuID');

        $this->db->where(
            'peminjaman.userID',
            $this->session->userdata('userID')
        );

        $this->db->where(
            'peminjaman.statusPeminjaman',
            'Dipinjam'
        );

        // 🔥 jatuh tempo = tanggal pinjam + 7 hari
        $this->db->where("
            DATE_ADD(peminjaman.tanggalPeminjaman, INTERVAL 7 DAY) = '$besok'
        ");

        $data['notifJatuhTempo'] = $this->db->get()->result_array();
    
        // 🔥 NOTIF TERLAMBAT
        $today = date('Y-m-d');

        $this->db->select('peminjaman.*, buku.judul');
        $this->db->from('peminjaman');
        $this->db->join('buku', 'buku.bukuID = peminjaman.bukuID');

        $this->db->where(
            'peminjaman.userID',
            $this->session->userdata('userID')
        );

        $this->db->where(
            'peminjaman.statusPeminjaman',
            'Dipinjam'
        );

        $this->db->where("
            DATE_ADD(peminjaman.tanggalPeminjaman, INTERVAL 7 DAY) < '$today'
        ");

        $data['notifTerlambat'] = $this->db->get()->result_array();

        // ======================================================
// STATISTIK PEMINJAM
// ======================================================

$userID = $this->session->userdata('userID');

// Total Buku Dipinjam
$this->db->where('userID', $userID);
$data['totalDipinjam'] =
    $this->db->count_all_results('peminjaman');

// Total Buku Favorit
$this->db->where('userID', $userID);
$data['totalFavorit'] =
    $this->db->count_all_results('koleksipribadi');

// Total Review Ditulis
$this->db->where('userID', $userID);
$data['totalReviewUser'] =
    $this->db->count_all_results('ulasanbuku');

// Total Buku Selesai Dibaca
$this->db->where('userID', $userID);
$this->db->where('statusPeminjaman', 'Dikembalikan');
$data['totalSelesai'] =
    $this->db->count_all_results('peminjaman');


// ======================================================
// STATISTIK ADMIN / PETUGAS
// ======================================================

$data['totalBuku'] =
    $this->db->count_all('buku');

$data['totalKategori'] =
    $this->db->count_all('kategori');

$data['totalUser'] =
    $this->db->count_all('user');

$data['totalReviewAdmin'] =
    $this->db->count_all('ulasanbuku');

$this->db->where(
    'statusPeminjaman',
    'Dipinjam'
);

$data['totalPeminjamanAktif'] =
    $this->db->count_all_results('peminjaman');


// ======================================================
// REKOMENDASI BUKU
// ======================================================

$this->db->select('
    buku.*,
    kategori.namaKategori,
    AVG(ulasanbuku.rating) as rating_rata,
    COUNT(ulasanbuku.ulasanID) as jumlah_review
');

$this->db->from('buku');

$this->db->join(
    'kategori',
    'kategori.kategoriID = buku.kategoriID',
    'left'
);

$this->db->join(
    'ulasanbuku',
    'ulasanbuku.bukuID = buku.bukuID',
    'left'
);

$this->db->group_by('buku.bukuID');

$this->db->order_by('rating_rata', 'DESC');
$this->db->order_by('jumlah_review', 'DESC');

$this->db->limit(10);

$rekomendasi = $this->db->get()->result_array();

foreach ($rekomendasi as &$r) {

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
            $r['bukuID']
        )
        ->order_by(
            'ulasanbuku.ulasanID',
            'DESC'
        )
        ->get()
        ->result_array();

    $r['reviews'] = $review;

    $r['totalReview'] = count($review);

    if ($r['totalReview'] > 0) {

        $rating = array_column(
            $review,
            'rating'
        );

        $r['ratingRata'] = round(
            array_sum($rating) /
            count($rating),
            1
        );

    } else {

        $r['ratingRata'] = 0;
    }
}

$data['rekomendasi'] = $rekomendasi;


// TITLE
$data['judul'] = 'Halaman Dashboard';

$this->template->load(
    'template',
    'dashboard',
    $data
);

}

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
            $this->session->set_flashdata('notifikasi',
                '<div class="alert alert-warning alert-dismissible">
                    Kamu sudah memberikan ulasan untuk buku ini!
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>');
            redirect('ulasan');
        }

        $this->db->insert('ulasanbuku', [
            'userID' => $userID,
            'bukuID' => $bukuID,
            'rating' => $rating,
            'ulasan' => $ulasan
        ]);

        $this->session->set_flashdata('notifikasi',
            '<div class="alert alert-success alert-dismissible">
                Ulasan berhasil ditambahkan!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>');

        redirect('home');
    }

}
