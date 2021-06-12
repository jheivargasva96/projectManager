<script src="<?= base_url() ?>/assets/jquery/jquery.min.js"></script>
<script>
    function base_url(){
        return "<?= base_url() ?>";
    }
</script>
<?php
    $cadena = '';
    if (@$js) {
        foreach ($js as $value) {
            $cadena .= '<script src="' . base_url() . 'assets/' . $value . '"></script>';
        }
    }
?>

<?= $cadena ?>
<script>
    setTimeout(function(){
        $("#<?= $modulo ?>").addClass('active');
    }, 500);
</script>
</body>

</html>