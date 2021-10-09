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
          <th>Pelanggaran</th>
          <th>Tipe Pelanggaran</th>
          <th>Tgl Pelanggaran</th>
          <th>Poin Pelanggaran</th>
          <th>Deskripsi</th>		
		</tr>
	</thead>
<tbody>

<?php $i=0; foreach($pelanggaran as $user) { ?>

<tr>
  <td><?php echo ++$i; ?></td>
  <td><?php echo $user->nis; ?></td>
  <td><?php echo $user->pelanggaran; ?></td>
  <td><?php echo $user->tipe_pelanggaran; ?></td>
  <td><?php echo $user->tgl_pelanggaran; ?></td>
  <td><?php echo $user->poin_pelanggaran; ?></td>
  <td><?php echo $user->deskripsi; ?>

 </tr>

<?php $i; } ?>

</tbody>

</table>