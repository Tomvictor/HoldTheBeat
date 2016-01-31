<html>
<head>
<?php 
$connection=mysqli_connect("Localhost","technorip","a5e6yduje","zadmin_technorip")or die(mysql_error());
?>
</head>

<body>
<script>
function f()
{
		var x=n1.name1.value;
		var y=n1.name2.value;
		var exp=/^[a-zA-Z]{2,10}$/;
		var axp=/^[0-9]{3}$/;
		var v=true;
		if(!exp.test(x))
		{
			v=false;
			document.getElementById("error").innerHTML=<font color='red'>fill name</font>;
		}
		if(!axp.test(y))
		{
			v=false;
			document.getElementById("error").innerHTML=<font color='red'>fill num</font>;
			
		}
		
		return v;
}
</script>			
		<form name="n1" action="<?php $_SERVER['PHP_SELF']?>" onsubmit="return f()" method="POST">
		<table>
		<tr><td>USERNAME : </td><td><input type="text" name="name1"></td></tr><div id="error">
		<tr><td>Emergency Contact No : </td><td><input type="text" name="name2"></td></tr><div id="error">
		<tr><td><input type="Submit" name="sub" value="enter"></td></tr>
		</table>
		</form>
		<?php 
		if(isset($_POST["sub"])&&$_POST["sub"]=="enter")
		{
			if(isset($_POST["name1"],$_POST["name2"])&&$_POST["name1"]!=""&&$_POST["name2"]!="")
			{
				echo "<br><p>entered name is: ".$_POST['name1']."<br>Id is :" .$_POST['name2']."</p>";
		
		$query="insert into message(`name`,`phone`)values('".$_POST["name1"]."',".$_POST["name2"].")";
		mysqli_query($connection,$query)or die("error".mysql_error());
		header("Location:tom.php");
		}}
		?>
		<table border=2>
		<tr><td>Name</td><td>Id</td></tr>
		<?php 
		$t="select * from message";
		$data=mysqli_query($connection,$t)or die("errr".mysqli_error());
		
		while($row=mysqli_fetch_array($data,MYSQL_ASSOC))
		{
			?>
			<form name="fname" action="data.php" method="POST">
			<input type="hidden" name="id"  value="<?php echo $row["num"];?>">
			<tr>
			<td><?php echo $row["name"];?></td>
			<td><?php echo $row["phone"];?></td>
			<td><input type="submit"  value="Select"></td></tr>
			
			</form>
		<?php
		}
		mysqli_free_result($data);
		?>
		
		</table>
</body>
</html>