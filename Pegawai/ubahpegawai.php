<?php
include '../koneksi.php';

if(isset($_GET['nomor_pegawai'])) {
    $nomor_pegawai = $_GET['nomor_pegawai'];
    $query = mysqli_query($conn, "SELECT * FROM pegawai WHERE nomor_pegawai='$nomor_pegawai'");
    if ($query && mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_array($query);
    } else {
        echo "<script>alert('Data tidak ditemukan'); window.location.href='pegawai.php';</script>";
        exit;
    }
}
?>

<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 20px;
        }

        h3 {
            color: #333;
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        table {
            width: 100%;
        }

        h4 {
            text-align: center;
            color: #666;
            font-size: 18px;
            margin-bottom: 10px;
        }

        tr {
            line-height: 2;
        }

        td:first-child {
            text-align: right;
            padding-right: 10px;
            color: #666;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 14px;
        }

        input[type="submit"] {
            padding: 8px 15px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 14px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .kembali {
            padding: 10px 10px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
            font-size: 14px;
        }

        .kembali:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

<h3>Ubah Data Pegawai</h3>
<form action="" method="post">
    <table>
        <h4>FORM UBAH PEGAWAI</h4>
        <tr>
            <td>Nomor Pegawai</td>
            <td><input type="text" name="nomor_pegawai" value="<?php echo $data['nomor_pegawai'];?>" readonly></td>
        </tr>
        <tr>
            <td>Nama Pegawai</td>
            <td><input type="text" name="nama_pegawai" value="<?php echo $data['nama_pegawai'];?>"></td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td><input type="text" name="jabatan" value="<?php echo $data['jabatan'];?>"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="proses" value="Ubah Pegawai"> | <a class="kembali" href="pegawai.php">Kembali</a></td>
        </tr>
    </table>
</form>

<?php
if (isset($_POST['proses'])) {
    $nomor_pegawai = $_POST['nomor_pegawai'];
    $nama_pegawai = $_POST['nama_pegawai'];
    $jabatan = $_POST['jabatan'];

    mysqli_query($conn, "UPDATE pegawai SET nama_pegawai='$nama_pegawai', jabatan='$jabatan' WHERE nomor_pegawai='$nomor_pegawai'");
    echo "<script>alert('Data berhasil diubah'); window.location.href='pegawai.php';</script>";
}
?>

</body>
</html>
