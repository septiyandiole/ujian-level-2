<?php 

$jenis_id = $_GET['id'];
// GET Category

$select_jenis = mysqli_query($connection, "SELECT * FROM list_jenis_barang WHERE jenis_id=$jenis_id");
while($row = mysqli_fetch_assoc($select_jenis)) {
	$jenis_id = $row['jenis_id'];
	$jenis_name = $row['jenis_name'];
}

if (isset($_POST['submit']))
{
    $jenis_name = $_POST['jenis_name'];
    if ($jenis_name == "" || empty($jenis_name))
    {
        echo "This Field should not be empty";
    }
    else
    {
        $stmt = mysqli_prepare($connection, "UPDATE list_jenis_barang SET jenis_name = ? WHERE jenis_id=?");
        mysqli_stmt_bind_param($stmt, "si", $jenis_name, $jenis_id);
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
		<label>Edit Jenis</label>
		<input type="text" class="form-control" name="jenis_name" value="<?php echo $jenis_name ?>">
	</div>	
	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="submit" value="Update">
	</div>
</form>