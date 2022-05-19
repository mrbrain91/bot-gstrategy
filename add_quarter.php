<?php
include('settings.php');
include('bot_lib.php');

if(isset($_GET['text'])){  
  $text = $_GET['text'];  
}
if(isset($_GET['id_region'])){  
    $id_region = $_GET['id_region'];  
}
if(isset($_GET['name_region'])){  
  $name_region = $_GET['name_region'];  
}


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
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



    <title>Gstrategy</title>
     </head>
    <body>
    <main>
    <?php include 'partSite/leftSite.php'; ?>
    <div class="container">
        <div style="width: 100%; height: 9%; background-color: #Eaf7f2;"> 
          <span style="position: relative;display: inline-block;font-size: 18px;padding: 13px 0 0 10px;border-left-width: 10px;">
          <i class="fa fa-cogs" aria-hidden="true">
                настройки адреса
                </i>
          </span><br>
        </div>
    

          <?php
        //    if (isset($name_region)) {
        //     echo '>> '.$name_region;
        //  }
         ?>
        
        <div>
            <a href="quarters.php?id_region=<?=$id_region?>&&name_region=<?=$name_region?>">
              <button class="mt-2 btn btn-primary">
              <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>
                  Назад
              </button>
            </a>
        </div>
        <span style="color:red;display: inline-block;position: absolute;margin: 23px 0px 0px 50px;">
        <?php 
        if (isset($text)) {
          echo $text;
        }?>
        </span>
        <div class="card mt-5 ml-5 mr-5 mb-5">
            <div class="card-body">
                <form action="action.php?id_region=<?=$id_region?>&&name_region=<?=$name_region?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label>Введите квартал или массив:</label>
                        <input type="text" class="form-control" value="Другой" name="name_of_quarter">
                    </div>
                    <div class="form-group mb-3">
                        <button type="submit" name="save_quarter" class="btn btn-primary">
                          <i class="fa fa-floppy-o" aria-hidden="true"></i>
                          Сохранить</button>
                        <button type="reset" class="btn btn-success">Сбросить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>       
    </main>

       
      <script src="css/bootstrap.bundle.min.js"></script>
      <script src="css/sidebars.js"></script> 
      <script src="css/bootstrap.bundle.min.js"></script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
 </html>