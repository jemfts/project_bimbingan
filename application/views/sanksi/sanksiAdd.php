<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content light-blue lighten-1 white-text">
        <span class="card-title"><?php echo $pageTitle; ?></span>
      </div>
      <div class="card-content">
        <form class="row" id="add-user-form" method="post" action="">
          <?php if(validation_errors()): ?>
            <div class="col s12">
              <div class="card-panel red">
                <span class="white-text"><?php echo validation_errors('<p>', '</p>'); ?></span>
              </div>
            </div>
          <?php endif; ?>
          <?php if($message = $this->session->flashdata('message')): ?>
            <div class="col s12">
              <div class="card-panel <?php echo ($message['status']) ? 'green' : 'red'; ?>">
                <span class="white-text"><?php echo $message['message']; ?></span>
              </div>
            </div>
          <?php endif; ?>
          <div class="input-field col s12 m6">
                  <input id="nis" name="nis" type="text" value="<?php echo $this->session->userdata('nis'); ?>">
                  <label for="nis" class="active">NIS</label>
              </div>
              <div class="input-field col s12 m6">
                  <input id="jenis_hukuman" name="jenis_hukuman" type="text" value="<?php echo $this->session->userdata('jenis_hukuman'); ?>">
                  <label for="jenis_hukuman" class="active">Jenis Hukuman</label>
              </div>
              <div class="input-field col s12 m6">
                  <input id="tgl_hukuman" name="tgl_hukuman" class="datepicker" type="date" value="<?php echo $this->session->userdata('tgl_hukuman'); ?>">
                  <label for="tgl_hukuman" class="active">Tgl Hukuman</label>
              </div>
              <div class="input-field col s12 m6">
                  <input id="keterangan" name="keterangan" type="text" value="<?php echo $this->session->userdata('keterangan'); ?>">
                  <label for="keterangan" class="active">Keterangan</label>
              </div>
          <div class="input-field col s12 right-align">
              <button type="submit" name="submit" value="add_user" class="btn amber waves-effect waves-green">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>