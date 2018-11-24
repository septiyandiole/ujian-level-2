<?php

$barang_id = $_GET['id'];

$stmt = mysqli_prepare($connection, "DELETE FROM list_barang WHERE barang_id = ?");
mysqli_stmt_bind_param($stmt, "i", $barang_id);
mysqli_stmt_execute($stmt);
if (!$stmt)
{
    die('QUERY FAILED' . mysqli_error($connection));
}

mysqli_stmt_close($stmt);

header("Location: list_barang.php");

?>