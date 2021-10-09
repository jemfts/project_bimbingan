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
                  <input id="pelanggaran" name="pelanggaran" type="text" value="<?php echo $this->session->userdata('pelanggaran'); ?>">
                  <label for="pelanggaran" class="active">Pelanggaran</label>
              </div>
              <div class="input-field col s12 m6">
                  <input id="tipe_pelanggaran" name="tipe_pelanggaran" type="text" value="<?php echo $this->session->userdata('tipe_pelanggaran'); ?>">
                  <label for="tipe_pelanggaran" class="active">Tipe pelanggaran</label>
              </div>
              <div class="input-field col s12 m6">
                  <input id="tgl_pelanggaran" name="tgl_pelanggaran" type="date" class="datepicker" value="<?php echo $this->session->userdata('tgl_pelanggaran'); ?>">
                  <label for="tgl_pelanggaran" class="active">Tgl Pelanggaran</label>
              </div>
              <div class="input-field col s12 m6">
                  <input id="poin_pelanggaran" name="poin_pelanggaran" type="text" value="<?php echo $this->session->userdata('poin_pelanggaran'); ?>">
                  <label for="poin_pelanggaran" class="active">Poin Pelanggaran</label>
              </div>
              <div class="input-field col s12 m6">
                  <input id="deskripsi" name="deskripsi" type="text" value="<?php echo $this->session->userdata('deskripsi'); ?>">
                  <label for="deskripsi" class="active">Deskripsi</label>
              </div>
              
          <div class="input-field col s12 right-align">
              <button type="submit" name="submit" value="add_user" class="btn amber waves-effect waves-green">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>