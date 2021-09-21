
<?php
    $this->load->view('pages/head');
    $this->load->view('pages/header');
    $this->load->view('pages/menu');
    $this->load->view('pages/wrapper');
    $this->load->view($content_page);
    $this->load->view('pages/footer');
    $this->load->view('pages/script');
?>