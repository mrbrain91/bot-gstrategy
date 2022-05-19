<?php 
include('settings.php');
include('bot_lib.php');
if(isset($_GET['id_agenta'])){ // delete agent
  $id_agent =  $_GET['id_agenta']; 
  if (delete_agent($connect,$id_agent)) {
    $text = 'Успешно удален агент';
    redirect("agents.php?text=$text");
  }
}
if(isset($_GET['id_object'])){ // delete agent
  $id_object =  $_GET['id_object']; 
  if (delete_object($connect,$id_object)) {
    $text = 'Успешно удален объект';
    redirect("main.php?text=$text");
  }
}
if(isset($_GET['id_object_restore'])){ // delete agent
  $id_object =  $_GET['id_object_restore']; 
  if (restore_object($connect,$id_object)) {
    $text = 'Успешно восстановлен ID:'.$id_object;
    redirect("deleted_object_page.php?text=$text");
  }
}
?>