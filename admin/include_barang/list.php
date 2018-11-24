<?php

$select_barang = mysqli_query($connection, "SELECT * FROM list_barang");

?>


<a href="http://localhost/CMS_UJIAN2/admin/list_barang.php?source=add" class="btn btn-primary">Tambah Barang</a>
<br><br> 
<table class="table table-bordered table-hover">
	<tr class="info">	
		<th>Kode</th>
		<th>Nama Barang</th>
		<th>Merk</th>
		<th>Jenis</th>
		<th>Stok</th>
		<th>Action</th>
	</tr>
	<?php while ($row = mysqli_fetch_assoc($select_barang)) :
		$merk_id=$row['barang_merk'];
		$select_merk = mysqli_query($connection, "SELECT * FROM list_merk_barang WHERE merk_id=$merk_id");
		while($row_merk = mysqli_fetch_assoc($select_merk)) {
			$merk_name = $row_merk['merk_name'];
		}
		$jenis_id=$row['barang_jenis'];
		$select_jenis = mysqli_query($connection, "SELECT * FROM list_jenis_barang WHERE jenis_id=$jenis_id");
		while($row_jenis = mysqli_fetch_assoc($select_jenis)) {
			$jenis_name = $row_jenis['jenis_name'];
		}
	?>
	<tr>
		<td><?php echo $row['barang_id'] ?></td>
		<td><?php echo $row['barang_name'] ?></td>
		<td><?php echo $merk_name; ?></td>
		<td><?php echo $jenis_name; ?></td>
		<td><?php echo $row['barang_stok'] ?></td>
		<td>
			<a href="list_barang.php?source=ubahstok&id=<?php echo $row['barang_id'] ?>" class="btn btn-success">Ubah Stok</a>
			<a href="list_barang.php?source=edit&id=<?php echo $row['barang_id'] ?>" class="btn btn-primary">Edit</a>
			<a href="list_barang.php?source=delete&id=<?php echo $row['barang_id'] ?>" class="btn btn-danger">Delete</a>
		</td>
	</tr>
<?php endwhile ; ?>
</table>

<script type="text/javascript">
	
</script>