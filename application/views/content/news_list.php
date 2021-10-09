<div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content light-blue lighten-1 white-text">
          <span class="card-title">Bimbingan Konseling</span>
        </div>
        <div class="card-content">
<div class="table-responsive">
<table class="table">
    <thead>
    <tr>
        <th>Topik</th>
        <th>Deskripsi</th><!-- 
        <th>Image</th> -->
    </tr>
    </thead>
    <tbody>
    <?php foreach ($news as $n) : ?>
    <tr>
        <td><a href="<?= base_url() ?>news/lihatData/<?= $n['id_det_bimbingan']; ?>"><?= $n['topik']; ?></a></td>
        <td><?= $n['deskripsi']; ?></td>
       <!--  <td><img src="<?php echo base_url(); ?>global/uploads/<?= $n['ne_img']; ?>"/>
        </td> -->
    </tr>
    </tbody>
    <?php endforeach ?>
</table>
</div>
 </div>
        </div>
      </div>
    </div>
</div>

