<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<title><?php echo $title; ?></title>

		<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css') ?>"/>
		<link rel="stylesheet" href="<?php echo base_url('css/dataTables.bootstrap.min.css') ?>"/>

		<style type="text/css">
			body
			{
				padding-top: 50px;
			}
		</style>

		<script src="<?php echo base_url('js/jquery-2.2.3.min.js') ?>"></script>
		<script src="<?php echo base_url('js/bootstrap.min.js') ?>"></script>
		<script src="<?php echo base_url('js/jquery.dataTables.min.js') ?>"></script>
		<script src="<?php echo base_url('js/dataTables.bootstrap.min.js') ?>"></script>

	</head>

	<body>
		<div class="row">
			<div class="container">
				<div class="col-md-6">
					<div id="bus-message"></div>
					<?php echo form_open('welcome', array('id'=>'bus')); ?>
					<div class="form-group hidden">
						<input type="text" name="bus_id" class="form-control"/>
					</div>
					<div class="form-group">
						<label>Bus Name</label>
						<input type="text" name="bus_name" class="form-control" placeholder="Star-8 Bus 1"/>
					</div>
					<div class="form-group">
						<label>Plate Number</label>
						<input type="text" name="plate_number" class="form-control" placeholder="3D-3382"/>
					</div>
					<div class="form-group">
						<label>Description</label>
						<textarea name="bus_desc" class="form-control" cols="30" rows="7" placeholder="The SunBus carries 30 people (incl. driver) with a range of approx 120km from a single battery charge.  Available with full airconditioning and strong suspension it is designed to give the passenger a smooth, comfortible ride that will greatly enhance the commuting experience."></textarea>
					</div>
					<div class="form-group">
						<label>Bus Type</label>
						<select name="bus_type" class="form-control">
							<?php 
								foreach($bustype as $row)
								{
							?>
								<option value= <?php echo $row[0];?> >
									<?php echo $row[1]; ?>
								</option>
							<?php 
								}
							?>
						</select>
					</div>
					<button type="button" class="btn btn-primary save" onclick="save_bus()">Save</button>
					<button type="button" class="btn btn-success update" disabled="disabled" onclick="update_bus()">Update</button>
					<?php echo form_close(); ?>
				</div>
			</div>
			<div class="container">
				<div class="col-md-12">
					<h3 class="page-header">Bus Data</h3>
					<table id="bus_data" class="table table-hover">
						<thead>
							<tr>
								<th>BUS ID</th>
								<th>BUS NAME</th>
								<th>PLATE NUMBER</th>
								<th>BUS DESCRIPTION</th>
								<th>BUS TYPE</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			function save_bus() {
				$.ajax({
					url: "<?php echo site_url('buscontroller/saveBus') ?>",
					type: 'POST',
					dataType: 'json',
					data: $('#bus').serialize(),
					encode:true,
					success:function(data) {
						if(!data.success){
							if(data.errors){
								$('#bus-message').html(data.errors).addClass('alert alert-danger');
							}
						}else {
							alert(data.message);
							setTimeout(function() {
								window.location.reload()
							}, 400);
						}
					}
				})
			}

			function update_bus() {
				$.ajax({
					url: "<?php echo site_url('buscontroller/updateBus') ?>",
					type: 'POST',
					dataType: 'json',
					data: $('#bus').serialize(),
					encode:true,
					success:function (data) {
						if(!data.success){
							$('#bus-message').html(data.errors).addClass('alert alert-danger');
						}else {
							alert(data.message);
							setTimeout(function () {
								window.location.reload();
							}, 400);
						}
					}
				})
			}

			function edit_bus(bus_id) {
				$.ajax({
					url: "<?php echo site_url('buscontroller/edit_Bus') ?>",
					type: 'POST',
					dataType: 'json',
					data: 'bus_id='+bus_id,
					encode:true,
					success:function (data) {
						$('.save').attr('disabled', true);
						$('.update').removeAttr('disabled');
						$('input[name="bus_id"]').val(data.bus_id);
						$('input[name="bus_name"]').val(data.bus_name);
						$('input[name="plate_number"]').val(data.plate_number);
						$('textarea[name="bus_desc"]').val(data.bus_desc);
						$('select[name="bus_type"]').val(data.bus_type);
					}
				})
			}

			function delete_bus(bus_id) {
				if(confirm('Do you really want to delete this Bus Record ??')){
					$.ajax({
						url: "<?php echo site_url('buscontroller/delete_Bus/') ?>",
						type: 'POST',
						dataType: 'json',
						data: 'bus_id='+bus_id,
						encode:true,
						success:function(data) {
							if(!data.success){
								if(data.errors){
									$('#bus-message').html(data.errors).addClass('alert alert-danger');
								}
							}else {
								$('#bus-message').html(data.message).addClass('alert alert-success').removeClass('alert alert-danger');
								setTimeout(function() {
									window.location.reload();
								}, 400);
							}
						}
					});
				}
			}

			$("#bus_data").DataTable({
				"ajax":{
					"url":"<?php echo site_url('buscontroller/show_Bus') ?>",
					"type":"POST"
				}
			})
		</script>
	</body>
</html>