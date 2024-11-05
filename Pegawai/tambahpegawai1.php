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

</style>
<h3> JATARIM BINAU LINES </h3>

<form action="" method="post">
<table>
    <h4>TAMBAH PEGAWAI</h4>
    <tr>
        <td> nomor_pegawai </td>
        <td> <input type="text" name="nomor_pegawai"> </td>
    </tr>
    <tr>
        <td> nama_pegawai </td>
        <td> <input type="text" name="nama_pegawai"> </td>
    </tr>

    <tr>
        <td> jabatan </td>
        <td> <input type="text" name="jabatan"> </td>
    </tr>

    <tr>
        <td><a class="kembali" href="Pegawai1.php">Kembali</a></td>
        <td><input type="submit" name="proses" value="Simpan Pegawai"> </td>
    </tr>

</table>

</form>
</html>
<?php

if (isset($_POST['proses'])){
    include '../koneksi.php';
  
    $nomor_pegawai = $_POST['nomor_pegawai'];
    $nama_pegawai = $_POST['nama_pegawai'];
    $jabatan = $_POST['jabatan'];
    
    mysqli_query($conn, "INSERT INTO pegawai VALUES('$nomor_pegawai','$nama_pegawai','$jabatan')");
    header("Pegawai1.php");
    echo "<script>window.location.href = 'Pegawai1.php?nomor_pegawai=".$nomor_pegawai."';</script>";
}
?>