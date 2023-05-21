<!DOCTYPE html>
<html lang="en">
<head>
	<title>Bootstrap Example</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
</div>
<div class="container">
	<div class="row">
		<div class="col-4 border p-1">
			<h1 style="text-align: center">Update</h1>
<!--	--><?/*= base_url('update/<?php echo $edit->id ?>') */?>
			<form action="<?php echo base_url('update/'.$edit->id)?>" method="post">
				<div class="form-group">
					<label for="email">id</label>
					<input type="text" class="form-control" placeholder="Enter ID" id="id" name="id" value="<?php echo $edit->id?>" disabled>
				</div>
				<div class="form-group">
					<label for="pwd">Name</label>
					<input type="text" class="form-control" placeholder="Enter name" id="namestudent" name="namestudent" value="<?php echo $edit->nameStudent?>">
				</div>
				<div class="form-group">
					<label for="pwd">Address:</label>
					<input type="text" class="form-control" placeholder="Enter address" id="address" name="address" value="<?php echo $edit->address?>">
				</div>
				<select name="id_class" class="custom-select">
					<option selected><?php echo $edit->id_class?></option>
					<?php foreach ($cclass->result() as $kq):{ ?>
						<option value="<?php echo $kq->id?>"><?php echo $kq->name?></option>
					<?php } endforeach; ?>
				</select>
				<button type="submit" class="btn btn-primary" style="justify-items: cen">Submit</button>

			</form>
		</div>
	</div>
</div>
</body>
</html>
