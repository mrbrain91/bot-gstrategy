<?php  

include('settings.php');
$output = '';

$query = "SELECT * FROM main_tbl WHERE status_object='0'";
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
    <tr> 
      <th>ИД</th>
      <th>Т/Н объекта</th>
      <th>Район</th>
      <th>Квартал</th>
      <th>К-во комнат</th>
      <th>Этаж</th>
      <th>Этаж-ть</th>
      <th>S общ(м2)</th>
      <th>Балкон</th>
      <th>Сан.узел</th>
      <th>Состояние/ремонт</th>
      <th>Тип стоения</th>
      <th>Планировка</th>
      <th>Тип постройки</th>
      <th>Торец</th>
      <th>Стартовая цена</th>
      <th>Мебель</th>
      <th>Техника</th>
      <th>Кондиционер</th>
      <th>Кухня(м2)</th>
      <th>Пластиковые окна</th>
      <th>Высота потолков</th>
      <th>Удалённость от дороги</th>
      <th>Метро</th>
      <th>Источник</th>
      <th>Дата создания</th>
      <th>Даза обзвона</th>
      <th>Информатор</th>
      <th>Перепланировка</th>
      <th>Парковка</th>
      <th>Описание агента</th>
      <th>Лифт</th>
      <th>Кырша</th>
      <th>Прописка</th>
      <th>Под офис</th>
      <th>Эксклюзивный договор</th>
    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
      <td>'.$row['id'].'</td>
      <td>'.$row['phone_number_owner'].'</td>
      <td>'.$row['region'].'</td>
      <td>'.$row['quarter'].'</td>
      <td>'.$row['number_of_rooms'].'</td>
      <td>'.$row['floor'].'</td>
      <td>'.$row['number_of_floors'].'</td>
      <td>'.$row['quadrature'].'</td>
      <td>'.$row['balcony'].'</td>
      <td>'.$row['bath_toilet'].'</td>
      <td>'.$row['state_repair'].'</td>
      <td>'.$row['type_of_walls'].'</td>
      <td>'.$row['layout'].'</td>
      <td>'.$row['type_of_building'].'</td>
      <td>'.$row['end_face'].'</td>
      <td>'.$row['startingPrice'].'</td>
      <td>'.$row['furniture'].'</td>
      <td>'.$row['technic'].'</td>
      <td>'.$row['conditioner'].'</td>
      <td>'.$row['kitchen'].'</td>
      <td>'.$row['plast_window'].'</td>
      <td>'.$row['ceiling_height'].'</td>
      <td>'.$row['distance_from_road'].'</td>
      <td>'.$row['underground'].'</td>
      <td>'.$row['source'].'</td>
      <td>'.$row['create_date'].'</td>
      <td>'.$row['create_date'].'</td>
      <td>'.$row['informator'].'</td>
      <td>'.$row['redevelopment'].'</td>
      <td>'.$row['parking'].'</td>
      <td>'.$row['agent_description'].'</td>
      <td>'.$row['elevator'].'</td>
      <td>'.$row['roof'].'</td>
      <td>'.$row['last_registration'].'</td>
      <td>'.$row['for_office'].'</td>
      <td>'.$row['exclusive_contract'].'</td>
    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=base.xls');
  echo $output;
 }

 ?> 



