<div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content blue darken-1 white-text">
          <span class="card-title">Poin Bimbingan</span>
          <a href="<?php echo base_url('siswa/add'); ?>" class="btn-floating right halfway-fab waves-effect waves-light amber tooltipped" data-position="top" data-tooltip="Tambah Data"><i class="material-icons">add</i></a>
        </div>
        <div class="card-content">
          <?php if($message = $this->session->flashdata('message')): ?>
            <div class="col s12">
              <div class="card-panel <?php echo ($message['status']) ? 'green' : 'red'; ?>">
                <span class="white-text"><?php echo $message['message']; ?></span>
              </div>
            </div>
          <?php endif; ?>
          <table class="bordered highlight">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>NIS</th>
                      <th>Poin Bimbingan</th>
                      <th>Tanggal Bimbingan</th>
                      <th>Keterangan</th>
                      <th class="center-align">Action</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $no = 0; foreach($reward as $row): ?>
                    <tr>
                      <td><?php echo ++$no; ?></td>
                      <td><?php echo $row->nis; ?></td>
                      <td><?php echo $row->jml_poin_reward; ?></td>
                      <td><?php echo $row->tgl_poin_reward; ?></td>
                      <td><?php echo $row->keterangan; ?></td>
                      <td class="center-align">
                        <a href="<?php echo base_url('siswa/edit/' . $row->nis); ?>" class="btn-floating halfway-fab waves-effect waves-light tooltipped" data-position="top" data-tooltip="Edit Data"><i class="material-icons">edit</i></a>
                        <a href="<?php echo base_url('siswa/delete/' . $row->nis); ?>" class="btn-floating halfway-fab waves-effect waves-light tooltipped" data-position="top" data-tooltip="Delete Data"><i class="material-icons">delete</i></a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
              </tbody>
          </table>
        </div>
      </div>
    </div>
</div>