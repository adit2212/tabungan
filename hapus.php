<?php
include "function.php";
$id = $_GET['id'];
// var_dump( $id );

if (hapus($id) > 1) {
    ?>
    <script>
        alert("data di hapus")
    </script>
    <?php
    header('location: tabungan.php');
} else {
    ?>
    <script>
        alert('data gagal di hapus');
    </script>
    <?php
    header('location: tabungan.php');

}
