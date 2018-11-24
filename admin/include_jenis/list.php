<?php
$select_jenis = mysqli_query($connection, "SELECT * FROM list_jenis_barang order by jenis_id asc");
?>


<a href="http://localhost/CMS_UJIAN2/admin/list_jenis.php?source=add" class="btn btn-primary">Tambah Jenis</a>
<br><br> 
<table class="table table-bordered table-hover">
	<tr class="info">	
		<th>Kode</th>
		<th>Jenis</th>
		<th>Aksi</th>
	</tr>
	<?php while ($row = mysqli_fetch_assoc($select_jenis)) :  ?>
	<tr>
		<td><?php echo $row['jenis_id'] ?></td>
		<td><?php echo $row['jenis_name'] ?></td>
		<td>
			<a href="list_jenis.php?source=edit&id=<?php echo $row['jenis_id'] ?>" class="btn btn-primary">Edit</a>
			<a href="list_jenis.php?source=delete&id=<?php echo $row['jenis_id'] ?>" class="btn btn-danger">Delete</a>
		</td>
	</tr>
	<?php endwhile ; ?>
</table>