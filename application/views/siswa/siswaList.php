<div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content light-blue lighten-1 white-text">
          <span class="card-title">Data Siswa</span>
          <a href="<?php echo base_url('siswa/tambahData'); ?>" class="btn-floating right halfway-fab waves-effect waves-light amber tooltipped" data-position="top" data-tooltip="Tambah Data"><i class="material-icons">add</i></a>
          <a href="<?php echo base_url('siswa/cetak'); ?>" class="btn-floating right halfway-fab waves-effect waves-light amber tooltipped" data-position="top" data-tooltip="Print Data"><i class="material-icons">print</i></a>
          <a href="<?php echo base_url('siswa/export_excel') ?>" class="btn-floating right halfway-fab waves-effect waves-light amber tooltipped" data-position="top" data-tooltip="Export Excel"><i class="material-icons">save_alt</i></a>
        </div>
        <div class="card-content">
          <?php if($message = $this->session->flashdata('message')): ?>
            <div class="col s12">
              <div class="card-panel <?php echo ($message['status']) ? 'green' : 'red'; ?>">
                <span class="white-text"><?php echo $message['message']; ?></span>
              </div>
            </div>
          <?php endif; ?>
          <?php echo form_open('siswa/search') ?>
            <input type="text" name="keyword" placeholder="search">
            <input type="submit" name="search_submit" value="Cari">
          <?php echo form_close() ?>
          <table class="bordered highlight">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>NIS</th>
                      <th>Nama Lengkap</th>
                      <th>Kelas</th>
                      <th>No. HP</th>
                      <th class="center-align">Action</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $no = $this->uri->segment(3); foreach($siswa as $row): ?>
                    <tr>
                      <td><?php echo ++$no; ?></td>
                      <td><?php echo $row->nis; ?></td>
                      <td><?php echo $row->nama_lengkap; ?></td>
                      <td><?php echo $row->kelas; ?></td>
                      <td><?php echo $row->no_hp; ?></td>
                      <td class="center-align">
                        <a href="<?php echo base_url('siswa/detail/' . $row->nis); ?>" class="btn-floating halfway-fab waves-effect waves-light tooltipped" data-position="top" data-tooltip="Detail"><i class="material-icons">list</i></a>
                        <a href="<?php echo base_url('siswa/editData/' . $row->nis); ?>" class="btn-floating halfway-fab waves-effect waves-light tooltipped" data-position="top" data-tooltip="Edit Data"><i class="material-icons">edit</i></a>
                        <a href="<?php echo base_url('siswa/hapusData/' . $row->nis); ?>" class="btn-floating halfway-fab waves-effect waves-light tooltipped" data-position="top" data-tooltip="Delete Data"><i class="material-icons">delete</i></a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
              </tbody>
          </table>
          <div class="center-align">
            <?php echo $this->pagination->create_links(); ?>
          </div>
        </div>
      </div>
    </div>
</div>