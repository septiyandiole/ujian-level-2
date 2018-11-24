<?php
if (isset($_POST['submit']))
{
    $jenis_name = $_POST['jenis_name'];
    if ($jenis_name == "" || empty($jenis_name))
    {
        echo "This Field should not be empty";
    }
    else
    {
        $stmt = mysqli_prepare($connection, "INSERT INTO list_jenis_barang(jenis_name) VALUES(?) ");
        mysqli_stmt_bind_param($stmt, "s", $jenis_name);
        mysqli_stmt_execute($stmt);
        if (!$stmt)
        {
            die('QUERY FAILED' . mysqli_error($connection));
        }
   		mysqli_stmt_close($stmt);

        header("Location: list_jenis.php");
    }
}
?>

<form action="" method="post">
	<div class="form-group">
		<label for="jenis_name">Add Jenis</label>
		<input type="text" class="form-control" id="jenis_name" name="jenis_name">
	</div>	
	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="submit" value="Add Jenis">
	</div>
</form>