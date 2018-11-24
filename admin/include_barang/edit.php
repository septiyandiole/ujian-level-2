<?php

$barang_id = $_GET['id'];

$query_merk = "SELECT * FROM list_merk_barang";
$select_merk = mysqli_query($connection, $query_merk);
$query_jenis = "SELECT * FROM list_jenis_barang";
$select_jenis = mysqli_query($connection, $query_jenis);

// GET Category

$select_barang = mysqli_query($connection, "SELECT * FROM list_barang WHERE barang_id=$barang_id");
while($row = mysqli_fetch_assoc($select_barang)) {
    $barang_id = $row['barang_id'];
    $barang_name = $row['barang_name'];
    $barang_merk = $row['barang_merk'];
    $barang_jenis = $row['barang_jenis'];
    
}

if (isset($_POST['submit']))
{

    $barang_jenis = $_POST['jenislama'];
    $barang_merk = $_POST['merklama'];

    $barang_name = $_POST['barang_name'];
    


    if (empty($barang_name) || empty($barang_merk) || empty($barang_jenis))
    {
        echo "This Field should not be empty";
    }
    else
    {
        $stmt = mysqli_prepare($connection, "UPDATE list_barang SET barang_name=?, barang_merk=?, barang_jenis=? WHERE barang_id=?");
        mysqli_stmt_bind_param($stmt, "siii", $barang_name, $barang_merk, $barang_jenis, $barang_id) or die('asd');
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

<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="barang_name">Nama Barang</label>
		<input type="text" class="form-control" id="barang_name" name="barang_name" value="<?php echo $barang_name ?>">
	</div>

    <div class="form-group">
        <label for="merklama">Merk Barang</label>
        <select class="form-control" name="merklama" id="merklama">
            <option>-Pilih-</option>
            <?php while ($row = mysqli_fetch_assoc($select_merk)) : ?>
                <option value="<?php echo $row['merk_id']; ?>"<?php if($row['merk_id'] == $barang_merk):?> selected="" <?php endif;?>><?php echo $row['merk_name']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="jenislama">Jenis Barang</label>
        <select class="form-control" name="jenislama" id="jenislama">
            <option>-Pilih-</option>
            <?php while ($row = mysqli_fetch_assoc($select_jenis)) : ?>
                <option value="<?php echo $row['jenis_id']; ?>"<?php if($row['jenis_id'] == $barang_jenis):?> selected="" <?php endif;?>><?php echo $row['jenis_name']; ?></option>
            <?php endwhile; ?>
        </select>
    </div><br>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="submit" value="Update">
    </div>

</form>
