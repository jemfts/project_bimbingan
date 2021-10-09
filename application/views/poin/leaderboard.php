<div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content light-blue lighten-1 white-text">
          <span class="card-title">Leaderboard</span>
          
        </div>
        <div class="card-content">
          <table class="bordered highlight">
              <thead>
                  <tr>
                      <th class="center-align">No</th>
                      <th class="center-align">Avatar</th>
                      <th class="center-align">Username</th>
                      <th class="center-align">Poin Reward</th>
                      <th class="center-align">Rank</th>
                      <th class="center-align">Last Login</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $no = 0; $image_path=base_url()."assets/images"; $rank="SELECT gambar FROM rank where gambar='1.jpg'"; foreach($poin as $row): ?>
                    <tr>
                      <td class="center-align"><?php echo ++$no; ?></td>
                      <td class="center-align"><img class="circle" src="<?php echo base_url('assets/images/'.$row->avatar); ?>" width="70" height="70"></td>
                      <td class="center-align"><?php echo $row->nis; ?></td>
                      <td class="center-align"><?php echo $row->jml_poin_reward; ?></td>
                      <td class="center-align"><?php if($row->jml_poin_reward <= '50'): ?>
                          <img class="circle" src="<?php echo base_url('assets/images/1.jpg'); ?>" width="70" height="70">
                          <?php elseif ($row->jml_poin_reward <= '100'): ?>
                          <img class="circle" src="<?php echo base_url('assets/images/2.jpg'); ?>"  width="70" height="70">
                          <?php elseif ($row->jml_poin_reward <= '200'): ?>
                          <img class="circle" src="<?php echo base_url('assets/images/3.jpg'); ?>"  width="70" height="70">
                          <?php endif; ?>
                      </td>
                      <td class="center-align"><?php echo $row->last_login; ?> </td>
                      

                     <!--  <td><?php if ($rank >= '0') {
                        echo " <img class='circle' src='$image_path/2.jpg' width='70' height='70'/>";
                      }
                      elseif ($rank >= '10') {
                        echo " <img class='circle' src='$image_path/2.jpg' width='70' height='70'/>";
                      }
                      elseif ($rank >= '200') {
                        echo " <img class='circle' src='$image_path/3.jpg' width='70' height='70'/>";
                      } ?></td> -->
                      
                    </tr>
                  <?php endforeach; ?>
              </tbody>
          </table>
        </div>
      </div>
    </div>
</div>