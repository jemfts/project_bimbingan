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
                  <input id="nis" name="nis" type="number" value="<?php echo $biodata->nis; ?>">
                  <label for="nis" class="active">NIS</label>
              </div>
          <div class="input-field col s12 m6">
                  <input id="nama_lengkap" name="nama_lengkap" type="text" value="<?php echo $biodata->nama_lengkap; ?>">
                  <label for="nama_lengkap" class="active">Nama Lengkap</label>
              </div>
              <div class="input-field col s12 m6">
                  <input id="kelas" name="kelas" type="text" value="<?php echo $biodata->kelas; ?>">
                  <label for="kelas" class="active">Kelas</label>
              </div>
              <div class="input-field col s12 m6">
                  <input id="alamat" name="alamat" type="text" value="<?php echo $biodata->alamat; ?>">
                  <label for="alamat" class="active">Alamat</label>
              </div>
              <div class="input-field col s12 m6">
                  <input id="tempat_lahir" name="tempat_lahir" type="text" value="<?php echo $biodata->tempat_lahir; ?>">
                  <label for="tempat_lahir" class="active">Tempat Lahir</label>
              </div>
              <div class="input-field col s12 m6">
                  <input id="tgl_lahir" name="tgl_lahir" type="date" value="<?php echo $biodata->tgl_lahir; ?>">
                  <label for="tgl_lahir" class="active">Tanggal Lahir</label>
              </div>
              <div class="input-field col s12 m6">
              <select id="jenis_kelamin" name="jenis_kelamin" value="<?php echo $biodata->jenis_kelamin; ?>">
                  <option value="P">P</option>
                  <option value="L">L</option>
              </select>
              <label>Pilih Jenis Kelamin</label>
              </div>
              <div class="input-field col s12 m6">
                  <input id="agama" name="agama" type="text" value="<?php echo $biodata->agama; ?>">
                  <label for="agama" class="active">Agama</label>
              </div>
              <div class="input-field col s12 m6">
                  <input id="email" name="email" type="email" value="<?php echo $biodata->email; ?>">
                  <label for="email" class="active">Email</label>
              </div>
              <div class="input-field col s12 m6">
                  <input id="no_hp" name="no_hp" type="number" value="<?php echo $biodata->no_hp; ?>">
                  <label for="no_hp" class="active">No. HP</label>
              </div>
              <div class="input-field col s12 m6">
                  <input id="nama_wali_murid" name="nama_wali_murid" type="text" value="<?php echo $biodata->nama_wali_murid; ?>">
                  <label for="nama_wali_murid" class="active">Nama Wali Murid</label>
              </div>
              <div class="input-field col s12 m6">
                  <input id="email_wali_murid" name="email_wali_murid" type="email" value="<?php echo $biodata->email_wali_murid; ?>">
                  <label for="email_wali_murid" class="active">Email Wali Murid</label>
              </div>
          <div class="input-field col s12 right-align">
              <button type="submit" name="submit" value="<?php echo $biodata->nis; ?>" class="btn amber waves-effect waves-green">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>