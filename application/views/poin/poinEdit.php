<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content light-blue lighten-1 white-text">
        <span class="card-title"><?php echo $pageTitle; ?></span>
      </div>
      <div class="card-content">
        <form class="row" id="edit-user-form" method="post" action="">
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
                  <input id="nis" disabled name="nis" type="text" value="<?php echo $poin->nis; ?>">
                  <label for="nis" class="active"></label>
          </div>
          <!-- <div class="input-field col s12 m6">
                  <input id="jml_poin_reward" disabled name="jml_poin_reward" type="text" value="<?php echo $poin->jml_poin_reward; ?>">
                  <label for="jml_poin_reward" class="active"></label>
              </div> -->
              <div class="input-field col s12 m6">
                  <input id="tgl_poin_reward" name="tgl_poin_reward" class="datepicker" type="date" value="<?php echo $poin->tgl_poin_reward; ?>">
                  <label for="tgl_poin_reward" class="active">Tanggal</label>
              </div>
          <div class="input-field col s12 right-align">
              <button type="submit" name="submit" value="<?php echo $poin->nis; ?>" class="btn amber waves-effect waves-green">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>