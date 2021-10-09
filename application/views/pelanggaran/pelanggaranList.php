<div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content light-blue lighten-1 white-text">
          <span class="card-title">Data Pelanggaran</span>
          <?php if($this->session->userdata('level') === 'bk'): ?>
          <a <?php echo ($this->session->userdata('level') == 'siswa') ? 'disabled' : ''; ?> href="<?php echo base_url('pelanggaran/tambahData'); ?>" class="btn-floating right halfway-fab waves-effect waves-light amber tooltipped" data-position="top" data-tooltip="Tambah Data"><i class="material-icons">add</i></a>
          <a href="<?php echo base_url('pelanggaran/cetak'); ?>" class="btn-floating right halfway-fab waves-effect waves-light amber tooltipped" data-position="top" data-tooltip="Print Data"><i class="material-icons">print</i></a>
          <a href="<?php echo base_url('pelanggaran/export_excel') ?>" class="btn-floating right halfway-fab waves-effect waves-light amber tooltipped" data-position="top" data-tooltip="Export Excel"><i class="material-icons">save_alt</i></a>
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
          <?php echo form_open('pelanggaran/search') ?>
            <input type="text" name="keyword" placeholder="search">
            <input type="submit" name="search_submit" value="Cari">
          <?php echo form_close() ?>
          <?php endif; ?>
          <table class="bordered highlight">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>NIS</th>
                      <th>Pelanggaran</th>
                      <th>Tipe Pelanggaran</th>
                      <th>Tgl Pelanggaran</th>
                      <th>Poin Pelanggaran</th>
                      <th>Deskripsi</th>
                      <?php if($this->session->userdata('level') === 'bk'): ?>
                      <th class="center-align">Action</th>
                      <?php endif; ?>
                  </tr>
              </thead>
              <tbody>
                  <?php $no = 0; foreach($pelanggaran as $row): ?>
                    <tr>
                      <td><?php echo ++$no; ?></td>
                      <td><?php echo $row->nis; ?></td>
                      <td><?php echo $row->pelanggaran; ?></td>
                      <td><?php echo $row->tipe_pelanggaran; ?></td>
                      <td><?php echo $row->tgl_pelanggaran; ?></td>
                      <td><?php echo $row->poin_pelanggaran; ?></td>
                      <td><?php echo $row->deskripsi; ?>
                      <td class="center-align">
                        <!-- <a href="<?php echo base_url('pelanggaran/detail/' . $row->nis); ?>" class="btn-floating halfway-fab waves-effect waves-light tooltipped" data-position="top" data-tooltip="Detail"><i class="material-icons">list</i></a> -->
                        <?php if($this->session->userdata('level') === 'bk'): ?>
                        <a <?php echo ($this->session->userdata('level') == 'siswa') ? 'disabled' : ''; ?> href="<?php echo base_url('pelanggaran/editData/' . $row->nis); ?>" class="btn-floating halfway-fab waves-effect waves-light tooltipped" data-position="top" data-tooltip="Edit Data"><i class="material-icons">edit</i></a>
                        <a <?php echo ($this->session->userdata('level') == 'siswa') ? 'disabled' : ''; ?> href="<?php echo base_url('pelanggaran/hapusData/' . $row->nis); ?>" class="btn-floating halfway-fab waves-effect waves-light tooltipped" data-position="top" data-tooltip="Delete Data"><i class="material-icons">delete</i></a>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
              </tbody>
          </table>
        </div>
      </div>
    </div>
</div>