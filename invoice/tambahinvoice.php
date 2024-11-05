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
    <h4>TAMBAH INVOICE</h4>
    <tr> 
        <td> nomor_invoice </td>
        <td> <input type="text" name="nomor_invoice"> </td>
    </tr>

    <tr>
        <td> Tanggal </td>
        <td> <input type="date" name="Tanggal"> </td>
    </tr>

    <tr>
        <td> perihal </td>
        <td> <input type="text" name="perihal"> </td>
    </tr>

    <tr>
        <td> jml_yang_harus_dibayarkan </td>
        <td> <input type="text" name="jml_yang_harus_dibayarkan"> </td>
    </tr>

    <tr>
        <td> dibulatkan </td>
        <td> <input type="text" name="dibulatkan"> </td>
    </tr>

    <tr>
        <td> terbilang </td>
        <td> <input type="text" name="terbilang"> </td>
    </tr>


        <tr><td> 
        nomor_rekening
        <td><select name="nomor_rekening" style="width:170px;">
        <option value="">--Pilih--</option>
        <?php
        include '../koneksi.php';
        $query=mysqli_query($conn, "SELECT * FROM tabelpemilikrekening");
        while ($data = mysqli_fetch_array($query)) {
        ?>
          
            <option value="<?php echo $data['nomor_rekening'];?>" >
            <?php echo $data['nomor_rekening'];?></option>
        <?php
        }
        ?></td>
        </select>
        </td></tr>

        <tr>
        <td> 
        nomor_pegawai
        <td><select name="nomor_pegawai" style="width:170px;">
        <option value="">--Pilih--</option>
        <?php
        include '../koneksi.php';
        $query=mysqli_query($conn, "SELECT * FROM pegawai");
       
        while ($data = mysqli_fetch_array($query)) {
        ?>
            
            <option value="<?php echo $data['nomor_pegawai'];?>" >
            <?php echo $data['nomor_pegawai'];?></option>
        <?php
        }
        ?></td>
        </select>
        </td></tr>

    <tr>
        <td><a class="kembali" href="invoice.php">Kembali</a></td>
        <td><input type="submit" name="proses" value="Simpan invoice"> </td>
    </tr>
</form>
</table>
</html>
<?php

if (isset($_POST['proses'])){
    include '../koneksi.php';
  
    $nomor_invoice= $_POST['nomor_invoice'];
    $tanggal = $_POST['Tanggal'];
    $perihal = $_POST['perihal'];
    $jml_yang_harus_dibayarkan = $_POST['jml_yang_harus_dibayarkan'];
    $dibulatkan = $_POST['dibulatkan'];
    $terbilang = $_POST['terbilang'];
    $nomor_rekening = $_POST['nomor_rekening'];
    $nomor_pegawai = $_POST['nomor_pegawai'];

    
    
    mysqli_query($conn, "INSERT INTO invoice VALUES('$nomor_invoice','$tanggal','$perihal','$jml_yang_harus_dibayarkan',
    '$dibulatkan','$terbilang','$nomor_rekening','$nomor_pegawai')");
    
        // Gunakan nilai $kodenota untuk keperluan selanjutnya
        echo "<script>window.location.href = 'invoice.php?nomor_invoice=".$nomor_invoice."';</script>";

    
}
?>