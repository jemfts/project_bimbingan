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
          <th>Nama Lengkap</th>
          <th>Kelas</th>
          <th>Alamat</th>
          <th>Tempat Lahir</th>
          <th>Tanggal Lahir</th>
          <th>Jenis Kelamin</th>
          <th>Agama</th>
          <th>Email</th>
          <th>No. HP</th>
          <th>Nama Wali Murid</th>
          <th>Email Wali Murid</th>
		</tr>
	</thead>
<tbody>

<?php $i=0; foreach($siswa as $user) { ?>

<tr>
  <td><?php echo ++$i; ?></td>
  <td><?php echo $user->nis; ?></td>
  <td><?php echo $user->nama_lengkap; ?></td>
  <td><?php echo $user->kelas; ?></td>
  <td><?php echo $user->alamat; ?></td>
  <td><?php echo $user->tempat_lahir; ?></td>
  <td><?php echo $user->tgl_lahir; ?></td>
  <td><?php echo $user->jenis_kelamin; ?></td>
  <td><?php echo $user->agama; ?></td>
  <td><?php echo $user->email; ?></td>
  <td><?php echo $user->no_hp; ?></td>
  <td><?php echo $user->nama_wali_murid; ?></td>
  <td><?php echo $user->email_wali_murid; ?></td>

 </tr>

<?php $i; } ?>

</tbody>

</table>