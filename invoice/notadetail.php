<!DOCTYPE html>
<html>
<head>
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
    </style>
</head>
<body>

<?php
include '../koneksi.php';

if (isset($_GET['nomor_invoice'])) {
    $nomor_invoice = $_GET['nomor_invoice'];
    $query = mysqli_query($conn, "SELECT * FROM invoice i
                                  JOIN pegawai p ON i.nomor_pegawai = p.nomor_pegawai
                                  JOIN tabelpemilikrekening t ON i.nomor_rekening = t.nomor_rekening
                                  WHERE i.nomor_invoice = '$nomor_invoice'");
    $data = mysqli_fetch_array($query);
} else {
    echo "Nomor invoice tidak ditemukan.";
    exit;
}
?>

<h3>Tabel Detail</h3>

<form action="" method="post">
<table>
<h4>DETAIL INVOICE: <?php echo htmlspecialchars($data['nomor_invoice']); ?> </h4>
<a class="kembali" href="Invoice1.php">Kembali</a>

    <tr>
        <td>Nomor Invoice</td>
        <td><?php echo htmlspecialchars($data['nomor_invoice']); ?></td>
    </tr>

    <tr>
        <td>Tanggal</td>
        <td><?php echo htmlspecialchars($data['tanggal']); ?></td>
    </tr>
    
    <tr>
        <td>Perihal</td>
        <td><?php echo htmlspecialchars($data['perihal']); ?></td>
    </tr>

   

    <tr>
        <td>Pemilik Rekening</td>
        <td><?php echo htmlspecialchars($data['pemilik_rekening']); ?></td>
    </tr>

    <tr>
        <td>Nama Pegawai</td>
        <td><?php echo htmlspecialchars($data['nama_pegawai']); ?></td>
    </tr>

</form>
</table>

<h4>TABEL DETAIL INVOICE</h4>
<a class="kembali" href="notadetailtambah.php?nomor_invoice=<?php echo htmlspecialchars($data['nomor_invoice']); ?>">Tambah</a> |
<a class="hapus" href="notacetak.php?nomor_invoice=<?php echo htmlspecialchars($data['nomor_invoice']); ?>">Cetak</a>
<table width='100%' border=1>
    <tr style="background-color: green; color: white;">
        <th><center>Jumlah</center></th>
        <th><center>Nomor Invoice</center></th>
        <th><center>Nomor Permohonan</center></th>
        <th><center>Aksi</center></th>
    </tr>

<?php
$index = 1;
$query = mysqli_query($conn, "SELECT dn.nomor_invoice, dn.nomor_permohonan, dn.jumlah
                              FROM detail dn
                              JOIN invoice i ON i.nomor_invoice = dn.nomor_invoice
                              WHERE i.nomor_invoice = '$nomor_invoice'");

$totalharga = 0; // Inisialisasi grand total

while ($data = mysqli_fetch_array($query)) {    
    $totalharga += $data['jumlah'];
?>
    <tr>
        <td><?php echo htmlspecialchars($data['jumlah']); ?></td>
        <td><?php echo htmlspecialchars($data['nomor_invoice']); ?></td>
        <td><?php echo htmlspecialchars($data['nomor_permohonan']); ?></td>
        <td>
            <a class="hapus" href="notadetailhapus.php?nomor_invoice=<?php echo htmlspecialchars($data['nomor_invoice']); ?>&nomor_permohonan=<?php echo htmlspecialchars($data['nomor_permohonan']); ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
            | <a class="edit" href="notadetailedit.php?nomor_invoice=<?php echo htmlspecialchars($data['nomor_invoice']); ?>&nomor_permohonan=<?php echo htmlspecialchars($data['nomor_permohonan']); ?>">Edit</a>
        </td>
    </tr>
<?php } ?>
</table>
</body>
</html>
