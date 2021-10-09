<script type='text/javascript'>
    $(function () {
        $("a.reply").click(function () {
            var id = $(this).attr("id");
            $("#parent_id").attr("value", id);
            $("#name").focus();
        });
    });

    
</script>

<style type='text/css'>


    a, a:visited {
        outline: none;
        color: black;
    }

    .clear {
        clear: both;
    }

    #wrapper {
        width: 480px;
        margin: 0 auto 0 4px;
        padding: 15px 0px;
    }

    .comment_box {
        border-radius: 25px;
        padding: 5px;
        border: 2px solid navy;
        margin-top: 15px;
        list-style: none;
    }

    .aut {
        font-weight: bold;
    }

    .timestamp {
        font-size: 85%;
        float: right;
    }

    .btn-xs{
        width: 100%;
    }

    .btn-success{
        width: 100%;
    }

    #isi_bimbingan {
        display: block;
        width: 100%;
        height: 150px;
    }


</style>
        <div class="container">

            <div class="starter-template">
                <h1><?= $news->topik ?></h1>
                <p class="lead"><?= $news->deskripsi ?></p><!-- 
                <p><img src="<?php echo base_url(); ?>global/uploads/<?= $news->ne_img ?>"/></p> -->
                <p>     </p>
            </div>
            <div class="contact-form">
                <?php echo $comments ?>
                <h4 class="comment-reply-title">
                    <br>
                    Mulai Bimbingan!
                </h4>

                <p class="notice error"><?= $this->session->flashdata('error_msg') ?></p><br/>

                <form id="comment_form" action="<?= base_url() ?>news/tambahData/<?= $news->id_det_bimbingan ?>" method='post'>
                    <div class="form-group">
                        <label for="username">NIS:</label>
                        <input readonly class="form-control" type="text" required name="username" id='name' value="<?php echo $this->session->userdata('username'); ?>"/>
                    </div>

                    <div class="form-group">
                        <label for="email">Nama :</label>
                        <input readonly class="form-control" type="text" name="nama" value="<?php echo $this->session->userdata('nama'); ?>"'/>
                    </div>
                    <div class="form-group">
                        <label for="comment">Isi Bimbingan :</label>
                        <textarea class="form-control" name="isi_bimbingan" value="<?= set_value("isi_bimbingan") ?>" id='comment'></textarea>
                    </div>

                    <input type='hidden' name='parent_id' value="0" id='parent_id' />
                    <input type='hidden' name='id_det_bimbingan' value="<?= set_value("id_det_bimbingan", $news->id_det_bimbingan) ?>" id='parent_id'/>

                    <div id='submit_button'>
                        <input class="btn btn-success" type="submit" name="submit" value="add comment"/>
                    </div>
                    <br>
                    <div>
                    <?php if ($this->session->userdata('level') == 'siswa') {
                                            echo "<a href=".base_url('news/point')." class=\"btn btn-success btn-xs\" title=\"Bimbingan Selesai\"><i class=\"glyphicon glyphicon-user\"></i> Bimbingan Selesai</a>";
                                        }
                                    ?>
                    </div>
                   
                </form>
            </div>
        </div><!-- /.container -->





