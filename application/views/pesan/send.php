 <div class="container">
    <h1 align="center">Kirim Pesan Kepada Pelanggan</h1><br>
    <div class="col-md-5" style="margin:0 auto;">
    <div class="well bs-component">
      <form action="<?php echo base_url('pesan/sendmsg') ?>" method="post" class="form-horizontal"> 
      
        <fieldset>
          <div class="form-group">
            <label for="inputEmail" class="col-lg-3 control-label">No Telepon</label>
            <div class="col-lg-12">
                <input type="text" name="mobile" class="form-control" placeholder="Ex:Masukan No Tujuan"> 
            </div>
            <div class="col-md-12">
              <?php echo form_error('mobile', '<span class="text-danger">','</span>') ?>
            </div>
          </div>


          <div class="form-group">
            <label for="inputEmail" class="col-lg-3 control-label">Pesan</label>
            <div class="col-lg-12">
              <textarea name="message" class="form-control" placeholder="Masukan Pesan Anda"></textarea>
            </div>
            <div class="col-md-12">
              <?php echo form_error('message', '<span class="text-danger">','</span>') ?>
            </div>
          </div>
         
          <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
             <button type="reset" class="btn btn-default">Batal</button>
              <button type="submit" class="btn btn-primary"><span class="fa fa-send"></span> Kirim</button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
  </div>