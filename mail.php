<?php

include('settings.php');
include('bot_lib.php');

if (!isset($_SESSION['usersname'])) {
  header("location: index.php");
}

if(isset($_POST['save'])){

  $msg = $_POST['textarea'];
  $agents_all_for_mail = agents_all_for_mail($connect);

  foreach($agents_all_for_mail as $p){
    if ($p['userId'] != 0) {
    $url = file_get_contents("https://api.telegram.org/bot".$api."/sendMessage?chat_id=".$p['userId']."&text=".$msg."&parse_mode=HTML");
    }
  }

}

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
          <i class="fa fa-envelope" aria-hidden="true">
            сообщения
            </i>
          </span><br>
        </div>

        <form enctype="plain/text" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="orderform">
          <div class="form-group" style='margin-top:30px;'>
            <label for="exampleFormControlTextarea1">Введите сообщение</label>
            <textarea name="textarea" class="form-control" id="exampleFormControlTextarea1" rows="5" maxlength="100" style="height:50px; padding-top: 11px;"></textarea>
            <div id="count">
              <span id="current_count">0</span>
              <span id="maximum_count">/ 100</span>
            </div>
          </div>
          <input type="submit" class="btn btn-primary" name="save" value="save">
        </form>




  
    
</div>




    
  </main>

  </body>
  <?php include 'partSite/footer.php'; ?>

</html>


<script type="text/javascript">

$('#orderform').submit(function() {
    if($('#exampleFormControlTextarea1').val() == ''){
        alert('Iltimos xabar kiriting!');
        return false;
    }
});



$('textarea').keyup(function() {    
    var characterCount = $(this).val().length,
        current_count = $('#current_count'),
        maximum_count = $('#maximum_count'),
        count = $('#count');    
        current_count.text(characterCount);        
});
</script>
