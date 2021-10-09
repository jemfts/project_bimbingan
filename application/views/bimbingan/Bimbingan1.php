
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <link href="<?php echo base_url('assets/css/chat.css'); ?>" type="text/css" rel="stylesheet" media="screen,projection"/>

<div class="row" >
  <div class="col s12" >
    <div class="card" >
      <div class="card-content blue darken-1 white-text" >
        <span class="card-title"><?php echo $pageTitle; ?></span>
      </div>
	      <div class="card-content" >
	      	 <form class="row" id="add-user-form" method="post" action="">
				<div class="panel-body" >
					<div class="col-md-9">
							<div class="input-group">
								<span class="input-group-addon">
									Menerangkan Kejadian:
								</span>
								<input id="nickname" type="text" class="form-control input-sm" placeholder="" />
							</div>
						</div>
					<ul class="chat" id="received">		
					</ul>
				</div>
				<div class="panel-footer">
					<div class="clearfix">
						
						<div class="col-md-9" id="msg_block">
							<div class="input-group">
								<span class="input-group-addon">
									Kronologi Kejadian:
								</span>
								<input id="bimbingan" type="text" class="form-control input-sm" placeholder="Type your message here..." />
								<span class="input-group-btn">
									<button class="btn blue waves-effect waves-green" id="submit">Send</button>
								</span>
							</div>
						</div>
					</div>
				</div>
			 </form>
			</div>
	    </div>
	</div>
</div>
<button class="btn success waves-effect waves-green" style="min-width: 100%; height: 50px" id="submit">Bimbingan Konseling Selesai</button>
</form>
</body>
</html>