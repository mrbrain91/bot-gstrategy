<?php

include('settings.php');
include('bot_lib.php');

if (!isset($_SESSION['usersname'])) {
  header("location: index.php");
}
if(isset($_GET['text'])){  
  $text = $_GET['text'];  
}
$count = regionsCount($connect);

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
        <a href="https://gstrategy.galaxytest.xyz/add_region.php">
          <button class="mt-2 btn btn-success">
          <i class="fa fa-plus" aria-hidden="true"></i>
            Добавить район
          </button>
        </a>
    </div>

    <!-- agents list -->

    <?php
        $query = "SELECT * FROM regions";
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
              <th style="width:6%">Ид</th>
              <th style="width:47%">Название района</th>
              <th style="width:47%">Добавьте квартал и улицу</th>
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
            <td><?php echo $row["name_region"]; ?></td> 
            <td>
                <a href="quarters.php?id_region=<?=$row["id"]?>&&name_region=<?=$row["name_region"]?>" role="button"><button class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i>
 Добавьте квартал и улицу</button></a>
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


