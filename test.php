<?php


include('settings.php');


function regionsCount($connect) {
    $sql = "SELECT COUNT(id) FROM regions";
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

$count = regionsCount($connect);
$regions_all = regions_all($connect);


$inline_keyboard = array();
for ($i=0; $i < $count; $i++) { 
    $region = $regions_all[$i]['name_region'];
    $inline_button = array("text"=>$region,"callback_data"=>$region);
    $inline_keyboard[] = array($inline_button);
}
$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_regions = json_encode($keyboard);
print_r($keyboard);

// $inline_button1 = array("text"=>"Чиланзар1","callback_data"=>'Чиланзар1');
// $inline_button2 = array("text"=>"Чиланзар2","callback_data"=>'Чиланзар2');
// $inline_button3 = array("text"=>"Чиланзар3","callback_data"=>'Чиланзар3');

// $inline_keyboard = [[$inline_button1],[$inline_button2],[$inline_button3]];

// $keyboard=array("inline_keyboard"=>$inline_keyboard);




?>