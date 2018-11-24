<?php
$select_merk = mysqli_query($connection, "SELECT * FROM list_merk_barang");
?>


<a href="http://localhost/CMS_UJIAN2/admin/list_merk.php?source=add" class="btn btn-primary">Tambah Merk</a>
<br><br> 
<table class="table table-bordered table-hover">
	<tr class="info">	
		<th>Kode</th>
		<th>Merk</th>
		<th>Aksi</th>
	</tr>
	<?php while ($row = mysqli_fetch_assoc($select_merk)) :  ?>
	<tr>
		<td><?php echo $row['merk_id'] ?></td>
		<td><?php echo $row['merk_name'] ?></td>
		<td>
			<a href="list_merk.php?source=edit&id=<?php echo $row['merk_id'] ?>" class="btn btn-primary">Edit</a>
			<a href="list_merk.php?source=delete&id=<?php echo $row['merk_id'] ?>" class="btn btn-danger">Delete</a>
		</td>
	</tr>
	<?php endwhile ; ?>
</table>