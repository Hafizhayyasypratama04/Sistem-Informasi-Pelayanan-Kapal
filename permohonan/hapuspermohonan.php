<?php
// include database connection file
include '../koneksi.php';
 
// Get id from URL to delete that user
if (isset($_GET['nomor_permohonan'])) {
    $nomor_permohonan=$_GET['nomor_permohonan'];
}
 
// Delete user row from table based on given id
$result = mysqli_query($conn, "DELETE FROM permohonan WHERE nomor_permohonan='$nomor_permohonan'");
 
// After delete redirect to Home, so that latest user list will be displayed.
header("Location: permohonan1.php");
?>