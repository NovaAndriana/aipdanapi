  <!-- Main content -->
  <?php $level = $this->session->userdata('level');?>
  <?php $tahun = $this->session->userdata('tahun');?>
  <style type="text/css">
    .lebel{
      font-weight: bold;
      font-size: 16px;
    }
  </style>
  <div class="row">
    <div class="col-xs-12">
      <div class="nav-tabs-custom">
        <?php $this->load->view('main/nav_tab_view'); ?>
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title"></h3>
            <p class="box-title pull-right" style="margin-right:40px"><i class="fa fa-calendar"></i>&nbsp;&nbsp;<?php echo (isset($bulan[0]->nama_bulan) ? $bulan[0]->nama_bulan : '').' - '. $tahun;?></p>
          </div>
          <br>
          <!-- /.box-header -->                        
          <div class="box-body">
          <div class="col-md-12">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group adm">
                    <select class="form-control select2nya" id="iduser">
                      <option value="">
                        -- Pilih --
                      </option>
                      <?php if(isset($opt_user) && is_array($opt_user)){?> 
                        <?php foreach($opt_user as $k=>$v){?>
                          <option value="<?php echo $v['id'];?>" <?php if(!empty($iduser) && $v['id'] == $iduser) echo 'selected="selected"';?>>
                            <?php echo $v['txt'];?>
                          </option>
                        <?php }?>
                      <?php }?>
                    </select>
                  </div>
                </div> 
                <div class="col-md-1">
                  <div class="form-group adm">
                    <a href="javascript:void(0)" title="Add" class="btn btn-primary btn-sm btn-flat" onClick="gensearch('index-print_all','index-print_all');">
                      <i class="fa fa-search"></i>
                    </a> 
                  </div>
                </div>
                
              </div>
            </div>
            <hr>
            <?php if($this->session->flashdata('form_true')){?>
              <div id="notif">               
                <?php echo $this->session->flashdata('form_true');?>               
              </div>
            <?php } ?>

            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo site_url('bulanan/printall/generate_all_reports');?>">
              <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
              <!-- <div class="row">
                <div class="col-md-12">
                  <div class="col-md-12" style="background-color: #dae7ef;">
                    
                  </div>
                </div>
              </div> -->
              <div class="col-md-12" style="background-color: #dae7ef;">
                    <div class="form-group" style="margin-left: 20px;">
                      <br>
                      <fieldset>      
                          <legend>Pilih report:</legend>   
                          <div style="float:left">
                            <input type="checkbox" name="templates[]" value="pendahuluan"/>&nbsp;Pendahuluan
                          </div> 
                          <div style="float:left">
                            &nbsp;&nbsp;<input type="checkbox" name="templates[]" value="asetinvest"/>&nbsp;Aset Investasi
                          </div>  
                          <div style="float:left">
                            &nbsp;&nbsp;<input type="checkbox" name="templates[]" value="hasilinvest"/>&nbsp;Hasil Investasi
                          </div> 
                          <div style="float:left">
                            &nbsp;&nbsp;<input type="checkbox" name="templates[]" value="bebaninvest"/>&nbsp;Beban Investasi
                          </div> 
                          <div style="float:left">
                            &nbsp;&nbsp;<input type="checkbox" name="templates[]" value="bukaninvest"/>&nbsp;Aset Bukan Investasi
                          </div> 
                          <div style="float:left">
                            &nbsp;&nbsp;<input type="checkbox" name="templates[]" value="danabersih"/>&nbsp;Dana Bersih
                          </div>  
                          <div style="float:left">
                            &nbsp;&nbsp;<input type="checkbox" name="templates[]" value="perubahandanabersih"/>&nbsp;Perubahan Dana Bersih
                          </div>  
                          <div style="float:left">
                            &nbsp;&nbsp;<input type="checkbox" name="templates[]" value="aruskas"/>&nbsp;Arus Kas
                          </div>   
                          <div style="float:left">
                            &nbsp;&nbsp;<input type="checkbox" name="templates[]" value="rincian"/>&nbsp;Rincian
                          </div>  
                          <br>      
                          <br>
                          <!-- <input type="submit" value="Submit now" />    -->
                          <a type="submit" href="<?php echo base_url('bulanan/printall/generate_all_reports'); ?>" class="btn btn-danger btn-sm btn-flat" target="_blank">
                              <i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Generate PDF
                          </a>
                      </fieldset>
                    </div>
              </div>
            </form>
            <br>
        </div>
        <!-- /.col -->

      </div>
    </div>
    <!-- /.box -->
  </div>
</div>

<script type="text/javascript">
   $(".select2nya").select2( { 'width':'100%' } );

   $(".ckeditor").each(function () {
     CKEDITOR.replace( $(this).attr("name") );
   })

   CKEDITOR.config.toolbar = [
    ['Styles','Format','Font','FontSize'],
    '/',
    ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    ];
</script>

