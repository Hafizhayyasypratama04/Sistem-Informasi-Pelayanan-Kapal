<?php
// include database connection file
include '../koneksi.php';
 
// Get id from URL to delete that user
if (isset($_GET['nomor_invoice'])) {
    $nomor_invoice=$_GET['nomor_invoice'];
}
 
// Delete user row from table based on given id
$result = mysqli_query($conn, "DELETE FROM invoice WHERE nomor_invoice='$nomor_invoice'");
 
// After delete redirect to Home, so that latest user list will be displayed.
header("Location:invoice1.php");
?>