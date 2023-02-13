<?php 
$min = 0;
$mid = 0;
$max = 0;
?>
<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Bayes</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Dashboard</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Bayes</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
					 <div class="col-5 align-self-center">
					
                        <div class="customize-input float-right">
                    <button class="btn waves-effect waves-light btn-rounded btn-success text-center" data-toggle="modal" data-target="#ModalaAdd">Tambah Data</button>
				</div>
				</div>
                </div>
            </div>
			
			<div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                
 <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
					<h4 class="card-title">Data Tes</h4>
					<div class="progress-bar" role="progressbar" style="width: 100%"
                                                aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
				 <?php
            echo form_open_multipart('bayes/edit', 'role="form" class="form-horizontal"');
            ?>
				<?php foreach ($rule as $r) { ?>
				<?php 
				//Hasil
				$lolos = $this->db->select('*')->from('dataset')->where('hasil', 'Lolos')->get()->num_rows();
				$tidaklolos = $this->db->select('*')->from('dataset')->where('hasil', 'Tidak Lolos')->get()->num_rows();
				$parameterfakultaslolos = $this->db->select('*')->from('dataset')->where('fakultas', $r->fakultas)->where('hasil', 'Lolos')->get()->num_rows();
				$parameterfakultastidaklolos = $this->db->select('*')->from('dataset')->where('fakultas', $r->fakultas)->where('hasil', 'Tidak Lolos')->get()->num_rows();
				$parameteradministrasilolos = $this->db->select('*')->from('dataset')->where('administrasi', $r->administrasi)->where('hasil', 'Lolos')->get()->num_rows();
				$parameteradministrasitidaklolos = $this->db->select('*')->from('dataset')->where('administrasi', $r->administrasi)->where('hasil', 'Tidak Lolos')->get()->num_rows();
				
				?>
				<div class="row">
				<input type="number" name="id" value="<?php echo $r->id ?>" class="form-control" hidden>
				 <div class="col-3">
					<div class="form-group">
                        <label class="control-label col-xs-3" >Fakultas</label>
                        <div class="col-xs-9">
                           <input type="text" name="fakultas" value="<?php echo $r->fakultas ?>" class="form-control">
                        </div>
                    </div>
				</div>
				<div class="col-3">
					<div class="form-group">
                        <label class="control-label col-xs-3" >Administrasi</label>
                        <div class="col-xs-9">
                           <input type="text" name="administrasi" value="<?php echo $r->administrasi ?>" class="form-control">
                        </div>
                    </div>
				</div>
				<div class="col-3">
					<div class="form-group">
                        <label class="control-label col-xs-3" >Hasil</label>
                        <div class="col-xs-9">
						<?php $lolosgabung = ($lolos*$parameterfakultaslolos*$parameteradministrasilolos) + ($tidaklolos*$parameterfakultastidaklolos*$parameteradministrasitidaklolos); ?>
                           <p>Lolos = <?php echo ($lolos*$parameterfakultaslolos*$parameteradministrasilolos)/$lolosgabung;  ?>, Tidak Lolos = <?php echo ($tidaklolos*$parameterfakultastidaklolos*$parameteradministrasitidaklolos)/$lolosgabung; ?></p>
                        </div>
                    </div>
				</div>
				
				<?php } ?>
				<div class="col-12">
					<div class="form-group">
						</br>
                        <button type="submit" name="submit" class="btn btn-danger text-center" style="margin-top:7px; width:100%;">Submit</button>
                    </div>
				</div>
				<div class="col-6">
					<div class="form-group" style="text-align:center;">
						</br>
						<h4 class="card-title">Lolos</h4>
                        <input data-plugin="knob" data-width="150" data-height="150" data-min="0" data-max="1"
                                        data-fgColor="#62DF2A" data-displayPrevious=true value="<?php echo number_format((float)(($lolos*$parameterfakultaslolos*$parameteradministrasilolos)/$lolosgabung), 2, '.', '');  ?>" disabled />
							
                    </div>
				</div>
				<div class="col-6">
					<div class="form-group" style="text-align:center;">
						</br>
						<h4 class="card-title">Tidak Lolos</h4>
                       <input data-plugin="knob" data-width="150" data-height="150" data-min="0" data-max="1"
                                        data-fgColor="#768bf4" data-displayPrevious=true value="<?php echo number_format((float)(($tidaklolos*$parameterfakultastidaklolos*$parameteradministrasitidaklolos)/$lolosgabung), 2, '.', ''); ?>" disabled />
							
                    </div>
				</div>
				</div>
			</form>
		</div>
		</div>
		</div>
</div>



                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
					<h4 class="card-title">Data Set</h4>
			<div class="table-responsive">
            <table id="datatable" class="table">
                <thead>
                    <tr>
                        <th>No</th>
						<th>Fakultas</th>
						<th>Administrasi</th>
						<th>Hasil</th>
						
                    </tr>
                </thead>
		<tbody>		
		<?php 
		$no = 1;
		foreach($data as $u){ //untuk menampilkan variabel data yang diangkut dari controller
		?>
		
		<tr>  
			<td><?php echo $no++ ?></td>
			<td><?php echo $u->fakultas ?></td>
			<td><?php echo $u->administrasi ?></td>
			<td><?php echo $u->hasil ?></td>
		</tr>
		<?php } ?>
		</tbody>
            </table>
        </div>
		</div>
		</div>
		</div>
</div>
</div>             
           
<!-- MODAL ADD -->
        <div class="modal fade" id="ModalaAdd" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">TAMBAH DATA</h3>
            </div>
            <?php
            echo form_open_multipart('bayes/add', 'role="form" class="form-horizontal"');
            ?>
                <div class="modal-body">
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Fakultas</label>
                        <div class="col-xs-9">
                           <input type="text" name="fakultas" class="form-control">
                        </div>
                    </div>
					 <div class="form-group">
                        <label class="control-label col-xs-3" >Administrasi</label>
                        <div class="col-xs-9">
                           <input type="text" name="administrasi" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Hasil</label>
                        <div class="col-xs-9">
                           <input type="text" name="hasil" class="form-control">
                        </div>
                    </div>
 
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="btn_simpan">Simpan</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!--END MODAL ADD-->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
        $(function () {
            $('[data-plugin="knob"]').knob();
        });
    </script>
  
