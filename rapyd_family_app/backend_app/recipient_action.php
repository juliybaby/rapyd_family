
<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
//set_time_limit(300);





// this if line statement below is important otherwise the progressbar will not work perfectly
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

$file_content = strip_tags($_POST['file_fname']);
//$username1 = strip_tags($_POST['username']);
//$username = str_replace(' ', '', $username1);

//$fullname = strip_tags($_POST['fullname']);
$email = strip_tags($_POST['email']);
$user_rank = strip_tags($_POST['department']);
$phone_no = strip_tags($_POST['phone_no']);
$mt_id=rand(0000,9999);
$dt2=date("Y-m-d H:i:s");
$ipaddress = strip_tags($_SERVER['REMOTE_ADDR']);
$username = md5(uniqid());

$salary = strip_tags($_POST['salary1']);
$creator_id = strip_tags($_POST['creator_id']);

$first_name = strip_tags($_POST['first_name']);
$last_name = strip_tags($_POST['last_name']);


$fullname = "$last_name $first_name";


$ux_wallets = strip_tags($_POST['ux_wallets']);





$b_name = strip_tags($_POST['b_name']);
$b_address = strip_tags($_POST['b_address']);
$b_email = strip_tags($_POST['b_email']);
$b_country = strip_tags($_POST['b_country']);
$b_city = strip_tags($_POST['b_city']);
$b_postcode = strip_tags($_POST['b_postcode']);
$b_account_number = strip_tags($_POST['b_account_number']);
$bank_name = strip_tags($_POST['bank_name']);
$b_state = strip_tags($_POST['b_state']);
$b_identification_type = strip_tags($_POST['b_identification_type']);
$b_identification_value = strip_tags($_POST['b_identification_value']);
$b_bic_swift = strip_tags($_POST['b_bic_swift']);
$b_ach_code = strip_tags($_POST['b_ach_code']);
$b_beneficiary_country = strip_tags($_POST['b_beneficiary_country']);
$b_beneficiary_entity_type = strip_tags($_POST['b_beneficiary_entity_type']);


// honey pot spambots
$emailaddress_pot =$_POST['emailaddress_pot'];
if($emailaddress_pot !=''){
//spamboot detected.
//Redirect the user to google site

echo "<script>
window.setTimeout(function() {
    window.location.href = 'https://google.com';
}, 1000);
</script><br><br>";

exit();
}


if ($file_content == ''){
echo "<div class='alert alert-danger' id='alerts_reg'><font color=red>Files Upload is empty</font></div>";
exit();
}



if ($fullname == ''){
echo "<div class='alert alert-danger' id='alerts_reg'><font color=red>fullname Name is empty</font></div>";
exit();
}

if ($email == ''){
echo "<div class='alert alert-danger' id='alerts_reg'><font color=red>Email Address is empty</font></div>";
exit();
}

$em= filter_var($email, FILTER_VALIDATE_EMAIL);
if (!$em){
echo "<div class='alert alert-danger' id='alerts_reg'><font color=red>Email Address is Invalid</font></div>";
exit();
}

$ip= filter_var($ipaddress, FILTER_VALIDATE_IP);
if (!$ip){
echo "<div class='alert alert-danger' id='alerts_reg'><font color=red>IP Address is Invalid</font></div>";
exit();
}


$upload_path = "uploads_image/";

/* validate file names, ensures directory tranversal attack is not possible.
thus allow only alphanumeric filenames and dots

//allow alphanumeric,underscore, dot and dash
$filename_string = '../../fred_09@#H$%.exe.-png';
$fnaming = preg_replace("/[^\w-.]/", "", $filename_string);
//echo $fnaming;



//validate to ensure that it contains only aphabets or dots or both
$fstring = 'fred.png';
$fresult = preg_match("/^[a-zA-Z. ]*$/",$fstring);

if ($fresult) {
echo "good. contains only aphabets and dots<br>";
}else{
echo "bad.";
exit();
}



//validate to ensure that it contains only alphanumerics or dots or both
$fstring1 = 'fred02324.png';
$fresult1 = preg_match("/^[a-zA-Z0-9. ]*$/",$fstring1);

if ($fresult1) {
echo "good. contains only aphanumerics, dots<br>";
}else{
echo "bad.";
exit();
}


$fname1 = strip_tags($_FILES['file_content']['name']); 
$filename_string = $fname1;
$fname = preg_match("/^[a-zA-Z0-9. ]*$/",$fname1);
echo $fname;
if ($fname1) {
//echo "good. contains only aphanumerics, dots<br>";
}else{
echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>Please Rename the file. File name can be numeric, alphabetic or alphanumeric</div>";
exit();
}


*/




$filename_string = strip_tags($_FILES['file_content']['name']);
// thus check files extension names before major validations

$allowed_formats = array("PNG", "png", "gif", "GIF", "jpeg", "JPEG", "BMP", "bmp","JPG","jpg");
$exts = explode(".",$filename_string);
$ext = end($exts);

if (!in_array($ext, $allowed_formats)) { 
echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>File Formats not allowed. Only Images are allowed.<br></div>";
exit();
}




 //validate file names, ensures directory tranversal attack is not possible.
//thus replace and allowe filenames with alphanumeric dash and hy

//allow alphanumeric,underscore and dash

$fname_1= preg_replace("/[^\w-]/", "", $filename_string);

// add a new extension name to the uploaded files after stripping out its dots extension name
$new_extension = ".png";
$fname = $fname_1.$new_extension;





// for security reasons, you migh want to avoid files with more than one dot extension name
//file like fred.exe.png might contain virus. only ask the user to rename files to eg fred.png before uploads

 $fname_dot_count = substr_count($fname,".");
if($fname_dot_count >1){
echo "<div id='alertdata_uploadfiles2' class='alerts alert-danger'>
Your files <b>$filename_string</b> has <b>($fname_dot_count dot extension names)</b>
File with more than one <b>dot(.) extension name are not allowed.
you can rename and ensure it has only one dot extension eg: <b>example.png</b>
</b></div>";
exit();

}


$fsize = $_FILES['file_content']['size']; 
$ftmp = $_FILES['file_content']['tmp_name'];

//give file a random names
$filecontent_name = $username.time();
//$filecontent_name = 'fred1';


if ($fsize > 5 * 1024 * 1024) { // allow file of less than 5 mb
echo "<div id='alertdata' class='alerts alert-danger'>File greater than 5mb not allowed<br></div>";
exit();
}

// Check if file already exists
if (file_exists($upload_path . $filecontent_name.'.'.$ext)) {
echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>This uploaded File <b>$filecontent_name.$ext</b> already exist<br></div>";
exit(); 
}


$allowed_types=array(
'application/json',
'application/octet-stream',
'text/plain',
'image/gif',
    'image/jpeg',
    'image/png',
'image/jpg',

'image/GIF',
    'image/JPEG',
    'image/PNG',
'image/JPG'
);



if ( ! ( in_array($_FILES["file_content"]["type"], $allowed_types) ) ) {
  echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>Only Images are allowed bro..<br><br></div>";
exit();
}



// Calling getimagesize() function 
//$image_info = getimagesize("team1.png"); 
//print_r($image_info); 

$image_info =getimagesize($_FILES['file_content']['tmp_name']);

    $width = $image_info[0];
    $height = $image_info[1];
    $mime_image = $image_info['mime'];
/*
//validate file dimension eg 400 by 250
if ($width > "400" || $height > "250") {
       echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>file upload dimension must not be more than 400(width) by 250(height)</div>";
exit();

}
*/


// check file validation using getimagesizes
 if ($image_info === FALSE) {
           echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>cannot determine the image type</div>";
exit();
        }



if ( ! ( in_array($mime_image, $allowed_types) ) ) {
  echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>Only Image types are allowed..<br><br></div>";
exit();
}



if (($image_info[2] !== IMAGETYPE_GIF) && ($image_info[2] !== IMAGETYPE_JPEG) && ($image_info[2] !== IMAGETYPE_PNG)) {
           echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>only image format gif,jpg, png are allowed..</div>";
exit();
        }





//validate image using file info  method
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $_FILES['file_content']['tmp_name']);

if ( ! ( in_array($mime, $allowed_types) ) ) {
  echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>Only Images are allowed...<br></div>";
exit();
}
finfo_close($finfo);


include('data6rst.php');




// check if email already exist.
$result1 = $db->prepare('SELECT * FROM families where email = :email');
$result1->execute(array(':email' => $email));
$nosofrows1 = $result1->rowCount();
//if ($nosofrows1 == 1)
//if ($nosofrows1 != 0)
if ($nosofrows1 > 0)
{
echo "<br><div class='alert alert-danger'  id='alertdata_uploadfiles'><b><font color=red><b></b>This Email is already taken</font></b><br>";
exit();
}



if (move_uploaded_file($ftmp, $upload_path . $filecontent_name.'.'.$ext)) {

//insert into database
$final_filename =  $filecontent_name.'.'.$ext;
$timer = time();
include("time/now.fn");
$created_time=strip_tags($now);
$dt2=date("Y-m-d H:i:s");


$token1= md5(uniqid());
$token2 = time();
$token = $token1.$token2;
$app ='myapp';
$ewallet_reference_id= "$first_name-$last_name-$timer-$app";



// create wallets Id for the Customer starts

if($ux_wallets =='none'){  // start if statements

include('utilities.php');
$body = [
    'first_name' => "$first_name",
    'last_name' => "$last_name",
    'email' => '',
    'ewallet_reference_id' => "$ewallet_reference_id",
    'metadata' => [
        'merchant_defined' => true
    ],
    'phone_number' => '',
    'type' => 'person',
    'contact' => [
        'phone_number' => '+14155551234',
        'email' => 'johndoe@rapyd.net',
        'first_name' => "$first_name",
        'last_name' => "$last_name",
        'mothers_name' => 'Jane Smith',
        'contact_type' => 'personal',
        'address' => [
            'name' => 'John Doe',
            'line_1' => '123 Main Street',
            'line_2' => '',
            'line_3' => '',
            'city' => 'Anytown',
            'state' => 'NYAA',
            'country' => 'RU',
            'zip' => '12345',
            'phone_number' => '+14155551234',
            'metadata' => [],
            'canton' => '',
            'district' => '',
        ],
        'identification_type' => 'PA',
        'identification_number' => '1234567890',
        'date_of_birth' => '11/22/2000',
        'country' => 'RU',
        'metadata' => [
                'merchant_defined' => true
        ],
      ],
    ];


try {
    $object = make_request('post', '/v1/user', $body);
$json = json_decode(json_encode($object), true);

//$json = json_encode($object, true);


$status_success = $json['status']['status'];
$wallet_id= $json['data']['id'];
$account_status = 'ACT';

if($status_success !='SUCCESS'){
	echo "<div style='background:red;color:white;padding:10px;border-none;'>There is a Problem creating Wallets for Your Employees</div><br>";

	 print_r($json);
	 exit();
}

} catch(Exception $e) {


    echo "Error: $e";
}



if($wallet_id ==''){

echo "<script>alert('There is a Problem creating Wallets for Your Employees. Please Ensure there is Internet Connections');</script>";
echo "<div style='background:red;color:white;padding:10px;border-none;'>There is a Problem creating Wallets for Your Employees. Please Ensure there is Internet Connections</div><br>";

 //print_r($json);
	 exit();
	
}





} // close if statements
// create wallets ID for the Customer Ends



if($ux_wallets !='none'){
$wallet_id = $ux_wallets;

}



$statement = $db->prepare('INSERT INTO families
(fullname,email,photo,department,phone_no,created_time,timer,lastdate_pay,lastdate_time,payment_status,user_token,salary,creator_id,first_name,last_name,wallet_id,
b_name,b_address,b_email,b_country,b_city,b_postcode,b_account_number,bank_name,b_state,b_identification_type,b_identification_value,b_bic_swift,b_ach_code,b_beneficiary_country,b_beneficiary_entity_type)
 
                          values
(:fullname,:email,:photo,:department,:phone_no,:created_time,:timer,:lastdate_pay,:lastdate_time,:payment_status,:user_token,:salary,:creator_id,:first_name,:last_name,:wallet_id,
:b_name,:b_address,:b_email,:b_country,:b_city,:b_postcode,:b_account_number,:bank_name,:b_state,:b_identification_type,:b_identification_value,:b_bic_swift,:b_ach_code,:b_beneficiary_country,:b_beneficiary_entity_type)');

$statement->execute(array( 
':fullname' => $fullname,
':email' => $email,		
':photo' => $final_filename,
':department' => $user_rank,
':phone_no' => $phone_no,
':created_time' =>$created_time,
':timer' => $timer,
':lastdate_pay' => '00:00:00',
':lastdate_time' =>'00:00:00',
':payment_status' => 'Not Yet',
':user_token'=> $token,
':salary'=> $salary,
':creator_id'=> $creator_id,
':first_name'=> $first_name,
':last_name'=> $last_name,
':wallet_id'=> $wallet_id,

':b_name'=> $fullname,
':b_address'=> $b_address,
':b_email'=> $b_email,
':b_country'=> $b_country,
':b_city'=> $b_city,
':b_postcode'=> $b_postcode,
':b_account_number'=> $b_account_number,
':bank_name'=> $bank_name,
':b_state'=> $b_state,
':b_identification_type'=> $b_identification_type,
':b_identification_value'=> $b_identification_value,
':b_bic_swift'=> $b_bic_swift,
':b_ach_code'=> $b_ach_code,
':b_beneficiary_country'=> $b_beneficiary_country,
':b_beneficiary_entity_type'=> $b_beneficiary_entity_type


));


// update Employes Count

$result = $db->prepare('SELECT * FROM updates_data_rapyd where creator_id = :creator_id');

		$result->execute(array(
			':creator_id' => $creator_id 
    ));
$nosofrows = $result->rowCount();
$rec_List1 = $nosofrows;
if($rec_List1  == 0){
//echo "<div style='background:red;color:white;padding:10px;border:none'>You will need to create wallet First.</div>";

}

$rows = $result->fetch();
$id = $rows['id'];
$total_employee = $rows['total_employee'];
$ftotal = $total_employee + 1;

$update1 = $db->prepare('UPDATE updates_data_rapyd set total_employee=:total_employee where creator_id = :creator_id');
$update1->execute(array(
			':creator_id' => $creator_id,
			':total_employee' => $ftotal 
    ));

if($statement){

echo "<script>alert('User Created Successfully');</script>";

echo "<div id='alertdata_uploadfiles_o' class='well alerts alert-success'>User Created Successfully.
.Redirecting in a second.....<img src='loader.gif'><br></div>";

echo "<script>
window.setTimeout(function() {
    window.location.href = 'dashboard.html';
}, 1000);
</script><br><br>";

}

                } else {
echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>Your Data cannot be submitted to database.<br></div>";
                }

}


?>










