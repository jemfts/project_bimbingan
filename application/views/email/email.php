<div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content light-blue lighten-1 white-text">
          <span class="card-title">Kirim Email</span>
        </div>
        <div class="card-content">
          <?php if($message = $this->session->flashdata('message')): ?>
            <div class="col s12">
              <div class="card-panel <?php echo ($message['status']) ? 'green' : 'red'; ?>">
                <span class="white-text"><?php echo $message['message']; ?></span>
              </div>
            </div>
          <?php endif; ?>
            <table>
             <?php echo form_open_multipart('email/kirim'); ?>
             <tbody>
              
              <div class="input-field col s12 m12">
               <input name="to" type="email" value=""><label for="to" class="">To</label>
              </div>
              <div class="input-field col s12 m12">
               <input name="subject" type="text" value=""><label for="subject" class="">Subject / Judul</label>
              </div>
              <div class="input-field col s12 m12">
              <textarea id="isi" class="materialize-textarea" name="isi" type="text"></textarea>
              <label for="isi">Isi Pesan</label>
              </div>
              <div class="input-field col s12 right-align">
              <button type="submit" name="submit" value="Kirim" class="btn amber waves-effect waves-green">Kirim</button>
              </div>
             
             </tbody>
             <?php echo form_close();?>
            </table>
           </div>
      </div>
    </div>
</div> 