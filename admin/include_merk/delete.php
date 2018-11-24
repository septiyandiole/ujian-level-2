<?php 

$merk_id = $_GET['id'];

$select_barang = mysqli_query($connection, "SELECT * FROM list_barang WHERE barang_merk=$merk_id");

	while ($row = mysqli_fetch_assoc($select_barang)) {
		$barang_merk_id=$row['barang_merk'];
		
	}	
	if($barang_merk_id)
	{
		echo "<script>alert('Merk Masih Digunakan !');history.go(-1);</script>";
	}
	else
	{
		$stmt = mysqli_prepare($connection, "DELETE FROM list_merk_barang WHERE merk_id = ?");
		mysqli_stmt_bind_param($stmt, "i", $merk_id);
		mysqli_stmt_execute($stmt);
		if (!$stmt)
		{
		    die('QUERY FAILED' . mysqli_error($connection));
		}

		mysqli_stmt_close($stmt);

		header("Location: list_merk.php");
	}	
?>