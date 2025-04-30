<?php
$conn = mysqli_connect("localhost", "root", "", "nikah");
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
}

// function

function tampil($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function add($data)
{
    global $conn;
    $tanggal = $data['tanggal'];
    $keterangan = $data['keterangan'];
    $jumlah = $data['jumlah'];
    $jenis = $data['jenis'];
    $status = $data['status'];

    $query = "INSERT INTO `nikah`(`tanggal`, `keterangan`, `jumlah`, `jenis`, `status`) VALUES ('$tanggal','$keterangan','$jumlah','$jenis','$status')";

    // var_dump($query);
    // die
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function rupiah($angka)
{
    // number_format (3);
    $hasil_rupiah = "Rp " . number_format($angka, 3, ',', '.');
    return $hasil_rupiah;
}

function hapus($id)
{
    global $conn;
    $hapus = "DELETE FROM `nikah` WHERE id = '$id'";
    mysqli_query($conn, $hapus);
    return mysqli_affected_rows($conn);
}
