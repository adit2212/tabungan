<?php
include 'function.php';
// ini arahnya kemana ??????
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabungan Nikah - Kelola Pencatatan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="tab.css">
</head>

<body>
    <!-- Modal Form -->
    <?php
    if (isset($_POST['simpan'])) {
        if (add($_POST) > 1) {
            ?>
            <script>
                alert('Data berhasil di simpan!');
            </script>
        <?
        } else {
            ?>
            <script>
                alert('Data gagal di simpan!');
            </script>
            <?php

        }
    }
    ?>
    <div class="modal" id="recordModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">Tambah Pencatatan Baru</h3>
                <button class="close-btn" id="closeModal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="recordForm" method="post">
                    <div class="form-group">
                        <label for="date">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" id="date" required title="wajib di isi">
                    </div>
                    <div class="form-group">
                        <label for="description">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" id="description"
                            placeholder="Masukkan keterangan" required title="wajib di isi">
                    </div>
                    <div class="form-group">
                        <label for="amount">Jumlah (Rp)</label>
                        <input type="text" class="form-control" name="jumlah" id="amount" placeholder="Masukkan jumlah"
                            required title="wajib di isi">
                    </div>
                    <div class="form-group">
                        <label for="type">Jenis</label>
                        <select class="form-control" name="jenis" id="type">
                            <option value="" required title="wajib di isi">Pilih jenis</option>
                            <option value="pemasukan">Pemasukan</option>
                            <option value="pengeluaran">Pengeluaran</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status" required title="wajib di isi">
                            <option value="terkonfirmasi">Terkonfirmasi</option>
                            <!-- <option value="pending">Pending</option> -->
                            <option value="dibatalkan">Dibatalkan</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" id="cancelBtn">Batal</button>
                        <button class="btn btn-success" name="simpan" id="saveBtn">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <header>
            <h1>
                <i class="fas fa-heart"></i>
                Tabungan Nikah
            </h1>
            <button class="btn btn-primary" id="addBtn">
                <i class="fas fa-plus"></i>
                Tambah Pencatatan
            </button>
        </header>

        <div class="total-savings">
            <div>
                <h3>Total Tabungan</h3>
                <p>Terakhir diperbarui: <span id="lastUpdate">17 April 2025</span></p>
            </div>
            <?php
            // query jumlah data keuangan
            $jumlah = mysqli_query($conn, "SELECT SUM(jumlah)as jumlah_semua FROM nikah");
            $data1 = mysqli_fetch_assoc($jumlah);
            // var_dump($data1)
            ?>
            <div class="total-amount">
                <?php echo rupiah($data1['jumlah_semua']) ?>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="fas fa-list"></i>
                    Daftar Pencatatan Tabungan
                </h2>
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari pencatatan...">
                </div>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php
                    $tampil = tampil('SELECT * FROM nikah');
                    $nomor = 0;
                    // var_dump($tampil);
                    foreach ($tampil as $row) {
                        $nomor++;
                        ?>
                        <tbody>
                            <tr>
                                <td><?php echo $nomor ?></td>
                                <td><?php echo $row['tanggal'] ?></td>
                                <td><?php echo $row['keterangan'] ?></td>
                                <td><?php echo $row['jumlah'] ?></td>
                                <td><?php echo $row['jenis'] ?></td>
                                <td><span class="badge badge-success"><?php echo $row['status'] ?></span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="action-btn btn-info" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <!-- <button class="action-btn btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button> -->
                                        <button class="btn-warning" data-id="<?php echo $data['id']; ?>">Edit</button>
                                        <a href="hapus.php?id=<?php echo $row['id'] ?>"
                                            onclick="return confirm('yakin kah yu sayang ???')"><button
                                                class="action-btn btn-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button></a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- <div class="pagination">
                <li class="page-item active"><a href="#" class="page-link">1</a></li>
                <li class="page-item"><a href="#" class="page-link">2</a></li>
                <li class="page-item"><a href="#" class="page-link">3</a></li>
                <li class="page-item"><a href="#" class="page-link">Next</a></li>
            </div> -->
        </div>
    </div>



    <script src="tab.js"></script>
</body>

</html>
