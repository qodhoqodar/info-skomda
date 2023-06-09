<?php
    include('koneksi.php');

    if(isset($_GET['id'])){
        $delete = mysqli_query($db, "DELETE FROM fasilitas WHERE id_fasilitas = '".$_GET['id']."'");
        echo '<script>window.location="fasilitas.php"</script>';
    }