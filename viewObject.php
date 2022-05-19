<?php

include('settings.php');
include('bot_lib.php');

if (!isset($_SESSION['usersname'])) {
  header("location: index.php");
}

if(isset($_GET['text'])){  
  $text = $_GET['text'];  
}
if(isset($_GET['id_object'])){  
    $id_object = $_GET['id_object'];  
  }

$count = registredObjectCount($connect);


// $agents_all = agents_all($connect);



?>





<!doctype html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/sidebars.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 0px;
}

#customers tr:nth-child(even){background-color: white;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 0px;
  padding-left:2px;
  padding-bottom: 0px;
  text-align: left;
  background-color: #f8f9fa;
  color: black;
}
</style>


<title>Gstrategy</title>
</head>

  <body>
      

     
  <main>
    
  <?php include 'partSite/leftSite.php'; ?>
    
      
    
<div class="container" style="overflow-x: auto;">
<?php

function select_object($connect, $id_object){
    $query = "SELECT * FROM main_tbl WHERE id = $id_object";
    $result = mysqli_query($connect, $query);
    if(!$result) return false;
    $filename = mysqli_fetch_assoc($result);
    return $filename;
}  
$object = select_object($connect, $id_object);

// echo $object['region'].'<br>';
// echo $object['quarter'].'<br>';
// echo $object['street'].'<br>';

?>


    <div style="width: 100%; height: 9%; background-color: #Eaf7f2;"> 
      <span style="position: relative;display: inline-block;font-size: 18px;padding: 13px 0 0 10px;border-left-width: 10px;">
        <i class="fa fa-database" aria-hidden="true">
        Посмотреть объект <span><?php echo 'ID:'.$object['id']; ?></span>
        </i>
      </span><br>
    </div>
 


    <div>
        <a href="main.php">
        <button type="button" class="btn btn-outline-danger" style="margin: 15px 0px 15px 23px;">
        <i class="fa fa-times" aria-hidden="true"></i>
            Закрыт
        </button>
        </a>
      
    </div>


<form action="/action_page.php">
  <div style="display:inline-block;position: absolute;width:50%;">
    <span style="margin-left:10px;"> 1 </span><input readonly="readonly" required type="text" name="phone_number_owner" value="<?php echo $object['phone_number_owner']?>"> <label for="phone_number_owner">Номер телефона</label><br>
    <span style="margin-left:10px;"> 2 </span><input readonly="readonly" required type="text" name="ownerName" value="<?php echo $object['ownerName']?>"> <label for="ownerName">Имя владельца</label><br>
    <span style="margin-left:10px;"> 3 </span><input readonly="readonly" required type="text" name="startingPrice" value="<?php echo $object['startingPrice']?>"> <label for="startingPrice">Стартовая цена($)</label><br>
    <span style="margin-left:10px;"> 4 </span><input readonly="readonly" required type="text" name="startingPrice" value="<?php echo $object['quadrature']?>"> <label for="startingPrice">Общая площадь(м2)</label><br>
    <span style="margin-left:10px;"> 5 </span><input readonly="readonly" required type="text" name="section" value="<?php echo $object['section']?>"> <label for="section">Раздел</label><br>
    <span style="margin-left:10px;"> 6 </span><input readonly="readonly" required type="text" name="typeOfHouse" value="<?php echo $object['typeOfHouse']?>"> <label for="typeOfHouse">Тип дома</label><br>
    <span style="margin-left:10px;"> 7 </span><input readonly="readonly" required type="text" name="locations" value="<?php echo $object['locations']?>"> <label for="locations">Расположение</label><br>
    <span style="margin-left:10px;"> 8 </span><input readonly="readonly" required type="text" name="commercial" value="<?php echo $object['commercial']?>"> <label for="commercial">Тип недвижимости</label><br>
    <span style="margin-left:10px;"> 9 </span><input readonly="readonly" required type="text" name="area" value="<?php echo $object['area']?>"> <label for="area">Тип земля</label><br>
    <span style="margin-left:10px;"> 10 </span><input readonly="readonly" required type="text" name="region" value="<?php echo $object['region']?>"> <label for="region">Район</label><br>
    11 <input readonly="readonly" required type="text" name="quarter" value="<?php echo $object['quarter']?>"> <label for="quarter">Кватал</label><br>
    12 <input readonly="readonly" required type="text" name="street" value="<?php echo $object['street']?>"> <label for="street">Улица</label><br>
    13 <input readonly="readonly" required type="text" name="number_of_rooms" value="<?php echo $object['number_of_rooms']?>"> <label for="number_of_rooms">Кол-во комнат</label><br>
    14 <input readonly="readonly" required type="text" name="floor" value="<?php echo $object['floor']?>"> <label for="floor">Этаж</label><br>
    15 <input readonly="readonly" required type="text" name="number_of_floors" value="<?php echo $object['number_of_floors']?>"> <label for="number_of_floors">Этаж-сть</label><br>
    16 <input readonly="readonly" required type="text" name="balcony" value="<?php echo $object['balcony']?>"> <label for="balcony">Балкон</label><br>
    17 <input readonly="readonly" required type="text" name="bath_toilet" value="<?php echo $object['bath_toilet']?>"> <label for="bath_toilet">Сан.узел</label><br>
    18 <input readonly="readonly" required type="text" name="state_repair" value="<?php echo $object['state_repair']?>"> <label for="state_repair">Состояние/ремонт</label><br>
    19 <input readonly="readonly" required type="text" name="type_of_walls" value="<?php echo $object['type_of_walls']?>"> <label for="type_of_walls">Тип стоения</label><br>
</div>
<div style="display:inline-block;position: absolute;width:50%;margin-left: 438px;">
    20 <input readonly="readonly" required type="text" name="layout" value="<?php echo $object['layout']?>"> <label for="layout">Планировка</label><br>
    21 <input readonly="readonly" required type="text" name="type_of_building" value="<?php echo $object['type_of_building']?>"> <label for="type_of_building">Тип постройки</label><br>
    22 <input readonly="readonly" required type="text" name="end_face" value="<?php echo $object['end_face']?>"> <label for="end_face">Торец</label><br>
    23 <input readonly="readonly" required type="text" name="furniture" value="<?php echo $object['furniture']?>"> <label for="furniture">Мебел</label><br>
    24 <input readonly="readonly" required type="text" name="technic" value="<?php echo $object['technic']?>"> <label for="technic">Техника</label><br>
    25 <input readonly="readonly" required type="text" name="conditioner" value="<?php echo $object['conditioner']?>"> <label for="conditioner">Кондиционер</label><br>
    26 <input readonly="readonly" required type="text" name="plast_window" value="<?php echo $object['plast_window']?>"> <label for="plast_window">Пластиковые окна</label><br>
    27 <input readonly="readonly" required type="text" name="distance_from_road" value="<?php echo $object['distance_from_road']?>"> <label for="distance_from_road">Удалённость от дороги</label><br>
    28 <input readonly="readonly" required type="text" name="underground" value="<?php echo $object['underground']?>"> <label for="underground">Метро</label><br>
    29 <input readonly="readonly" required type="text" name="parking" value="<?php echo $object['parking']?>"> <label for="parking">Парковка</label><br>
    30 <input readonly="readonly" required type="text" name="elevator" value="<?php echo $object['elevator']?>"> <label for="elevator">Лифт</label><br>
    31 <input readonly="readonly" required type="text" name="roof" value="<?php echo $object['roof']?>"> <label for="roof">Кырша</label><br>
    32 <input readonly="readonly" required type="text" name="last_registration" value="<?php echo $object['last_registration']?>"> <label for="last_registration">Последное оформ.</label><br>
    33 <input readonly="readonly" required type="text" name="registration" value="<?php echo $object['registration']?>"> <label for="registration">Прописка</label><br>
    34 <input readonly="readonly" required type="text" name="for_office" value="<?php echo $object['for_office']?>"> <label for="for_office">Под офис	</label><br>
    35 <input readonly="readonly" required type="text" name="exclusive_contract" value="<?php echo $object['exclusive_contract']?>"> <label for="exclusive_contract">Эксклюзивный договор</label><br>
    36 <input readonly="readonly" required type="text" name="advertisement" value="<?php echo $object['advertisement']?>"> <label for="advertisement">Рекламировать</label><br>
    37 <textarea readonly="readonly" required type="text" name="agent_description"  cols="21" rows="1" value="<?php echo $object['agent_description']?>"><?php echo $object['agent_description']?></textarea><label for="agent_description"> Описание агента</label><br>

  </div>
  


  



  
</form>



    
</div>


    
  </main>

  </body>
  <?php include 'partSite/footer.php'; ?>

</html>


