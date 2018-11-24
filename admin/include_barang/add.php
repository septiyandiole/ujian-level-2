<?php

$query_merk = "SELECT * FROM list_merk_barang";
$select_merk = mysqli_query($connection, $query_merk);
$query_jenis = "SELECT * FROM list_jenis_barang";
$select_jenis = mysqli_query($connection, $query_jenis);

//var_dump($select_merk);

if (isset($_POST['submit']))
{

    $jenisoption = $_POST['jenisoption'];
    $merkoption = $_POST['merkoption'];

    $barang_name = $_POST['barang_name'];
    $barang_stok = $_POST['barang_stok'];

    $merk = '';
    if ($merkoption == 'merkbaru'){
        $merk = $_POST['merkbaru'];
        $stmt = mysqli_prepare($connection, "INSERT INTO list_merk_barang(merk_name) VALUES(?) ");
        mysqli_stmt_bind_param($stmt, "s", $merk);
        mysqli_stmt_execute($stmt);
        $merk = mysqli_insert_id($connection);

        if (!$stmt)
        {
            die('QUERY FAILED' . mysqli_error($connection));
        }
        mysqli_stmt_close($stmt);
    } 

    if ($merkoption == 'merklama'){
        $merk = $_POST['merklama'];
    }

    $jenis = '';
    if ($jenisoption == 'jenisbaru'){
        $jenis = $_POST['jenisbaru'];
       $stmt = mysqli_prepare($connection, "INSERT INTO list_jenis_barang(jenis_name) VALUES(?) ");
       mysqli_stmt_bind_param($stmt, "s", $jenis);
       mysqli_stmt_execute($stmt);
       $jenis = mysqli_insert_id($connection);
       if (!$stmt)
       {
        die('QUERY FAILED' . mysqli_error($connection));
        }
        mysqli_stmt_close($stmt);
    }


if ($jenisoption == 'jenislama'){
    $jenis = $_POST['jenislama'];
}

if (empty($barang_name) || empty($merk) || empty($jenis) || empty($barang_stok))
{
    echo "This Field should not be empty";
}
else
{
    $stmt = mysqli_prepare($connection, "INSERT INTO list_barang(barang_name, barang_merk, barang_jenis, barang_stok) VALUES(?, ?, ?, ?) ");
    mysqli_stmt_bind_param($stmt, "siii", $barang_name, $merk, $jenis, $barang_stok) or die('asd');
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
		<input type="text" class="form-control" id="barang_name" name="barang_name">
	</div>
    <div class="form-group">
        <label for="barang_merk">Merk</label>
        <div>
            <label><input type="radio" name="merkoption" id="merkoption" onclick="selectMerk()" value="merklama" checked="true">Merk Sudah Tersedia </label>
        </div>
        <div>
         <label><input type="radio" name="merkoption" id="merkoption"  onclick="selectMerk()" value="merkbaru">Merk Baru</label> 
     </div><br>
     <div class="formmerk formmerk-merklama">
        <select class="form-control" name="merklama" id="merklama">
            <option>-Pilih-</option>
            <?php while ($row = mysqli_fetch_assoc($select_merk)) : ?>
                <option value="<?php echo $row['merk_id']; ?>"><?php echo $row['merk_name']; ?></option>
            <?php endwhile; ?>
        </select>

    </div>
    <div class="formmerk formmerk-merkbaru">
       <input type="text" class="form-control" id="merkbaru" name="merkbaru">
   </div>
</div>
</div>
<div class="form-group">
    <label for="barang_jenis">Jenis</label>
    <div>
        <label><input type="radio" name="jenisoption" id="jenisoption" onclick="selectJenis()" value="jenislama" checked="true">Jenis Sudah Tersedia</label>
    </div>
    <div>
     <label><input type="radio" name="jenisoption" id="jenisoption" onclick="selectJenis()" value="jenisbaru">Jenis Baru</label>  
 </div><br>
 <div class="formjenis formjenis-jenislama">
    <select class="form-control" name="jenislama" id="jenislama">
        <option>-Pilih-</option>
        <?php while ($row = mysqli_fetch_assoc($select_jenis)) : ?>
            <option value="<?php echo $row['jenis_id']; ?>"><?php echo $row['jenis_name']; ?></option>
        <?php endwhile; ?>
    </select>
</div>
<div class="formjenis formjenis-jenisbaru">
   <input type="text" class="form-control" id="jenisbaru" name="jenisbaru">
</div>


</div>
<div class="form-group">
    <label for="barang_stok">Stok</label>
    <input type="text" class="form-control" id="barang_stok" name="barang_stok">
</div>	
<div class="form-group">
  <input type="submit" class="btn btn-primary" name="submit" value="Tambah">
</div>
</form>


<script type="text/javascript">
    function selectJenis() {
        // console.log($("#jenisoption:checked").val())
        $(".formjenis").hide();
        $(".formjenis-" + $("#jenisoption:checked").val()).show();
    }
    selectJenis();
    // $("#jenisoption").click(function(){selectJenis()});

    function selectMerk() {
        // console.log($("#merkoption:checked").val())
        $(".formmerk").hide();
        $(".formmerk-" + $("#merkoption:checked").val()).show();
    }
    selectMerk();
    // $("#jenisoption").click(function(){selectMerk()});
</script>