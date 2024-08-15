<?php 
include 'config/database.php';

if(!empty($_GET['modal']))
{
	$modal = $_GET['modal'];

	#==load_modal
	if($modal == 'tambah')
	{
		?>
		<div id="modal_content" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow-y:scroll">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header bg-primary">
						<h4 class="modal-title"><b>Tambah</b> | User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					</div>
					<form action="user_proses.php?proses=tambah" method="POST" class="form-inputdata" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="card">
								<div class="card-body">
									<div class="form-group">
										<label>Nama <b class="text-danger">*</b></label>
										<input type="text" name="nama" class="form-control" placeholder="..." required>
									</div>
									<div class="form-group">
										<label>Username <b class="text-danger">*</b></label>
										<input type="text" name="username" class="form-control" placeholder="..." required>
									</div>
									<div class="form-group">
										<label>Password <b class="text-danger">*</b></label>
										<input type="password" name="password_1" class="form-control" placeholder="..." required>
									</div>
									<div class="form-group">
										<label>Ulangi Password <b class="text-danger">*</b></label>
										<input type="password" name="password_2" class="form-control" placeholder="..." required>
									</div>
								</div>
								<div class="modal-footer justify-content-between bg-gray-pudar">
									<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
									<button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Simpan</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>










	<?php
	} 
	else if($modal == 'edit') {
		$id 			= $_GET['id'];
		$sql 			= "SELECT * FROM tb_user WHERE id = '".$id."' ";
		$get_data = mysqli_query($con,$sql) or die (mysqli_error($con));
		$count 		= mysqli_num_rows($get_data);
		?>
		<div id="modal_content" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow-y:scroll">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header bg-success">
						<h4 class="modal-title"><b>Edit</b> | User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					</div>
					<div class="modal-body">
						<?php if($count == 0){ ?>
							<div class="card">
								<div class="card-body">
									<center>
										<div class="alert alert-warning"><i class="fas fa-info-circle"></i> Data tidak ditemukan</div>
									</center>
								</div>
								<div class="modal-footer justify-content-between bg-gray-pudar">
									<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
								</div>
							</div>
						<?php } ?>



						<?php 
						if($count > 0){
							$row = mysqli_fetch_array($get_data);
							?>
							<form action="user_proses.php?proses=edit" method="POST" class="form-inputdata" enctype="multipart/form-data">
								<input type="hidden" name="id" value="<?= $row['id'] ?>">
								<div class="card">
									<div class="card-body">
										<div class="form-group">
											<label>Nama <b class="text-danger">*</b></label>
											<input type="text" name="nama" class="form-control" placeholder="..." value="<?= $row['nama'] ?>" required>
										</div>
										<div class="form-group">
											<label>Username <b class="text-danger">*</b></label>
											<input type="text" name="username" class="form-control" placeholder="..." value="<?= $row['username'] ?>" required>
										</div>
									</div>
									<div class="modal-footer justify-content-between bg-gray-pudar">
										<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
										<button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Simpan</button>
									</div>
								</div>
							</form>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<!-- end -->
	<?php } ?>
<?php } ?>