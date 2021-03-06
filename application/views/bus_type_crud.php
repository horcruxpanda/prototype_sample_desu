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
					<?php echo form_open('welcome', array('id'=>'bus_type')); ?>
					<div class="form-group hidden">
						<input type="text" name="bus_type_id" class="form-control"/>
					</div>
					<div class="form-group">
						<label>Bus Type Name</label>
						<input type="text" name="bus_type_name" class="form-control" placeholder="Sun Bus ( 30 pax )"/>
					</div>
					<button type="button" class="btn btn-primary save" onclick="save_bus_type()">Save</button>
					<button type="button" class="btn btn-success update" disabled="disabled" onclick="update_bus_type()">Update</button>
					<?php echo form_close(); ?>
				</div>
			</div>
			<div class="container">
				<div class="col-md-12">
					<h3 class="page-header">Bus Type Data</h3>
					<table id="bus_type_data" class="table table-hover">
						<thead>
							<tr>
								<th>BUS ID</th>
								<th>BUS TYPE NAME</th>
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

			////////////////////////////////////////////////////////////////
			//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
			////////////////////////////////////////////////////////////////

			// C R E A T E
			function save_bus_type() {
				$.ajax({
					url: "<?php echo site_url('bus_typecontroller/saveBusType') ?>",
					type: 'POST',
					dataType: 'json',
					data: $('#bus_type').serialize(),
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

			// R E A D
			$("#bus_type_data").DataTable({
				"ajax":{
					"url":"<?php echo site_url('bus_typecontroller/show_Bus_Type') ?>",
					"type":"POST"
				}
			})

			// U P D A T E
			function edit_bus_type(bus_type_id) {
				$.ajax({
					url: "<?php echo site_url('bus_typecontroller/edit_Bus_Type') ?>",
					type: 'POST',
					dataType: 'json',
					data: 'bus_type_id='+bus_type_id,
					encode:true,
					success:function (data) {
						$('.save').attr('disabled', true);
						$('.update').removeAttr('disabled');
						$('input[name="bus_type_id"]').val(data.bus_type_id);
						$('input[name="bus_type_name"]').val(data.bus_type_name);
					}
				})
			}

			function update_bus_type() {
				$.ajax({
					url: "<?php echo site_url('bus_typecontroller/updateBusType') ?>",
					type: 'POST',
					dataType: 'json',
					data: $('#bus_type').serialize(),
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

			// D E L E T E
			function delete_bus_type(bus_type_id) {
				if(confirm('Do you really want to delete this Bus Type Record ??')){
					$.ajax({
						url: "<?php echo site_url('bus_typecontroller/delete_Bus_Type/') ?>",
						type: 'POST',
						dataType: 'json',
						data: 'bus_type_id='+bus_type_id,
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

			////////////////////////////////////////////////////////////////
			// E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
			////////////////////////////////////////////////////////////////

			// END OF BUS TYPE JAVASCRIPT
		</script>	
		
	</body>

</html>