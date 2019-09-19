<?php  include('db_conn.php'); 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($conn, "SELECT * FROM user WHERE ID=$id");
		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$name = $n['Name'];
			$surname = $n['SurName'];
			$email = $n['Email'];
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>task1</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php if (isset($_SESSION['message'])): ?>
		<div class="msg">
			<?php 
				echo $_SESSION['message']; 
				unset($_SESSION['message']);
			?>
		</div>
	<?php endif ?>

		<?php $results = mysqli_query($conn, "SELECT * FROM user"); ?>
<table>

		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>SurName</td>
			<th>Email</th>
			<th colspan="2">Edit/Delete</th>
		</tr>


		
		<?php while ($row = mysqli_fetch_array($results)) { ?>
			<tr>
				<td><?php echo $row['ID']; ?></td>
				<td><?php echo $row['Name']; ?></td>
				<td><?php echo $row['SurName']; ?></td>
				<td><?php echo $row['Email']; ?></td>
				<td>
					<a href="index.php?edit=<?php echo $row['ID']; ?>" class="edit_btn" >Edit</a>
				</td>
				<td>
					<a href="db_conn.php?del=<?php echo $row['ID']; ?>" class="del_btn">Delete</a>
				</td>
			</tr>
		<?php } ?>
		
		
	


</table>
	<form method="post" action="db_conn.php" >
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="input-group">
			<label>Name</label>
			<input type="text" name="name" value="<?php echo $name; ?>">
		</div>
		<div class="input-group">
			<label>Surname</label>
			<input type="text" name="surname" value="<?php echo $surname; ?>">
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="text" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<?php if ($update == true): ?>
				<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
			<?php else: ?>
				<button class="btn" type="submit" name="save" >Save</button>
			<?php endif ?>
		</div>
	</form>
</body>
</html>