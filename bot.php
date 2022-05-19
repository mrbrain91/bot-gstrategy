<?php

include('settings.php');
include('func_bot.php');
include('menu.php');
include('UpdMsg.php');
$is_user = is_user($connect, $user_id);


$vars = [];

if (get_last_command($connect, $user_id) != NULL) {
	$last_command = get_last_command($connect, $user_id); /*OXIRGI XARAKATNI OLISH*/
		$last_command_step = $last_command['step'];

		$last_command_vars = unserialize($last_command['vars']);
		if ($last_command_vars != array()) {
			$last_command_vars_object_id = $last_command_vars['object_id'];
			if (isset($last_command_vars['region_id'])) {
				$last_command_vars_region_id = $last_command_vars['region_id'];
			}
			

		}

}else {
	$last_command = 'no_last_command';
	$last_command_step = 'no_last_command_step';

}

if ($is_user == 'is_user') {

	if ($text == '/start') {
		$reply_markup = json_encode(["keyboard"=>$main_menu, 'one_time_keyboard' => false, "resize_keyboard"=>true]);
		bot("sendMessage", ['chat_id' => $user_id, 'text' => "Добро пожаловать", 'reply_markup' => $reply_markup]);
		$step = 'start';
	}
	if($text == '➕ Добавить объект') {
		


		if (null !== get_last_object($connect, $user_id)) {
			$get_last_object = get_last_object($connect, $user_id);
			$check_over_object = $get_last_object['check_over_object'];
			$get_id_last_object = $get_last_object['id'];

		}else {
			$get_last_object = 'not_found_last_object';
			$check_over_object = 'not_isset';
			$get_id_last_object = 'not_id';

		}
		
		if ($get_last_object == 'not_found_last_object') {
			$reply = '☎️ введите номер телефона владельца в формате (90 123 45 67):';
			$reply_markup = json_encode(["keyboard"=>$menu_back_main, 'one_time_keyboard' => false, "resize_keyboard"=>true]);
			bot("sendMessage", ['chat_id' => $user_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
			$step = 'check_number_for_create_object';

		}

		
		if ($check_over_object == '0') {

			bot("deleteMessage", ['chat_id' => $user_id, 'message_id' => $message_id-1]);
			$reply = 'У Вас есть незаполненные объект:
			 id - '.$get_id_last_object.' сначала удалите!';
			bot("sendMessage", ['chat_id' => $user_id, 'text' => $reply, 'reply_markup' => $menu_delete_unsaved_object, 'parse_mode' => 'HTML']);
			$step = 'start';

		}elseif ($check_over_object == '1') {

			$reply = '☎️ введите номер телефона владельца в формате (90 123 45 67):';
			$reply_markup = json_encode(["keyboard"=>$menu_back_main, 'one_time_keyboard' => false, "resize_keyboard"=>true]);
			bot("sendMessage", ['chat_id' => $user_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
			$step = 'check_number_for_create_object';

		}

		
		

		
		
	}
	elseif ($text == '📖 Инструкция') {
		bot("sendMessage", ['chat_id' => $user_id, 'text' => "https://telegra.ph/Instrukciya-12-12-8" ]);
	}
	elseif ($text == '🔍 Найти объект по ид') {
		$reply_markup = json_encode(["keyboard"=>$menu_back_main, 'one_time_keyboard' => false, "resize_keyboard"=>true]);
		bot("sendMessage", ['chat_id' => $user_id, 'text' => 'Введите ид объекта:', 'reply_markup' => $reply_markup]);
		$step = 'search_object_by_id';
	}elseif ($text == '🗑 Удалить объект') {
		$reply_markup = json_encode(["keyboard"=>$menu_back_main, 'one_time_keyboard' => false, "resize_keyboard"=>true]);
		bot("sendMessage", ['chat_id' => $user_id, 'text' => 'Введите удаленный ID объект:', 'reply_markup' => $reply_markup]);
		$step = 'delete_object';
	}
	elseif ($text == '🔍 Найти объект по т/н') {
		$reply_markup = json_encode(["keyboard"=>$menu_back_main, 'one_time_keyboard' => false, "resize_keyboard"=>true]);
		bot("sendMessage", ['chat_id' => $user_id, 'text' => 'введите номер телефона владельца в формате (90 123 45 67):', 'reply_markup' => $reply_markup]);
		$step = 'search_object_by_phone_number';
	}
	elseif ($text == '👥 Маклер') {
		$reply_markup = json_encode(["keyboard"=>$menu_broker, 'one_time_keyboard' => false, "resize_keyboard"=>true]);
		bot("sendMessage", ['chat_id' => $user_id, 'text' => 'Выберите меню:', 'reply_markup' => $reply_markup]);
		$step = 'broker';
	}
	elseif ($text == '🔍 Найти объект') {
		$reply_markup = json_encode(["keyboard"=>$menu_search_object, 'one_time_keyboard' => false, "resize_keyboard"=>true]);
		bot("sendMessage", ['chat_id' => $user_id, 'text' => 'Выберите меню:', 'reply_markup' => $reply_markup]);
		$step = 'search_object';
	}
	elseif ($text == '🔙 назад') {
		$reply_markup = json_encode(["keyboard"=>$main_menu, 'one_time_keyboard' => false, "resize_keyboard"=>true]);
		bot("sendMessage", ['chat_id' => $user_id, 'text' => "Главная", 'reply_markup' => $reply_markup]);
		$step = 'start';
	}
	elseif($text == '➕ добавить т/н маклера'){
		$reply_markup = json_encode(["keyboard"=>$menu_back_main, 'one_time_keyboard' => false, "resize_keyboard"=>true]);
		bot("sendMessage", ['chat_id' => $user_id, 'text' => 'Введите новый номер телефона маклера в формате (90 123 45 67):', 'reply_markup' => $reply_markup]);
		$step = 'add_phone_number_broker';
	}
	elseif($text == '🔍 Проверит т/н маклера'){
		$reply_markup = json_encode(["keyboard"=>$menu_back_main, 'one_time_keyboard' => false, "resize_keyboard"=>true]);
		bot("sendMessage", ['chat_id' => $user_id, 'text' => 'Введите новый номер телефона маклера в формате (90 123 45 67):', 'reply_markup' => $reply_markup]);
		$step = 'check_phone_number_broker';
	}

	elseif($text == 'Удалить объект'){
			delete_unsaved_object($connect, $user_id);
			bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  'Вы можете добавить новый объект', 'parse_mode' => 'HTML']);

			// bot("deleteMessage", ['chat_id' => $user_id, 'message_id' => $message_id]);
			// bot("editMessageReplyMarkup", ['chat_id' => $user_id, 'message_id' => $message_id, 'reply_markup' => $remove_menu]);
			// bot("sendMessage", ['chat_id' => $user_id, 'text' =>  'Вы можете добавить новый объект', 'parse_mode' => 'HTML']);
		
	}
	

	if ($last_command_step == 'check_number_for_create_object' && $text != '🔙 назад' && $text != '/start') {
		// bot("sendMessage", ['chat_id' => $user_id, 'text' => var_export($text ,1)]);
		$phone_number_broker = __cleanData($text);
		if (strlen($phone_number_broker) == 9) {
			$status_broker = brokers($connect, $phone_number_broker);
			if ($status_broker == 'isnot_broker') {
				$phone_number_owner = $phone_number_broker;
				$name_agent = name_agent($connect, $user_id);
				create_new_object($connect, $user_id, $phone_number_owner, $name_agent);
				$s = select_new_obj_id($connect, $user_id);
	
				$reply = "
				Новый объект                                                           
				id: ".$s."
				т/н:  ".$phone_number_broker."
				----------------------------------
				✍️ <strong>Введите имя владельца:</strong>

				";

				$reply_markup = json_encode(["keyboard"=>$menu_back_main, 'one_time_keyboard' => false, "resize_keyboard"=>true]);
				bot("sendMessage", ['chat_id' => $user_id, 'text' => $reply, 'reply_markup' => $reply_markup, 'parse_mode' => 'HTML']);

				$step = 'choose_name';
				$vars = ['object_id' => $s];

			}elseif ($status_broker == 'is_broker') {
				$reply = 'Этот номер есть в базе маклера ('.$phone_number_broker.')';
				$reply_markup = json_encode(["keyboard"=>$main_menu, 'one_time_keyboard' => false, "resize_keyboard"=>true]);
				bot("sendMessage", ['chat_id' => $user_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
				$step = 'start';
			}
		}
		else {
			bot("sendMessage", ['chat_id' => $user_id, 'text' => 'Пожалуйста, введите номер телефона в формате (90 123 45 67)']);
			$step = 'check_number_for_create_object';
		}
	}
	if ($last_command_step == 'choose_name'  && $text != '🔙 назад' && $text != '/start') {
		insert_name($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);
		
		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		----------------------------------
		💲 <strong>Стартовая цена:</strong> 
		";
		$reply_markup = json_encode(["keyboard"=>$menu_back_main, 'one_time_keyboard' => false, "resize_keyboard"=>true]);
		bot("sendMessage", ['chat_id' => $user_id, 'text' => $reply, 'reply_markup' => $reply_markup, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'choose_starting_price';
	}	
	if ($last_command_step == 'choose_starting_price'  && $text != '🔙 назад' && $text != '/start') {
		$text = __cleanData($text);
		insert_starting_price($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);
		
		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		----------------------------------
		<strong>Общая площадь(м2):</strong> 
		";
		$reply_markup = json_encode(["keyboard"=>$menu_back_main, 'one_time_keyboard' => false, "resize_keyboard"=>true]);
		bot("sendMessage", ['chat_id' => $user_id, 'text' => $reply, 'reply_markup' => $reply_markup, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'choose_quadrature';
	}
	if ($last_command_step == 'choose_quadrature'  && $text != '🔙 назад' && $text != '/start') {
		$text = __cleanData($text);
		insert_quadrature($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);
		
		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		----------------------------------
		<strong>Выберите раздел:</strong> 👇
		";
		bot("sendMessage", ['chat_id' => $user_id, 'text' => $reply, 'reply_markup' => $menu_section, 'parse_mode' => 'HTML']);

		$vars = $last_command_vars;
		$step = 'section';

	}
	if ($last_command_step == 'section'  && $text != '🔙 назад' && $text != '/start') {
		insert_section($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);
		if ($text == 'Квартира') {
			$reply = "
			Новый объект                                                           
			id: ".$last_command_vars_object_id."
			т/н:  ".$get_last_object['phone_number_owner']."
			ФИО: ".$get_last_object['ownerName']."
			Стартовая цена: ".$get_last_object['startingPrice']."
			Общая площадь(м2): ".$get_last_object['quadrature']."
			Раздел: ".$get_last_object['section']."
			----------------------------------
			<strong>Выберите район:</strong> 👇
			";
			bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_regions, 'parse_mode' => 'HTML']);
			$vars = $last_command_vars;
			$step = 'choose_region';
		}elseif ($text == 'Дом') {
			$reply = "
			Новый объект                                                           
			id: ".$last_command_vars_object_id."
			т/н:  ".$get_last_object['phone_number_owner']."
			ФИО: ".$get_last_object['ownerName']."
			Стартовая цена: ".$get_last_object['startingPrice']."
			Общая площадь(м2): ".$get_last_object['quadrature']."
			Раздел: ".$get_last_object['section']."
			----------------------------------
			<strong>Тип дома:</strong> 👇
			";
			bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_typeOfHouse, 'parse_mode' => 'HTML']);
			$vars = $last_command_vars;
			$step = 'typeOfHouse';
		}elseif ($text == 'Коммерческой') {

			$reply = "
			Новый объект                                                           
			id: ".$last_command_vars_object_id."
			т/н:  ".$get_last_object['phone_number_owner']."
			ФИО: ".$get_last_object['ownerName']."
			Стартовая цена: ".$get_last_object['startingPrice']."
			Общая площадь(м2): ".$get_last_object['quadrature']."
			Раздел: ".$get_last_object['section']."
			----------------------------------
			<strong>Тип недвижимости:</strong> 👇
			";
			bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_commercial, 'parse_mode' => 'HTML']);
			$vars = $last_command_vars;
			$step = 'commercial';
		}elseif ($text == 'Земля') {

			$reply = "
			Новый объект                                                           
			id: ".$last_command_vars_object_id."
			т/н:  ".$get_last_object['phone_number_owner']."
			ФИО: ".$get_last_object['ownerName']."
			Стартовая цена: ".$get_last_object['startingPrice']."
			Общая площадь(м2): ".$get_last_object['quadrature']."
			Раздел: ".$get_last_object['section']."
			----------------------------------
			<strong>Тип земля:</strong> 👇
			";
			bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_area, 'parse_mode' => 'HTML']);
			$vars = $last_command_vars;
			$step = 'area';
		}
	}
	if ($last_command_step == 'area'  && $text != '🔙 назад' && $text != '/start') {
		insert_area($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

			$reply = "
			Новый объект                                                           
			id: ".$last_command_vars_object_id."
			т/н:  ".$get_last_object['phone_number_owner']."
			ФИО: ".$get_last_object['ownerName']."
			Стартовая цена: ".$get_last_object['startingPrice']."
			Общая площадь(м2): ".$get_last_object['quadrature']."
			Раздел: ".$get_last_object['section']."
			Тип дома: ".$get_last_object['typeOfHouse']."
			Тип недвижимости: ".$get_last_object['commercial']."
			Тип земля: ".$get_last_object['area']."

			----------------------------------
			<strong>Выберите район:</strong> 👇
			";
			bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_regions, 'parse_mode' => 'HTML']);
			$vars = $last_command_vars;
			$step = 'choose_region';
		
	}
	if ($last_command_step == 'commercial'  && $text != '🔙 назад' && $text != '/start') {
		insert_commercial($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

			$reply = "
			Новый объект                                                           
			id: ".$last_command_vars_object_id."
			т/н:  ".$get_last_object['phone_number_owner']."
			ФИО: ".$get_last_object['ownerName']."
			Стартовая цена: ".$get_last_object['startingPrice']."
			Общая площадь(м2): ".$get_last_object['quadrature']."
			Раздел: ".$get_last_object['section']."
			Тип дома: ".$get_last_object['typeOfHouse']."
			Тип недвижимости: ".$get_last_object['commercial']."
			----------------------------------
			<strong>Выберите район:</strong> 👇
			";
			bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_regions, 'parse_mode' => 'HTML']);
			$vars = $last_command_vars;
			$step = 'choose_region';
		
	}
	if ($last_command_step == 'typeOfHouse'  && $text != '🔙 назад' && $text != '/start') {
		insert_typeOfHouse($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

			$reply = "
			Новый объект                                                           
			id: ".$last_command_vars_object_id."
			т/н:  ".$get_last_object['phone_number_owner']."
			ФИО: ".$get_last_object['ownerName']."
			Стартовая цена: ".$get_last_object['startingPrice']."
			Общая площадь(м2): ".$get_last_object['quadrature']."
			Раздел: ".$get_last_object['section']."
			Тип дома: ".$get_last_object['typeOfHouse']."

			----------------------------------
			<strong>Расположение:</strong> 👇
			";
			bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_location, 'parse_mode' => 'HTML']);
			$vars = $last_command_vars;
			$step = 'location';
		
	}
	if ($last_command_step == 'location'  && $text != '🔙 назад' && $text != '/start') {
		insert_locations($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

			$reply = "
			Новый объект                                                           
			id: ".$last_command_vars_object_id."
			т/н:  ".$get_last_object['phone_number_owner']."
			ФИО: ".$get_last_object['ownerName']."
			Стартовая цена: ".$get_last_object['startingPrice']."
			Общая площадь(м2): ".$get_last_object['quadrature']."
			Раздел: ".$get_last_object['section']."
			Тип дома: ".$get_last_object['typeOfHouse']."
			Расположение: ".$get_last_object['locations']."
			----------------------------------
			<strong>Выберите район:</strong> 👇
			";
			bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_regions, 'parse_mode' => 'HTML']);
			$vars = $last_command_vars;
			$step = 'choose_region';
		
	}
	if ($last_command_step == 'choose_region' && $only_callback == 'yes') {
		insert_region($connect, $user_id, $last_command_vars_object_id, $text);
        //border section for menu
		$region_name_for_id = $text;
		$get_region_id = get_region_id($connect, $region_name_for_id);  
		$quarters_all = quarters_all($connect, $get_region_id);
		$count = quartersCount($connect, $get_region_id);

		$inline_keyboard = array();
		for ($i=0; $i < $count; $i++) { 
			$quarter = $quarters_all[$i]['name_quarter'];
			$inline_button = array("text"=>$quarter,"callback_data"=>$quarter);  
			$inline_keyboard[] = array($inline_button);
		}
		$keyboard=array("inline_keyboard"=>$inline_keyboard);

		$menu_quarters = json_encode($keyboard);	
        //border section for menu
		
		$get_last_object = get_last_object($connect, $user_id);
		
		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		----------------------------------
		<strong>Выберите квартал:</strong> 👇
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_quarters, 'parse_mode' => 'HTML']);
		$vars = ['object_id' => $last_command_vars_object_id, 'region_id' => $get_region_id];
		$step = 'choose_quarter';

	}
	if ($last_command_step == 'choose_quarter' && $only_callback == 'yes') {
		insert_quarter($connect, $user_id, $last_command_vars_object_id, $text);
		//border section for menu
		
		$quarter_name_for_id = $text;
		$last_command_vars_region_id_for_menu = $last_command_vars_region_id;
		$get_quarter_id = get_quarter_id($connect, $quarter_name_for_id, $last_command_vars_region_id_for_menu);  

		


		$streets_all = streets_all($connect, $last_command_vars_region_id_for_menu, $get_quarter_id);


		$count = streetsCount($connect, $last_command_vars_region_id_for_menu, $get_quarter_id);
		
		
		$inline_keyboard = array();
		for ($i=0; $i < $count; $i++) { 
			$street = $streets_all[$i]['name_street'];
			$inline_button = array("text"=>$street,"callback_data"=>$street);  
			$inline_keyboard[] = array($inline_button);
		}
		$keyboard=array("inline_keyboard"=>$inline_keyboard);

		$menu_streets = json_encode($keyboard);	
        // //border section for menu

		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		----------------------------------
		<strong>выберите улицу:</strong> 👇
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_streets, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'choose_street';
	}

	if ($last_command_step == 'choose_street' && $only_callback == 'yes') {
		insert_street($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		----------------------------------
		<strong>выберите этажность:</strong> 👇
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_number_of_floors, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'choose_number_of_floors';
	}

	if ($last_command_step == 'choose_number_of_floors' && $only_callback == 'yes') {
		insert_number_of_floors($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		Этажность: ".$get_last_object['number_of_floors']."
		----------------------------------
		<strong>выберите этаж:</strong> 👇
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_number_of_floors, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'choose_floor';
	}

	if ($last_command_step == 'choose_floor' && $only_callback == 'yes') {
		insert_floors($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		Этажность: ".$get_last_object['number_of_floors']."
		Этаж: ".$get_last_object['floor']."
		----------------------------------
		<strong>выберите количество комнат:</strong> 👇
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_number_of_floors, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'choose_number_of_rooms';
	}

	if ($last_command_step == 'choose_number_of_rooms' && $only_callback == 'yes') {
		insert_number_of_rooms($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		Этажность: ".$get_last_object['number_of_floors']."
		Этаж: ".$get_last_object['floor']."
		К-во комнат: ".$get_last_object['number_of_rooms']."
		----------------------------------
		<strong>сан.узел:</strong> 👇
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_bath, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'choose_bath';
	}
	if ($last_command_step == 'choose_bath' && $only_callback == 'yes') {
		insert_bath($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		Этажность: ".$get_last_object['number_of_floors']."
		Этаж: ".$get_last_object['floor']."
		К-во комнат: ".$get_last_object['number_of_rooms']."
		Сан.узел: ".$get_last_object['bath_toilet']."
		----------------------------------
		<strong>Состояние/ремонт:</strong> 👇
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_state_repair, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'state_repair';
	}
	if ($last_command_step == 'state_repair' && $only_callback == 'yes') {
		insert_state_repair($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		Этажность: ".$get_last_object['number_of_floors']."
		Этаж: ".$get_last_object['floor']."
		К-во комнат: ".$get_last_object['number_of_rooms']."
		Сан.узел: ".$get_last_object['bath_toilet']."
		Сост./рем.: ".$get_last_object['state_repair']."
		----------------------------------
		<strong>Тип стоения:</strong> 👇
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_type_of_walls, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'type_of_walls';
	}

	if ($last_command_step == 'type_of_walls' && $only_callback == 'yes') {
		insert_type_of_walls($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		Этажность: ".$get_last_object['number_of_floors']."
		Этаж: ".$get_last_object['floor']."
		К-во комнат: ".$get_last_object['number_of_rooms']."
		Сан.узел: ".$get_last_object['bath_toilet']."
		Сост./рем.: ".$get_last_object['state_repair']."
		Тип стоения: ".$get_last_object['type_of_walls']."
		----------------------------------
		<strong>Планировка:</strong> 👇
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_layout, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'layout';
	}

	if ($last_command_step == 'layout' && $only_callback == 'yes') {
		insert_layout($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		Этажность: ".$get_last_object['number_of_floors']."
		Этаж: ".$get_last_object['floor']."
		К-во комнат: ".$get_last_object['number_of_rooms']."
		Сан.узел: ".$get_last_object['bath_toilet']."
		Сост./рем.: ".$get_last_object['state_repair']."
		Тип стоения: ".$get_last_object['type_of_walls']."
		Планировка: ".$get_last_object['layout']."
		----------------------------------
		<strong>Балкон:</strong> 👇
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_balcony, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'balcony';
	}
		if ($last_command_step == 'balcony' && $only_callback == 'yes') {
		insert_balcony($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		Этажность: ".$get_last_object['number_of_floors']."
		Этаж: ".$get_last_object['floor']."
		К-во комнат: ".$get_last_object['number_of_rooms']."
		Сан.узел: ".$get_last_object['bath_toilet']."
		Сост./рем.: ".$get_last_object['state_repair']."
		Тип стоения: ".$get_last_object['type_of_walls']."
		Планировка: ".$get_last_object['layout']."
		Балкон: ".$get_last_object['balcony']."
		----------------------------------
		<strong>Тип постройки:</strong> 👇
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_type_of_building, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'type_of_building';
	}
	if ($last_command_step == 'type_of_building' && $only_callback == 'yes') {
		insert_type_of_building($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		Этажность: ".$get_last_object['number_of_floors']."
		Этаж: ".$get_last_object['floor']."
		К-во комнат: ".$get_last_object['number_of_rooms']."
		Сан.узел: ".$get_last_object['bath_toilet']."
		Сост./рем.: ".$get_last_object['state_repair']."
		Тип стоения: ".$get_last_object['type_of_walls']."
		Планировка: ".$get_last_object['layout']."
		Балкон: ".$get_last_object['balcony']."
		Тип постройки: ".$get_last_object['type_of_building']."
		----------------------------------
		<strong>Торец:</strong> 👇

		
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_end_face, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'end_face';
	}
	if ($last_command_step == 'end_face' && $only_callback == 'yes') {
		insert_end_face($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		Этажность: ".$get_last_object['number_of_floors']."
		Этаж: ".$get_last_object['floor']."
		К-во комнат: ".$get_last_object['number_of_rooms']."
		Сан.узел: ".$get_last_object['bath_toilet']."
		Сост./рем.: ".$get_last_object['state_repair']."
		Тип стоения: ".$get_last_object['type_of_walls']."
		Планировка: ".$get_last_object['layout']."
		Балкон: ".$get_last_object['balcony']."
		Тип постройки: ".$get_last_object['type_of_building']."
		Торец: ".$get_last_object['end_face']."
		----------------------------------
		<strong>Мебель:</strong> 👇

		
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_furniture, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'furniture';
	}
	if ($last_command_step == 'furniture' && $only_callback == 'yes') {
		insert_furniture($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		Этажность: ".$get_last_object['number_of_floors']."
		Этаж: ".$get_last_object['floor']."
		К-во комнат: ".$get_last_object['number_of_rooms']."
		Сан.узел: ".$get_last_object['bath_toilet']."
		Сост./рем.: ".$get_last_object['state_repair']."
		Тип стоения: ".$get_last_object['type_of_walls']."
		Планировка: ".$get_last_object['layout']."
		Балкон: ".$get_last_object['balcony']."
		Тип постройки: ".$get_last_object['type_of_building']."
		Торец: ".$get_last_object['end_face']."
		Мебель: ".$get_last_object['furniture']."
		----------------------------------
		<strong>Техника:</strong> 👇

		
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_technic, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'technic';
	}
	
	if ($last_command_step == 'technic' && $only_callback == 'yes') {
		insert_technic($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		Этажность: ".$get_last_object['number_of_floors']."
		Этаж: ".$get_last_object['floor']."
		К-во комнат: ".$get_last_object['number_of_rooms']."
		Сан.узел: ".$get_last_object['bath_toilet']."
		Сост./рем.: ".$get_last_object['state_repair']."
		Тип стоения: ".$get_last_object['type_of_walls']."
		Планировка: ".$get_last_object['layout']."
		Балкон: ".$get_last_object['balcony']."
		Тип постройки: ".$get_last_object['type_of_building']."
		Торец: ".$get_last_object['end_face']."
		Мебель: ".$get_last_object['furniture']."
		Техника: ".$get_last_object['technic']."
		----------------------------------
		<strong>Кондиционер:</strong> 👇

		
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_conditioner, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'conditioner';
	}

	if ($last_command_step == 'conditioner' && $only_callback == 'yes') {
		insert_conditioner($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		Этажность: ".$get_last_object['number_of_floors']."
		Этаж: ".$get_last_object['floor']."
		К-во комнат: ".$get_last_object['number_of_rooms']."
		Сан.узел: ".$get_last_object['bath_toilet']."
		Сост./рем.: ".$get_last_object['state_repair']."
		Тип стоения: ".$get_last_object['type_of_walls']."
		Планировка: ".$get_last_object['layout']."
		Балкон: ".$get_last_object['balcony']."
		Тип постройки: ".$get_last_object['type_of_building']."
		Торец: ".$get_last_object['end_face']."
		Мебель: ".$get_last_object['furniture']."
		Техника: ".$get_last_object['technic']."
		Кондиционер: ".$get_last_object['conditioner']."
		----------------------------------
		<strong>Пластиковые окна:</strong> 👇
		
		
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_plast_window, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'plast_window';
	}

	if ($last_command_step == 'plast_window' && $only_callback == 'yes') {
		insert_plast_window($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		Этажность: ".$get_last_object['number_of_floors']."
		Этаж: ".$get_last_object['floor']."
		К-во комнат: ".$get_last_object['number_of_rooms']."
		Сан.узел: ".$get_last_object['bath_toilet']."
		Сост./рем.: ".$get_last_object['state_repair']."
		Тип стоения: ".$get_last_object['type_of_walls']."
		Планировка: ".$get_last_object['layout']."
		Балкон: ".$get_last_object['balcony']."
		Тип постройки: ".$get_last_object['type_of_building']."
		Торец: ".$get_last_object['end_face']."
		Мебель: ".$get_last_object['furniture']."
		Техника: ".$get_last_object['technic']."
		Кондиционер: ".$get_last_object['conditioner']."
		Пластиковые окна: ".$get_last_object['plast_window']."
		----------------------------------
		<strong>Удал.от дороги:</strong> 👇
		
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_distance_from_road, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'distance_from_road';
	}
	
	if ($last_command_step == 'distance_from_road' && $only_callback == 'yes') {
		insert_distance_from_road($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		Этажность: ".$get_last_object['number_of_floors']."
		Этаж: ".$get_last_object['floor']."
		К-во комнат: ".$get_last_object['number_of_rooms']."
		Сан.узел: ".$get_last_object['bath_toilet']."
		Сост./рем.: ".$get_last_object['state_repair']."
		Тип стоения: ".$get_last_object['type_of_walls']."
		Планировка: ".$get_last_object['layout']."
		Балкон: ".$get_last_object['balcony']."
		Тип постройки: ".$get_last_object['type_of_building']."
		Торец: ".$get_last_object['end_face']."
		Мебель: ".$get_last_object['furniture']."
		Техника: ".$get_last_object['technic']."
		Кондиционер: ".$get_last_object['conditioner']."
		Пластиковые окна: ".$get_last_object['plast_window']."
		Удал.от дороги: ".$get_last_object['distance_from_road']."
		----------------------------------
		<strong>Метро:</strong> 👇
		
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_underground, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'underground';
	}

	if ($last_command_step == 'underground' && $only_callback == 'yes') {
		insert_underground($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		Этажность: ".$get_last_object['number_of_floors']."
		Этаж: ".$get_last_object['floor']."
		К-во комнат: ".$get_last_object['number_of_rooms']."
		Сан.узел: ".$get_last_object['bath_toilet']."
		Сост./рем.: ".$get_last_object['state_repair']."
		Тип стоения: ".$get_last_object['type_of_walls']."
		Планировка: ".$get_last_object['layout']."
		Балкон: ".$get_last_object['balcony']."
		Тип постройки: ".$get_last_object['type_of_building']."
		Торец: ".$get_last_object['end_face']."
		Мебель: ".$get_last_object['furniture']."
		Техника: ".$get_last_object['technic']."
		Кондиционер: ".$get_last_object['conditioner']."
		Пластиковые окна: ".$get_last_object['plast_window']."
		Удал.от дороги: ".$get_last_object['distance_from_road']."
		Метро: ".$get_last_object['underground']."
		----------------------------------
		<strong>Парковка:</strong> 👇
		
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_parking, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'parking';
	}

	if ($last_command_step == 'parking' && $only_callback == 'yes') {
		insert_parking($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		Этажность: ".$get_last_object['number_of_floors']."
		Этаж: ".$get_last_object['floor']."
		К-во комнат: ".$get_last_object['number_of_rooms']."
		Сан.узел: ".$get_last_object['bath_toilet']."
		Сост./рем.: ".$get_last_object['state_repair']."
		Тип стоения: ".$get_last_object['type_of_walls']."
		Планировка: ".$get_last_object['layout']."
		Балкон: ".$get_last_object['balcony']."
		Тип постройки: ".$get_last_object['type_of_building']."
		Торец: ".$get_last_object['end_face']."
		Мебель: ".$get_last_object['furniture']."
		Техника: ".$get_last_object['technic']."
		Кондиционер: ".$get_last_object['conditioner']."
		Пластиковые окна: ".$get_last_object['plast_window']."
		Удал.от дороги: ".$get_last_object['distance_from_road']."
		Метро: ".$get_last_object['underground']."
		Парковка: ".$get_last_object['parking']."
		----------------------------------
		<strong>Лифт:</strong> 👇
		
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_elevator, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'elevator';
	}
	if ($last_command_step == 'elevator' && $only_callback == 'yes') {
		insert_elevator($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		Этажность: ".$get_last_object['number_of_floors']."
		Этаж: ".$get_last_object['floor']."
		К-во комнат: ".$get_last_object['number_of_rooms']."
		Сан.узел: ".$get_last_object['bath_toilet']."
		Сост./рем.: ".$get_last_object['state_repair']."
		Тип стоения: ".$get_last_object['type_of_walls']."
		Планировка: ".$get_last_object['layout']."
		Балкон: ".$get_last_object['balcony']."
		Тип постройки: ".$get_last_object['type_of_building']."
		Торец: ".$get_last_object['end_face']."
		Мебель: ".$get_last_object['furniture']."
		Техника: ".$get_last_object['technic']."
		Кондиционер: ".$get_last_object['conditioner']."
		Пластиковые окна: ".$get_last_object['plast_window']."
		Удал.от дороги: ".$get_last_object['distance_from_road']."
		Метро: ".$get_last_object['underground']."
		Парковка: ".$get_last_object['parking']."
		Лифт: ".$get_last_object['elevator']."
		----------------------------------
		<strong>Крыша:</strong> 👇
		
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_roof, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'roof';
	}

	if ($last_command_step == 'roof' && $only_callback == 'yes') {
		insert_roof($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		Этажность: ".$get_last_object['number_of_floors']."
		Этаж: ".$get_last_object['floor']."
		К-во комнат: ".$get_last_object['number_of_rooms']."
		Сан.узел: ".$get_last_object['bath_toilet']."
		Сост./рем.: ".$get_last_object['state_repair']."
		Тип стоения: ".$get_last_object['type_of_walls']."
		Планировка: ".$get_last_object['layout']."
		Балкон: ".$get_last_object['balcony']."
		Тип постройки: ".$get_last_object['type_of_building']."
		Торец: ".$get_last_object['end_face']."
		Мебель: ".$get_last_object['furniture']."
		Техника: ".$get_last_object['technic']."
		Кондиционер: ".$get_last_object['conditioner']."
		Пластиковые окна: ".$get_last_object['plast_window']."
		Удал.от дороги: ".$get_last_object['distance_from_road']."
		Метро: ".$get_last_object['underground']."
		Парковка: ".$get_last_object['parking']."
		Лифт: ".$get_last_object['elevator']."
		Крыша: ".$get_last_object['roof']."
		----------------------------------
		<strong>Время с пос. оформ.:</strong> 👇
		
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_last_registration, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'last_registration';
	}

	if ($last_command_step == 'last_registration' && $only_callback == 'yes') {
		insert_last_registration($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		Этажность: ".$get_last_object['number_of_floors']."
		Этаж: ".$get_last_object['floor']."
		К-во комнат: ".$get_last_object['number_of_rooms']."
		Сан.узел: ".$get_last_object['bath_toilet']."
		Сост./рем.: ".$get_last_object['state_repair']."
		Тип стоения: ".$get_last_object['type_of_walls']."
		Планировка: ".$get_last_object['layout']."
		Балкон: ".$get_last_object['balcony']."
		Тип постройки: ".$get_last_object['type_of_building']."
		Торец: ".$get_last_object['end_face']."
		Мебель: ".$get_last_object['furniture']."
		Техника: ".$get_last_object['technic']."
		Кондиционер: ".$get_last_object['conditioner']."
		Пластиковые окна: ".$get_last_object['plast_window']."
		Удал.от дороги: ".$get_last_object['distance_from_road']."
		Метро: ".$get_last_object['underground']."
		Парковка: ".$get_last_object['parking']."
		Лифт: ".$get_last_object['elevator']."
		Крыша: ".$get_last_object['roof']."
		Время с пос. оформ.: ".$get_last_object['last_registration']."
		----------------------------------
		<strong>Прописка: </strong>👇
		
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_registration, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'registration';
	}
	if ($last_command_step == 'registration' && $only_callback == 'yes') {
		insert_registration($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		Этажность: ".$get_last_object['number_of_floors']."
		Этаж: ".$get_last_object['floor']."
		К-во комнат: ".$get_last_object['number_of_rooms']."
		Сан.узел: ".$get_last_object['bath_toilet']."
		Сост./рем.: ".$get_last_object['state_repair']."
		Тип стоения: ".$get_last_object['type_of_walls']."
		Планировка: ".$get_last_object['layout']."
		Балкон: ".$get_last_object['balcony']."
		Тип постройки: ".$get_last_object['type_of_building']."
		Торец: ".$get_last_object['end_face']."
		Мебель: ".$get_last_object['furniture']."
		Техника: ".$get_last_object['technic']."
		Кондиционер: ".$get_last_object['conditioner']."
		Пластиковые окна: ".$get_last_object['plast_window']."
		Удал.от дороги: ".$get_last_object['distance_from_road']."
		Метро: ".$get_last_object['underground']."
		Парковка: ".$get_last_object['parking']."
		Лифт: ".$get_last_object['elevator']."
		Крыша: ".$get_last_object['roof']."
		Время с пос. оформ.: ".$get_last_object['last_registration']."
		Прописка: ".$get_last_object['registration']."
		----------------------------------
		<strong>Под Офис:</strong> 👇
		
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_for_office, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'for_office';
	}
	if ($last_command_step == 'for_office' && $only_callback == 'yes') {
		insert_for_office($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		Этажность: ".$get_last_object['number_of_floors']."
		Этаж: ".$get_last_object['floor']."
		К-во комнат: ".$get_last_object['number_of_rooms']."
		Сан.узел: ".$get_last_object['bath_toilet']."
		Сост./рем.: ".$get_last_object['state_repair']."
		Тип стоения: ".$get_last_object['type_of_walls']."
		Планировка: ".$get_last_object['layout']."
		Балкон: ".$get_last_object['balcony']."
		Тип постройки: ".$get_last_object['type_of_building']."
		Торец: ".$get_last_object['end_face']."
		Мебель: ".$get_last_object['furniture']."
		Техника: ".$get_last_object['technic']."
		Кондиционер: ".$get_last_object['conditioner']."
		Пластиковые окна: ".$get_last_object['plast_window']."
		Удал.от дороги: ".$get_last_object['distance_from_road']."
		Метро: ".$get_last_object['underground']."
		Парковка: ".$get_last_object['parking']."
		Лифт: ".$get_last_object['elevator']."
		Крыша: ".$get_last_object['roof']."
		Время с пос. оформ.: ".$get_last_object['last_registration']."
		Прописка: ".$get_last_object['registration']."
		Под Офис: ".$get_last_object['for_office']."
		----------------------------------
		<strong>Экслюзивный договор:</strong> 👇
		
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_exclusive_contract, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'exclusive_contract';
	}
	if ($last_command_step == 'exclusive_contract' && $only_callback == 'yes') {
		insert_exclusive_contract($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		Этажность: ".$get_last_object['number_of_floors']."
		Этаж: ".$get_last_object['floor']."
		К-во комнат: ".$get_last_object['number_of_rooms']."
		Сан.узел: ".$get_last_object['bath_toilet']."
		Сост./рем.: ".$get_last_object['state_repair']."
		Тип стоения: ".$get_last_object['type_of_walls']."
		Планировка: ".$get_last_object['layout']."
		Балкон: ".$get_last_object['balcony']."
		Тип постройки: ".$get_last_object['type_of_building']."
		Торец: ".$get_last_object['end_face']."
		Мебель: ".$get_last_object['furniture']."
		Техника: ".$get_last_object['technic']."
		Кондиционер: ".$get_last_object['conditioner']."
		Пластиковые окна: ".$get_last_object['plast_window']."
		Удал.от дороги: ".$get_last_object['distance_from_road']."
		Метро: ".$get_last_object['underground']."
		Парковка: ".$get_last_object['parking']."
		Лифт: ".$get_last_object['elevator']."
		Крыша: ".$get_last_object['roof']."
		Время с пос. оформ.: ".$get_last_object['last_registration']."
		Прописка: ".$get_last_object['registration']."
		Под Офис: ".$get_last_object['for_office']."
		Экслюзивный договор: ".$get_last_object['exclusive_contract']."
		----------------------------------
		<strong>Рекламировать:</strong> 👇
		";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_advertisement, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'agent_description';
	}
	if ($last_command_step == 'agent_description' && $only_callback == 'yes') {
		insert_advertisement($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);
		
		
		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		Этажность: ".$get_last_object['number_of_floors']."
		Этаж: ".$get_last_object['floor']."
		К-во комнат: ".$get_last_object['number_of_rooms']."
		Сан.узел: ".$get_last_object['bath_toilet']."
		Сост./рем.: ".$get_last_object['state_repair']."
		Тип стоения: ".$get_last_object['type_of_walls']."
		Планировка: ".$get_last_object['layout']."
		Балкон: ".$get_last_object['balcony']."
		Тип постройки: ".$get_last_object['type_of_building']."
		Торец: ".$get_last_object['end_face']."
		Мебель: ".$get_last_object['furniture']."
		Техника: ".$get_last_object['technic']."
		Кондиционер: ".$get_last_object['conditioner']."
		Пластиковые окна: ".$get_last_object['plast_window']."
		Удал.от дороги: ".$get_last_object['distance_from_road']."
		Метро: ".$get_last_object['underground']."
		Парковка: ".$get_last_object['parking']."
		Лифт: ".$get_last_object['elevator']."
		Крыша: ".$get_last_object['roof']."
		Время с пос. оформ.: ".$get_last_object['last_registration']."
		Прописка: ".$get_last_object['registration']."
		Под Офис: ".$get_last_object['for_office']."
		Экслюзивный договор: ".$get_last_object['exclusive_contract']."
		Рекламировать: ".$get_last_object['advertisement']."
		----------------------------------
		<strong>Примечание агента:</strong> 👇
		";
		$reply_markup = json_encode(["keyboard"=>$menu_back_main, 'one_time_keyboard' => false, "resize_keyboard"=>true]);
		bot("sendMessage", ['chat_id' => $user_id, 'text' => $reply, 'reply_markup' => $reply_markup, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'advertisement';
	}
	if ($last_command_step == 'advertisement' && $text != '🔙 назад' && $text != '/start') {
		insert_agent_description($connect, $user_id, $last_command_vars_object_id, $text);
		$get_last_object = get_last_object($connect, $user_id);

		$reply = "
		Новый объект                                                           
		id: ".$last_command_vars_object_id."
		т/н:  ".$get_last_object['phone_number_owner']."
		ФИО: ".$get_last_object['ownerName']."
		Стартовая цена: ".$get_last_object['startingPrice']."
		Общая площадь(м2): ".$get_last_object['quadrature']."
		Раздел: ".$get_last_object['section']."
		Тип дома: ".$get_last_object['typeOfHouse']."
		Расположение: ".$get_last_object['locations']."
		Район: ".$get_last_object['region']."
		Квартал: ".$get_last_object['quarter']."
		Улица: ".$get_last_object['street']."
		Этажность: ".$get_last_object['number_of_floors']."
		Этаж: ".$get_last_object['floor']."
		К-во комнат: ".$get_last_object['number_of_rooms']."
		Сан.узел: ".$get_last_object['bath_toilet']."
		Сост./рем.: ".$get_last_object['state_repair']."
		Тип стоения: ".$get_last_object['type_of_walls']."
		Планировка: ".$get_last_object['layout']."
		Балкон: ".$get_last_object['balcony']."
		Тип постройки: ".$get_last_object['type_of_building']."
		Торец: ".$get_last_object['end_face']."
		Мебель: ".$get_last_object['furniture']."
		Техника: ".$get_last_object['technic']."
		Кондиционер: ".$get_last_object['conditioner']."
		Пластиковые окна: ".$get_last_object['plast_window']."
		Удал.от дороги: ".$get_last_object['distance_from_road']."
		Метро: ".$get_last_object['underground']."
		Парковка: ".$get_last_object['parking']."
		Лифт: ".$get_last_object['elevator']."
		Крыша: ".$get_last_object['roof']."
		Время с пос. оформ.: ".$get_last_object['last_registration']."
		Прописка: ".$get_last_object['registration']."
		Под Офис: ".$get_last_object['for_office']."
		Экслюзивный договор: ".$get_last_object['exclusive_contract']."
		Рекламировать: ".$get_last_object['advertisement']."
		Примечание агента: ".$get_last_object['agent_description']."
		----------------------------------
		<strong>Сохранить:</strong> 👇
		";
		bot("sendMessage", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_save, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'save_object';
	}
	
	if ($last_command_step == 'save_object' && $text == 'Сохранить объект в базе' && $only_callback == 'yes') {
		save_object($connect, $user_id, $last_command_vars_object_id);
		$reply = "id: ".$last_command_vars_object_id."  сохранено";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'start';
	}
	if ($last_command_step == 'search_object_by_id' && $text != '🔙 назад' && $text != '/start') {
		$id_object = $text;
		if (get_object_by_id($connect, $id_object)!= NULL) {
			$object_data = get_object_by_id($connect, $id_object);


			$reply = "
			 Объект                                                           
			id: ".$object_data['id']."
			т/н:  ".$object_data['phone_number_owner']."
			ФИО: ".$object_data['ownerName']."
			Стартовая цена: ".$object_data['startingPrice']."
			Общая площадь(м2: ".$object_data['quadrature']."
			Раздел: ".$object_data['section']."
			Тип дома: ".$object_data['typeOfHouse']."
			Расположение: ".$object_data['locations']."
			Район: ".$object_data['region']."
			Квартал: ".$object_data['quarter']."
			Улица: ".$object_data['street']."
			Этажность: ".$object_data['number_of_floors']."
			Этаж: ".$object_data['floor']."
			К-во комнат: ".$object_data['number_of_rooms']."
			Сан.узел: ".$object_data['bath_toilet']."
			Сост./рем.: ".$object_data['state_repair']."
			Тип стоения: ".$object_data['type_of_walls']."
			Планировка: ".$object_data['layout']."
			Балкон: ".$object_data['balcony']."
			Тип постройки: ".$object_data['type_of_building']."
			Торец: ".$object_data['end_face']."
			Мебель: ".$object_data['furniture']."
			Техника: ".$object_data['technic']."
			Кондиционер: ".$object_data['conditioner']."
			Пластиковые окна: ".$object_data['plast_window']."
			Удал.от дороги: ".$object_data['distance_from_road']."
			Метро: ".$object_data['underground']."
			Парковка: ".$object_data['parking']."
			Лифт: ".$object_data['elevator']."
			Крыша: ".$object_data['roof']."
			Время с пос.оформ. ".$object_data['last_registration']."
			Прописка: ".$object_data['registration']."
			Под Офис: ".$object_data['for_office']."
			Экслюзивный договор: ".$object_data['exclusive_contract']."
			Рекламировать: ".$object_data['advertisement']."
			----------------------------------
			
			";
			
			
			


		}else {
			$reply = 'Такого объекта не существует';
		}
		$reply_markup = json_encode(["keyboard"=>$main_menu, 'one_time_keyboard' => false, "resize_keyboard"=>true]);
		bot("sendMessage", ['chat_id' => $user_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
		$step = 'start';
	}
	if ($last_command_step == 'delete_object' && $text != '🔙 назад' && $text != '/start') {
		$id_object = $text;
		if (get_object_by_id($connect, $id_object)!= NULL) {
			$object_data = get_object_by_id($connect, $id_object);


			$reply = "
			Удалить объект                                                           
			id: ".$object_data['id']."
			т/н:  ".$object_data['phone_number_owner']."
			ФИО: ".$object_data['ownerName']."
			----------------------------------
			✍️ Введите описание: 
			";

			bot("sendMessage", ['chat_id' => $user_id, 'text' => $reply]);
			$vars = ['object_id' => $text];
			$step = 'update_delete_description';

		}else {
			$reply = 'Такого объекта не существует';
			bot("sendMessage", ['chat_id' => $user_id, 'text' => $reply]);
			$step = 'delete_object';
		}
		
	}
	if ($last_command_step == 'update_delete_description' && $text != '🔙 назад' && $text != '/start') {
		$name_agent = name_agent($connect, $user_id);
		$c = update_delete_description($connect, $last_command_vars_object_id, $name_agent, $text);
		// bot("sendMessage", ['chat_id' => $user_id, 'text' => var_export($c ,1)]);
		// exit();
		$reply = "вы действительно хотите удалить 👇";
		bot("sendMessage", ['chat_id' => $user_id, 'text' => $reply, 'reply_markup' => $menu_del_object]);
		
		// bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'reply_markup' => $menu_del_object, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'update_status_object';
	}
	if ($last_command_step == 'update_status_object' && $text == '✅ Удалить' && $only_callback == 'yes') {
		update_status_object($connect, $last_command_vars_object_id);
		$reply = "id: ".$last_command_vars_object_id."  удалено";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'start';
	}if ($last_command_step == 'update_status_object' && $text == '❌ Отменить' && $only_callback == 'yes') {
		$reply = "успешно отменен";
		bot("editMessageText", ['chat_id' => $user_id, 'message_id' => $message_id, 'text' =>  $reply, 'parse_mode' => 'HTML']);
		$vars = $last_command_vars;
		$step = 'start';
	}
	if ($last_command_step == 'search_object_by_phone_number' && $text != '🔙 назад' && $text != '/start') {
		$phone_number_owner = __cleanData($text);

		if (strlen($phone_number_owner) == 9) {
			$phone_number_broker = $phone_number_owner;
			$status_broker = brokers($connect, $phone_number_broker);
			
			if ($status_broker == 'isnot_broker') {
				if (get_object_by_phone($connect, $phone_number_owner)!= NULL) {
					$count = count_object_by_phone($connect, $phone_number_owner);
					$get_object_by_phone = get_object_by_phone($connect, $phone_number_owner);
					

					for ($i=0; $i < $count; $i++) { 
						$object_id = $get_object_by_phone[$i]['id'];
						$object_phone_number_owner = $get_object_by_phone[$i]['phone_number_owner'];
						$object_region = $get_object_by_phone[$i]['region'];
						$object_quarter = $get_object_by_phone[$i]['quarter'];
						$object_street = $get_object_by_phone[$i]['street'];
			
						$reply = "
						Объект                                                           
						id: ".$object_id."
						т/н: ".$object_phone_number_owner."
						";
	


						bot("sendMessage", ['chat_id' => $user_id, 'text' => $reply]);

					}


					$step = 'start';
		
				}else {
					$reply = 'Такого объекта не существует';
					bot("sendMessage", ['chat_id' => $user_id, 'text' => var_export($reply ,1)]);
					$step = 'search_object_by_phone_number';
				}
				
				
				
			}elseif ($status_broker == 'is_broker') {
				$reply = 'Есть такой маклер в базе ('.$phone_number_broker.')';
				$reply_markup = json_encode(["keyboard"=>$main_menu, 'one_time_keyboard' => false, "resize_keyboard"=>true]);
				bot("sendMessage", ['chat_id' => $user_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
				$step = 'start';
			}
			
		}
		else {
			bot("sendMessage", ['chat_id' => $user_id, 'text' => 'Пожалуйста, введите номер телефона в формате (90 123 45 67)']);
			$step = 'search_object_by_phone_number';

		}
	}
	if ($last_command_step == 'add_phone_number_broker' && $text != '🔙 назад' && $text != '/start') {
		
		$phone_number_broker = __cleanData($text);

		if (strlen($phone_number_broker) == 9) {
			$status_broker = brokers($connect, $phone_number_broker);
			
			if ($status_broker == 'isnot_broker') {
				$name_agent = name_agent($connect, $user_id);
				if(add_phone_number_broker($connect, $user_id, $phone_number_broker, $name_agent)){
					$reply = 'Номер телефона успешно добавлен';
					$reply_markup = json_encode(["keyboard"=>$main_menu, 'one_time_keyboard' => false, "resize_keyboard"=>true]);
					bot("sendMessage", ['chat_id' => $user_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
					$step = 'start';
				}
			}elseif ($status_broker == 'is_broker') {
				$reply = 'Есть такой маклер в базе ('.$phone_number_broker.')';
				$reply_markup = json_encode(["keyboard"=>$main_menu, 'one_time_keyboard' => false, "resize_keyboard"=>true]);
				bot("sendMessage", ['chat_id' => $user_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
				$step = 'start';
			}
		}
		else {
			bot("sendMessage", ['chat_id' => $user_id, 'text' => 'Пожалуйста, введите номер телефона в формате (90 123 45 67)']);
			$step = 'add_phone_number_broker';

		}
	}
	if ($last_command_step == 'check_phone_number_broker' && $text != '🔙 назад' && $text != '/start') {
		
		$phone_number_broker = __cleanData($text);

		if (strlen($phone_number_broker) == 9) {
			$status_broker = brokers($connect, $phone_number_broker);
			
			if ($status_broker == 'isnot_broker') {
				
					$reply = 'Нету такой маклер в базе ('.$phone_number_broker.')';
					$reply_markup = json_encode(["keyboard"=>$main_menu, 'one_time_keyboard' => false, "resize_keyboard"=>true]);
					bot("sendMessage", ['chat_id' => $user_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
					$step = 'start';
				
			}elseif ($status_broker == 'is_broker') {
				$reply = 'Есть такой маклер в базе ('.$phone_number_broker.')';
				$reply_markup = json_encode(["keyboard"=>$main_menu, 'one_time_keyboard' => false, "resize_keyboard"=>true]);
				bot("sendMessage", ['chat_id' => $user_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
				$step = 'start';
			}
		}
		else {
			bot("sendMessage", ['chat_id' => $user_id, 'text' => 'Пожалуйста, введите номер телефона в формате (90 123 45 67)']);
			$step = 'check_phone_number_broker';

		}
	}


	
	


}elseif($is_user == 'isnot_user' && !isset($phone_number)){
	$reply_markup = json_encode(["keyboard"=>$sendContact,"resize_keyboard"=>true]);
	bot("sendMessage", ['chat_id' => $user_id, 'text' => "😊 Пожалуйста поделитесь номером\n телефона, чтобы продолжить", 'reply_markup' => $reply_markup]);
}

if (isset($phone_number)) {
	$agents = agents($connect, $phone_number);
	if ($agents == 'is_agent') {
		writeUserId($connect, $phone_number, $user_id);
		$reply_markup = json_encode(["keyboard"=>$main_menu, "resize_keyboard"=>true, 'one_time_keyboard' => false]);
		bot("sendMessage", ['chat_id' => $user_id, 'text' => "Добро пожаловать", 'reply_markup' => $reply_markup]);
	}
	else{
		$reply_markup = json_encode(["remove_keyboard" => true]);
		bot("sendMessage", ['chat_id' => $user_id, 'text' => '⛔️ Вам не разрешено использовать этот бот!', 'reply_markup' => $reply_markup]);
	}
}



if (isset($step)) {
	textlog($connect, $user_id, $text, $step, $vars);
}
	

	



	
            

?>