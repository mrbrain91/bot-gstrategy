<?php

include('settings.php');
include('bot_lib.php');

if (!isset($_SESSION['usersname'])) {
  header("location: index.php");
}

if(isset($_GET['text'])){  
  $text = $_GET['text'];  
}

$count = registredMemberCount($connect);




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
        <i class="fa fa-address-book-o" aria-hidden="true">
            маклеры
        </i>
      </span><br>
    </div>


    <?php
      
    $per_page_record = 10; //Number of entries to show in a page

    
    
    //Look for a GET variable page if not found default is 1.

    if(isset($_GET['page'])){
      
      $page = $_GET['page'];

    }

    else {
      
      $page = 1;

    }



    $start_from = ($page - 1) * $per_page_record;

    $query = "SELECT * FROM broker_tbl ORDER by id DESC LIMIT  $start_from, $per_page_record";     

    $rs_result = mysqli_query ($connect, $query);   
    
    
    ?>


      <!-- <br>    -->
      <div>   
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
              <th style="width:31%">Кто добавил</th>
              <th style="width:31%">Телефон номера маклера</th>
              <th style="width:31%">Добавленное время</th>


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
                  <td><?php echo $row["name_agent"]; ?></td> 
                 <td><?php echo $row["phone_number_broker"]; ?></td> 
                 <td><?php echo $row["added_time"]; ?></td>   

            </tr>     
            <?php     
                };    
            ?>     
          </tbody>   
        </table>   
  
     <div class="pagination">    
      <?php  
        $query = "SELECT COUNT(*) FROM broker_tbl";     
        $rs_result = mysqli_query($connect, $query);     
        $row = mysqli_fetch_row($rs_result);     
        $total_records = $row[0];     
          
    echo "</br>";     
        // Number of pages required.   
        $total_pages = ceil($total_records / $per_page_record);     
        $pagLink = "";       
      
        if($page>=2){   
            echo "<a href='brokers.php?page=".($page-1)."'>  Prev </a>";   
        }       
                   
        for ($i=1; $i<=$total_pages; $i++) {   
          if ($i == $page) {   
              $pagLink .= "<a class = 'active' href='brokers.php?page="  
                                                .$i."'>".$i." </a>";   
          }               
          else  {   
              $pagLink .= "<a href='brokers.php?page=".$i."'>   
                                                ".$i." </a>";     
          }   
        };     
        echo $pagLink;   
  
        if($page<$total_pages){   
            echo "<a href='brokers.php?page=".($page+1)."'>  Next </a>";   
        }   
  
      ?>    
        



   <!-- end users list -->
  
    
</div>


    
  </main>

  </body>
  <?php include 'partSite/footer.php'; ?>

</html>


