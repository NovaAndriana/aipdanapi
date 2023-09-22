<style type="text/css">
	td.dataTables_empty{
		text-align: center;
	}
	/*.odd*/
</style>
<form id="form_<?=$acak;?>" method="post" url="<?php echo site_url(); ?>pengajuan-master-simpan/tmp_mst_pihak" enctype="multipart/form-data" >
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
	<input type="hidden" name="editstatus" value="<?php echo !empty($editstatus) ? $editstatus : 'add';?>">
	<input type="hidden" name="id" value="<?php echo !empty($data) ? $data['id'] : '';?>">
	<input type="hidden" name="iduser" value="<?= $this->session->userdata('iduser');?>">
	<input type="hidden" name="status" value="<?php echo !empty($data) ? $data['status'] : '0';?>">
	<input type="hidden" name="insert_at" value="<?php echo date('Y-m-d H:i:s');?>">

	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Form Pengajuan Nama Pihak</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Kode Pihak<font color="red">&nbsp;*</font></label>
										<input type="text" placeholder="Kode Pihak" class="form-control" id="kode_pihak" name="kode_pihak" value="<?php echo !empty($data) ? $data['kode_pihak'] : '';?>" required="required" <?php if ($editstatus == 'edit'){ echo 'readonly';}?>>
									</div>
								</div>
								<div class="col-md-7">
									<div class="form-group">
										<label>Nama Pihak<font color="red">&nbsp;*</font></label>
										<input type="text" placeholder="Nama Pihak" class="form-control" id="nama_pihak" name="nama_pihak" value="<?php echo !empty($data) ? $data['nama_pihak'] : '';?>" required="required">
									</div>
								</div>
							</div>	
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Keterangan<font color="red">&nbsp;*</font></label>
										<textarea type="text" placeholder="Keterangan" class="form-control" id="keterangan" name="keterangan" required="required" rows="3"><?php echo !empty($data) ? $data['keterangan'] : '';?></textarea>
									</div>
								</div>
							</div>	
							<div class="row">
								<div class="col-md-3">
									<label>Group Investasi<font color="red">&nbsp;*</font></label>
									<select class="form-control select2nya group" id="group" name="group" required="required">
										<option value="">
											-- Pilih --
										</option>
										<?php if(isset($group_pihak) && is_array($group_pihak)){?> 
											<?php foreach($group_pihak as $k=>$v){?>
												<option value="<?php echo $v['id'];?>" <?php if(!empty($data) && $v['id'] == $data['group']) echo 'selected="selected"';?>>
													<?php echo $v['txt'];?>
												</option>
											<?php }?>
										<?php }?>
									</select>
									<label class="validation_error_message" for="group"></label>
								</div>
							</div>
							<hr />
							<div class="row" id="sub">
								<div class='col-md-12'>
									<br/>
									<fieldset class='form-group'>
										<legend style='font-size:16px;border-width: 2px;border-color: #2f87b7;'>Jenis Investasi</legend>
										<div class="table-responsive">
											<table class="table table-bordered table-striped table-hover tbl-form" id="tbl-form" width="100%">
												<thead>
													<tr style='background-color:#3C8DBC;'>
														<th width="85%">Jenis Investasi</th>
														<th class='text-center' style='vertical-align:middle;' width='5%'>
															<a href="javascript:void(0);" id="tambah_detail" class="btn btn-success btn-sm tambah_detail"><i class="fa fa-plus"></i></a>
														</th>
													</tr>
												</thead>
												<tbody class="form_master_nama_pihak">
													<?php if($editstatus == "edit") :?>
														<?php if(isset($data_detail) && is_array($data_detail)):?>
															<?php $idx=1;?>
															<?php foreach($data_detail as  $detail):?>
																<tr class="form_1" id="tr_inv_<?=$idx;?>" idx="<?=$idx;?>">
																	<td>
																		<select class="form-control combo-invest" id="jns_invest" name="jns_invest[]" required="required">
																			<option value="">
																				-- Pilih Jenis Investasi --
																			</option>
																			<?php if(isset($data_jenis) && is_array($data_jenis)){?>
																				<?php foreach($data_jenis as $jenis){?>
																					<option value="<?php echo $jenis->id_investasi;?>" <?php if(!empty($detail) && $jenis->id_investasi == $detail['id_investasi']) echo 'selected="selected"';?>>
																						<?php echo $jenis->jenis_investasi;?>
																					</option>
																				<?php }?>
																			<?php }?>
																		</select>		
																	</td>
																	<td class="text-center"><a href="javascript:void(0);" class="btn btn-danger btn-sm btn-circle" onclick="$(this).closest('tr').first().remove();"><i class="fa fa-times"></i></a></td>
																</tr>
															<?php $idx++;?>
															<?php endforeach;?>
														<?php endif;?>
													<?php endif;?>
												</tbody>
											</table>
										</div>
									</fieldset>
								</div>
							</div>	
							<hr />
							<div class="row">
								<div class="col-md-12">
									<button href="javascript:void(0);" id="save" class="btn btn-primary btn-flat" type="submit">
										Simpan
									</button>	
									<button type="reset" class="btn btn-danger btn-flat"  data-dismiss="modal" aria-hidden="true">
										Kembali
									</button>
								</div>
							</div>
						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</form>

<script type="text/javascript">
	var idx_row = 1;
	var sts ='<?= !empty($editstatus) ? $editstatus: ''?>';
	var iduser = '<?= $this->session->userdata('iduser');?>'
	

	$(document).ready(function(){
		$(".select2nya, .combo-invest").select2( { 'width':'100%' } );

		$("#kode_pihak").on("blur", function(){
			var kode = $('#kode_pihak').val();
			$.post(host+'pengajuan-master-display/cek_kode_pihak', { 'kode_pihak':$('#kode_pihak').val(),'iduser':iduser, [csrf_token]:csrf_hash }, function(resp1){
				if(resp1){
					parsing_cek = JSON.parse(resp1)
					console.log(parsing_cek);
					if(parsing_cek.total != 0){
						$.messager.alert('SMART AIP','Kode Pihak '+kode+' Sudah digunakan !','warning'); 
						$('#kode_pihak').val('');
						return false;

					}
				}
			});
		});

		$("#nama_pihak").on("blur", function(){
			var kode = $('#nama_pihak').val();
			$.post(host+'pengajuan-master-display/cek_nama_pihak', { 'nama_pihak':$('#nama_pihak').val(),'iduser':iduser, [csrf_token]:csrf_hash }, function(resp1){
				if(resp1){
					parsing_cek = JSON.parse(resp1)
					console.log(parsing_cek);
					if(parsing_cek.total != 0){
						$.messager.alert('SMART AIP','Nama Pihak '+kode+' Sudah digunakan !','warning'); 
						$('#nama_pihak').val('');
						return false;

					}
				}
			});
		});

		$('.group').on('change', function(){
			$.post(host+'pengajuan-master-display/data_jenis_invest2', { 'group':$(this).val(),'iduser':$('.iduser').val(), [csrf_token]:csrf_hash }, function(resp){
				if(resp){
					invest = resp;
					console.log(invest);
				}
			});
			
		});

	});

	
	// form action
	var rulesnya = {
		iduser : "required",
		kode_pihak : "required",
		nama_pihak : "required",
		keterangan : "required",
		group : "required",
		
	};

	var messagesnya = {
		iduser : "<i style='color:red'>Harus Diisi</i>",
		kode_pihak : "<i style='color:red'>Harus Diisi</i>",
		nama_pihak : "<i style='color:red'>Harus Diisi</i>",
		keterangan : "<i style='color:red'>Harus Diisi</i>",
		group : "<i style='color:red'>Harus Diisi</i>",
		
	}

	$( "#form_<?=$acak;?>" ).validate( {
		rules: rulesnya,
		messages: messagesnya,
		submitHandler: function(form) {
			$.LoadingOverlay("show");
			submit_form('form_<?=$acak;?>',function(r){
				if(r==1){ 
					$.messager.alert('SMART AIP','Data Tersimpan','info'); 
					$('#cancel').trigger('click');
					setTimeout(function(){
						window.location = host+'pengajuan-nama-pihak';
					}, 2000);
				}else{ 
					$.messager.alert('SMART AIP','Proses Simpan Data Gagal '+r,'warning'); 
				}
				$.LoadingOverlay("hide", true);
			});
		
		},
		errorPlacement: function(error, element) {
	        var name = element.attr('name');
	        var errorSelector = '.validation_error_message[for="' + name + '"]';
	        var $element = $(errorSelector);
	        if ($element.length) { 
	            $(errorSelector).html(error.html());
	        } else {
	            error.insertAfter(element);
	        }
	    }
	} );

	$('.tambah_detail').on('click', function(){
		if($('.group').val() == ""){
			$.messager.alert('SMART AIP','Pilih Group Investasi Terlebih Dahulu!','warning'); 
			return false;
		}else{
			// alert("tambah baris");
			tambah_row('form_master_nama_pihak');
		}
	});


</script>