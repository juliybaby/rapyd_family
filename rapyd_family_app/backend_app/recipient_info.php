<?php


error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
//set_time_limit(300);

$id=strip_tags($_POST['uid']);
$token=strip_tags($_POST['token']);

include('settings_url.php');
$image_url1= $image_url;
require('data6rst.php');
$result = $db->prepare('SELECT * FROM families where id =:id and user_token =:user_token');
		$result->execute(array(
':id' => $id, 
':user_token' => $token
    ));
$nosofrows = $result->rowCount();
$rec_List1 = $nosofrows;


if($rec_List1  == 0){

echo "<div style='background:red;color:white;padding:10px;border:none'>This User Info Does not Exist.</div>";
}

while($v1 = $result->fetch()){

$id = $v1['id'];
$fullname = $v1['fullname'];
$email = $v1['email'];
$photo = $v1['photo'];
$department =  $v1['department'];
$timing =  $v1['timer'];
$phone_no =  $v1['phone_no'];
$salary =  $v1['salary'];
$wallet_id =  $v1['wallet_id'];
?>

<div class="col-sm-12 notify_content_css" >
<div  style="color:black;padding:10px;background:#ddd">
<div class='col-sm-6'>
<img style='max-height:140px;max-width:140px;' class='img-circle' src='<?php echo $image_url1; ?>/uploads_image/<?php echo $photo; ?>' alt='User Image'><br>
</div>

<div class='col-sm-6'>
<b>Fullname:</b> <?php echo $fullname; ?><br>
<b>Email:</b> <?php echo $email; ?><br>
<b>Contacts:</b> <?php echo $phone_no; ?><br>
<b>Family Relations:</b> <?php echo $department; ?><br>

<b style='font-size:16px;color:#800000'>Wallet Id: <?php echo $wallet_id; ?></b><br>
<span style='color:#800000;'><b>Created Time: </b> <span data-livestamp="<?php echo $timing;?>"></span></span> 
</div>

<br>

</div></div>
<?php
}
?>

