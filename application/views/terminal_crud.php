<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8">
		<title><?php echo $title; ?></title>

		<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css') ?>"/>
		<link rel="stylesheet" href="<?php echo base_url('css/dataTables.bootstrap.min.css') ?>"/>

		<script src="<?php echo base_url('js/jquery-2.2.3.min.js') ?>"></script>
		<script src="<?php echo base_url('js/bootstrap.min.js') ?>"></script>
		<script src="<?php echo base_url('js/jquery.dataTables.min.js') ?>"></script>
		<script src="<?php echo base_url('js/dataTables.bootstrap.min.js') ?>"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZWe4gOwsSV0uNIKkrwvzjbVg15adxrvw&libraries=places" type="text/javascript"></script>

		<style type="text/css">
			body
			{
				padding-top: 50px;
			}
			#map-canvas{
				width: 100%;
				height: 400px;
			}
			.table-canvas{
				width: 100%;
				height: 200px;
			}
		</style>

	</head>
	
	<body>

		<div id="main-cont" class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Search Map</label>
						<input type="text" id="mapsearch" name="mapsearch" class="form-control"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div id="map-canvas"> </div>

					<div id="terminal-message"></div>
					<?php echo form_open('welcome', array('id'=>'terminal')); ?>
					<div class="form-group hidden">
						<input type="text" name="terminal_id" class="form-control"/>
					</div>
					<div class="form-group hidden">
						<input type="text" name="latitude" id="lat" value="14.58738368298855" class="form-control"/>
					</div>
					<div class="form-group hidden">
						<input type="text" name="longitude" id="lng" value="120.98392539999998" class="form-control"/>
					</div>
					<div class="form-group">
						<label>Terminal Name</label>
						<input type="text" name="terminal_name" class="form-control" placeholder="Ayala, Manila Terminal"/>
					</div>
					<button type="button" class="btn btn-primary save" onclick="save_terminal()">Save</button>
					<button type="button" class="btn btn-success update" disabled="disabled" onclick="update_terminal()">Update</button>
					<?php echo form_close(); ?>
				</div>
			</div>
			<div class="row">
				<div class="container">
					<div class="col-md-12">
						<h3 class="page-header">Terminal Data</h3>
						<table id="terminal_data" class="table table-hover">
							<thead>
								<tr>
									<th>TERMINAL ID</th>
									<th>TERMINAL NAME</th>
									<th>TERMINAL LAT / LONG</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">

			////////////////////////////////////////////////////////////////
			//          C  R  U  D    F  U  N  C  T  I  O  N  S           //
			////////////////////////////////////////////////////////////////

			// C R E A T E
			function save_terminal() {
				$.ajax({
					url: "<?php echo site_url('terminalcontroller/saveTerminal') ?>",
					type: 'POST',
					dataType: 'json',
					data: $('#terminal').serialize(),
					encode:true,
					success:function(data) {
						if(!data.success){
							if(data.errors){
								$('#terminal-message').html(data.errors).addClass('alert alert-danger');
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
			$("#terminal_data").DataTable({
				"ajax":{
					"url":"<?php echo site_url('terminalcontroller/show_Terminal') ?>",
					"type":"POST"
				}
			})

			// U P D A T E
			function edit_terminal(terminal_id) {
				$.ajax({
					url: "<?php echo site_url('terminalcontroller/edit_Terminal') ?>",
					type: 'POST',
					dataType: 'json',
					data: 'terminal_id='+terminal_id,
					encode:true,
					success:function (data) {
						$('.save').attr('disabled', true);
						$('.update').removeAttr('disabled');
						$('input[name="terminal_id"]').val(data.terminal_id);
						$('input[name="terminal_name"]').val(data.terminal_name);

						var xlat = data.latitude;
						var ylng = data.longitude;

						//location
						var location = new google.maps.LatLng(xlat, ylng);

						map.setCenter(location);
						marker.setPosition(location);

					}
				})
			}

			function update_terminal() {
				$.ajax({
					url: "<?php echo site_url('terminalcontroller/updateTerminal') ?>",
					type: 'POST',
					dataType: 'json',
					data: $('#terminal').serialize(),
					encode:true,
					success:function (data) {
						if(!data.success){
							$('#terminal-message').html(data.errors).addClass('alert alert-danger');
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
			function delete_terminal(terminal_id) {
				if(confirm('Do you really want to delete this Terminal Record ??')){
					$.ajax({
						url: "<?php echo site_url('terminalcontroller/delete_Terminal/') ?>",
						type: 'POST',
						dataType: 'json',
						data: 'terminal_id='+terminal_id,
						encode:true,
						success:function(data) {
							if(!data.success){
								if(data.errors){
									$('#terminal-message').html(data.errors).addClass('alert alert-danger');
								}
							}else {
								$('#terminal-message').html(data.message).addClass('alert alert-success').removeClass('alert alert-danger');
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

			////////////////////////////////////////////////////////////////
			//        G  O  O  G  L  E    M  A  P  S    A  P  I           //
			////////////////////////////////////////////////////////////////

			// Zoom Level
			var szoom = 17;

			// Map
			var map = new google.maps.Map( document.getElementById('map-canvas'),{
				center:{
					lat: 14.58738368298855,
					lng: 120.98392539999998
				},
				zoom:szoom
			});

			// Marker
			var marker = new google.maps.Marker({
				position:{
					lat: 14.58738368298855,
					lng: 120.98392539999998
				},
				map:map,
				draggable: true
			});

			// Marker Drag
			google.maps.event.addListener(marker,'dragend',function(){
				setMarker();
			});

			// Search function
			var searchBox = new google.maps.places.SearchBox(document.getElementById('mapsearch'));

			google.maps.event.addListener( searchBox, 'places_changed',function(){

				// console.log(searchBox.getPlaces());
				var places = searchBox.getPlaces();

				//bounds
				var bounds = new google.maps.LatLngBounds();
				var i,place;

				for( i=0; place = places[i]; i++ ){

					bounds.extend(place.geometry.location);
					marker.setPosition(place.geometry.location);

				}

				setMarker();

				map.fitBounds(bounds);
				map.setZoom(szoom);
			});

			// Set Marker function
			function setMarker()
			{
				var xlatitude = marker.getPosition().lat();
				var ylongitude = marker.getPosition().lng();
				$('#lat').val(xlatitude);
				$('#lng').val(ylongitude);
			}

			////////////////////////////////////////////////////////////////
			//E  N  D    O  F    G  O  O  G  L  E    M  A  P  S    A  P  I//
			////////////////////////////////////////////////////////////////

			// END OF TERMINAL JAVASCRIPT
		</script>

	</body>

</html>