<?php
include('settings.php');
include('bot_lib.php');
if(isset($_POST['save_agent'])){  
  $agent_name = $_POST['name_of_agent'];
  $agent_phone_number = __cleanData($_POST['phone_number_of_agent']);
  if(strlen($agent_phone_number) == 12){
    if (isset_agent_phone_number($connect, $agent_phone_number) == FALSE) {
      if ($add_agent = add_agent($connect, $agent_name, $agent_phone_number)) {
        $text = 'Успешно добавлен новый агент';
        redirect("agents.php?text=$text");
      }
    }
    else{

      $text = 'Этот номер телефона есть в базе данных';
      redirect("add_agents.php?text=$text");
    }
  }
  else{
    $text = 'Введите номер телефона: в формате (9989х ххх хх хх)';

    redirect("add_agents.php?text=$text");
  }
}
if(isset($_POST['save_region'])){  
  $region_name = $_POST['region_name'];
    if (isset_region_name($connect, $region_name) == FALSE) {
      if ($add_region = add_region($connect, $region_name)) {
        $text = 'Успешно добавлен регион';
        redirect("address_settings.php?text=$text");
      }
    }
    else{
      $text = 'Этот регион есть в базе данных';
      redirect("add_region.php?text=$text");
    }
}

if(isset($_POST['save_quarter'])){  
  if(isset($_GET['id_region'])){  
    $id_region = $_GET['id_region'];  
  }
  if(isset($_GET['name_region'])){  
    $name_region = $_GET['name_region'];  
  }


  $name_of_quarter = $_POST['name_of_quarter'];
  


    if (isset_quarter_name($connect, $name_of_quarter, $id_region) == FALSE) {
      if ($add_quarter = add_quarter($connect, $name_of_quarter, $id_region)) {
        $text = 'Успешно добавлен';
        redirect("quarters.php?text=$text&&id_region=$id_region&&name_region=$name_region");
      }
    }
    else{
      $text = 'Этот массив или квартал есть в базе данных';
      redirect("add_quarter.php?text=$text&&id_region=$id_region&&name_region=$name_region");
    }
}

if(isset($_POST['save_street'])){  
  if(isset($_GET['id_region'])){  
    $id_region = $_GET['id_region'];  
  }
  if(isset($_GET['id_quarter'])){  
    $id_quarter = $_GET['id_quarter'];  
  }
  if(isset($_GET['name_region'])){  
    $name_region = $_GET['name_region'];  
  }
  if(isset($_GET['name_quarter'])){  
    $name_quarter = $_GET['name_quarter'];  
  }



  $name_of_street= $_POST['name_of_street'];


    if (isset_street_name($connect, $name_of_street, $id_region, $id_quarter) == FALSE) {
      if ($add_street = add_street($connect, $name_of_street, $id_region, $id_quarter)) {
        $text = 'Успешно добавлен';
        redirect("street.php?text=$text&&id_region=$id_region&&id_quarter=$id_quarter&&name_region=$name_region&&name_quarter=$name_quarter");
      }
    }
    else{
      $text = 'Этот адрес есть в базе данных';
      redirect("street.php?text=$text&&id_region=$id_region&&id_quarter=$id_quarter&&name_region=$name_region&&name_quarter=$name_quarter");

    }
}

if (isset($_POST['save_edit_object'])) {
  $id_object = $_GET['id_edit_object'];  
  
  $phone_number_owner = $_POST['phone_number_owner'];
  $ownerName = $_POST['ownerName'];
  $startingPrice = $_POST['startingPrice'];
  $quadrature = $_POST['quadrature'];
  $section = $_POST['section'];
  $typeOfHouse = $_POST['typeOfHouse'];
  $locations = $_POST['locations'];
  $commercial = $_POST['commercial'];
  $area = $_POST['area'];
  $region = $_POST['region'];
  $quarter = $_POST['quarter'];
  $street = $_POST['street'];
  $number_of_rooms = $_POST['number_of_rooms'];
  $floor = $_POST['floor'];
  $number_of_floors = $_POST['number_of_floors'];
  $balcony = $_POST['balcony'];
  $bath_toilet = $_POST['bath_toilet'];
  $state_repair = $_POST['state_repair'];
  $type_of_walls = $_POST['type_of_walls'];
  $layout = $_POST['layout'];
  $type_of_building = $_POST['type_of_building'];
  $end_face = $_POST['end_face'];
  $furniture = $_POST['furniture'];
  $technic = $_POST['technic'];
  $conditioner = $_POST['conditioner'];
  $plast_window = $_POST['plast_window'];
  $distance_from_road = $_POST['distance_from_road'];
  $underground = $_POST['underground'];
  $parking = $_POST['parking'];
  $elevator = $_POST['elevator'];
  $roof = $_POST['roof'];
  $last_registration = $_POST['last_registration'];
  $registration = $_POST['registration'];
  $for_office = $_POST['for_office'];
  $exclusive_contract = $_POST['exclusive_contract'];
  $advertisement = $_POST['advertisement'];
  $agent_description = $_POST['agent_description'];

  if (
    update_object($connect, $id_object,
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
    )
    
    ) {
    $text = 'Успешно редактирован ID: '.$id_object;

    


    redirect("main.php?text=$text");
  }else{
    echo 'something wrong';
  }
}



if(isset($_GET['id_object'])){ // delete agent
  $id_object =  $_GET['id_object']; 
  if (delete_object($connect,$id_object)) {
    $text = 'Успешно удален объект';
    redirect("main.php?text=$text");
  }
}






?>