<?php
            include '../koneksi.php';
            $query = mysqli_query($conn, "Select*from nota where kodenota = '$_GET[kodenota]'");
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
<h3>KLINIK MELYAN</h3>
<form action="" method="post">
<table>
    <h4>FORM UBAH NOTA</h4>
    <tr>
        <td> Kode Nota </td>
        <td> <input type="text" name="kodenota" value="<?php echo $data['kodenota'];?>" readonly> </td>
    </tr>

    <tr>
        <td> Tanggal Nota </td>
        <td> <input type="date" name="tglnota" value="<?php echo $data['tglnota'];?>"> </td>
    </tr>

    

    <tr><td> 
        Kode Pasien
        <td><select name="kodepasien" style="width:170px;">
        <?php
        include '../koneksi.php';
        $ambilpasien=mysqli_query($conn, "SELECT * FROM pasien");
        while ($pasien = mysqli_fetch_array($ambilpasien)) {
            $selected = ($data['kodepasien'] == $pasien['kodepasien']) ? 'selected' : '';
            echo "<option value='$pasien[kodepasien]' $selected>$pasien[namapasien]</option>";
        }
        ?></td>
        </select>
        </td></tr>

        <tr><td> 
        Kode Dokter
        <td><select name="kodedokter" style="width:170px;">
        <?php
        include '../koneksi.php';
        $ambildokter=mysqli_query($conn, "SELECT * FROM dokter");
        while ($dokter = mysqli_fetch_array($ambildokter)) {
            $selected = ($data['kodedokter'] == $dokter['kodedokter']) ? 'selected' : '';
            echo "<option value='$dokter[kodedokter]' $selected>$dokter[namadokter]</option>";
        }
        ?></td>
        </select>
        </td></tr>

    <tr>
        <td></td>
        <td><input type="submit" name="proses" value="Ubah Nota"><a class="kembali" href="nota.php">Kembali</a> </td>
    </tr>
    </table>
</form>

</html>

<?php

if (isset($_POST['proses'])){
    include '../koneksi.php';

    $kodenota = $_POST['kodenota'];
    $tglnota = $_POST['tglnota'];
    $kodepasien = $_POST['kodepasien'];
    $kodedokter = $_POST['kodedokter'];
    $totalharga = $_POST['totalharga'];
    
    
    mysqli_query($conn, "update nota set tglnota='$tglnota',kodepasien='$kodepasien',
                            kodedokter='$kodedokter' where kodenota='$kodenota'");
    header("location:nota.php");
}