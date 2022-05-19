<?php

//get is_user
function is_user($connect, $user_id){
    $query = sprintf("SELECT * FROM agents WHERE userId='%s' limit 1", $user_id);
    $result = mysqli_query($connect, $query);
	$row = mysqli_fetch_assoc($result);
	if(mysqli_num_rows($result)==1 ){
		return 'is_user';
   }else{
  		 return 'isnot_user';
    }
    
}

//get last command
function get_last_command($connect, $user_id){
	$query = sprintf("SELECT * FROM textlog WHERE chat_id=%d order by id desc limit 1", (int)$user_id);
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	$last_data = mysqli_fetch_assoc($result);
	return $last_data;
}

//get agent infotrmation
function agents($connect, $phoneNumber){
	
    $query = sprintf("SELECT * FROM agents WHERE phoneNumber='%s' limit 1", $phoneNumber);
    $result = mysqli_query($connect, $query);
	$row = mysqli_fetch_assoc($result);
	if(mysqli_num_rows($result)==1 ){
		return 'is_agent';
   }else{
  		 return 'isnot_agnet';
    }
}
//get broker infotrmation

function brokers($connect, $phone_number_broker){
	
    $query = sprintf("SELECT * FROM broker_tbl WHERE phone_number_broker='%s' limit 1", $phone_number_broker);
    $result = mysqli_query($connect, $query);
	$row = mysqli_fetch_assoc($result);
	if(mysqli_num_rows($result)==1 ){
		return 'is_broker';
   }else{
  		 return 'isnot_broker';
    }
}
//update agent_id

function name_agent($connect, $id_agent){
	$query = "SELECT userName FROM agents WHERE userId='$id_agent'";
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$name_agent = mysqli_fetch_assoc($result);
	$name_agent = $name_agent['userName'];
	return $name_agent;
}

function writeUserId($connect, $phone_number, $user_id){
    $sql = "UPDATE agents SET userId = '$user_id' WHERE phoneNumber='$phone_number'";
	$result = mysqli_query($connect, $sql);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function update_delete_description($connect, $last_command_vars_object_id, $name_agent, $text){
    $sql = "UPDATE main_tbl SET user_name_deleted = '$name_agent', delete_description = '$text'  WHERE id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $sql);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function update_status_object($connect, $last_command_vars_object_id){
    $sql = "UPDATE main_tbl SET status_object = '1' WHERE id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $sql);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}


function regionsCount($connect) {
    $sql = "SELECT COUNT(id) FROM regions";
    $result = mysqli_query($connect,$sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}
function count_object_by_phone($connect, $phone_number_owner) {
    $sql = "SELECT COUNT(id) FROM main_tbl WHERE phone_number_owner = '$phone_number_owner'";
    $result = mysqli_query($connect,$sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
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


function get_region_id($connect, $region_name_for_id){
	$query = sprintf("SELECT id FROM regions WHERE name_region='%s'limit 1", $region_name_for_id);
    $result = mysqli_query($connect,$query);
	if(!$result) return false;
	$region_id_data = mysqli_fetch_assoc($result);
	return $region_id_data['id'];
}

function get_quarter_id($connect, $quarter_name_for_id, $last_command_vars_region_id_for_menu){
	$query = sprintf("SELECT id FROM quarters WHERE name_quarter='%s' AND id_region='%s' limit 1", $quarter_name_for_id,$last_command_vars_region_id_for_menu);
    $result = mysqli_query($connect,$query);
	if(!$result) return false;
	$quarter_id_data = mysqli_fetch_assoc($result);
	return $quarter_id_data['id'];
}


function quartersCount($connect, $get_region_id) {
    $sql = "SELECT COUNT(id) FROM quarters WHERE id_region = '$get_region_id'";
    $result = mysqli_query($connect,$sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}


function streetsCount($connect, $last_command_vars_region_id_for_menu, $get_quarter_id) {
    $sql = "SELECT COUNT(id) FROM streets WHERE id_region = '$last_command_vars_region_id_for_menu' AND id_quarter = '$get_quarter_id'";
    $result = mysqli_query($connect,$sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}

function quarters_all($connect, $get_region_id){
	$query = "SELECT * FROM quarters WHERE id_region = '$get_region_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	$n = mysqli_num_rows($result);
	$quarters_all = array();
	for ($i = 0; $i <$n; $i++){
		$row = mysqli_fetch_assoc($result);
		$quarters_all[] = $row;
	}
	return $quarters_all;
}

function streets_all($connect, $last_command_vars_region_id_for_menu, $get_quarter_id){
	$query = "SELECT * FROM streets WHERE id_region = '$last_command_vars_region_id_for_menu' AND id_quarter = '$get_quarter_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	$n = mysqli_num_rows($result);
	$streets_all = array();
	for ($i = 0; $i <$n; $i++){
		$row = mysqli_fetch_assoc($result);
		$streets_all[] = $row;
	}
	return $streets_all;
}



function create_new_object($connect, $user_id, $phone_number_owner, $name_agent)
{
	$user_id = trim($user_id);
	$phone_number_owner = trim($phone_number_owner);
	$name_agent = trim($name_agent);


	$t = "INSERT INTO main_tbl (id_agent, phone_number_owner, name_agent) VALUES ('%s', '%s', '%s')";
	
	$query = sprintf($t, mysqli_real_escape_string($connect, $user_id),
						 mysqli_real_escape_string($connect, $phone_number_owner),
						 mysqli_real_escape_string($connect, $name_agent)	
						);
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}

function select_new_obj_id($connect, $user_id){
	$query = "SELECT id FROM main_tbl WHERE id_agent = '$user_id' ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($connect, $query);
	$rows = mysqli_fetch_row($result);
	if(!$result)
		die(mysqli_error($connect));
	return $rows[0];
}
function insert_name($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET ownerName = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}

function insert_starting_price($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET startingPrice = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_quadrature($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET quadrature = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_section($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET section = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_typeOfHouse($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET typeOfHouse = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_commercial($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET commercial = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_area($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET area = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}


function insert_locations($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET locations = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_balcony($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET balcony = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}

function get_last_object($connect, $user_id){
	$query = "SELECT * FROM main_tbl WHERE id_agent = '$user_id' ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_assoc($result);
	if(!$result)
		die(mysqli_error($connect));
	return $row;
}


//record text_log
function textlog($connect, $user_id, $text, $step, $vars = []) {
	$vars = serialize($vars);
	if($user_id == '') return false;
	$t = "INSERT INTO textlog (chat_id, msg, step, vars) VALUES ('%s', '%s', '%s', '%s')";
	$query = sprintf($t, mysqli_real_escape_string($connect, $user_id),
							mysqli_real_escape_string($connect, $text), 
							mysqli_real_escape_string($connect, $step), 
							mysqli_real_escape_string($connect, $vars));
	$result = mysqli_query($connect, $query);

	if(!$result)
		die(mysqli_error($connect));
	return true;				
}






function __cleanData($phoneNumber) 
{
    return preg_replace('/\D/', '', $phoneNumber);
}


//add region to main_tbl
function add_region($connect, $agent_id, $region){

	// bot("sendMessage", ['chat_id' => $agent_id, 'text' => var_export($region ,1)]);
	// exit();
	
		$agent_id = trim($agent_id);
		$region = trim($region);

		$t = "INSERT INTO main_tbl (id_agent, region) VALUES ('%s', '%s')";

		
		$query = sprintf($t, mysqli_real_escape_string($connect, $agent_id),
							mysqli_real_escape_string($connect, $region));
		$result = mysqli_query($connect, $query);
		if(!$result)
			die(mysqli_error($connect));
		return true;
}

function delete_unsaved_object($connect, $user_id){
	$query = "DELETE FROM main_tbl WHERE id_agent = '$user_id' ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}

function save_object($connect, $user_id, $last_command_vars_object_id){
	$query = "UPDATE main_tbl SET check_over_object = '1' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}

function insert_region($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET region = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}

function insert_quarter($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET quarter = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}

function insert_landmark($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET landmark = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}

function insert_street($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET street = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_number_of_floors($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET number_of_floors = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}

function insert_floors($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET floor = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_number_of_rooms($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET number_of_rooms = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_bath($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET bath_toilet = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_state_repair($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET state_repair = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}


function insert_type_of_walls($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET type_of_walls = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}

function insert_layout($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET layout = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_type_of_building($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET type_of_building = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_end_face($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET end_face = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_furniture($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET furniture = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_technic($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET technic = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_conditioner($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET conditioner = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_plast_window($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET plast_window = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_distance_from_road($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET distance_from_road = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_underground($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET underground = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_parking($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET parking = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_elevator($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET elevator = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_roof($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET roof = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_last_registration($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET last_registration = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_registration($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET registration = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_for_office($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET for_office = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_exclusive_contract($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET exclusive_contract = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}
function insert_advertisement($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET advertisement = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}

function insert_agent_description($connect, $user_id, $last_command_vars_object_id, $text){
	$query = "UPDATE main_tbl SET agent_description = '$text' WHERE id_agent='$user_id' AND id='$last_command_vars_object_id'";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}














function get_object_by_id($connect, $id_object){
	$query = sprintf("SELECT * FROM main_tbl WHERE id=%d AND status_object='0'", (int)$id_object);
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	$object_data = mysqli_fetch_assoc($result);
	return $object_data;
}

function get_object_by_phone($connect, $phone_number_owner){
	$query = sprintf("SELECT id, 
	phone_number_owner,
	region,
	quarter,
	street
	 FROM main_tbl WHERE phone_number_owner=%d", (int)$phone_number_owner);
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

function add_phone_number_broker($connect, $user_id, $phone_number_broker, $name_agent){
	$user_id = trim($user_id);
	$phone_number_broker = trim($phone_number_broker);
	$name_agent = trim($name_agent);


	$t = "INSERT INTO broker_tbl (id_agent, phone_number_broker, name_agent) VALUES ('%s', '%s', '%s')";
	
	$query = sprintf($t, mysqli_real_escape_string($connect, $user_id),
						 mysqli_real_escape_string($connect, $phone_number_broker),
						 mysqli_real_escape_string($connect, $name_agent)
						);
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}

