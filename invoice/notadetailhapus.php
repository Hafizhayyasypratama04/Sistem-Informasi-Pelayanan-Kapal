<?php
// include database connection file
include '../koneksi.php';

// Get nomor_invoice and nomor_permohonan from URL
if (isset($_GET['nomor_invoice']) && isset($_GET['nomor_permohonan'])) {
    $nomor_invoice = $_GET['nomor_invoice'];
    $nomor_permohonan = $_GET['nomor_permohonan'];

    // Start transaction
    mysqli_begin_transaction($conn);

    try {
        // Delete specific detail record based on nomor_invoice and nomor_permohonan
        $deleteDetailQuery = "DELETE FROM detail WHERE nomor_invoice = '$nomor_invoice' AND nomor_permohonan = '$nomor_permohonan'";
        mysqli_query($conn, $deleteDetailQuery);

        // Calculate new total price after deletion
        $query = "SELECT SUM(jumlah) AS total FROM detail WHERE nomor_invoice = '$nomor_invoice'";
        $totalResult = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($totalResult);
        $totalHargaBaru = $row['total'] ? $row['total'] : 0; // Set to 0 if no rows returned

        // Update total price in invoice table
        $updateInvoiceQuery = "UPDATE invoice SET jml_yang_harus_dibayarkan = '$totalHargaBaru', dibulatkan = '$totalHargaBaru' WHERE nomor_invoice = '$nomor_invoice'";
        mysqli_query($conn, $updateInvoiceQuery);

        // Commit transaction
        mysqli_commit($conn);

        // Redirect to notadetail.php
        header("Location: notadetail.php?nomor_invoice=$nomor_invoice");
        exit;
    } catch (Exception $e) {
        // Rollback transaction if any query fails
        mysqli_rollback($conn);
        // Redirect to an error page or display an error message
        echo "An error occurred: " . $e->getMessage();
        exit;
    }
} else {
    // Redirect to a different page if nomor_invoice or nomor_permohonan is not set
    header("Location: notadetail.php");
    exit;
}
?>
