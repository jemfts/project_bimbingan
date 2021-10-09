<html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php echo form_open('siswa/search') ?>
		<input type="text" name="keyword" placeholder="search">
		<input type="submit" name="search_submit" value="Cari">
	<?php echo form_close() ?>

	<table>

			<?php foreach($siswa as $siswa) { ?>
				<tr>
					<td><?php echo $siswa->nis ?></td>
				</tr>
			<?php } ?>


	</table>
</body>
</html>