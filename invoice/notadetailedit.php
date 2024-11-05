<?php
    include '../koneksi.php';
    if (isset($_GET['nomor_invoice'])) {
        $nomor_invoice = $_GET['nomor_invoice'];
        $query = mysqli_query($conn, "SELECT * FROM invoice WHERE nomor_invoice = '$nomor_invoice'");
        $data = mysqli_fetch_array($query);
    }

    // Fetch the detail data for the invoice
    if (isset($_GET['nomor_invoice']) && isset($_GET['nomor_permohonan'])) {
        $nomor_permohonan = $_GET['nomor_permohonan'];
        $detail_query = mysqli_query($conn, "SELECT * FROM detail WHERE nomor_invoice = '$nomor_invoice' AND nomor_permohonan = '$nomor_permohonan'");
        $detail_data = mysqli_fetch_array($detail_query);
    }
?>

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
    <h3>EDIT TABEL DETAIL</h3>

    <form action="" method="post">
        <table>
            <h4>FORM DETAIL NOTA: <?php echo $data['nomor_invoice']; ?></h4>

            <tr>
                <td>Nomor Invoice</td>
                <td><input type="text" name="nomor_invoice" value="<?php echo $data['nomor_invoice']; ?>" readonly></td>
            </tr>

            <tr>
                <td>Nomor Permohonan</td>
                <td>
                    <select name="nomor_permohonan" style="width:170px;" readonly onmousedown="return false;" onkeydown="return false;">
                        <?php
                        $ambilcustomer = mysqli_query($conn, "SELECT * FROM permohonan");
                        while ($customer = mysqli_fetch_array($ambilcustomer)) {
                            $selected = ($detail_data['nomor_permohonan'] == $customer['nomor_permohonan']) ? 'selected' : '';
                            echo "<option value='$customer[nomor_permohonan]' $selected>$customer[nomor_permohonan]</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Jumlah</td>
                <td><input type="number" name="jumlah" value="<?php echo $detail_data['jumlah']; ?>"></td>
            </tr>

            <tr>
                <td><a class="kembali" href="notadetail.php?nomor_invoice=<?php echo htmlspecialchars($nomor_invoice, ENT_QUOTES, 'UTF-8'); ?>">Kembali</a></td>
                <td><input type="submit" name="proses" value="Simpan Detail Nota"></td>
            </tr>
        </table>
    </form>

    <?php
    if (isset($_POST['proses'])) {
        $id_invoice = $_POST['nomor_invoice'];
        $nomor_permohonan = $_POST['nomor_permohonan'];
        $qty = $_POST['jumlah'];

        if (!empty($id_invoice) && !empty($nomor_permohonan) && !empty($qty)) {
            // Ensure data to be updated exists
            $query_check = mysqli_query($conn, "SELECT * FROM detail WHERE nomor_invoice='$id_invoice' AND nomor_permohonan='$nomor_permohonan'");
            if (mysqli_num_rows($query_check) > 0) {
                $query_update = "UPDATE detail SET jumlah='$qty' WHERE nomor_invoice='$id_invoice' AND nomor_permohonan='$nomor_permohonan'";
                $result_update = mysqli_query($conn, $query_update);

                if ($result_update) {
                    // Fetch the total after update
                    $query_total = mysqli_query($conn, "SELECT SUM(jumlah) AS total_jumlah FROM detail WHERE nomor_invoice = '$id_invoice'");
                    $row_total = mysqli_fetch_array($query_total);
                    $total = $row_total['total_jumlah'];

                    // Update the total in the invoice table
                    $query_update_total = "UPDATE invoice SET jml_yang_harus_dibayarkan='$total', dibulatkan='$total' WHERE nomor_invoice = '$id_invoice'";
                    $result_update_total = mysqli_query($conn, $query_update_total);

                    if ($result_update_total) {
                        header("Location: notadetail.php?nomor_invoice=$id_invoice");
                        exit;
                    }
                }
            } else {
                echo "Data detail tidak ditemukan untuk diupdate.";
            }
        }
    }
    ?>
</body>
</html>
