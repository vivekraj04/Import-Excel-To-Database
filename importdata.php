<?php  

$connect = mysqli_connect("localhost", "root", "", "trinity");//databse connectivity
if(isset($_POST["submit"]))
{
	
 if($_FILES['file']['name'])
 {
  $filename = explode(".", $_FILES['file']['name']);
  if($filename[1] == 'csv')
  {
   $handle = fopen($_FILES['file']['tmp_name'], "r");
   while($data = fgetcsv($handle))//handling csv file 
   {
    $item1 = mysqli_real_escape_string($connect, $data[0]);  
                $item2 = mysqli_real_escape_string($connect, $data[1]);
                $item3 = mysqli_real_escape_string($connect, $data[2]);
                $item4 = mysqli_real_escape_string($connect, $data[3]);
                $item5 = mysqli_real_escape_string($connect, $data[4]);
				//insert data from CSV file 
                $query = "INSERT into marks( `Name`, `Class`,`Maths`,`Physics`,`Science`) values('$item1','$item2','$item3','$item4','$item5')";
                mysqli_query($connect, $query);
   }
   fclose($handle);
   echo "File sucessfully imported";
  }
 }
}
?>

<!DOCTYPE html>  
<html>  
<head>  
  <title>TechnoSmarter.com Tutorial</title>
</head> 
<body> 
  <form method="post" enctype="multipart/form-data">
    <label>Select CSV File:</label>
    <input type="file" name="file">
    <br>
    <input type="submit" name="submit" value="Import">
  </form>
</body>  
</html>