<?php

$update = json_decode(file_get_contents('php://input'));



if (isset($update)) {
	if (isset($update->message)) {
		$only_callback = 'no';
		$message = $update->message;
		if (isset($message->text)) {
			$text = $message->text;
		}else{
			$text = '!isset_text';		
		}
		if (isset($message->from->id)) {
			$user_id = $message->from->id;
		}else{
			$user_id = '!isset_user_id';
		}
		if (isset($message->contact->phone_number)) {
			$phone_number = $message->contact->phone_number;
			$phone_number = __cleanData($phone_number);
		}
		if (isset($message->message_id)) {
			$message_id = $message->message_id;
		}


	}
	if (isset($update->callback_query)) {
		$only_callback = 'yes';
		$text = $update->callback_query->data;
	    $user_id = $update->callback_query->from->id;
		$message_id = $update->callback_query->message->message_id;
	}
}





