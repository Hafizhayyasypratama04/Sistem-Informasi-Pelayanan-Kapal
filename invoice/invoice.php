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

<h4>TABEL INVOICE</h4>
<a class="kembali" href="tambahinvoice.php">Tambah Invoice </a>|<a class="kembali" href="../index.php">Kembali</a>
<table border="1" align="center" width="100%">
    <tr bgcolor="green">
        <th>nomor_invoice</th>
        <th>tanggal</th>
        <th>perihal</th>
        <th>jml_yang_harus_dibayarkan</th>
        <th>dibulatkan</th>
        <th>terbilang</th>
        <th>nomor_rekening</th>
        <th>nomor_pegawai</th>
        <th>Aksi</th>
        <th>Keterangan</th>
    </tr>
    <tr>
    <?php
            include '../koneksi.php';

            // Pagination
            $limit = 10; // Jumlah baris per halaman
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $start = ($page - 1) * $limit;

            $query = mysqli_query($conn, "SELECT 
            invoice.nomor_invoice, 
            invoice.tanggal, 
            invoice.perihal, 
            invoice.jml_yang_harus_dibayarkan, 
            invoice.dibulatkan, 
            invoice.terbilang,
            tabelpemilikrekening.nomor_rekening, 
            pegawai.nomor_pegawai
        FROM invoice 
        INNER JOIN tabelpemilikrekening ON invoice.nomor_rekening = tabelpemilikrekening.nomor_rekening 
        INNER JOIN pegawai ON invoice.nomor_pegawai = pegawai.nomor_pegawai LIMIT $start, $limit");
            while ($data = mysqli_fetch_array($query)) {
                ?>
                <tr>
                <td><?php echo $data['nomor_invoice']   ;?></td>
                <td><?php echo $data['tanggal']    ;?></td>
                <td><?php echo $data['perihal'] ;?></td>
                <td><?php echo $data['jml_yang_harus_dibayarkan'] ;?></td>
                <td><?php echo $data['dibulatkan'] ;?></td>
                <td><?php echo $data['terbilang'] ;?></td>
                <td><?php echo $data['nomor_rekening'] ;?></td>
                <td><?php echo $data['nomor_pegawai'] ;?></td>
                
                <td>
				<a class="edit" href="ubahinvoice.php?nomor_invoice=<?php echo $data['nomor_invoice'];?>" >Edit</a> |
				<a class="hapus" href="hapusinvoice.php?nomor_invoice=<?php echo $data['nomor_invoice']; ?>" onclick="return confirm('yakin hapus?')">Hapus</a></td>
                <td>	
                <a class="edit" href="editinvoice.php?nomor_invoice=<?php echo $data['nomor_invoice']; ?>">Detail</a>	|
                <a class="hapus" href="editinvoice.php?nomor_invoice=<?php echo $data['nomor_invoice']; ?>">Cetak</a>	</td>	
			
            </tr>
            
            <?php }
             ?>
             </table>
             <div class="pagination">
    <?php
        // Pagination - Tampilkan tombol "Back" jika halaman bukan halaman pertama
        if ($page > 1) {
            echo '<a href="?page=' . ($page - 1) . '">Back</a>';
        }

        // Menghitung jumlah total halaman
        $total_pages = ceil(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM invoice")) / $limit);

        // Menampilkan angka halaman
        for ($i = 1; $i <= $total_pages; $i++) {
            // Tambahkan class 'current' pada tombol halaman saat ini
            if ($i == $page) {
                echo '<a href="?page=' . $i . '" class="current">' . $i . '</a>';
            } else {
                echo '<a href="?page=' . $i . '">' . $i . '</a>';
            }
        }

        // Tampilkan tombol "Next" jika halaman bukan halaman terakhir
        if ($page < $total_pages) {
            echo '<a href="?page=' . ($page + 1) . '">Next</a>';
        }
    ?>
    </div> 
   
</table>

</form>
</html>