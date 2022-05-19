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


// $users_all = users_all($connect);
$agents_all = agents_all($connect);



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
        <i class="fa fa-male" aria-hidden="true">
              агенты
        </i>
      </span><br>
    </div>
    <div>
        <a href="https://gstrategy.galaxytest.xyz/add_agents.php">
          <button class="mt-2 btn btn-success">
          <i class="fa fa-plus" aria-hidden="true"></i>
            Добавить нового агента
          </button>
        </a>
    </div>

    <!-- agents list -->

    <?php
      
    $per_page_record = 5; //Number of entries to show in a page

    
    
    //Look for a GET variable page if not found default is 1.

    if(isset($_GET['page'])){
      
      $page = $_GET['page'];

    }

    else {
      
      $page = 1;

    }



    $start_from = ($page - 1) * $per_page_record;

    $query = "SELECT * FROM agents ORDER by id DESC LIMIT  $start_from, $per_page_record";     

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
              <th style="width:6%">Id</th>
              <th style="width:40%">Имя агента</th>
              <th style="width:40%">Номер телефона агента</th>
              <th style="width:30%">Удалить</th>
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
            <td><?php echo $row["userName"]; ?></td>   
            <td><?php echo '+'.$row["phoneNumber"]; ?></td>   
            <td>
              <a href="delete.php?id_agenta=<?php echo $row["id"]; ?>" onclick="return confirm('Удалить?')" role="button"><button class="btn btn-danger" style="width:98px;" ><i class="fa fa-trash" aria-hidden="true"></i></button></a>
            </td>                                           
            </tr>     
            <?php     
                };    
            ?>     
          </tbody>   
        </table>   
  
     <div class="pagination">    
      <?php  
        $query = "SELECT COUNT(*) FROM agents";     
        $rs_result = mysqli_query($connect, $query);     
        $row = mysqli_fetch_row($rs_result);     
        $total_records = $row[0];     
          
    echo "</br>";     
        // Number of pages required.   
        $total_pages = ceil($total_records / $per_page_record);     
        $pagLink = "";       
      
        if($page>=2){   
            echo "<a href='agents.php?page=".($page-1)."'>  Prev </a>";   
        }       
                   
        for ($i=1; $i<=$total_pages; $i++) {   
          if ($i == $page) {   
              $pagLink .= "<a class = 'active' href='agents.php?page="  
                                                .$i."'>".$i." </a>";   
          }               
          else  {   
              $pagLink .= "<a href='agents.php?page=".$i."'>   
                                                ".$i." </a>";     
          }   
        };     
        echo $pagLink;   
  
        if($page<$total_pages){   
            echo "<a href='agents.php?page=".($page+1)."'>  Next </a>";   
        }   
  
      ?>    
        



   <!-- end users list -->
  
    
</div>


    
  </main>

  </body>
  <?php include 'partSite/footer.php'; ?>

</html>


