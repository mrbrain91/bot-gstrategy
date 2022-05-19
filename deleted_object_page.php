<?php

include('settings.php');
include('bot_lib.php');

if (!isset($_SESSION['usersname'])) {
  header("location: index.php");
}

if(isset($_GET['text'])){  
  $text = $_GET['text'];  
}
if(isset($_POST['search_id_object'])){  
  if ($_POST['id_object']) {
    $id_object = $_POST['id_object'];
}

}

$count = registredObjectCount($connect);


// $agents_all = agents_all($connect);



?>





<!doctype html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/sidebars.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/alert.css" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body{
            background-color:#ff000002;
        }
    </style>
    <title>Gstrategy</title>
     </head>

  <body>
      

     
  <main>
    
  <?php include 'partSite/leftSite.php'; ?>
    
      
    
   <div class="container" style="overflow-x: auto;">



   <div style="width: 100%;height: 9%;color: white;background-color: #dc3545;"> 
      <span style="position: relative;display: inline-block;font-size: 18px;padding: 13px 0 0 10px;border-left-width: 10px;">
        <i class="fa fa-database" aria-hidden="true">
          Удаленная база
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


    if (isset($id_object)) {
        $query = "SELECT * FROM main_tbl WHERE check_over_object='1' AND status_object='1' AND id='$id_object' ORDER by id DESC LIMIT  $start_from, $per_page_record";     
      }else{
        $query = "SELECT * FROM main_tbl WHERE check_over_object='1' AND status_object='1'  ORDER by id DESC LIMIT  $start_from, $per_page_record";  
      }
  



    $rs_result = mysqli_query ($connect, $query);   
    
    
    ?>


      <!-- <br>    -->
      <div>   
      <div style="display: inline-block;padding-top: 10px;float: right;">
        <a href="main.php">
        <button type="button" class="btn btn-outline-success">Активный</button>
        </a>
        
        <button type="button" class="btn btn-outline-danger" style="background-color: #dc3545; color: white; ">Удаленный</button> 
      </div>
      <div style="display: inline-block;padding-top: 10px;">
          <div style="display:inline-block">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">  
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="введите ид " name="id_object">
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="submit" name="search_id_object">Поиск</button>
                </div>
              </div>
            </form>
          </div>
          <!-- <a href="https://gstrategy.galaxytest.xyz/export.php" role="button">
            <div style="display:inline-block">
              <button class="bttn"><i class="fa fa-download"></i> Cкачать (.xls)</button>
            </div>
          </a> -->
      </div>
         <span style="color: #018910;display: inline-block;position: relative;margin: 15px 0px 15px 0px;">
          <?php if (isset($text)) { ?>
            <section>
                <div class="row">
                  <div class="col-sm-12">
                    <div style="display:inline;" class="alert fade alert-simple alert-success alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show">
                      <button type="button" class="close font__size-18" data-dismiss="alert">
                              <span aria-hidden="true"><a>
                                <i class="fa fa-times greencross"></i>
                                </a></span>
                              <span class="sr-only">Close</span> 
                            </button>
                      <i class="start-icon fa fa-check-circle faa-tada animated"></i>
                      <strong class="font__weight-semibold"><? echo $text; ?></strong> 
                    </div>
                  </div>
              </div>
            </section>
            
           


         <?php }?>
        </span>
        <table class="table">   
          <thead>   
            <tr>   
              <th style="width:10%">Id</th>
              <th style="width:15%">Кто удалил</th>
              <th style="width:60%">Описания</th>
              <th style="width:15%">Восстановить</th>
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
              <td><?php echo $row["user_name_deleted"]; ?></td>   
              <td><?php echo $row["delete_description"]; ?></td>   
              <td>
                <a href="delete.php?id_object_restore=<?php echo $row["id"]; ?>" onclick="return confirm('Восстановить?')" role="button"><button class="btn btn-success" style="width:90px;"><i class="fa fa-exchange" aria-hidden="true"></i></button></a>
              </td>                                           
            </tr>     
            <?php     
                };    
            ?>     
          </tbody>   
        </table>   
  
     <div class="pagination">    
      <?php  
        $query = "SELECT COUNT(*) FROM main_tbl";     
        $rs_result = mysqli_query($connect, $query);     
        $row = mysqli_fetch_row($rs_result);     
        $total_records = $row[0];     
          
    echo "</br>";     
        // Number of pages required.   
        $total_pages = ceil($total_records / $per_page_record);     
        $pagLink = "";       
      
        if($page>=2){   
            echo "<a href='deleted_object_page.php?page=".($page-1)."'>  Prev </a>";   
        }       
                   
        for ($i=1; $i<=$total_pages; $i++) {   
          if ($i == $page) {   
              $pagLink .= "<a class = 'active' href='deleted_object_page.php?page="  
                                                .$i."'>".$i." </a>";   
          }               
          else  {   
              $pagLink .= "<a href='deleted_object_page.php?page=".$i."'>   
                                                ".$i." </a>";     
          }   
        };     
        echo $pagLink;   
  
        if($page<$total_pages){   
            echo "<a href='deleted_object_page.php?page=".($page+1)."'>  Next </a>";   
        }   
  
      ?>    
        



   <!-- end users list -->
  
    
</div>


    
  </main>

  </body>
  <?php include 'partSite/footer.php'; ?>

</html>


