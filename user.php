<div class="content-header">
	<div class="container-fluid">
		<h1 class="m-0">User</h1>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<section class="col-lg-12 connectedSortable">
				<div class="card">
					<div class="card-body">
						<button type="button" id="tambah_button" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</button>
						<hr>
						<div class="table-responsive">
							<table class="table table-sm table-bordered datatables-1">
								<thead>
									<tr>
										<th style="text-align: center;">NO</th>
										<th>NAMA</th>
										<th>USERNAME</th>
										<th style="text-align: center;">AKSI</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sql        = "SELECT * FROM tb_user ORDER BY nama ASC ";
									$get_data   = mysqli_query($con, $sql) or die (mysqli_error($con));

									if(mysqli_num_rows($get_data) > 0)
									{
										$no = 1;
										while($row = mysqli_fetch_array($get_data))	
										{
											?>
											<tr>
												<td align="center"><?= $no ?></td>
												<td><?= $row['nama'] ?></td>
												<td><?= $row['username'] ?></td>
												<td align="center">
													<button type="button" onclick="edit_data('<?= $row['id'] ?>')" id="edit_button_<?= $row['id'] ?>" class="btn btn-sm btn-success"><i class="fas fa-edit"></i> Edit</button>

													<a href="user_proses.php?proses=hapus&id=<?= base64_encode($row['id']) ?>" onclick="return confirm('Apakah anda yakin angin menghapus user: <?= $row['nama'] ?>')">
														<button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
													</a>
												</td>
											</tr>
											<?php 
											$no++;
										}
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</section>
<script>
	$('#tambah_button').click(function() 
	{
		$('#tambah_button').html('<i class="fas fa-spinner fa-pulse"></i> Loading..');
		$('#tambah_button').prop('disabled', true);

		$('#div_modal').load('user_modal.php?modal=tambah', function( response, status, xhr ) {
			if(status == 'success'){
				setTimeout(function() { 
					$('#modal_content').modal({
						backdrop: 'static',
						keyboard: false
					});
					$('#modal_content').modal('show');
					$('#tambah_button').html('<i class="fas fa-plus"></i> Tambah');
					$('#tambah_button').prop('disabled', false);
				}, 200);
			}
			else{
				alert(response);
			}
		});
	});

	function edit_data(id)
	{
		$('#edit_button_'+id).html('<i class="fas fa-spinner fa-pulse"></i> Loading..');
		$('#edit_button_'+id).prop('disabled', true);

		$('#div_modal').load('user_modal.php?modal=edit&id='+id, function( response, status, xhr ) {
			if(status == 'success'){
				setTimeout(function() { 
					$('#modal_content').modal({
						backdrop: 'static',
						keyboard: false
					});
					$('#modal_content').modal('show');
					$('#edit_button_'+id).html('<i class="fas fa-edit"></i> Edit');
					$('#edit_button_'+id).prop('disabled', false);
				}, 200);
			}
			else{
				alert(response);
			}
		});
	};
</script>