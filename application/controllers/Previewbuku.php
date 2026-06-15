<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Previewbuku extends CI_Controller
{
    public function index()
    {
        $this->db->select('buku.*, kategori.namaKategori');
        $this->db->from('buku');
        $this->db->join(
            'kategori',
            'kategori.kategoriID = buku.kategoriID',
            'left'
        );

        // FILTER
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
            $this->db->where(
                'buku.tahunTerbit',
                $this->input->get('tahun')
            );
        }

        if ($this->input->get('status') != '') {
            $this->db->where(
                'buku.status',
                $this->input->get('status')
            );
        }

        if ($this->input->get('kategori') != '') {
            $this->db->like(
                'kategori.namaKategori',
                $this->input->get('kategori')
            );
        }

        $this->db->order_by(
            'buku.judul',
            'ASC'
        );

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

        $kategori = $this->db
            ->get('kategori')
            ->result_array();

        $data = [
            'judul'    => 'Halaman Preview Buku',
            'buku'     => $buku,
            'kategori' => $kategori
        ];

        $this->template->load(
            'frontend',
            'previewbuku',
            $data
        );
    }
}