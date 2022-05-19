<?php

include('settings.php');
include('bot_lib.php');

if (!isset($_SESSION['usersname'])) {
  header("location: index.php");
}
if(isset($_GET['text'])){  
  $text = $_GET['text'];  
}
if(isset($_GET['id_region'])){  
    $id_region = $_GET['id_region'];  
  }
if(isset($_GET['name_region'])){  
  $name_region = $_GET['name_region'];  
}  
$count = quartersCount($connect, $id_region);

?>





<!doctype html>
<html lang="en">
  <?php include 'partSite/header.php'; ?>

  <body>
      

     
  <main>
    
  <?php include 'partSite/leftSite.php'; ?>
    
      
    
   <div class="container" style="overflow-x: auto;">

    <div style="width: 100%; height: 9%; background-color: #Eaf7f2;"> 
      <span style="position: relative;display: inline-block;font-size: 18px;padding: 13px 0 0 10px;border-left-width: 10px;">
      <i class="fa fa-cogs" aria-hidden="true">
            настройки адреса
            </i>
      </span><br>
    </div>
    <div>
                <a href="address_settings.php">
                  <button class="mt-2 btn btn-primary">
                  <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>
                      Назад
                  </button>
                </a>
      
        </div>
    <div>
        <a href="https://gstrategy.galaxytest.xyz/add_quarter.php?id_region=<?=$id_region?>&&name_region=<?=$name_region?>">
          <button class="mt-2 btn btn-success">
          <i class="fa fa-plus" aria-hidden="true"></i>
            Добавить квартал
          </button>
        </a>
    </div>
    <div>
      <span style="position: relative; margin: 0px 0px 0px -2px;font-size: 16px;color: #1d491d;">
      Район: <?php if (isset($name_region)) {echo $name_region;}?> <br> Выберите квартал:
      </span>
    </div>


    <?php
        $query = "SELECT * FROM quarters WHERE id_region='$id_region'";
        $rs_result = mysqli_query ($connect, $query);   
    ?>

      <span style="color: #018910;display: inline-block;position: relative;margin: 15px 0px 15px 0px;">
        <?php 
        if (isset($text)) {
          echo $text;
        }?>
        </span>
        <table class="table">   
          <thead>   
            <tr>   
              <th style="width:6%">Id</th>
              <th style="width:47%">название</th>
              <th style="width:47%">входить</th>
            </tr>   
          </thead>   
          <tbody>   
    <?php     

            $i = $count;
            while ($row = mysqli_fetch_array($rs_result)) {    
                  // Display each field of the records.    
            ?>     
            <tr>     
            <td><?php echo $row["id"]; ?></td>   
            <td><?php echo $row["name_quarter"]; ?></td> 
            <td>
                <a href="street.php?id_quarter=<?=$row["id"]?>&&id_region=<?=$id_region?>&&name_region=<?=$name_region?>&&name_quarter=<?=$row["name_quarter"]?>" role="button"><button class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Добавить улицу</button></a>
            </td>  
            </tr>     
            <?php     
                };    
            ?>     
          </tbody>   
        </table>   
  

</div>


    
  </main>

  </body>
  <?php include 'partSite/footer.php'; ?>

</html>


