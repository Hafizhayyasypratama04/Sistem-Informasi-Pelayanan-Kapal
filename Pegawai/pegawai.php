<html>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }
    
    h3 {
        color: #333;
        text-align: center;
        margin-top: 20px;
    }
    
    form {
        margin: 20px auto;
        width: 80%;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    
    table td {
        padding: 10px;
        border: 1px solid #ccc;
    }
    
    table th {
        padding: 10px;
        background-color: #333;
        color: #fff;
        border: 1px solid #ccc;
    }
    
    table tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    
    input[type="text"] {
        padding: 5px;
        width: 100%;
        box-sizing: border-box;
    }
    
    input[type="submit"] {
        padding: 8px 20px;
        background-color: #333;
        color: #fff;
        border: none;
        cursor: pointer;
    }
    
    input[type="submit"]:hover {
        background-color: #555;
    }
    
    .edit,
    .hapus,
    .kembali {
        padding: 7.5px 10px;
        background-color: #333;
        color: #fff;
        text-decoration: none;
        border-radius: 3px;
    }
    
    .edit:hover,
    .hapus:hover,
    .kembali:hover {
        background-color: #555;
    }
    
    .edit {
        margin-right: 5px;
    }
    
    .kembali {
        margin-top: 1px;
    }
    
    .kembali:hover {
        background-color: #f2f2f2;
        color: #333;
    }

    .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination a {
            display: inline-block;
            padding: 5px 10px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
            font-size: 14px;
            margin-right: 5px;
        }

        .pagination a.current {
            background-color: #555;
        }
</style>
<h3> JATARIM BINAU LINES </h3>
<form>

<h4>TABEL PEGAWAI</h4>
<a class="kembali" href="tambahpegawai.php">Tambah Pegawai </a>|<a class="kembali" href="../index.php">Kembali</a>
<table border="1" align="center" width="100%">
    <tr bgcolor="green">
        <th>Nomor pegawai</th>
        <th>Nama Pegawai</th>
        <th>Jabatan</th>
        <th>Aksi</th>
    </tr>
    <tr>
        <?php
            include '../koneksi.php';
            $limit = 10; // Jumlah baris per halaman
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $start = ($page - 1) * $limit;
        
            $query = mysqli_query($conn, "SELECT * FROM pegawai LIMIT $start, $limit");
            while ($data=mysqli_fetch_array($query)){
                ?>
                <tr>
                <td><?php echo $data['nomor_pegawai']   ;?></td>
                <td><?php echo $data['nama_pegawai'] ;?></td>
                <td><?php echo $data['jabatan'] ;?></td>
                <td>
				<a class="edit" href="../Pegawai/ubahpegawai.php?nomor_pegawai=<?php echo $data['nomor_pegawai'];?>" >Edit</a> |
				<a class="hapus" href="../Pegawai/hapuspegawai.php?nomor_pegawai=<?php echo $data['nomor_pegawai']; ?>" onclick="return confirm('yakin hapus?')">Hapus</a>				
			</td>
            </tr>
            </tr>
            <?php } ?>

</table>

        <div class="pagination">
            <?php
            $query_total = mysqli_query($conn, "SELECT COUNT(*) as total FROM pegawai");
            $data_total = mysqli_fetch_assoc($query_total);
            $total_pages = ceil($data_total['total'] / $limit);

            if ($page > 1) {
                echo '<a href="?page=' . ($page - 1) . '">Back</a>';
            }

            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    echo '<a href="?page=' . $i . '" class="current">' . $i . '</a>';
                } else {
                    echo '<a href="?page=' . $i . '">' . $i . '</a>';
                }
            }

            if ($page < $total_pages) {
                echo '<a href="?page=' . ($page + 1) . '">Next</a>';
            }
            ?>
</div>
</form>
</html>
