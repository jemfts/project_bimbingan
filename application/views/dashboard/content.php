<div class="row">
    <div class="col s12 m6">
        <div class="card blue">
            <div class="card-content white-text">
                <p class="card-title">Jumlah Siswa Terdaftar</p>
                <div class="row dashboard-row">
                    <div class="col s2">
                        <i class="large material-icons">people</i>
                    </div>
                    <div class="col s10">
                        <h2 class="dashboard-title">
                            <?php echo $siswa; ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col s12 m6">
        <div class="card teal">
            <div class="card-content white-text">
                <p class="card-title">Poin Tertinggi</p>
                <div class="row dashboard-row">
                    <div class="col s2">
                        <i class="large material-icons">score</i>
                    </div>
                    <div class="col s10">
                        <h4 class="dashboard-title">
                            <?php echo ($poin_reward) ? $poin_reward->nama_lengkap : '-'; ?>
                        </h4>
                        <h5 class="dashboard-title">
                            <?php echo ($poin_reward) ? $poin_reward->jml_poin_reward: '-'; ?>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>    
    <div class="col s12">
        <div class="card white">
            <div class="card-content white-text">
                <p class="card-title" style="color:blue;">Top 3 Highest Reward Points</p>
                <link rel="stylesheet" href="<?php echo base_url().'assets/css/morris.css'?>">
 
    <div id="graph"></div>
 
    <script src="<?php echo base_url().'assets/js/jquery.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/raphael-min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/morris.min.js'?>"></script>
    <script>
        Morris.Bar({
          element: 'graph',
          data: <?php echo $chart;?>,
          xkey: 'nis',
          ykeys: ['reward'],
          labels: ['Reward']
        });
    </script>
            </div>
        </div>
    </div>
    

</div>