<?php

//------------------------------------------------------------------------
$sendContact = array(array(array('text'=>"☎️ Поделиться номером телефона", 'request_contact'=>true)));

//------------------------------------------------------------------------
// $main_menu = [["➕ Добавить новый объект"],["🔍 Найти объект по ид" , "🔍 Найти объект по т/н"],["👥 Маклер","📖 Инструкция"]];

$main_menu = [["➕ Добавить объект"],["🗑 Удалить объект" , "🔍 Найти объект"],["👥 Маклер","📖 Инструкция"]];

//------------------------------------------------------------------------

$menu_back_main = [["🔙 назад"]];
//------------------------------------------------------------------------

$menu_search_object = [["🔍 Найти объект по ид", "🔍 Найти объект по т/н"], ["🔙 назад"]];

//------------------------------------------------------------------------

$menu_broker = [["➕ добавить т/н маклера", "🔍 Проверит т/н маклера"], ["🔙 назад"]];
//------------------------------------------------------------------------
//choose menu regions:

$count = regionsCount($connect);
$regions_all = regions_all($connect);


$inline_keyboard = array();
for ($i=0; $i < $count; $i++) { 
    $region = $regions_all[$i]['name_region'];
    $inline_button = array("text"=>$region,"callback_data"=>$region);  
	$inline_keyboard[] = array($inline_button);
}
$keyboard=array("inline_keyboard"=>$inline_keyboard);

$menu_regions = json_encode($keyboard);



//------------------------------------------------------------------------

$inline_button1 = array("text"=>"Магазин-бутики","callback_data"=>'Магазин-бутики');
$inline_button2 = array("text"=>"Салоны","callback_data"=>'Салоны');
$inline_button3 = array("text"=>"Ресторан-кафе-бары","callback_data"=>'Ресторан-кафе-бары');
$inline_button4 = array("text"=>"Офис","callback_data"=>'Офис');
$inline_button5 = array("text"=>"Склады","callback_data"=>'Склады');
$inline_button6 = array("text"=>"Отдельно стоящие здание","callback_data"=>'Отдельно стоящие здание');
$inline_button7 = array("text"=>"Базы отдыха","callback_data"=>'Базы отдыха');
$inline_button8 = array("text"=>"Перем. пром. назначения","callback_data"=>'Перем. пром. назначения');
$inline_button9 = array("text"=>"Помещ. своб. назначения","callback_data"=>'Помещ. своб. назначения');
$inline_button10 = array("text"=>"Малая архи.я форма)","callback_data"=>'Малая архи.я форма');
$inline_button11 = array("text"=>"Част здания","callback_data"=>'Част здания');
$inline_button12 = array("text"=>"Другое","callback_data"=>'Другое');



$inline_keyboard = [
    [$inline_button1] , [$inline_button2], 
    [$inline_button3], [$inline_button4],
    [$inline_button5] , [$inline_button6],
    [$inline_button7] , [$inline_button8] ,
    [$inline_button9], [$inline_button10] ,
    [$inline_button11] , [$inline_button12]
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_commercial = json_encode($keyboard);


//------------------------------------------------------------------------

$inline_button1 = array("text"=>"✅ Удалить","callback_data"=>'✅ Удалить');
$inline_button2 = array("text"=>"❌ Отменить","callback_data"=>'❌ Отменить');


$inline_keyboard = [
    [$inline_button1] , [$inline_button2]
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_del_object = json_encode($keyboard);
//------------------------------------------------------------------------

$inline_button1 = array("text"=>"1","callback_data"=>'1');
$inline_button2 = array("text"=>"2","callback_data"=>'2');
$inline_button3 = array("text"=>"3","callback_data"=>'3');
$inline_button4 = array("text"=>"4","callback_data"=>'4');
$inline_button5 = array("text"=>"5","callback_data"=>'5');
$inline_button6 = array("text"=>"6","callback_data"=>'6');
$inline_button7 = array("text"=>"7","callback_data"=>'7');
$inline_button8 = array("text"=>"8","callback_data"=>'8');
$inline_button9 = array("text"=>"9","callback_data"=>'9');
$inline_button10 = array("text"=>"10","callback_data"=>'10');
$inline_button11 = array("text"=>"11","callback_data"=>'11');
$inline_button12 = array("text"=>"12","callback_data"=>'12');
$inline_button13 = array("text"=>"13","callback_data"=>'13');
$inline_button14 = array("text"=>"14","callback_data"=>'14');
$inline_button15 = array("text"=>"15","callback_data"=>'15');
$inline_button16 = array("text"=>"16","callback_data"=>'16');
$inline_button17 = array("text"=>"Другое","callback_data"=>'Другое');

$inline_keyboard = [
    [$inline_button1 , $inline_button2, $inline_button3] , 
    [$inline_button4, $inline_button5 , $inline_button6] ,
    [$inline_button7 , $inline_button8, $inline_button9 ] ,
    [$inline_button10, $inline_button11 , $inline_button12] ,
    [$inline_button13 , $inline_button14, $inline_button15] ,
              [$inline_button16, $inline_button17] 
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_number_of_floors = json_encode($keyboard);
//------------------------------------------------------------------------


$inline_button1 = array("text"=>"1*1","callback_data"=>'1*1');
$inline_button2 = array("text"=>"1*2","callback_data"=>'1*2');
$inline_button3 = array("text"=>"1*3","callback_data"=>'1*3');
$inline_button4 = array("text"=>"1*4","callback_data"=>'1*4');
$inline_button5 = array("text"=>"1*5","callback_data"=>'1*5');
$inline_button6 = array("text"=>"1*6","callback_data"=>'1*6');

$inline_button7 = array("text"=>"2*1","callback_data"=>'2*1');
$inline_button8 = array("text"=>"2*2","callback_data"=>'2*2');
$inline_button9 = array("text"=>"2*3","callback_data"=>'2*3');
$inline_button10 = array("text"=>"2*4","callback_data"=>'2*4');
$inline_button11 = array("text"=>"2*5","callback_data"=>'2*5');
$inline_button12 = array("text"=>"2*6","callback_data"=>'2*6');
$inline_button13 = array("text"=>"2*7","callback_data"=>'2*7');

$inline_button14 = array("text"=>"3*2","callback_data"=>'3*2');
$inline_button15 = array("text"=>"3*4","callback_data"=>'3*6');

$inline_button16 = array("text"=>"нет","callback_data"=>'нет');
$inline_button17 = array("text"=>"Г-образ","callback_data"=>'Г-образ');
$inline_button18 = array("text"=>"Терасса","callback_data"=>'Терасса');
$inline_button19 = array("text"=>"Другое","callback_data"=>'Другое');

$inline_keyboard = [
    [$inline_button1 , $inline_button2, $inline_button3] , 
    [$inline_button4, $inline_button5 , $inline_button6] ,
    [$inline_button7 , $inline_button8, $inline_button9 ] ,
    [$inline_button10, $inline_button11 , $inline_button12] ,
    [$inline_button13 , $inline_button14, $inline_button15] ,
    [$inline_button16 , $inline_button17, $inline_button18] ,
              [$inline_button16, $inline_button19]
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_balcony = json_encode($keyboard);

//------------------------------------------------------------------------


$inline_button1 = array("text"=>"1","callback_data"=>'1');
$inline_button2 = array("text"=>"2","callback_data"=>'2');
$inline_button3 = array("text"=>"3","callback_data"=>'3');
$inline_button4 = array("text"=>"4","callback_data"=>'4');
$inline_button5 = array("text"=>"5","callback_data"=>'5');
$inline_button6 = array("text"=>"6","callback_data"=>'6');
$inline_button7 = array("text"=>"7","callback_data"=>'7');
$inline_button8 = array("text"=>"8","callback_data"=>'8');
$inline_button9 = array("text"=>"9","callback_data"=>'9');
$inline_button10 = array("text"=>"10","callback_data"=>'10');
$inline_button11 = array("text"=>"Другое","callback_data"=>'Другое');

$inline_keyboard = [
    [$inline_button1 , $inline_button2, $inline_button3] , 
    [$inline_button4, $inline_button5 , $inline_button6] ,
    [$inline_button7 , $inline_button8, $inline_button9 ] ,
           [$inline_button10, $inline_button11] 
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_registration = json_encode($keyboard);

//------------------------------------------------------------------------

$inline_button1 = array("text"=>"Авторский ремонт","callback_data"=>'Авторский ремонт');
$inline_button2 = array("text"=>"Без ремонта","callback_data"=>'Без ремонта');
$inline_button3 = array("text"=>"Евроремонт","callback_data"=>'Евроремонт');
$inline_button4 = array("text"=>"Капитальный ремонт","callback_data"=>'Капитальный ремонт');
$inline_button5 = array("text"=>"Коробка","callback_data"=>'Коробка');
$inline_button6 = array("text"=>"Косметический ремон","callback_data"=>'Косметический ремон');
$inline_button7 = array("text"=>"Пред чистовая отделка","callback_data"=>'Пред чистовая отделка');
$inline_button8 = array("text"=>"Средний ремонт","callback_data"=>'Средний ремонт');
$inline_button9 = array("text"=>"Требует ремонта","callback_data"=>'Требует ремонта');
$inline_button10 = array("text"=>"Частичный ремонт","callback_data"=>'Частичный ремонт');
$inline_button11 = array("text"=>"Черновая отделка","callback_data"=>'Черновая отделка');
$inline_button12 = array("text"=>"Чистая аккуратная","callback_data"=>'Чистая аккуратная');
$inline_button13 = array("text"=>"Другое","callback_data"=>'Другое');

$inline_keyboard = [
    [$inline_button1 , $inline_button2], 
    [$inline_button3, $inline_button4],
    [$inline_button5 , $inline_button6],
    [$inline_button7 , $inline_button8] ,
    [$inline_button9, $inline_button10] ,
    [$inline_button11 , $inline_button12],
            [$inline_button13] 
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_state_repair = json_encode($keyboard);

//------------------------------------------------------------------------



$inline_button1 = array("text"=>"Зеркальная","callback_data"=>'Зеркальная');
$inline_button2 = array("text"=>"Коробка","callback_data"=>'Коробка');
$inline_button3 = array("text"=>"Малогабаритная","callback_data"=>'Малогабаритная');
$inline_button4 = array("text"=>"Малосемейная","callback_data"=>'Малосемейная');
$inline_button5 = array("text"=>"Многоуровневая","callback_data"=>'Многоуровневая');
$inline_button6 = array("text"=>"Однокомнатная","callback_data"=>'Однокомнатная');
$inline_button7 = array("text"=>"Параллельная","callback_data"=>'Параллельная');
$inline_button8 = array("text"=>"Раздельная","callback_data"=>'Раздельная');
$inline_button9 = array("text"=>"Свободная","callback_data"=>'Свободная');
$inline_button10 = array("text"=>"Смежная","callback_data"=>'Смежная');
$inline_button11 = array("text"=>"Смежно-раздельная","callback_data"=>'Смежно-раздельная');
$inline_button12 = array("text"=>"Студия","callback_data"=>'Студия');
$inline_button13 = array("text"=>"Другое","callback_data"=>'Другое');

$inline_keyboard = [
    [$inline_button1 , $inline_button2], 
    [$inline_button3, $inline_button4],
    [$inline_button5 , $inline_button6],
    [$inline_button7 , $inline_button8] ,
    [$inline_button9, $inline_button10] ,
    [$inline_button11 , $inline_button12],
            [$inline_button13] 
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_layout = json_encode($keyboard);

//------------------------------------------------------------------------

$inline_button1 = array("text"=>"76 серия","callback_data"=>'76 серия');
$inline_button2 = array("text"=>"77 серия","callback_data"=>'77 серия');
$inline_button3 = array("text"=>"Банковская","callback_data"=>'Банковская');
$inline_button4 = array("text"=>"Высокопотолочная","callback_data"=>'Высокопотолочная');
$inline_button5 = array("text"=>"Галерейная","callback_data"=>'Галерейная');
$inline_button6 = array("text"=>"Грузинская","callback_data"=>'Грузинская');
$inline_button7 = array("text"=>"Казахская","callback_data"=>'Казахская');
$inline_button8 = array("text"=>"Московская","callback_data"=>'Московская');
$inline_button9 = array("text"=>"Новостройка","callback_data"=>'Новостройка');
$inline_button10 = array("text"=>"Общежитие","callback_data"=>'Общежитие');
$inline_button11 = array("text"=>"Специальная","callback_data"=>'Специальная');
$inline_button12 = array("text"=>"Улучшенная","callback_data"=>'Улучшенная');
$inline_button13 = array("text"=>"Французская","callback_data"=>'Французская');
$inline_button14 = array("text"=>"Хрущевка","callback_data"=>'Хрущевка');
$inline_button15 = array("text"=>"Экспериментальная","callback_data"=>'Экспериментальная');
$inline_button16 = array("text"=>"Японская","callback_data"=>'Японская');
$inline_button17 = array("text"=>"Другое","callback_data"=>'Другое');

$inline_keyboard = [
    [$inline_button1 , $inline_button2], 
    [$inline_button3, $inline_button4],
    [$inline_button5 , $inline_button6],
    [$inline_button7 , $inline_button8] ,
    [$inline_button9, $inline_button10] ,
    [$inline_button11 , $inline_button12],
    [$inline_button13 , $inline_button14],
    [$inline_button15 , $inline_button16],
            [$inline_button17] 
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_type_of_building = json_encode($keyboard);


//------------------------------------------------------------------------

$select = array("text"=>"📍 Выберите ориентиры:","callback_data"=>'Выберите ориентиры');
$inline_button1 = array("text"=>"школа №1","callback_data"=>'школа №1');
$inline_button2 = array("text"=>"Детский сад","callback_data"=>'Детский сад');
$inline_button3 = array("text"=>"Кафе Москва","callback_data"=>'Кафе Москва');
$inline_button4 = array("text"=>"Загс","callback_data"=>'Загс');
$inline_button5 = array("text"=>"Другое","callback_data"=>'Другое');

$inline_keyboard = [
              [$select],
    [$inline_button1 , $inline_button2] , 
    [$inline_button3 , $inline_button4] ,
         [$inline_button5] ,
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_landmark = json_encode($keyboard);

//------------------------------------------------------------------------

$inline_button1 = array("text"=>"Квартира","callback_data"=>'Квартира');
$inline_button2 = array("text"=>"Дом","callback_data"=>'Дом');
$inline_button3 = array("text"=>"Коммерческой","callback_data"=>'Коммерческой');
$inline_button4 = array("text"=>"Земля","callback_data"=>'Земля');

$inline_keyboard = [
    [$inline_button1] , 
    [$inline_button2] , 
    [$inline_button3] , 
    [$inline_button4] 
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_section = json_encode($keyboard);

//------------------------------------------------------------------------

$inline_button1 = array("text"=>"Под строительство","callback_data"=>'Под строительство');
$inline_button2 = array("text"=>"Под сад/огород","callback_data"=>'Под сад/огород');
$inline_button3 = array("text"=>"Земля с/х назначения","callback_data"=>'Земля с/х назначения');
$inline_button4 = array("text"=>"Промышленного назначения","callback_data"=>'Промышленного назначения');

$inline_keyboard = [
    [$inline_button1] , 
    [$inline_button2] , 
    [$inline_button3] , 
    [$inline_button4] 
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_area = json_encode($keyboard);

//------------------------------------------------------------------------

$inline_button1 = array("text"=>"Дом","callback_data"=>'Дом');
$inline_button2 = array("text"=>"Флигель","callback_data"=>'Флигель');
$inline_button3 = array("text"=>"Коттедж","callback_data"=>'Коттедж');
$inline_button5 = array("text"=>"Част дома","callback_data"=>'Част дома');
$inline_button6 = array("text"=>"Дача","callback_data"=>'Дача');
$inline_button7 = array("text"=>"Таунхаус","callback_data"=>'Таунхаус');



$inline_keyboard = [
    [$inline_button1] , 
    [$inline_button2] , 
    [$inline_button3] , 
    [$inline_button4] ,
    [$inline_button5] ,
    [$inline_button6] ,
    [$inline_button7] 

];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_typeOfHouse = json_encode($keyboard);
//------------------------------------------------------------------------

$inline_button1 = array("text"=>"1 ряд","callback_data"=>'1 ряд');
$inline_button2 = array("text"=>"2 ряд","callback_data"=>'2 ряд');
$inline_button3 = array("text"=>"3 ряд","callback_data"=>'3 ряд');
$inline_button4 = array("text"=>"Вдоль дороги","callback_data"=>'Вдоль дороги');
$inline_button5 = array("text"=>"Внутри района","callback_data"=>'Внутри района');
$inline_button6 = array("text"=>"Торцом к дороге","callback_data"=>'Торцом к дороге');
$inline_button7 = array("text"=>"Другое","callback_data"=>'Другое');


$inline_keyboard = [
    [$inline_button1 , $inline_button2] , 
    [$inline_button3 , $inline_button4] ,
    [$inline_button5 , $inline_button6] ,
         [$inline_button7]
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_distance_from_road = json_encode($keyboard);

//------------------------------------------------------------------------

$inline_button1 = array("text"=>"От 250 (м) до 500 (м)","callback_data"=>'От 250 (м) до 500 (м)');
$inline_button2 = array("text"=>"От 500 (м) до 1000 (м)","callback_data"=>'От 500 (м) до 1000 (м)');
$inline_button3 = array("text"=>"От 1000 (м) до 2000 (м)","callback_data"=>'От 1000 (м) до 2000 (м)');
$inline_button4 = array("text"=>"Более 2000 (м)","callback_data"=>'Более 2000 (м)');
$inline_button5 = array("text"=>"Нет","callback_data"=>'Нет');
$inline_button6 = array("text"=>"Рядом","callback_data"=>'Рядом');
$inline_button7 = array("text"=>"Другое","callback_data"=>'Другое');


$inline_keyboard = [
    [$inline_button1 , $inline_button2] , 
    [$inline_button3 , $inline_button4] ,
    [$inline_button5 , $inline_button6] ,
         [$inline_button7]
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_underground = json_encode($keyboard);

//------------------------------------------------------------------------

$inline_button1 = array("text"=>"Да","callback_data"=>'Да');
$inline_button2 = array("text"=>"Нет","callback_data"=>'Нет');
$inline_button3 = array("text"=>"Прилегающая общая","callback_data"=>'Прилегающая общая');
$inline_button4 = array("text"=>"Собственная","callback_data"=>'Собственная');
$inline_button5 = array("text"=>"Другое","callback_data"=>'Другое');


$inline_keyboard = [
    [$inline_button1 , $inline_button2] , 
    [$inline_button3 , $inline_button4] ,
         [$inline_button5]
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_parking = json_encode($keyboard);

//------------------------------------------------------------------------

$inline_button1 = array("text"=>"Керамзит","callback_data"=>'Керамзит');
$inline_button2 = array("text"=>"Кирпич","callback_data"=>'Кирпич');
$inline_button3 = array("text"=>"Монолит","callback_data"=>'Монолит');
$inline_button4 = array("text"=>"Панел","callback_data"=>'Панел');
$inline_button5 = array("text"=>"Другое","callback_data"=>'Другое');

$inline_keyboard = [
    [$inline_button1 , $inline_button2] , 
    [$inline_button3 , $inline_button4] ,
         [$inline_button5] 
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_type_of_walls = json_encode($keyboard);

//------------------------------------------------------------------------

$inline_button1 = array("text"=>"В городе","callback_data"=>'В городе');
$inline_button2 = array("text"=>"В пригороде","callback_data"=>'В пригороде');
$inline_button3 = array("text"=>"В селс. мест.","callback_data"=>'В селс. мест.');
$inline_button4 = array("text"=>"Вдоль трассы","callback_data"=>'Вдоль трассы');
$inline_button5 = array("text"=>"В предгоях","callback_data"=>'В предгоях');
$inline_button6 = array("text"=>"В дачном массиве","callback_data"=>'В дачном массиве');
$inline_button7 = array("text"=>"На зак.й территори","callback_data"=>'На зак.й территори');
$inline_button8 = array("text"=>"Другое","callback_data"=>'Другое');




$inline_keyboard = [
    [$inline_button1 , $inline_button2] , 
    [$inline_button3 , $inline_button4] ,
    [$inline_button5 , $inline_button6] ,
    [$inline_button7, $inline_button8] 
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_location = json_encode($keyboard);

//------------------------------------------------------------------------

$inline_button1 = array("text"=>"2 и более","callback_data"=>'2 и более');
$inline_button2 = array("text"=>"Нету","callback_data"=>'нету');
$inline_button3 = array("text"=>"Раздельный","callback_data"=>'Раздельный');
$inline_button4 = array("text"=>"Совмещенный","callback_data"=>'Совмещенный');
$inline_button5 = array("text"=>"Другое","callback_data"=>'Другое');

$inline_keyboard = [
    [$inline_button1 , $inline_button2] , 
    [$inline_button3 , $inline_button4] ,
         [$inline_button5] ,
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_bath = json_encode($keyboard);

//------------------------------------------------------------------------

$inline_button1 = array("text"=>"Торец","callback_data"=>'Торец');
$inline_button2 = array("text"=>"Не торец","callback_data"=>'Не торец');
$inline_button3 = array("text"=>"Другое","callback_data"=>'Другое');

$inline_keyboard = [
    [$inline_button1 , $inline_button2] , 
         [$inline_button3]
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_end_face = json_encode($keyboard);
//------------------------------------------------------------------------

$inline_button1 = array("text"=>"Да","callback_data"=>'Да');
$inline_button2 = array("text"=>"Нет","callback_data"=>'Нет');
$inline_button3 = array("text"=>"Частично","callback_data"=>'Частично');
$inline_button4 = array("text"=>"Другое","callback_data"=>'Другое');

$inline_keyboard = [
    [$inline_button1 , $inline_button2] , 
    [$inline_button3, $inline_button4]
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_furniture = json_encode($keyboard);

//------------------------------------------------------------------------

$inline_button1 = array("text"=>"Да","callback_data"=>'Да');
$inline_button2 = array("text"=>"Нет","callback_data"=>'Нет');
$inline_button3 = array("text"=>"Другое","callback_data"=>'Другое');

$inline_keyboard = [
    [$inline_button1 , $inline_button2] , 
             [$inline_button3]
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_technic = json_encode($keyboard);

//------------------------------------------------------------------------

$inline_button1 = array("text"=>"Да","callback_data"=>'Да');
$inline_button2 = array("text"=>"Нет","callback_data"=>'Нет');
$inline_button3 = array("text"=>"Другое","callback_data"=>'Другое');

$inline_keyboard = [
    [$inline_button1 , $inline_button2] , 
             [$inline_button3]
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_for_office = json_encode($keyboard);
//------------------------------------------------------------------------

$inline_button1 = array("text"=>"Да","callback_data"=>'Да');
$inline_button2 = array("text"=>"Нет","callback_data"=>'Нет');
$inline_button3 = array("text"=>"Другое","callback_data"=>'Другое');

$inline_keyboard = [
    [$inline_button1 , $inline_button2] , 
             [$inline_button3]
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_exclusive_contract = json_encode($keyboard);
//------------------------------------------------------------------------

$inline_button1 = array("text"=>"Да","callback_data"=>'Да');
$inline_button2 = array("text"=>"Нет","callback_data"=>'Нет');
$inline_button3 = array("text"=>"Другое","callback_data"=>'Другое');

$inline_keyboard = [
    [$inline_button1 , $inline_button2] , 
             [$inline_button3]
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_advertisement = json_encode($keyboard);
//------------------------------------------------------------------------

$inline_button1 = array("text"=>"Да","callback_data"=>'Да');
$inline_button2 = array("text"=>"Нет","callback_data"=>'Нет');
$inline_button3 = array("text"=>"Другое","callback_data"=>'Другое');

$inline_keyboard = [
    [$inline_button1 , $inline_button2] , 
             [$inline_button3]
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_elevator = json_encode($keyboard);
//------------------------------------------------------------------------

$inline_button1 = array("text"=>"Не последний этаж","callback_data"=>'Не последний этаж');
$inline_button2 = array("text"=>"Течёт","callback_data"=>'Течёт');
$inline_button3 = array("text"=>"Новая","callback_data"=>'Новая');
$inline_button4 = array("text"=>"Старая","callback_data"=>'Старая');
$inline_button5 = array("text"=>"Другое","callback_data"=>'Другое');

$inline_keyboard = [
    [$inline_button1 , $inline_button2] , 
    [$inline_button3 , $inline_button4] , 
             [$inline_button5]
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_roof = json_encode($keyboard);
//------------------------------------------------------------------------

$inline_button1 = array("text"=>"Менее 3х лет","callback_data"=>'Менее 3х лет');
$inline_button2 = array("text"=>"Более 3х лет","callback_data"=>'Более 3х лет');
$inline_button3 = array("text"=>"Другое","callback_data"=>'Другое');

$inline_keyboard = [
    [$inline_button1 , $inline_button2] , 
             [$inline_button3]
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_last_registration = json_encode($keyboard);

//------------------------------------------------------------------------

$inline_button1 = array("text"=>"Да","callback_data"=>'Да');
$inline_button2 = array("text"=>"Нет","callback_data"=>'Нет');
$inline_button3 = array("text"=>"Другое","callback_data"=>'Другое');

$inline_keyboard = [
    [$inline_button1 , $inline_button2] , 
             [$inline_button3]
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_conditioner = json_encode($keyboard);

//------------------------------------------------------------------------

$inline_button1 = array("text"=>"Да","callback_data"=>'Да');
$inline_button2 = array("text"=>"Нет","callback_data"=>'Нет');
$inline_button3 = array("text"=>"Другое","callback_data"=>'Другое');

$inline_keyboard = [
    [$inline_button1 , $inline_button2] , 
             [$inline_button3]
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_plast_window = json_encode($keyboard);

//------------------------------------------------------------------------

$select = array("text"=>"📍 Выберите улицу:","callback_data"=>'Выберите улицу');
$inline_button1 = array("text"=>"Арнасай","callback_data"=>'Арнасай');
$inline_button2 = array("text"=>"Гагарин","callback_data"=>'Гагарин');
$inline_button3 = array("text"=>"Мукими","callback_data"=>'Мукими');

$inline_keyboard = [
    [$select],
    [$inline_button1] , 
    [$inline_button2] ,
    [$inline_button3] ,
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_street = json_encode($keyboard);
//------------------------------------------------------------------------


$select = array("text"=>"Сохранить объект в базе","callback_data"=>'Сохранить объект в базе');

$inline_keyboard = [
    [$select]
];


$keyboard=array("inline_keyboard"=>$inline_keyboard);
$menu_save = json_encode($keyboard);
//------------------------------------------------------------------------


$inline_buttonss1 = array("text"=>"Удалить объект","callback_data"=>'Удалить объект');

$inline_keyboardss = [[$inline_buttonss1]];
$keyboardss=array("inline_keyboard"=>$inline_keyboardss);
$menu_delete_unsaved_object = json_encode($keyboardss);



//------------------------------------------------------------------------



$in_key = [[]];
$key=array("inline_keyboard"=>$in_key);
$remove_menu  = json_encode($key);





?>