<body>
	<!-- Start of LiveChat (www.livechatinc.com) code -->
<!-- <script type="text/javascript">
window.__lc = window.__lc || {};
window.__lc.license = 10382907;
(function() {
  var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
  lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
})();
</script>
<noscript>
<a href="https://www.livechatinc.com/chat-with/10382907/">Chat with us</a>,
powered by <a href="https://www.livechatinc.com/?welcome" rel="noopener" target="_blank">LiveChat</a>
</noscript> -->
<!-- End of LiveChat code -->
</body>
<div class="row" >
  <div class="col s12" >
    <div class="card" >
      <div class="card-content light-blue lighten-1 white-text" >
        <span class="card-title"><?php echo $pageTitle; ?></span>
      </div>
   <div class="card-content">
   <div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
				<?= $this->session->flashdata('done'); ?>
				<div class="panel panel-default">
					<?php foreach($status as $s): ?>
					<div class="panel-heading">
						<strong><?= $this->session->userdata('username'); ?></strong>
						<!-- <?php 
							if ($this->session->userdata('level') == 'administrator') {
								echo "<a href=".base_url('chat/pending')." class=\"btn btn-primary btn-xs\" title=\"User Perlu Persetujuan\"><i class=\"glyphicon glyphicon-user\"></i> User Pending</a>";
								if($s->status == TRUE) {
									echo "<a href=".base_url('chat/maintenance')." class=\"btn btn-warning btn-xs\" title=\"Disable Chat\"><i class=\"glyphicon glyphicon-lock\"></i> Maintenance</a>";
								} else {
									echo "<a href=".base_url('chat/open')." class=\"btn btn-success btn-xs\" title=\"Enable Chat\"><i class=\"glyphicon glyphicon-ok\"></i> Buka Chat</a>";
								}
							}
						?> -->
					</div>
					<?php endforeach ?>
					<?php if ($s->status == TRUE): ?>
					<div class="panel-body" style="height: 300px; overflow-y: scroll;">
					<?php foreach ($chat as $c){ ?>
						<?php if($c->pengirim == $this->session->userdata('username')){ ?>
							<div class="col-md-12">
								<div class="panel panel-success right-align">
									<div class="panel-heading" >
										<strong style="opacity: .5; font-size: 12px; color: #0093FF">Saya : &nbsp;&nbsp;&nbsp;</strong>
										<small><?php echo date("d-M-Y H:i:s", strtotime($c->tgl_bimbingan)); ?></small><br/>
										<?= $c->isi_bimbingan ?>
									</div>
								</div>
							</div>
						<?php } else { ?>
							<div class="col-md-12">
								<div class="panel panel-warning left-align">
									<div class="panel-heading" >
										<strong style="opacity: .5; font-size: 12px; color: #00FF59"><?= $c->pengirim ?>:</strong>
										<small><?php echo date("d-M-Y H:i:s", strtotime($c->tgl_bimbingan)); ?></small><br/>
										<?= $c->isi_bimbingan ?>
									</div>
								</div>
							</div>
						<?php } ?>
					<?php } ?>
					</div>
					<?php endif ?>
					<?php if ($s->status == FALSE): ?>
					<div class="panel-body">
						<h4 class="text-center" style="color: #FF0000">MOHON MAAF<br>SERVER SEDANG MAINTENANCE<br><br>SILAHKAN KEMBALI BEBERAPA SAAT</h4>
					</div>
					<?php endif ?>
				</div>
				<?php if ($s->status == TRUE): ?>
					<div class="row">
						<div class="col-md-12 ">
							<form method="post" action="<?php echo base_url('chat/kirim');?>">
								<div class="col-md-12">
									<div class="input-group">
										<input type="text" name="pesan" class="form-control" placeholder="Masukan Teks">
										<span class="input-group-btn">
											<input class="btn btn-success" type="submit" value="Send">
										</span>
									</div>
								</div>
							</form>
						</div>
					</div>
				<?php endif ?>
				
		</div>

		</div>
	</div>
</div>

		</div>
		<div>
		<?php if ($this->session->userdata('level') == 'siswa') {
								echo "<a href=".base_url('chat/point')." class=\"btn btn-primary btn-xs\" title=\"Bimbingan Selesai\"><i class=\"glyphicon glyphicon-user\"></i> Bimbingan Selesai</a>";
							}
						?>
		</div>
		<div>
		<?php if ($this->session->userdata('level') == 'administrator') {
								echo "<a href=".base_url('chat/reset')." class=\"btn btn-primary btn-xs\" title=\"Reset\"><i class=\"glyphicon glyphicon-user\"></i> Reset</a>";
							}
						?>
		</div>
	</div>
</div>