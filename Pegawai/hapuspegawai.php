<?php
// include database connection file
include '../koneksi.php';
 
// Get id from URL to delete that user
if (isset($_GET['nomor_pegawai'])) {
    $nomor_pegawai = $_GET['nomor_pegawai'];
    
    // Delete user row from table based on given id
    $result = mysqli_query($conn, "DELETE FROM pegawai WHERE nomor_pegawai = '$nomor_pegawai'");
    
    // After delete redirect to Home, so that latest user list will be displayed.
    header("Location: Pegawai1.php");
}
?>