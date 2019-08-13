<?php
session_start();
header( 'Location: http://cs.iiests.ac.in/~arijits/ID_Generator/thankyou.php' ) ;
//header( 'Location: http://localhost/ID_Generator/thankyou.php' ) ;

$split_name=explode(".",$_FILES["profile"]["name"]);
$split_name=end($split_name);
$personName=preg_replace('/\s+/', '_',$_POST["name"]);
$imageFileType = strtolower(pathinfo($_FILES["profile"]["name"],PATHINFO_EXTENSION));
$target_file = "uploads/"."IMG_".strtolower($personName)."_".strtolower($_POST["dob"]).".".$imageFileType;
$uploadOk = 1;

/*if (file_exists($target_file))
{
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}*/

if ($_FILES["profile"]["size"] > 500000)
    $uploadOk = 0;

if($uploadOk==1)
{
	$con = mysqli_connect("localhost","btech2017","btech2017") or die ("Cannot Connect to mysql because : ".mysql_error());
	//$con = mysqli_connect("localhost","PPLab","PPRox") or die ("Cannot Connect to mysql because : ".mysql_error());

	mysqli_select_db($con, "btech2017");
	//mysqli_select_db($con, "StudentDataBase");

    $query_string="SELECT StateName FROM argasstate WHERE StCode=".$_POST["state"];
    $query=mysqli_query($con,$query_string);
    $row=mysqli_fetch_array($query);

	$query_string="INSERT INTO AS_ARG_TABLE VALUES(".
					"\""	.	$_POST["name"]								.	"\"".
					",\""	.	date("Y-m-d",strtotime($_POST["dob"]))		.	"\"".
					","		.	$_POST["yoj"]								.
					",\""	.	$_POST["course"]							.	"\"".
					",\""	.	$_POST["bloodgroup"]						.	"\"".
					",\""	.	$_POST["gender"]							.	"\"".
					",\""	.	$_POST["address"]							.	"\"".
					",SHA1(\"".	$_POST["password"]							.	"\")".
					",\""	.	$target_file								.	"\"".
					",\""	.	$row["StateName"]							.	"\"".
					",\""	.	$_POST["district"]							.	"\"".
					")";


	if($con->query($query_string)==FALSE)
	{
		$uploadOk = 0;
		// die ("Could not add entry due to : ".mysql_error());
	}
	mysqli_close($con);
}

if ($uploadOk == 0)
    $_SESSION['uploadOK']=FALSE;
else
{
    if(move_uploaded_file($_FILES["profile"]["tmp_name"],$target_file))
	{
		$_SESSION['uploadOK']=TRUE;
	}
	else
	{
		$_SESSION['uploadOK']=FALSE;
	}
}

?>
