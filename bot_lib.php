<?php

/********************************************************
*  Function library

********************************************************/



/*
 Function for add users to database
*/








function redirect($address){
	header("location: $address");
}







function login($connect){

	if (isset($_POST['submit_log'])) {
		$username = trim($_POST['username']);

		$username = crypt($username, 'PASSWORD_DEFAULT');

		$pass = trim($_POST['pass']);

		$query = "SELECT * FROM admin_user WHERE username='$username'";
		$result = mysqli_query($connect, $query);

		// $n = mysqli_num_rows($result);

		if (mysqli_num_rows($result) == 0) {
			$text = 'Неправильный логин или пароль';
		}
		else{
			
			$row = mysqli_fetch_assoc($result);

			// crypt($pass, $row['password']) === $row['password']

			if (crypt($pass, $row['password']) !== $row['password']) {
			
				$text = 'Неправильный логин или пароль';
				
			}
			else{
				$_SESSION['usersname'] = $username;
				// $_SESSION['id'] = $row['id'];

				redirect('main.php');
				$text = 'success';

			}

			

		}
		return $text;


	}
}


function get_last_id($connect){

	$query = "SELECT id FROM users ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($connect, $query);
	$rows = mysqli_fetch_row($result);
	if(!$result)
		die(mysqli_error($connect));
		return $rows[0];

}


function select_cron_mess_idd($connect){
	$query = "SELECT idd FROM cron_message WHERE id=1";
	$result = mysqli_query($connect, $query);
	$rows = mysqli_fetch_row($result);
	if(!$result)
		die(mysqli_error($connect));
		return $rows[0];
}

function update_msg_last_id($connect, $get_last_id){

	$sql = "UPDATE cron_message SET idd = '$get_last_id' WHERE id=1";
	$result = mysqli_query($connect, $sql);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}



//bot
function add_user_full_name($connect, $username, $chat_id, $name, $old_id, $userFullName){
	$username = trim($username);
	$chat_id = trim($chat_id);
	$name = trim($name);
	$userFullName = trim($userFullName);


	if($chat_id == $old_id)
		return false;
	$t = "INSERT INTO users (username, chat_id, name, userFullName) VALUES ('%s', '%s', '%s', '%s')";
	$query = sprintf($t, mysqli_real_escape_string($connect, $username),
						 mysqli_real_escape_string($connect, $chat_id),
						 mysqli_real_escape_string($connect, $name),
						 mysqli_real_escape_string($connect, $userFullName));
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}


function delete_test($connect,$test_id){
	$sql = "DELETE FROM test WHERE id='$test_id'";
	$result = mysqli_query($connect, $sql);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}

function delete_agent($connect,$id_agent){

	$sql = "DELETE FROM agents WHERE id='$id_agent'";
	$result = mysqli_query($connect, $sql);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function delete_object($connect,$id_object){

	$sql = "DELETE FROM main_tbl WHERE id='$id_object'";
	$result = mysqli_query($connect, $sql);
	if(!$result)
		die(mysqli_error($connect));
	return true;	
}

function restore_object($connect,$id_object){
	$sql = "UPDATE main_tbl SET status_object='0' WHERE id='$id_object'";
	$result = mysqli_query($connect, $sql);
	if(!$result)
		die(mysqli_error($connect));
	return true;	
}

function delete_offline_subject($connect,$offline_subject_id){

	$sql = "DELETE FROM offline_subjects WHERE id='$offline_subject_id'";
	$result = mysqli_query($connect, $sql);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}

//bot
function add_user_phone_number($connect, $chat_id, $phone_number){
	$sql = "UPDATE users SET phone_number = '$phone_number' WHERE chat_id='$chat_id'";
	$result = mysqli_query($connect, $sql);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}


//bot
function get_update_userFullName($connect, $chat_id, $update_name){
	$sql = "UPDATE users SET userFullName = '$update_name' WHERE chat_id='$chat_id'";
	$result = mysqli_query($connect, $sql);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}




/*
Function INSERT DATA
*/
function add_test($connect, $test_name, $test_date, $test_start_time, $test_over_time){
    $test_name = trim($test_name);
    $test_date = trim($test_date);
    $test_start_time = trim($test_start_time);
    $test_over_time = trim($test_over_time);
    
    
    
    $t = "INSERT INTO test (test_name, test_date, start_time, over_time) VALUES ('%s', '%s', '%s', '%s')";

    $query = sprintf($t, mysqli_real_escape_string($connect, $test_name),
						mysqli_real_escape_string($connect, $test_date),
						mysqli_real_escape_string($connect, $test_start_time),
						mysqli_real_escape_string($connect, $test_over_time));
    $result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}





function add_offline_test_result($connect, $user_id, $UserName, $offline_subject_id, $offline_subject_name, $correct, $wrong){

// $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $answer . "***" . var_export($chat_id ,1)]);

    $user_id = trim($user_id);
    $username = trim($UserName);
    $offline_subject_id = trim($offline_subject_id);
    $offline_subject_name = trim($offline_subject_name);
    $correct = trim($correct);
    $wrong = trim($wrong);
    
    
    
    $t = "INSERT INTO OfflineResult (user_id, UserName, offline_subject_id, offline_subject_name, correct, wrong) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')";

    $query = sprintf($t, mysqli_real_escape_string($connect, $user_id),
						mysqli_real_escape_string($connect, $username),
						mysqli_real_escape_string($connect, $offline_subject_id),
						mysqli_real_escape_string($connect, $offline_subject_name),
						mysqli_real_escape_string($connect, $correct),
						mysqli_real_escape_string($connect, $wrong));
    $result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}


/*
Function INSERT result
*/

//bot
function add_test_result($connect, $user_id, $username, $test_id, $score, $list){

// $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $answer . "***" . var_export($chat_id ,1)]);

    $user_id = trim($user_id);
    $username = trim($username);
    $test_id = trim($test_id);
    $score = trim($score);
    $answers = trim($list);
    
    
    
    $t = "INSERT INTO result (user_id, username, test_id, score, answer) VALUES ('%s', '%s', '%s', '%s', '%s')";

    $query = sprintf($t, mysqli_real_escape_string($connect, $user_id),
						mysqli_real_escape_string($connect, $username),
						mysqli_real_escape_string($connect, $test_id),
						mysqli_real_escape_string($connect, $score),
						mysqli_real_escape_string($connect, $answers));
    $result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}



/*
Function INSERT OFFLINE SUBJECT
*/
function offline_add_subject($connect, $offline_subject_name, $offline_filenames, $offline_subject_key){
   
    $offline_subject_name = trim($offline_subject_name);
    $offline_filenames = trim($offline_filenames);
    $offline_subject_key = trim($offline_subject_key);
    
    
    
    $t = "INSERT INTO offline_subjects (offline_subject_name, offline_filenames, offline_subject_key ) VALUES ('%s', '%s', '%s')";

    $query = sprintf($t,mysqli_real_escape_string($connect, $offline_subject_name),
						mysqli_real_escape_string($connect, $offline_filenames),
						mysqli_real_escape_string($connect, $offline_subject_key));
    $result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}


/*
Function generate random string
*/

function genRanStr($length = 5) {
    return substr(str_shuffle(str_repeat($x='0123456789', ceil($length/strlen($x)) )),1,$length);
}


/*
Function INSERT SUBJECT
*/

//new 
function add_agent($connect, $agent_name, $agent_phone_number){
    $agent_name = trim($agent_name);
    $agent_phone_number = trim($agent_phone_number);
	$t = "INSERT INTO agents (userName, phoneNumber) VALUES ('%s', '%s')";

    $query = sprintf($t, mysqli_real_escape_string($connect, $agent_name),
						mysqli_real_escape_string($connect, $agent_phone_number));
    $result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}

function add_region($connect, $region_name){
    $region_name = trim($region_name);
	$t = "INSERT INTO regions (name_region) VALUES ('%s')";

    $query = sprintf($t, mysqli_real_escape_string($connect, $region_name));
    $result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}

function add_quarter($connect, $name_of_quarter, $id_region){
    $name_of_quarter = trim($name_of_quarter);
    $id_region = trim($id_region);

	$t = "INSERT INTO quarters (name_quarter, id_region) VALUES ('%s','%s')";

    $query = sprintf($t, mysqli_real_escape_string($connect, $name_of_quarter),
						 mysqli_real_escape_string($connect, $id_region));
    $result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}

function add_street($connect, $name_of_street, $id_region, $id_quarter){
    $name_of_street = trim($name_of_street);
    $id_region = trim($id_region);
    $id_quarter = trim($id_quarter);


	$t = "INSERT INTO streets (name_street, id_region, id_quarter) VALUES ('%s','%s','%s')";

    $query = sprintf($t, mysqli_real_escape_string($connect, $name_of_street),
						 mysqli_real_escape_string($connect, $id_region),
						 mysqli_real_escape_string($connect, $id_quarter));
    $result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}

/*
 Function for get users from database
*/

// BOT FUNC
function get_user($connect, $chat_id){
	$query = sprintf("SELECT * FROM users WHERE chat_id=%d", (int)$chat_id);
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	$get_user = mysqli_fetch_assoc($result);
	return $get_user;

}

/*
 Function for add text entered by user
*/
//bot
function textlog($connect, $chat_id, $text, $step, $vars = []) {
	$vars = serialize($vars);
	if($chat_id == '') return false;
	$t = "INSERT INTO textlog (chat_id, msg, step, vars) VALUES ('%s', '%s', '%s', '%s')";
	$query = sprintf($t, mysqli_real_escape_string($connect, $chat_id),
							mysqli_real_escape_string($connect, $text), 
							mysqli_real_escape_string($connect, $step), 
							mysqli_real_escape_string($connect, $vars));
	$result = mysqli_query($connect, $query);

	if(!$result)
		die(mysqli_error($connect));
	return true;				
}
/*
Function to get all agents from the database
*/

function agents_all($connect){
	$query = "SELECT * FROM agents ORDER BY id DESC LIMIT 10";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	$n = mysqli_num_rows($result);
	$agents_all = array();
	for ($i = 0; $i <$n; $i++){
		$row = mysqli_fetch_assoc($result);
		$agents_all[] = $row;
	}
	return $agents_all;
}

function name_agent($connect, $id_agent){
	$query = "SELECT userName FROM agents WHERE userId='$id_agent'";
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$name_agent = mysqli_fetch_assoc($result);
	$name_agent = $name_agent['userName'];
	return $name_agent;
}



function regions_all($connect){
	$query = "SELECT * FROM regions";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	$n = mysqli_num_rows($result);
	$regions_all = array();
	for ($i = 0; $i <$n; $i++){
		$row = mysqli_fetch_assoc($result);
		$regions_all[] = $row;
	}
	return $regions_all;
}


function users_all_for_res($connect){
	$query = "SELECT * FROM result WHERE issett_res = '' ORDER BY id DESC LIMIT 100";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	$n = mysqli_num_rows($result);

	if($n > 0){
		$users_all_for_res = array();
		for ($i = 0; $i <$n; $i++){
			$row = mysqli_fetch_assoc($result);
			$users_all_for_res[] = $row;
		}
		return $users_all_for_res;
	}else{
		return 0;
	}
}

function users_all_for_mail($connect){
	$query = "SELECT * FROM users WHERE issett = '' ORDER BY id DESC LIMIT 100";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	$n = mysqli_num_rows($result);
	$users_all_for_mail = array();
	for ($i = 0; $i <$n; $i++){
		$row = mysqli_fetch_assoc($result);
		$users_all_for_mail[] = $row;
	}
	return $users_all_for_mail;
}

function agents_all_for_mail($connect){
	$query = "SELECT * FROM agents";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	$n = mysqli_num_rows($result);
	$agents_all_for_mail = array();
	for ($i = 0; $i <$n; $i++){
		$row = mysqli_fetch_assoc($result);
		$agents_all_for_mail[] = $row;
	}
	return $agents_all_for_mail;
}


function count_send_msg($connect){
	$query = "SELECT * FROM users WHERE issett = 'yes' ";
	$result = mysqli_query($connect, $query);
	if (!$result) 
		die(mysqli_error($connect));
	$n = mysqli_num_rows($result);
	return $n;
}



function update_mailed_res($connect, $id){
	$sql = "UPDATE result SET issett_res = 'yes' WHERE id='$id'";
	$result = mysqli_query($connect, $sql);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}

function updateKey($connect, $setKey){
	$query = "UPDATE admin_user SET special_key = '$setKey' WHERE id = 1";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;	
}

function update_mailed($connect, $id){
	$sql = "UPDATE users SET issett = 'yes' WHERE id='$id'";
	$result = mysqli_query($connect, $sql);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}

function update_cron_message($connect, $text_cron_message){

	// echo $text_cron_message;
	// exit();

	$sql = "UPDATE cron_message SET cron_message = '$text_cron_message', idd = '0' WHERE id=1";
	$result = mysqli_query($connect, $sql);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}

function clear_column_issett($connect){
	
	$sql = "UPDATE users SET issett = Null";
	$result = mysqli_query($connect, $sql);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}

//ozgarish

function select_cron_time($connect){

	$query = "SELECT cron_time FROM cron_message WHERE id = 1";

	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$time = mysqli_fetch_assoc($result);
	$time = $time['cron_message'];
	return $time;
}

function select_cron_mess($connect){

	$query = "SELECT cron_message FROM cron_message WHERE id = 1";

	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$mes = mysqli_fetch_assoc($result);
	$mes = $mes['cron_message'];
	return $mes;
}




// function count_users_all($connect){

// 	$query = "SELECT * FROM users";
// 	$result = mysqli_query($connect, $query);
// 	$num_row = mysqli_num_rows($result);
// 	return $num_row;
// }



/*
Function to get all subjects from the database
*/


/*Check user id*/

//bot
function get_check_user($connect, $chat_id){
	$query = sprintf("SELECT phone_number FROM users WHERE chat_id=%d", (int)$chat_id);
	$result = mysqli_query($connect, $query);

	$row = mysqli_fetch_assoc($result);


	if(mysqli_num_rows($result)>=1  && !empty($row['phone_number'])){
		return 'is_user';
   }else{
  		 return 'not_user';
    }
}

//bot
function get_check_phone($connect, $chat_id){
	$query = sprintf("SELECT phone_number FROM users WHERE chat_id=%d", (int)$chat_id);
	$result = mysqli_query($connect, $query);

	$row = mysqli_fetch_assoc($result);


	if(empty($row['phone_number'])){
		return false;
   }else{
  		 return true;
    }
}





/**************/

//bot
function get_offline_subject($connect, $offline_subject_name){
	$query = sprintf("SELECT * FROM offline_subjects WHERE offline_subject_name='%s' limit 1", $offline_subject_name);
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$get_offline_subject = mysqli_fetch_assoc($result);
	return $get_offline_subject;
}

function get_offline_subjects_all($connect){
	$query = "SELECT * FROM offline_subjects";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	$n = mysqli_num_rows($result);
	$get_offline_subjects_all = array();
	for ($i = 0; $i <$n; $i++){
		$row = mysqli_fetch_assoc($result);
		$get_offline_subjects_all[] = $row;
	}
	return $get_offline_subjects_all;
}


function last_psw($connect){
	$query = "SELECT special_key FROM admin_user WHERE id = 1";
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$last_psw = mysqli_fetch_assoc($result);
	$last_psw = $last_psw['special_key'];
	return $last_psw;
}






function subjects_all($connect,$get_id){ 
	$query = "SELECT * FROM subjects where test_id = $get_id";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	$n = mysqli_num_rows($result);
	$subjects_all = array();
	for ($i = 0; $i <$n; $i++){
		$row = mysqli_fetch_assoc($result);
		$subjects_all[] = $row;
	}
	return $subjects_all;
}


function select_subject($connect, $subject_id){

	$query = "SELECT filenames FROM subjects WHERE id = $subject_id";
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$filename = mysqli_fetch_assoc($result);
	$filenames = $filename['filenames'];
	return $filenames;
}


function select_offline_subject($connect, $offline_subject_id){

	$query = "SELECT offline_filenames FROM offline_subjects WHERE id = $offline_subject_id";
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$offline_filenames = mysqli_fetch_assoc($result);
	$offline_filenames = $offline_filenames['offline_filenames'];
	return $offline_filenames;
}



// function delete_file($filename){

// 	unlink("uploads/".$filename."");
// }

//bot
function tests_all($connect){
	$query = "SELECT * FROM test";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	$n = mysqli_num_rows($result);
	$tests_all = array();
	for ($i = 0; $i <$n; $i++){
		$row = mysqli_fetch_assoc($result);
		$tests_all[] = $row;
	}
	return $tests_all;
}


function registredMemberCount($connect) {
    $sql = "SELECT COUNT(id) FROM agents";
    $result = mysqli_query($connect,$sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}

function registredObjectCount($connect) {
    $sql = "SELECT COUNT(id) FROM main_tbl";
    $result = mysqli_query($connect,$sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}


function regionsCount($connect) {
    $sql = "SELECT COUNT(id) FROM regions";
    $result = mysqli_query($connect,$sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}
function quartersCount($connect, $id_region) {
    $sql = "SELECT COUNT(id) FROM quarters WHERE id_region = '$id_region'";
    $result = mysqli_query($connect,$sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}
function streetsCount($connect, $id_region, $id_quarter) {
    $sql = "SELECT COUNT(id) FROM streets WHERE id_region = '$id_region' AND id_quarter= '$id_quarter'";
    $result = mysqli_query($connect,$sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}

function get_tests($connect){
	$query = "SELECT * FROM test";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	$n = mysqli_num_rows($result);
	
	return $n;
}

//bot
function get_last_command($connect, $chat_id){
	$query = sprintf("SELECT * FROM textlog WHERE chat_id=%d order by id desc limit 1", (int)$chat_id);
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	$last_data = mysqli_fetch_assoc($result);
	return $last_data;
}

//bot
function get_test_id($connect, $test_name){
	$query = sprintf("SELECT id FROM test WHERE test_name='%s'limit 1", $test_name);
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$test_data = mysqli_fetch_assoc($result);
	return $test_data['id'];
}
//bot
function get_test_date($connect, $test_name){
	$query = sprintf("SELECT test_date FROM test WHERE test_name='%s'limit 1", $test_name);
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$test_data = mysqli_fetch_assoc($result);
	return $test_data['test_date'];
}

//cron

function get_test_date_cron($connect){
	$query = sprintf("SELECT test_date FROM test limit 1");
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$test_data = mysqli_fetch_assoc($result);
	return $test_data['test_date'];
}


function get_test_over_for_cron($connect){
	$query = sprintf("SELECT over_time FROM test limit 1");
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$test_data = mysqli_fetch_assoc($result);
	return $test_data['over_time'];
}




//bot
function get_test_start($connect, $test_name){
	$query = sprintf("SELECT start_time FROM test WHERE test_name='%s'limit 1", $test_name);
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$test_data = mysqli_fetch_assoc($result);
	return $test_data['start_time'];
}





function get_test_over($connect, $test_name){
	$query = sprintf("SELECT over_time FROM test WHERE test_name='%s'limit 1", $test_name);
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$test_data = mysqli_fetch_assoc($result);
	return $test_data['over_time'];
}
//bot
function get_test_over_by_id($connect, $test_id){
	$query = sprintf("SELECT over_time FROM test WHERE id='%s'limit 1", $test_id);
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$test_data = mysqli_fetch_assoc($result);
	return $test_data['over_time'];
}
//bot
function get_subjects($connect, $test_id){
	$subjects = [];
	$query = sprintf("SELECT id, subject_name FROM subjects WHERE test_id=%d", (int)$test_id);
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	while($row = mysqli_fetch_assoc($result)) {
		$subjects[] = [$row['subject_name']];
	}
	return $subjects;
}



function offline_subjects_all($connect){
	$offline_subjects = [];
	$query = sprintf("SELECT id, offline_subject_name FROM offline_subjects");
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	while($row = mysqli_fetch_assoc($result)) {
		$offline_subjects[] = [$row['offline_subject_name']];
	}
	return $offline_subjects;
}

//bot
function get_subject($connect, $test_id, $subject_name){
	$query = sprintf("SELECT * FROM subjects WHERE subject_name='%s' and test_id=%d limit 1", $subject_name, $test_id);
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$subject = mysqli_fetch_assoc($result);
	return $subject;
}

// check if isset this subject
function isset_agent_phone_number($connect, $agent_phone_number){
	$query = sprintf("SELECT * FROM agents WHERE phoneNumber='%s' limit 1", $agent_phone_number);
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$phone_number = mysqli_fetch_assoc($result);
	if (isset($phone_number)) {
		return true;
	}else{
		return false;
	}
}

function isset_region_name($connect, $region_name){
	$query = sprintf("SELECT * FROM regions WHERE name_region='%s' limit 1", $region_name);
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$region_name = mysqli_fetch_assoc($result);
	if (isset($region_name)) {
		return true;
	}else{
		return false;
	}
}

function isset_quarter_name($connect, $name_of_quarter, $id_region){
	$query = "SELECT * FROM quarters WHERE name_quarter='$name_of_quarter' AND id_region='$id_region'";
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$quarter_name = mysqli_fetch_assoc($result);
	if (isset($quarter_name)) {
		return true;
	}else{
		return false;
	}
}

function isset_street_name($connect, $name_of_street, $id_region, $id_quarter){
	$query = "SELECT * FROM streets WHERE name_street='$name_of_street' AND id_region='$id_region' AND id_quarter='$id_quarter'";
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$street_name = mysqli_fetch_assoc($result);
	if (isset($street_name)) {
		return true;
	}else{
		return false;
	}
}


// check if isset this offline subject

function get_subject_for_add_off($connect, $offline_subject_name){
	$query = sprintf("SELECT * FROM offline_subjects WHERE offline_subject_name='%s' limit 1", $offline_subject_name);
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$offline_subject = mysqli_fetch_assoc($result);
	if (isset($offline_subject)) {
		return true;
	}else{
		return false;
	}
}


//bot
function get_result_test_id($connect, $user_id){
	$query = sprintf("SELECT * FROM result WHERE user_id=%d", (int)$user_id);
	$result = mysqli_query($connect, $query);

	$row = mysqli_fetch_assoc($result);


	if(mysqli_num_rows($result)>=1  && !empty($row['test_id'])){
		return 'isset_test';
   }else{
  		 return 'not_test';
    }
}


function get_result_all($connect){
	$query = "SELECT * FROM result";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	$n = mysqli_num_rows($result);
	$result_all = array();
	for ($i = 0; $i <$n; $i++){
		$row = mysqli_fetch_assoc($result);
		$result_all[] = $row;
	}
	return $result_all;
}



function get_result_all_by($connect){
	// $query = "SELECT * FROM result  ORDER BY CAST(`score` AS UNSIGNED) DESC"; 
	$query = "SELECT * FROM result  ORDER BY score DESC"; 

	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	$n = mysqli_num_rows($result);
	$result_all = array();
	for ($i = 0; $i <$n; $i++){
		$row = mysqli_fetch_assoc($result);
		$result_all[] = $row;
	}
	return $result_all;
}

function update_object($connect, $id_object,
$phone_number_owner,
$ownerName,
$startingPrice,
$quadrature,
$section,
$typeOfHouse,
$locations,
$commercial,
$area,
$region,
$quarter,
$street,
$number_of_rooms,
$floor,
$number_of_floors,
$balcony,
$bath_toilet,
$state_repair,
$type_of_walls,
$layout,
$type_of_building,
$end_face,
$furniture,
$technic,
$conditioner,
$plast_window,
$distance_from_road,
$underground,
$parking,
$elevator,
$roof,
$last_registration,
$registration,
$for_office,
$exclusive_contract,
$advertisement,
$agent_description
){
	$sql = "UPDATE main_tbl SET 
	phone_number_owner = '$phone_number_owner',
	ownerName = '$ownerName',
	startingPrice = '$startingPrice',
	quadrature = '$quadrature',
	section = '$section',
	typeOfHouse = '$typeOfHouse',
	locations = '$locations',
	commercial = '$commercial',
	area = '$area',
	region = '$region',
	quarter = '$quarter',
	street = '$street',
	number_of_rooms = '$number_of_rooms',
	floor = '$floor',
	number_of_floors = '$number_of_floors',
	balcony = '$balcony',
	bath_toilet = '$bath_toilet',
	state_repair = '$state_repair',
	type_of_walls = '$type_of_walls',
	layout = '$layout',
	type_of_building = '$type_of_building',
	end_face = '$end_face',
	furniture = '$furniture',
	technic = '$technic',
	conditioner = '$conditioner',
	plast_window = '$plast_window',
	distance_from_road = '$distance_from_road',
	underground = '$underground',
	parking = '$parking',
	elevator = '$elevator',
	roof = '$roof',
	last_registration = '$last_registration',
	registration = '$registration',
	for_office = '$for_office',
	exclusive_contract = '$exclusive_contract',
	advertisement = '$advertisement',
	agent_description = '$agent_description'	
	WHERE id='$id_object'";
	$result = mysqli_query($connect, $sql);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}


// function admin_user($connect, $username, $pass){

// 	$query = "SELECT * FROM admin_user WHERE username = $username";
// 	$result = mysqli_query($connect, $query);

// 	if(!$result)
// 		die(mysqli_error($connect));
// 	$n = mysqli_num_rows($result);
// 	$admin_user = array();
// 	for ($i = 0; $i <$n; $i++){
// 		$row = mysqli_fetch_assoc($result);
// 		$users_all[] = $row;
// 	}
// 	return $users_all;

// }


function __cleanData($agent_phone_number) 
{
    return preg_replace('/\D/', '', $agent_phone_number);
}






?>