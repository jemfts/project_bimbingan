<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content light-blue lighten-1 white-text">
        <span class="card-title"><?php echo $pageTitle; ?></span>
      </div>
      <div class="card-content">
        <div class="row">
          <div class="col s12">
            <ul class="tabs tabs-fixed-width">
              <li class="tab col s3"><a class="active" href="#basic-tab">Basic Information</a></li>
            </ul>
          </div>
          <div id="basic-tab" class="col s12">
            <form class="row" id="basic-form" method="post" action="<?php echo base_url('siswa/insert'); ?>" style="margin-top: 20px;" enctype="multipart/form-data">
              <?php if(validation_errors()): ?>
                <div class="col s12">
                  <div class="card-panel red">
                    <span class="white-text"><?php echo validation_errors('<p>', '</p>'); ?></span>
                  </div>
                </div>
              <?php endif; ?>
              <?php if($message = $this->session->flashdata('message_profile')): ?>
                <div class="col s12">
                  <div class="card-panel <?php echo ($message['status']) ? 'green' : 'red'; ?>">
                    <span class="white-text"><?php echo $message['message']; ?></span>
                  </div>
                </div>
              <?php endif; ?>
              <div class="input-field col s12 m6">
                  <input id="nama_lengkap" name="nama_lengkap" type="text" value="<?php echo $this->session->userdata('nama_lengkap'); ?>">
                  <label for="nama_lengkap" class="">Nama Lengkap</label>
              </div>
              <div class="input-field col s12 m6">
                  <input id="kelas" name="kelas" type="text" value="<?php echo $this->session->userdata('kelas'); ?>">
                  <label for="kelas" class="">Kelas</label>
              </div>
              <div class="input-field col s12 m6">
                  <input id="alamat" name="alamat" type="text" value="<?php echo $this->session->userdata('alamat'); ?>">
                  <label for="alamat" class="">Alamat</label>
              </div>
              <div class="input-field col s12 m6">
                  <input id="tempat_lahir" name="tempat_lahir" type="text" value="<?php echo $this->session->userdata('tempat_lahir'); ?>">
                  <label for="tempat_lahir" class="">Tempat Lahir</label>
              </div>
              <div class="input-field col s12 m6">
                  <input id="tgl_lahir" name="tgl_lahir" type="number" value="<?php echo $this->session->userdata('tgl_lahir'); ?>">
                  <label for="tgl_lahir" class="">Tanggal Lahir</label>
              </div>
              <div class="input-field col s12 m6">
              <select id="jenis_kelamin" name="jenis_kelamin">
                  <option value="P">P</option>
                  <option value="L">L</option>
              </select>
              <label>Pilih Jenis Kelamin</label>
              </div>
              <div class="input-field col s12 m6">
                  <input id="agama" name="agama" type="text" value="<?php echo $this->session->userdata('agama'); ?>">
                  <label for="agama" class="">Agama</label>
              </div>
              <div class="input-field col s12 m6">
                  <input id="email" name="email" type="email" value="<?php echo $this->session->userdata('email'); ?>">
                  <label for="email" class="">Email</label>
              </div>
              <div class="input-field col s12 m6">
                  <input id="no_telp" name="no_telp" type="number" value="<?php echo $this->session->userdata('no_telp'); ?>">
                  <label for="no_telp" class="">No. Telepon</label>
              </div>
              </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text">
                </div>
              </div>
              <div class="input-field col s12 right-align">
                  <button type="submit" name="submit-information" value="true" class="btn amber waves-effect waves-green">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>