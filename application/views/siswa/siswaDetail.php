<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content light-blue lighten-1 white-text">
        <span class="card-title"><?php echo $pageTitle; ?></span>
      </div>
      <div class="card-content">
        <div class="row">
          <div class="input-field col s12 m6">
                  <input readonly id="nis" name="nis" type="number" value="<?php echo $siswa->nis; ?>">
                  <label for="nis" class="active">NIS</label>
              </div>
          <div class="input-field col s12 m6">
                  <input readonly id="nama_lengkap" name="nama_lengkap" type="text" value="<?php echo $siswa->nama_lengkap; ?>">
                  <label for="nama_lengkap" class="active">Nama Lengkap</label>
              </div>
              <div class="input-field col s12 m6">
                  <input readonly id="kelas" name="kelas" type="text" value="<?php echo $siswa->kelas; ?>">
                  <label for="kelas" class="active">Kelas</label>
              </div>
              <div class="input-field col s12 m6">
                  <input readonly id="alamat" name="alamat" type="text" value="<?php echo $siswa->alamat; ?>">
                  <label for="alamat" class="active">Alamat</label>
              </div>
              <div class="input-field col s12 m6">
                  <input readonly id="tempat_lahir" name="tempat_lahir" type="text" value="<?php echo $siswa->tempat_lahir; ?>">
                  <label for="tempat_lahir" class="active">Tempat Lahir</label>
              </div>
              <div class="input-field col s12 m6">
                  <input readonly id="tgl_lahir" name="tgl_lahir" type="date" value="<?php echo $siswa->tgl_lahir; ?>">
                  <label for="tgl_lahir" class="active">Tanggal Lahir</label>
              </div>
              <div class="input-field col s12 m6">
              <select readonly id="jenis_kelamin" name="jenis_kelamin" value="<?php echo $siswa->jenis_kelamin; ?>">
                  <option readonly value="P">P</option>
                  <option readonly value="L">L</option>
              </select>
              <label>Pilih Jenis Kelamin</label>
              </div>
              <div class="input-field col s12 m6">
                  <input readonly id="agama" name="agama" type="text" value="<?php echo $siswa->agama; ?>">
                  <label for="agama" class="active">Agama</label>
              </div>
              <div class="input-field col s12 m6">
                  <input readonly id="email" name="email" type="email" value="<?php echo $siswa->email; ?>">
                  <label for="email" class="active">Email</label>
              </div>
              <div class="input-field col s12 m6">
                  <input readonly id="no_hp" name="no_hp" type="number" value="<?php echo $siswa->no_hp; ?>">
                  <label for="no_hp" class="active">No. HP</label>
              </div>
              <div class="input-field col s12 m6">
                  <input readonly id="nama_wali_murid" name="nama_wali_murid" type="text" value="<?php echo $siswa->nama_wali_murid; ?>">
                  <label for="nama_wali_murid" class="active">Nama Wali Murid</label>
              </div>
              <div class="input-field col s12 m6">
                  <input readonly id="email_wali_murid" name="email_wali_murid" type="email" value="<?php echo $siswa->email_wali_murid; ?>">
                  <label for="email_wali_murid" class="active">Email Wali Murid</label>
              </div>
        </div>
      </div>
    </div>
  </div>
</div>