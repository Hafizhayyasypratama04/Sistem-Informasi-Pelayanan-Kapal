<?php
            include '../koneksi.php';
            $query = mysqli_query($conn, "Select*from invoice where nomor_invoice = '$_GET[nomor_invoice]'");
            $data = mysqli_fetch_array($query);
            
                ?>
  
  <html>
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
<h3>JATARIM BINAU LINES</h3>
<form action="" method="post">
<table>
    <h4>FORM UBAH INVOICE</h4>
    <tr>
        <td> nomor_invoice </td>
        <td> <input type="text" name="nomor_invoice" value="<?php echo $data['nomor_invoice'];?>" readonly> </td>
    </tr>

    <tr>
        <td> tanggal  </td>
        <td> <input type="date" name="tanggal" value="<?php echo $data['tanggal'];?>"> </td>
    </tr>

    <tr>
        <td> perihal </td>
        <td> <input type="text" name="perihal" value="<?php echo $data['perihal'];?>"> </td>
    </tr>

    <tr>
        <td> jml_yang_harus_dibayarkan </td>
        <td> <input type="text" name="jml_yang_harus_dibayarkan" value="<?php echo $data['jml_yang_harus_dibayarkan'];?>"> </td>
    </tr>

    <tr>
        <td> dibulatkan </td>
        <td> <input type="text" name="dibulatkan" value="<?php echo $data['dibulatkan'];?>"> </td>
    </tr>

    <tr>
        <td> terbilang </td>
        <td> <input type="text" name="terbilang" value="<?php echo $data['terbilang'];?>"> </td>
    </tr>
    
    <tr><td> 
        nomor_rekening
        <td><select name="nomor_rekening" style="width:170px;">
        <?php
        include '../koneksi.php';
        $ambilpasien=mysqli_query($conn, "SELECT * FROM tabelpemilikrekening");
        while ($pasien = mysqli_fetch_array($ambilpasien)) {
            $selected = ($data['nomor_rekening'] == $pasien['nomor_rekening']) ? 'selected' : '';
            echo "<option value='$pasien[nomor_rekening]' $selected>$pasien[nomor_rekening]</option>";
        }
        ?></td>
        </select>
        </td></tr>

        <tr><td> 
        nomor_pegawai
        <td><select name="nomor_pegawai" style="width:170px;">
        <?php
        include '../koneksi.php';
        $ambildokter=mysqli_query($conn, "SELECT * FROM pegawai");
        while ($dokter = mysqli_fetch_array($ambildokter)) {
            $selected = ($data['nomor_pegawai'] == $dokter['nomor_pegawai']) ? 'selected' : '';
            echo "<option value='$dokter[nomor_pegawai]' $selected>$dokter[nomor_pegawai]</option>";
        }
        ?></td>
        </select>
        </td></tr>

    <tr>
        <td></td>
        <td><input type="submit" name="proses" value="UBAH INVOICE"><a class="kembali" href="Invoice1.php">Kembali</a> </td>
    </tr>
    </table>
</form>

</html>

<?php

if (isset($_POST['proses'])){
    include '../koneksi.php';

    $tanggal = $_POST['tanggal'];
    $perihal = $_POST['perihal'];
    $jml_yang_harus_dibayarkan = $_POST['jml_yang_harus_dibayarkan'];
    $dibulatkan = $_POST['dibulatkan'];
    $terbilang = $_POST['terbilang'];
    $nomor_rekening = $_POST['nomor_rekening'];
    $nomor_pegawai = $_POST['nomor_pegawai'];
    
    
    mysqli_query($conn, "update invoice set tanggal='$tanggal',perihal='$perihal',jml_yang_harus_dibayarkan='$jml_yang_harus_dibayarkan',
                            dibulatkan = '$dibulatkan',terbilang = '$terbilang'
                                 where nomor_rekening='$nomor_rekening' and nomor_pegawai='$nomor_pegawai'");
    header("location:invoice.php");
}