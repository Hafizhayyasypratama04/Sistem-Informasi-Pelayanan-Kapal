<?php
// include database connection file
include '../koneksi.php';
 
// Get id from URL to delete that user
if (isset($_GET['nomor_rekening'])) {
    $nomor_rekening=$_GET['nomor_rekening'];
}
 
// Delete user row from table based on given id
$result = mysqli_query($conn, "DELETE FROM tabelpemilikrekening WHERE nomor_rekening='$nomor_rekening'");
 
// After delete redirect to Home, so that latest user list will be displayed.
header("Location: owner1.php");
?>