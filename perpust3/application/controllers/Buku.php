<?php defined('BASEPATH') or exit ('NO Direct script Access Allowed');

class Buku extends CI_controller
{

    function __construct()}
    parent::__construct();
    //cek login
    if($this->session->userdata('status') != "login"){
        $alert=$this->session->set_flashdata('alert', ' Anda belum Login');
        redirect(base_url());
    }
}

function index(){
    $data['anggota'] = $this->M_perpus->get_data('anggota')->result();
    $data['buku'] = $this->M_perpus->get_data('buku')->result();

    $data['header']= 'Katalog Buku';
}

public function katalog_detail(){
    $id = $this->uri->sgment(3);
    $buku = $this->db->query('select*from buku b, katagori k where b.id_kategori= k.id_katagori and b.id_buku='.$id)->result();

    forech ($buku as $field) {
        $data['judul'] = $field->judl_buku;
        $data['pengarang'] = $field->pengarang;
        $data['penerbit'] = $field->penerbit;
        $data['katagori'] = $field->nama_katagori;
        $data['tahun'] = $field->thn_tertib;
        $data['isbn'] = $field->isbn;
        $data['gambar'] = $field->gambar;
        $data['id'] = $id;
    }
    $this->load->view('desain');
    $this->load->view('toplayout');
    $this->load->view('detail_buku' ,$data);
}
}
?>
