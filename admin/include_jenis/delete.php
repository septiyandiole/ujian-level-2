<?php 

$jenis_id = $_GET['id'];

$select_barang = mysqli_query($connection, "SELECT * FROM list_barang WHERE barang_jenis=$jenis_id");
	
	if(mysql_num_rows($connection,$select_barang)<=0)
	{
		echo "<script>alert('Jenis Masih Digunakan !');history.go(-1);</script>";
	}
	else
	{
		$stmt = mysqli_prepare($connection, "DELETE FROM list_jenis_barang WHERE jenis_id = ?");
		mysqli_stmt_bind_param($stmt, "i", $jenis_id);
		mysqli_stmt_execute($stmt);
		if (!$stmt)
		{
		    die('QUERY FAILED' . mysqli_error($connection));
		}

		mysqli_stmt_close($stmt);

		header("Location: list_jenis.php");
	}	
?>