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
<div class=".container-fluid col-11 ml-5 pl-5">
	<div class="row">
		<div class="col-4">
		<table class="table table-bordered">
			<thead class="thead-dark">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Address</th>
				<th>Class</th>
				<th colspan="3" style="text-align: center;">Option</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($select->result() as $kq):{ ?>
			<tr>
				<td><?php echo $kq->id; ?></td>
				<td><?php echo $kq->nameStudent; ?></td>
				<td><?php echo $kq->address; ?></td>
				<td><?php echo $kq->name ?></td>
				<td><button type="button" class="btn btn-primary"><a href="edit/<?php echo $kq->id; ?>" style="text-decoration:none;color: snow">Edit</a></button></td>
				<td><button type="button" class="btn btn-secondary"><a href="delete/<?php echo $kq->id; ?>" style="text-decoration:none;color: snow">Delete</a></button></td>
			</tr>
				<?php
			}
			endforeach;?>
			</tbody>
		</table>
			<p><?php echo $links ?></p>
		</div>
		<div class="col-4 border border-primary p-1 ">
			<h1 style="text-align: center">Add Student</h1>
			<form action="insert" method="post">
<!--				<div class="form-group">-->
<!--					<label for="email">id</label>-->
<!--					<input type="text" class="form-control" placeholder="Enter ID" id="id" name="id">-->
<!--				</div>-->
				<div class="form-group">
					<label for="pwd">Name</label>
					<input type="text" class="form-control" placeholder="Enter name" id="namestudent" name="namestudent">
				</div>
				<div class="form-group">
					<label for="pwd">Address:</label>
					<input type="text" class="form-control" placeholder="Enter address" id="address" name="address">
				</div>
				<select name="id_class" class="custom-select">
					<option selected>Select class</option>
					<?php foreach ($cclass->result() as $kq):{ ?>
					<option value="<?php echo $kq->id?>"><?php echo $kq->name?></option>
					<?php } endforeach; ?>
				</select>
				<button type="submit" class="btn btn-primary" style="justify-items: center">Submit</button>
			</form>
			<h1 style="text-align: center">Search</h1>
			<form action="search" method="post">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Enter ID" id="id" name="keyword">
				</div>
				<button type="submit" class="btn btn-primary" style="justify-items: center" value="Search" >Search</button>
			</form>
<!--			<table class="table table-bordered">-->
<!--				<thead class="thead-dark">-->
<!--				<tr>-->
<!--					<th>ID</th>-->
<!--					<th>Name</th>-->
<!--					<th>Address</th>-->
<!--					<th>Class</th>-->
<!--				</tr>-->
<!--				</thead>-->
<!--				<tbody>-->
<!--				--><?php //foreach ($search->result() as $kq):{ ?>
<!--					<tr>-->
<!--						<td>--><?php //echo $kq->id; ?><!--</td>-->
<!--						<td>--><?php //echo $kq->nameStudent; ?><!--</td>-->
<!--						<td>--><?php //echo $kq->address; ?><!--</td>-->
<!--						<td>--><?php //echo $kq->name ?><!--</td>-->
<!--					</tr>-->
<!--					--><?php
//				}
//				endforeach;?>
<!--				</tbody>-->
<!--			</table>-->
		</div>
		<div class="col-3 ml-5 border border-primary">
			<h1 style="text-align: center">Add Class</h1>
			<form action="insert_class" method="post">
				<div class="form-group">
					<label for="pwd">Name</label>
					<input type="text" class="form-control" placeholder="Enter name" id="namestudent" name="name">
				</div>
				<button type="submit" class="btn btn-primary justify-content-center" style="justify-items: center">Submit</button>
			</form>
		<table class="table table-bordered">
			<thead class="thead-dark">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th colspan="2">Option</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($cclass->result() as $kq):{ ?>
				<tr>
					<td><?php echo $kq->id; ?></td>
					<td><?php echo $kq->name ?></td>
<!--					<td><button type="button" class="btn btn-success"><a href="edit_class/--><?php //echo $kq->id; ?><!--" style="text-decoration:none;color: snow">Edit</a></button></td>-->
					<td><button type="button" class="btn btn-secondary"><a href="delete_class/<?php echo $kq->id; ?>" style="text-decoration:none;color: snow">Delete</a></button></td>
				</tr>
				<?php
			}
			endforeach;?>
			</tbody>
		</table>
		</div>
	</div>
</div>
</body>
</html>
