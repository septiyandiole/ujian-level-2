<?php 

$barang_id = $_GET['id'];
// GET Category

$select_barang = mysqli_query($connection, "SELECT * FROM list_barang WHERE barang_id=$barang_id");
while($row = mysqli_fetch_assoc($select_barang)) {
	$barang_id = $row['barang_id'];
	$barang_name = $row['barang_name'];
    $barang_stok = $row['barang_stok'];
}

if (isset($_POST['submit']))
{
    $barang_stok = $_POST['barang_stok'];
    if ($barang_stok == "")
    {
        echo "This Field should not be empty";
    }
    else
    {
        $stmt = mysqli_prepare($connection, "UPDATE list_barang SET barang_stok=? WHERE barang_id=?");
        mysqli_stmt_bind_param($stmt, "ii", $barang_stok, $barang_id);
        mysqli_stmt_execute($stmt);
        if (!$stmt)
        {
            die('QUERY FAILED' . mysqli_error($connection));
        }
   		mysqli_stmt_close($stmt);

       header("Location: list_barang.php");
    }
}
?>
<form action="" method="post">
    <div class="form-group">
        <label>Kode Barang</label>
        <input type="text" class="form-control" name="barang_id" readonly value="<?php echo $barang_id ?>">
    </div>
    <div class="form-group">
        <label>Nama Barang</label>
        <input type="text" class="form-control" name="barang_name" readonly value="<?php echo $barang_name ?>">
    </div>
    <div class="form-group">
        <label>Stok</label>
        <input type="text" class="form-control" name="barang_stok" value="<?php echo $barang_stok ?>">
    </div>	
	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="submit" value="Update Stok">
	</div>
</form>