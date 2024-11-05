<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .invoice {
            max-width: 150vh;
            margin: auto;
            padding: 20px;
            border: 1px solid #000;
         
        }

        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .header .kepada {
            flex: 1;
            border: 1px solid #000;
            padding: 10px;
        }

        .header .kepada p {
            margin: 0;
        }

        .header .invoice-info {
            flex: 2;
            border: 1px solid #000;
            padding: 10px;
        }

        .header .invoice-info table {
            width: 100%;
        }

        .header .invoice-info table th,
        .header .invoice-info table td {
            padding: 2px 5px;
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .content table, .content th, .content td {
            border: 1px solid #000;
        }

        .content th, .content td {
            padding: 8px;
            text-align: left;
        }

        .total {
            margin-bottom: 20px;
        }

        .total table {
            width: 100%;
            border-collapse: collapse;
        }

        .total table, .total td {
            border: 1px solid #000;
        }

        .total td {
            padding: 8px;
            text-align: left;
        }

        .terbilang {
            margin-bottom: 5px;
        }

        .footer {
            position: relative;
            text-align: left;
        }

        .signature {
            position: relative;
            bottom: 16vh;
            text-align: right;
        }

        .signature .signed {
            font-weight: bold;
        }

        .title-box {
            text-align: center;
            border: 1px solid #000;
            padding: 5px;
            margin-bottom: 20px;
            font-size: 20px;
            font-weight: bold;
        }

        @media print {
            @page {
                size: A4 landscape;
                margin: 0;
            }
            body {
                margin: 0;
                padding: 10mm;
                box-sizing: border-box;
            }
            .invoice {
                border: none;
                width: 100%;
                box-shadow: none;
                page-break-inside: avoid;
            }
        }
        
        .signed img {
            width: 120px; /* Adjust the width as needed */
            height: auto; /* Maintain aspect ratio */
        }
    </style>
</head>
<body>
<div class="invoice">
    <div class="title-box">
        INVOICE
    </div>
    <div class="header">
        <div class="kepada">
            <p>KEPADA YTH:</p>
            <?php
                include '../koneksi.php';
                $nomor_invoice = $_GET['nomor_invoice'];
                $query = mysqli_query($conn, "SELECT * FROM invoice WHERE nomor_invoice = '$nomor_invoice'");
                $data = mysqli_fetch_array($query);
            ?>
        </div>
        <div class="invoice-info">
            <table>
                <tr>
                    <th>Nomor:</th>
                    <td><?php echo htmlspecialchars($data['nomor_invoice']); ?></td>
                </tr>
                <tr>
                    <th>Tanggal:</th>
                    <td><?php echo htmlspecialchars($data['tanggal']); ?></td>
                </tr>
                <tr>
                    <th>Perihal:</th>
                    <td><?php echo htmlspecialchars($data['perihal']); ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="content">
        <table>
            <tr>
                <th>NO</th>
                <th>URAIAN</th>
                <th>JUMLAH</th>
            </tr>
            <?php
                $index = 1;
                $query = mysqli_query($conn, "SELECT dn.nomor_permohonan, pm.deskripsi, dn.jumlah
                                              FROM detail dn
                                              JOIN permohonan pm ON dn.nomor_permohonan = pm.nomor_permohonan
                                              WHERE dn.nomor_invoice = '$nomor_invoice'");
                $totalharga = 0;
                while ($data = mysqli_fetch_array($query)) {
                    $totalharga += $data['jumlah'];
                    echo "<tr>";
                    echo "<td>" . $data['nomor_permohonan'] . "</td>";
                    echo "<td>" . $data['deskripsi'] . "</td>";
                    echo "<td>" . number_format($data['jumlah']) . "</td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </div>
    <div class="total">
        <table>
            <tr>
                <td>JUMLAH YANG HARUS DIBAYARKAN</td>
                <td><?php echo number_format($totalharga); ?></td>
            </tr>
            <tr>
                <td>DIBULATKAN</td>
                <td><?php echo number_format($totalharga); ?></td>
            </tr>
            <tr class="terbilang">
                <td colspan="3"><p align="center">TERBILANG: <?php echo ucwords(Terbilang($totalharga)) . ' Rupiah'; ?></p></td>
            </tr>
        </table>
    </div>
              
    <?php
        include '../koneksi.php';

        if (isset($_GET['nomor_invoice'])) {
            $nomor_invoice = $_GET['nomor_invoice'];
            $query = mysqli_query($conn, "SELECT * FROM invoice i
                                          JOIN pegawai p ON i.nomor_pegawai = p.nomor_pegawai
                                          JOIN tabelpemilikrekening t ON i.nomor_rekening = t.nomor_rekening
                                          WHERE i.nomor_invoice = '$nomor_invoice'");
            $data = mysqli_fetch_array($query);
        }
    ?>
    <div class="footer">
        <p>Dana Tersebut di Transferkan Ke :</p>
        <p>Pemilik Rekening : <?php echo htmlspecialchars($data['pemilik_rekening']); ?></p>
        <p>No. Rekening : <?php echo htmlspecialchars($data['nomor_rekening']); ?></p>
        <p>Nama Bank : <?php echo htmlspecialchars($data['nama_bank']); ?></p>
    </div>
    <div class="signature">
        <p><?php echo htmlspecialchars($data['tanggal']); ?></p>
        <p><?php echo htmlspecialchars($data['pemilik_rekening']); ?></p>
        <p>KANTOR CABANG BANDA ACEH</p>
        <div class="signed">
            <img src="../img/TTD.png" alt="TTD">
            <p><?php echo htmlspecialchars($data['nama_pegawai']); ?></p>
            <p><?php echo htmlspecialchars($data['jabatan']); ?></p>
        </div>
    </div>
</div>

</body>
</html>

<?php
function Terbilang($x)
{
    $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    if ($x < 12)
        return " " . $abil[$x];
    elseif ($x < 20)
        return Terbilang($x - 10) . " Belas";
    elseif ($x < 100)
        return Terbilang($x / 10) . " Puluh" . Terbilang($x % 10);
    elseif ($x < 200)
        return " Seratus" . Terbilang($x - 100);
    elseif ($x < 1000)
        return Terbilang($x / 100) . " Ratus" . Terbilang($x % 100);
    elseif ($x < 2000)
        return " Seribu" . Terbilang($x - 1000);
    elseif ($x < 1000000)
        return Terbilang($x / 1000) . " Ribu" . Terbilang($x % 1000);
    elseif ($x < 1000000000)
        return Terbilang($x / 1000000) . " Juta" . Terbilang($x % 1000000);
}
?>
