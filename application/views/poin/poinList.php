<script type="text/javascript">
  function notifyMe(msg_title, msg_body, redirect_onclick){
    var garanted = 0;
    if (!("Notification" in window)) {
      alert("This browser does not support dekstop notification")
    }
    else if (Notification.permission === "granted") {
      granted = 1;
    }
    else if (Notification.permission !== "denied") {
      Notification.requestPermission(function (permission) {
        if(permission === "granted") {
          granted = 1;
        }
      });
    }
    if (granted == 1) {
      var notification = new Notification(msg_title, {
        body: msg_body,
      });
      if (redirect_onclick) {
          notification.onclick = function() {
            window.location.href = redirect_onclick;
          }
      }
    }
  }
</script>
<div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content light-blue lighten-1 white-text">
          <span class="card-title">Data Poin</span>
          <?php if($this->session->userdata('level') === 'bk'): ?>
          <a <?php echo ($this->session->userdata('level') == 'siswa') ? 'disabled' : ''; ?> href="<?php echo base_url('poin/add'); ?>" class="btn-floating right halfway-fab waves-effect waves-light amber tooltipped" data-position="top" data-tooltip="Tambah Data"><i class="material-icons">add</i></a>
          <a href="<?php echo base_url('poin/cetak'); ?>" class="btn-floating right halfway-fab waves-effect waves-light amber tooltipped" data-position="top" data-tooltip="Print Data"><i class="material-icons">print</i></a>
          <?php endif; ?>
         
        </div>
        <div class="card-content">
          <?php if($message = $this->session->flashdata('message')): ?>
            <div class="col s12">
              <div class="card-panel <?php echo ($message['status']) ? 'green' : 'red'; ?>">
                <span class="white-text"><?php echo $message['message']; ?></span>
              </div>
            </div>
          <?php endif; ?>
          <?php if($this->session->userdata('level') === 'bk'): ?>
          <?php echo form_open('poin/search') ?>
            <input type="text" name="keyword" placeholder="search">
            <input type="submit" name="search_submit" value="Cari">
          <?php echo form_close() ?>
          <?php endif; ?>
          <table class="bordered highlight">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>NIS</th>
                      <th>Poin Reward</th>
                      <th>Tgl Poin Reward</th>
                      <th>Keterangan</th>
                      <th class="center-align">Rank</th>
                      <?php if($this->session->userdata('level') === 'bk'): ?>
                      <th class="center-align">Action</th>
                      <?php endif; ?>
                  </tr>
              </thead>
              <tbody>
                  <?php $no = 0; foreach($poin as $row): ?>
                    <tr>
                      <td><?php echo ++$no; ?></td>
                      <td><?php echo $row->nis; ?></td>
                      <td><?php echo $row->jml_poin_reward; ?></td>
                      <td><?php echo $row->tgl_poin_reward; ?></td>
                      <td ><?php if($row->jml_poin_reward <= '50'): ?>
                          <?php echo $row->keterangan = 'Bronze'; ?>
                          <?php elseif ($row->jml_poin_reward < '100'): ?>
                          <?php echo $row->keterangan = 'Silver'; ?>
                          <?php elseif ($row->jml_poin_reward >= '100'): ?>
                          <?php echo $row->keterangan = 'Gold'; ?>
                          <?php endif; ?>
                      </td>
                      <td class="center-align"><?php if($row->jml_poin_reward <= '50'): ?>
                          <img class="circle" src="<?php echo base_url('assets/images/1.jpg'); ?>" width="70" height="70">
                          <?php elseif ($row->jml_poin_reward < '100'): ?>
                          <img class="circle" src="<?php echo base_url('assets/images/2.jpg'); ?>"  width="70" height="70">
                          <?php elseif ($row->jml_poin_reward >= '100'): ?>
                          <img class="circle" src="<?php echo base_url('assets/images/3.jpg'); ?>"  width="70" height="70">
                          <?php endif; ?>
                      </td>

                      <?php if($this->session->userdata('level') === 'siswa'): ?>
                      <a <?php echo ($row->poin_pelanggaran <= '0' or $row->jml_poin_reward == '0') ? 'disabled' : ''; ?>  href="<?php echo base_url('poin/tukarpoin'); ?>" class="btn right halfway-fab waves-effect waves-light tooltipped"  data-tooltip="Tukar Poin"><i class="glyphicon glyphicon-user"></i> Tukar Poin</a>
                      <?php endif; ?>
                     
                      <?php if($this->session->userdata('level') === 'bk'): ?>
                      <td class="center-align">
                        <a <?php echo ($this->session->userdata('level') == 'siswa') ? 'disabled' : ''; ?> href="<?php echo base_url('poin/edit/' . $row->nis); ?>" class="btn-floating halfway-fab waves-effect waves-light tooltipped" data-position="top" data-tooltip="Edit Data"><i class="material-icons">edit</i></a>
                        <a <?php echo ($this->session->userdata('level') == 'siswa') ? 'disabled' : ''; ?> href="<?php echo base_url('poin/delete/' . $row->nis); ?>" class="btn-floating halfway-fab waves-effect waves-light tooltipped" data-position="top" data-tooltip="Delete Data"><i class="material-icons">delete</i></a>
                      </td>
                      <?php endif; ?>
                    </tr>
                  <?php endforeach; ?>
              </tbody>
          </table>
        </div>
      </div>
    </div>
</div>