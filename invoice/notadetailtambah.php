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
        input[type="text"], input[type="number"], select {
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
    $nomor_invoice = htmlspecialchars($_GET['nomor_invoice'], ENT_QUOTES, 'UTF-8');
    $query = mysqli_query($conn, "SELECT * FROM invoice WHERE nomor_invoice = '$nomor_invoice'");
    $data = mysqli_fetch_array($query);
}
?>

<h3>JATARIM BINAU LINES</h3>

<form action="" method="post">
<table>
<h4>FORM DETAIL NOTA: <?php echo htmlspecialchars($data['nomor_invoice']); ?></h4>
<tr>
    <td> Nomor Invoice </td>
    <td> <input type="text" name="invoice" value="<?php echo htmlspecialchars($data['nomor_invoice'], ENT_QUOTES, 'UTF-8');?>" readonly> </td>
</tr>
<tr>
    <td>Deskripsi</td>
    <td>
        <select name="nomor_permohonan" style="width:170px;">
            <option value="">--Pilih--</option>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM permohonan");
            while ($row = mysqli_fetch_array($query)) {
                echo "<option value='".htmlspecialchars($row['nomor_permohonan'], ENT_QUOTES, 'UTF-8')."' >".htmlspecialchars($row['nomor_permohonan'], ENT_QUOTES, 'UTF-8')." - ".htmlspecialchars($row['deskripsi'], ENT_QUOTES, 'UTF-8')."</option>";
            }
            ?>    
        </select>
    </td>
</tr>
<tr>
    <td>Jumlah</td>
    <td> <input type="number" name="jumlah" required> </td>
</tr>

<tr>
    <td><a class="kembali" href="notadetail.php?nomor_invoice=<?php echo htmlspecialchars($nomor_invoice, ENT_QUOTES, 'UTF-8'); ?>">Kembali</a></td>
    <td><input type="submit" name="proses" value="Simpan Detail Nota"></td>
</tr>
</table>
</form>

<?php
if (isset($_POST['proses'])){
    $id_invoice = htmlspecialchars($_POST['invoice'], ENT_QUOTES, 'UTF-8');
    $nomor_permohonan = htmlspecialchars($_POST['nomor_permohonan'], ENT_QUOTES, 'UTF-8');
    $qty = htmlspecialchars($_POST['jumlah'], ENT_QUOTES, 'UTF-8');

    if (!empty($id_invoice) && !empty($nomor_permohonan) && !empty($qty)) {
        $query_insert = "INSERT INTO detail (jumlah, nomor_invoice, nomor_permohonan) VALUES('$qty','$id_invoice','$nomor_permohonan')";
        $result_insert = mysqli_query($conn, $query_insert);

        if ($result_insert) {
            // Mengambil total sebelumnya
            $query_total = mysqli_query($conn, "SELECT jml_yang_harus_dibayarkan FROM invoice WHERE nomor_invoice = '$id_invoice'");
            $row_total = mysqli_fetch_array($query_total);
            $total_sebelumnya = $row_total['jml_yang_harus_dibayarkan'];
            
            // Mengupdate nilai total
            $total =  $qty;
            $query_update_total = "UPDATE invoice SET jml_yang_harus_dibayarkan='$total', dibulatkan='$total' WHERE nomor_invoice = '$id_invoice'";
            $result_update_total = mysqli_query($conn, $query_update_total);

            if ($result_update_total) {
                header("Location: notadetail.php?nomor_invoice=".urlencode($nomor_invoice));
                exit;
            }
        }
    }
}
?>

</body>
</html>
