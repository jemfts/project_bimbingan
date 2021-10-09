<aside>
  <ul id="sidenav" class="side-nav fixed">
    
    <li>
      <div class="userView">
        <div class="background">
          <img src="<?php echo base_url('assets/images/nav6.jpg'); ?>">
        </div>
        <a href="<?php echo base_url('profile'); ?>"><img class="circle" src="<?php echo base_url('assets/images/') . $this->session->userdata('avatar'); ; ?>"></a>
        <a href="<?php echo base_url('profile'); ?>"><span class="white-text name"><?php echo ucwords(strtolower($this->session->userdata('nama'))); ?><?php echo ucwords(strtolower($this->session->userdata('jml_poin_reward'))); ?></span></a>
        <a href="<?php echo base_url('profile'); ?>"><span class="white-text email"><?php echo ucwords(strtolower($this->session->userdata('level'))); ?></span></a>
      </div>
    </li>

    <li>
      <a class="waves-effect" href="<?php echo base_url('dashboard'); ?>"><i class="material-icons">home</i>Dashboard</a>
    </li>
    <!-- <li>
      <a class="waves-effect" href="<?php echo base_url('profile'); ?>"><i class="material-icons">person</i>Profile</a>
    </li> 
    -->
    <?php if($this->session->userdata('level') === 'siswa'): ?>
    <li>
      <a class="waves-effect" href="<?php echo base_url('biodata'); ?>"><i class="material-icons">person</i>Edit Biodata</a>
    </li>
    <?php endif; ?>
  
    <?php if($this->session->userdata('level') === 'bk'): ?>
      <!-- <li>
        <a class="subheader">Admin</a>
      </li> -->
      
      <li>
        <a class="waves-effect" href="<?php echo base_url('users'); ?>"><i class="material-icons">person_add</i>Users</a>
      </li>
      <li>
      <a class="waves-effect" href="<?php echo base_url('siswa'); ?>"><i class="material-icons">people</i>Data Siswa</a>
      </li>
      <li>
      <a class="waves-effect" href="<?php echo base_url('email'); ?>"><i class="material-icons">email</i>Kirim Email</a>
      </li>
      
    <?php endif; ?>


    <li>
      <a class="waves-effect" href="<?php echo base_url('news'); ?>"><i class="material-icons">chat</i>Bimbingan Konseling</a>
    </li>

    <li>
      <a class="waves-effect" href="<?php echo base_url('poin'); ?>"><i class="material-icons">score</i>Poin Reward</a>
    </li>

    <?php if($this->session->userdata('level') === 'siswa'): ?>
    <li>
      <a class="waves-effect" href="<?php echo base_url('poin/leaderboard'); ?>"><i class="material-icons">insert_chart</i>Leaderboard</a>
    </li>
    <?php endif; ?>


    <li>
      <a class="waves-effect" href="<?php echo base_url('pelanggaran'); ?>"><i class="material-icons">warning</i>Pelanggaran</a>
    </li>

    <li>
      <a class="waves-effect" href="<?php echo base_url('sanksi'); ?>"><i class="material-icons">sentiment_very_dissatisfied</i>Sanksi</a>
    </li>

    <li>
      <a class="waves-effect"  href="<?php echo base_url('auth/logout'); ?>"><i class="material-icons">exit_to_app</i>Logout</a>
    </li>
    
  </ul>
</aside>