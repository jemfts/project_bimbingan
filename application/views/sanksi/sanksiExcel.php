<?php 

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<table border="1" width="100%">
	<thead>
		<tr>
		 	<th>No</th>
			<th>NIS</th>
			<th>Jenis Hukuman</th>
			<th>Tanggal Hukuman</th>
			<th>Keterangan</th>
		</tr>
	</thead>
<tbody>

<?php $i=0; foreach($sanksi as $user) { ?>

<tr>
  <td><?php echo ++$i; ?></td>
  <td><?php echo $user->nis; ?></td>
  <td><?php echo $user->jenis_hukuman; ?></td>
  <td><?php echo $user->tgl_hukuman; ?></td>
  <td><?php echo $user->keterangan; ?></td>

 </tr>

<?php $i; } ?>

</tbody>

</table>