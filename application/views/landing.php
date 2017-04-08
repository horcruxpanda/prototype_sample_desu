<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css') ?>"/>
	<link rel="stylesheet" href="<?php echo base_url('css/dataTables.bootstrap.min.css') ?>"/>

	<script src="<?php echo base_url('js/jquery-2.2.3.min.js') ?>"></script>
	<script src="<?php echo base_url('js/bootstrap.min.js') ?>"></script>
	<script src="<?php echo base_url('js/jquery.dataTables.min.js') ?>"></script>
	<script src="<?php echo base_url('js/dataTables.bootstrap.min.js') ?>"></script>

</head>
<body>

	<a type="button" class="btn btn-lg btn-primary" href= '<?php  echo site_url('buscontroller') ?>' > BUS </a>
	<a type="button" class="btn btn-lg btn-primary" href= '<?php  echo site_url('bus_typecontroller') ?>' > BUS TYPE </a>
	<a type="button" class="btn btn-lg btn-primary" href= '<?php  echo site_url('terminalcontroller') ?>' > TERMINAL </a>

</body>
</html>