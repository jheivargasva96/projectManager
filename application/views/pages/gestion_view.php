
<?php

    $cadena = '';
    if (@$css) {
        foreach ($css as $value) {
            $cadena .= '<link rel="stylesheet" href="' . base_url() . '/assets/' . $value . '">';
        }
    }

    $this->load->view('pages/head');
    ?>
</head>
    <?= 
    $this->load->view('pages/header');
    $this->load->view('pages/menu');
    $this->load->view('pages/wrapper');
    $this->load->view($content_page);
    $this->load->view('pages/footer');
    $this->load->view('pages/script');
?>
<?= $cadena ?>




