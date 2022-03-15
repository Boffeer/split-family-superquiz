<?php

// Еще внизу есть mail_to
// $email_to = 'trofimenkonick@yandex.ru';
$email_to = 'vekzakona@yandex.ru';
$email_from = 'info@splitfamily.ru';
$email_subject = "Новый результат большого квиза";

$msg_box = "";
$errors = array();

// если форма без ошибок
if (empty($errors)) {
	$user_name = $_POST['user_name'];
	$user_tel = $_POST['user_tel'];
	$user_email = $_POST['user_email'];
	$spouse_name =  $_POST['spouse_name'];
	$spouse_tel =  $_POST['spouse_tel'];
	$spouse_email =  $_POST['spouse_email'];
	$question_divorce__plan =  $_POST['question_divorce__plan'];
	$question_divorce__relations =  $_POST['question_divorce__relations'];
	$question_divorce__divorce_date =  $_POST['question_divorce__divorce_date'];
	$question_divorce__together =  $_POST['question_divorce__together'];
	$question_divorce__date_no_relations =  $_POST['question_divorce__date_no_relations'];
	$question_children__have =  $_POST['question_children__have'];
	$question_children__age =  $_POST['question_children__age'];
	$question_children__live_with_you =  $_POST['question_children__live_with_you'];
	$question_children__dispute_livingplace =  $_POST['question_children__dispute_livingplace'];
	$question_children__livingplace_list =  $_POST['question_children__livingplace_list'];
	$question_children__dispute_communication =  $_POST['question_children__dispute_communication'];
	$question_children__communication_schedule =  $_POST['question_children__communication_schedule'];
	$question_alimoney__dispute =  $_POST['question_alimoney__dispute'];
	$question_alimoney__recovered =  $_POST['question_alimoney__recovered'];
	$question_alimoney__amount =  $_POST['question_alimoney__amount'];
	$question_alimoney__payer_official_income =  $_POST['question_alimoney__payer_official_income'];
	$question_alimoney__payer_income =  $_POST['question_alimoney__payer_income'];
	$question_alimoney__payer_unofficial =  $_POST['question_alimoney__payer_unofficial'];
	$question_alimoney__payer_unemployed =  $_POST['question_alimoney__payer_unemployed'];
	$question_alimoney__payer_businessman =  $_POST['question_alimoney__payer_businessman'];
	$question_alimoney__payer_credit =  $_POST['question_alimoney__payer_credit'];
	$question_alimoney__dispute_result =  $_POST['question_alimoney__dispute_result'];
	$question_alimoney__payer_children_amount =  $_POST['question_alimoney__payer_children_amount'];
	$question_alimoney__your_additional_expenses =  $_POST['question_alimoney__your_additional_expenses'];
	$question_alimoney__your_expenses_education =  $_POST['question_alimoney__your_expenses_education'];
	$question_alimoney__your_expenses_rehabilitation =  $_POST['question_alimoney__your_expenses_rehabilitation'];
	$question_alimoney__your_expenses_home =  $_POST['question_alimoney__your_expenses_home'];
	$question_alimoney__your_expenses_children_about =  $_POST['question_alimoney__your_expenses_children_about'];
	$question_alimoney__your_expenses_children =  $_POST['question_alimoney__your_expenses_children'];
	$question_alimoney__maintenanse =  $_POST['question_alimoney__maintenanse'];
	$question_alimoney__little_children =  $_POST['question_alimoney__little_children'];
	$question_alimoney__maintenanse_disabled =  $_POST['question_alimoney__maintenanse_disabled'];
	$question_alimoney__you_disabled =  $_POST['question_alimoney__you_disabled'];
	$question_alimoney__you_need_help =  $_POST['question_alimoney__you_need_help'];
	$question_alimoney__maintenanse_amount =  $_POST['question_alimoney__maintenanse_amount'];
	$question_money__jointly_property =  $_POST['question_money__jointly_property'];
	$question_money__disput_moments =  $_POST['question_money__disput_moments'];
	$question_money__marriage_agreement =  $_POST['question_money__marriage_agreement'];
	$question_money__jointly_property_list =  $_POST['question_money__jointly_property_list'];
	$question_money__jointly_property_cost =  $_POST['question_money__jointly_property_cost'];
	$question_money__jointly_money =  $_POST['question_money__jointly_money'];
	$question_money__maternity_capital =  $_POST['question_money__maternity_capital'];
	$question_money__wifes_personal =  $_POST['question_money__wifes_personal'];
	$question_money__mans_personal =  $_POST['question_money__mans_personal'];
	$question_money__credit_money =  $_POST['question_money__credit_money'];
	$question_money__repaired_estate =  $_POST['question_money__repaired_estate'];
	$question_money__repaired_estate_cost =  $_POST['question_money__repaired_estate_cost'];
	$question_money__repaired_estate_additional_cost =  $_POST['question_money__repaired_estate_additional_cost'];
	$question_money__repaired_estate_jointly =  $_POST['question_money__repaired_estate_jointly'];
	$question_money__repaired_estate_maternity =  $_POST['question_money__repaired_estate_maternity'];
	$question_money__repaired_estate_wifes_personal =  $_POST['question_money__repaired_estate_wifes_personal'];
	$question_money__repaired_estate_mans_personal =  $_POST['question_money__repaired_estate_mans_personal'];
	$question_money__repaired_estate_credit =  $_POST['question_money__repaired_estate_credit'];
	$question_credits__obligations =  $_POST['question_credits__obligations'];
	$question_credits__obligations_target =  $_POST['question_credits__obligations_target'];
	$question_credits__obligations_rest =  $_POST['question_credits__obligations_rest'];
	$question_credits__obligations_payer =  $_POST['question_credits__obligations_payer'];
	$question_credits__property_division =  $_POST['question_credits__property_division'];
	$actual_link = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
	// собираем данные из формы
	$message;
	if ($user_name != '-') {
		$message .=
			"<h3>ФИО прошедшего квиз</h3><br> " . $user_name;
	}
	if ($user_tel != '-') {
		$message .=
			"<br><br><h3>Телефон прошедшего квиз</h3><br> " . $user_tel;
	}
	if ($user_email != '-') {
		$message .=
			"<br><br><h3>Email прошедшего квиз</h3><br> " . $user_email;
	}
	if ($spouse_email != '-') {
		$message .=
			"<br><br><h3>ФИО второго супруга</h3><br> " . $spouse_name;
	}
	if ($spouse_email != '-') {
		$message .=
			"<br><br><h3>Телефон второго супруга</h3><br> " . $spouse_tel;
	}
	if ($spouse_email != '-') {
		$message .=
			"<br><br><h3>Email второго супруга</h3><br> " . $spouse_email;
	}
	if ($question_divorce__plan != '-') {
		$message .=
			"<br><br><h3>Планируют развод?</h3><br> " . $question_divorce__plan;
	}
	if ($question_divorce__relations != '-') {
		$message .=
			"<br><br><h3>Фактически отношения были прекращены?</h3><br> " . $question_divorce__relations;
	}
	if ($question_divorce__divorce_date != '-') {
		$message .=
			"<br><br><h3>Дата расторжения брака</h3><br> " . $question_divorce__divorce_date;
	}
	if ($question_divorce__together != '-') {
		$message .=
			"<br><br><h3>Живут совместно?</h3><br> " . $question_divorce__together;
	}
	if ($question_divorce__date_no_relations != '-') {
		$message .=
			"<br><br><h3>Не ведет общее хозяйство с супругом с</h3><br> " . $question_divorce__date_no_relations;
	}
	if ($question_children__have != '-') {
		$message .=
			"<br><br><h3>Есть совместные дети?</h3><br> " . $question_children__have;
	}
	if ($question_children__age != '-') {
		$message .=
			"<br><br><h3>Имена и возраст детей</h3><br> " . $question_children__age;
	}
	if ($question_children__live_with_you != '-') {
		$message .=
			"<br><br><h3>Дети проживают с вами?</h3><br> " . $question_children__live_with_you;
	}
	if ($question_children__dispute_livingplace != '-') {
		$message .=
			"<br><br><h3>Есть ли спор относительно места жительства детей?</h3><br> " . $question_children__dispute_livingplace;
	}
	if ($question_children__livingplace_list != '-') {
		$message .=
			"<br><br><h3>Где должны проживать дети?</h3><br> " . $question_children__livingplace_list;
	}
	if ($question_children__dispute_communication != '-') {
		$message .=
			"<br><br><h3>Есть ли спор относительно общения с детьми?</h3><br> " . $question_children__dispute_communication;
	}
	if ($question_children__communication_schedule != '-') {
		$message .=
			"<br><br><h3>Приемлемый график общения детей (с учетом занятости детей, удаленности проживания) с родителем, который проживает отдельно от детей</h3><br> " . $question_children__communication_schedule;
	}
	if ($question_alimoney__dispute != '-') {
		$message .=
			"<br><br><h3>Есть ли спор по алиментным обязательствам?</h3><br> " . $question_alimoney__dispute;
	}
	if ($question_alimoney__recovered != '-') {
		$message .=
			"<br><br><h3>Алименты уже взысканы?</h3><br> " . $question_alimoney__recovered;
	}
	if ($question_alimoney__amount != '-') {
		$message .=
			"<br><br><h3>Какую сумму вы получаете (платите) или должны получать (платить)</h3><br> " . $question_alimoney__amount;
	}
	if ($question_alimoney__payer_official_income != '-') {
		$message .=
			"<br><br><h3>Плательщик алиментов имеет официальный доход?</h3><br> " . $question_alimoney__payer_official_income;
	}
	if ($question_alimoney__payer_income != '-') {
		$message .=
			"<br><br><h3>Какая общая сумма его дохода?</h3><br> " . $question_alimoney__payer_income;
	}
	if ($question_alimoney__payer_unofficial != '-') {
		$message .=
			"<br><br><h3>Плательщик алиментов работает без оформления?</h3><br> " . $question_alimoney__payer_unofficial;
	}
	if ($question_alimoney__payer_unemployed != '-') {
		$message .=
			"<br><br><h3>Плательщик алиментов безработный?</h3><br> " . $question_alimoney__payer_unemployed;
	}
	if ($question_alimoney__payer_businessman != '-') {
		$message .=
			"<br><br><h3>Плательщик алиментов предприниматель?</h3><br> " . $question_alimoney__payer_businessman;
	}
	if ($question_alimoney__payer_credit != '-') {
		$message .=
			"<br><br><h3>Сумма задолженности?</h3><br> " . $question_alimoney__payer_credit;
	}
	if ($question_alimoney__dispute_result != '-') {
		$message .=
			"<br><br><h3>Опишите как вы считаете, как должен быть разрешен вопрос по алиментам (сумма, сроки, единовременные выплаты и т.д.)</h3><br> " . $question_alimoney__dispute_result;
	}
	if ($question_alimoney__payer_children_amount != '-') {
		$message .=
			"<br><br><h3>Сколько детей у плательщика алиментов от иных отношений?</h3><br> " . $question_alimoney__payer_children_amount;
	}
	if ($question_alimoney__your_additional_expenses != '-') {
		$message .=
			"<br><br><h3>Доп расходы на детей помимо обычного содержания?</h3><br> " . $question_alimoney__your_additional_expenses;
	}
	if ($question_alimoney__your_expenses_education != '-') {
		$message .=
			"<br><br><h3>Доп расходы на образование?</h3><br> " . $question_alimoney__your_expenses_education;
	}
	if ($question_alimoney__your_expenses_rehabilitation != '-') {
		$message .=
			"<br><br><h3>Доп расходы на лечение (реабилитацию)?</h3><br> " . $question_alimoney__your_expenses_rehabilitation;
	}
	if ($question_alimoney__your_expenses_home != '-') {
		$message .=
			"<br><br><h3>Доп расходы на жилье?</h3><br> " . $question_alimoney__your_expenses_home;
	}
	if ($question_alimoney__your_expenses_children_about != '-') {
		$message .=
			"<br><br><h3>Иные дополнительные расходы на детей?</h3><br> " . $question_alimoney__your_expenses_children_about;
	}
	if ($question_alimoney__your_expenses_children != '-') {
		$message .=
			"<br><br><h3>Сколько иных дополнительных расходов на детей?</h3><br> " . $question_alimoney__your_expenses_children;
	}
	if ($question_alimoney__maintenanse != '-') {
		$message .=
			"<br><br><h3>Претендует ли вы на ваше содержание от второго супруга?</h3><br> " . $question_alimoney__maintenanse;
	}
	if ($question_alimoney__little_children != '-') {
		$message .=
			"<br><br><h3>Беременны или находитесь в отпуске по уходу за ребенком до трех лет?</h3><br> " . $question_alimoney__little_children;
	}
	if ($question_alimoney__maintenanse_disabled != '-') {
		$message .=
			"<br><br><h3>Осуществляете уход за общим ребенком инвалидом?</h3><br> " . $question_alimoney__maintenanse_disabled;
	}
	if ($question_alimoney__you_disabled != '-') {
		$message .=
			"<br><br><h3>Стали нетрудоспособным до расторжения брака или в течение года с момента расторжения брака?</h3><br> " . $question_alimoney__you_disabled;
	}
	if ($question_alimoney__you_need_help != '-') {
		$message .=
			"<br><br><h3>Нуждающийся бывший супруг, достигший пенсионного возраста не позднее, чем через 5 лет с момента расторжения брака, который длился более 10 лет?</h3><br> " . $question_alimoney__you_need_help;
	}
	if ($question_alimoney__maintenanse_amount != '-') {
		$message .=
			"<br><br><h3>Какую сумму вы считаете приемлемой на свое содержание?</h3><br> " . $question_alimoney__maintenanse_amount;
	}
	if ($question_money__jointly_property != '-') {
		$message .=
			"<br><br><h3>У вас существует спор относительно совместно нажитого имущества?</h3><br> " . $question_money__jointly_property;
	}
	if ($question_money__disput_moments != '-') {
		$message .=
			"<br><br><h3>Спорные моменты существуют у вас при расторжении брака?</h3><br> " . $question_money__disput_moments;
	}
	if ($question_money__marriage_agreement != '-') {
		$message .=
			"<br><br><h3>Был ли заключен брачный договор до или во время брака?</h3><br> " . $question_money__marriage_agreement;
	}
	if ($question_money__jointly_property_list != '-') {
		$message .=
			"<br><br><h3>Наименования совместно нажитого имущества</h3><br> " . $question_money__jointly_property_list;
	}
	if ($question_money__jointly_property_cost != '-') {
		$message .=
			"<br><br><h3>Примерная рыночная стоимость совместно нажитого имущества</h3><br> " . $question_money__jointly_property_cost;
	}
	if ($question_money__jointly_money != '-') {
		$message .=
			"<br><br><h3>Совместно нажитых денежных средств было вложено в приобретение имущества</h3><br> " . $question_money__jointly_money;
	}
	if ($question_money__maternity_capital != '-') {
		$message .=
			"<br><br><h3>Средств мат. капитала было вложено в приобретение имущества</h3><br> " . $question_money__maternity_capital;
	}
	if ($question_money__wifes_personal != '-') {
		$message .=
			"<br><br><h3>Личных средств жены от продажи личного имущества</h3><br> " . $question_money__wifes_personal;
	}
	if ($question_money__mans_personal != '-') {
		$message .=
			"<br><br><h3>Личных средств мужа от продажи личного имущества</h3><br> " . $question_money__mans_personal;
	}
	if ($question_money__credit_money != '-') {
		$message .=
			"<br><br><h3>Кредитных средств из все еще не погашенных кредитов</h3><br> " . $question_money__credit_money;
	}
	if ($question_money__repaired_estate != '-') {
		$message .=
			"<br><br><h3>Есть ли такое недвижимое имущество, принадлежащее хоть одному супругу, которое ремонтировалось или достраивалось в браке</h3><br> " . $question_money__repaired_estate;
	}
	if ($question_money__repaired_estate_cost != '-') {
		$message .=
			"<br><br><h3>Стоимость до ремонта</h3><br> " . $question_money__repaired_estate_cost;
	}
	if ($question_money__repaired_estate_additional_cost != '-') {
		$message .=
			"<br><br><h3>Стоимость после ремонта</h3><br> " . $question_money__repaired_estate_additional_cost;
	}
	if ($question_money__repaired_estate_jointly != '-') {
		$message .=
			"<br><br><h3>Совместно нажитых денежных средств было вложено в ремонт имущества</h3><br> " . $question_money__repaired_estate_jointly;
	}
	if ($question_money__repaired_estate_maternity != '-') {
		$message .=
			"<br><br><h3>Средств мат. капитала было вложено в ремонт имущества</h3><br> " . $question_money__repaired_estate_maternity;
	}
	if ($question_money__repaired_estate_wifes_personal != '-') {
		$message .=
			"<br><br><h3>Личных средств жены от продажи личного имущества</h3><br> " . $question_money__repaired_estate_wifes_personal;
	}
	if ($question_money__repaired_estate_mans_personal != '-') {
		$message .=
			"<br><br><h3>Личных средств мужа от продажи личного имущества?</h3><br> " . $question_money__repaired_estate_mans_personal;
	}
	if ($question_money__repaired_estate_credit != '-') {
		$message .=
			"<br><br><h3>Кредитных средств из все еще не погашенных кредитов?</h3><br> " . $question_money__repaired_estate_credit;
	}
	if ($question_credits__obligations != '-') {
		$message .=
			"<br><br><h3>Есть ли совместно нажитые обязательства — долги, кредиты, ипотека</h3><br> " . $question_credits__obligations;
	}
	if ($question_credits__obligations_target != '-') {
		$message .=
			"<br><br><h3>Наименования кредитов и на какие цели выдавался</h3><br> " . $question_credits__obligations_target;
	}
	if ($question_credits__obligations_rest != '-') {
		$message .=
			"<br><br><h3>Остаток задолженности на момент прекращения ведения общего хозяйства</h3><br> " . $question_credits__obligations_rest;
	}
	if ($question_credits__obligations_payer != '-') {
		$message .=
			"<br><br><h3>Кто является плательщиком кредита?</h3><br> " . $question_credits__obligations_payer;
	}
	if ($question_credits__property_division != '-') {
		$message .=
			"<br><br><h3>Опишите как вы видите раздел имущества, кому что должно остаться в каких долях, как должны быть распределены совместные обязательства?</h3><br> " . $question_credits__property_division;
	}
	send_mail($message, $email_to, $email_subject, $email_from); // отправим письмо
}

// функция отправки письма
function send_mail($message, $email_to, $email_subject, $email_from)
{


	// почта, на которую придет письмо
	$mail_to = $email_to;

	// тема письма
	$subject = $email_subject;

	// заголовок письма
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
	$headers .= "From: <" . $email_from . ">\r\n"; // от кого письмо

	// отправляем письмо
	mail($mail_to, $subject, $message, $headers);

	// $mail_to = 'vekzakona@yandex.ru';
	// mail($mail_to, $subject, $message, $headers);
}
?>

<?php

// if ($config['wirecrm']) {
//Пример добавления сделки с указанием определенного этапа продажи на PHP
$apikey = "fe862c882cdb98f54182625f86d0bf60";
$headers = array("X-API-KEY:" . $apikey);

//Получаем список этапов сделок
$get_deals_url = "https://wirecrm.com/api/v1/deals/stages";


$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $get_deals_url);
curl_setopt($handle, CURLOPT_USERAGENT, "WireCRM Rest API");
curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($handle);
curl_close($handle);
$all_deals_json = json_decode($data);


$today = date("Y-m-d");
$contact_name = $_POST['user_name'];
$contact_tel = $_POST['user_tel'];

$description = "";



function wirecrm_post($url, $headers, $data)
{
	$handle = curl_init();
	curl_setopt($handle, CURLOPT_URL, $url);
	curl_setopt($handle, CURLOPT_USERAGENT, "WireCRM Rest API");
	curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);

	curl_setopt($handle, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

	$data = curl_exec($handle);
	curl_close($handle);

	return json_decode($data);
}
function wirecrm_get($url, $headers, $data)
{
	$handle = curl_init();
	curl_setopt($handle, CURLOPT_URL, $url);
	curl_setopt($handle, CURLOPT_USERAGENT, "WireCRM Rest API");
	curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);

	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

	$data = curl_exec($handle);
	curl_close($handle);

	return json_decode($data);
}

// $deals = wirecrm_get($get_deals_url, $headers, $data);

$contact = array(
	'name' => $contact_name,
	'phone' => $contact_tel,
);
// 'description' => $description
$contact_json = json_encode($contact);
$contact_url = 'https://wirecrm.com/api/v1/contacts';
// $new_contact = wirecrm_post($contact_url, $headers, $contact_json);

//Добавляем сделку с первым этапом из списка выше

$deal_description = str_replace('<br>', "\n", strip_tags($message, '<br>'));
$deal = array(
	'name' => $contact_name . ': прошел квиз',
	'description' => $deal_description,
	'currency' => '1',
	'stage' => $all_deals_json->data[0]->id,
	'd_close' => $today,
	'contact' => $_POST['user_id']
	// 'stage' => 0,
);
$deal_json = json_encode($deal);
$deal_url = "https://wirecrm.com/api/v1/deals";
$new_deal = wirecrm_post($deal_url, $headers, $deal_json);

$json = array(
	// 'contact' => $new_contact,
	'deal' => $new_deal,
);

print_r(json_encode($json));
// }


?>


<?php

//В переменную $token нужно вставить токен, который нам прислал @botFather
// $token = "";

// //Сюда вставляем chat_id
// $chat_id = "";

// //Определяем переменные для передачи данных из нашей формы
// // if ($_POST['act'] == 'order') {
//     $name = ($_POST['user_name']);
//     $phone = ($_POST['user_tel']);
// // }

// //Собираем в массив то, что будет передаваться боту
//     $arr = array(
//         'Имя:' => $name,
//         'Телефон:' => $phone
//     );

// //Настраиваем внешний вид сообщения в телеграме
//     foreach($arr as $key => $value) {
//         $txt .= "<b>".$key."</b> ".$value."%0A";
//     };

// //Передаем данные боту
//     $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");

?>

<?php


// формируем запись в таблицу google (изменить)
$url = "https://docs.google.com/forms/d/1aMTL9F9mYRZ-EKDPDi8M9KVgYFpM7__pTFZBGrsbhCE/formResponse";


// массив данных (изменить entry, draft и fbzx)
$post_data = array(
	'entry.261177372' => $_POST['user_name'],
	'entry.323683105' => $_POST['user_tel'],
	'entry.1975503925' => $_POST['user_email'],
	'entry.1764936621' => $_POST['spouse_name'],
	'entry.1820426269' => $_POST['spouse_tel'],
	'entry.811826840' => $_POST['spouse_email'],
	'entry.1412094746' => $_POST['question_divorce__plan'],
	'entry.1925562835' => $_POST['question_divorce__relations'],
	'entry.679549337' => $_POST['question_divorce__divorce_date'],
	'entry.1055134841' => $_POST['question_divorce__together'],
	'entry.1793195644' => $_POST['question_divorce__date_no_relations'],
	'entry.2091589396' => $_POST['question_children__have'],
	'entry.1880142701' => $_POST['question_children__age'],
	'entry.1310235624' => $_POST['question_children__live_with_you'],
	'entry.1446061294' => $_POST['question_children__dispute_livingplace'],
	'entry.1962849598' => $_POST['question_children__livingplace_list'],
	'entry.355557979' => $_POST['question_children__dispute_communication'],
	'entry.2044536038' => $_POST['question_children__communication_schedule'],
	'entry.695772809' => $_POST['question_alimoney__dispute'],
	'entry.1184940710' => $_POST['question_alimoney__recovered'],
	'entry.485873519' => $_POST['question_alimoney__amount'],
	'entry.390916449' => $_POST['question_alimoney__payer_official_income'],
	'entry.64945476' => $_POST['question_alimoney__payer_income'],
	'entry.1144369332' => $_POST['question_alimoney__payer_unofficial'],
	'entry.399058438' => $_POST['question_alimoney__payer_unemployed'],
	'entry.1618506188' => $_POST['question_alimoney__payer_businessman'],
	'entry.818775279' => $_POST['question_alimoney__payer_credit'],
	'entry.1758898727' => $_POST['question_alimoney__dispute_result'],
	'entry.291618290' => $_POST['question_alimoney__payer_children_amount'],
	'entry.2072657883' => $_POST['question_alimoney__your_additional_expenses'],
	'entry.504394165' => $_POST['question_alimoney__your_expenses_education'],
	'entry.1696458938' => $_POST['question_alimoney__your_expenses_rehabilitation'],
	'entry.1130889274' => $_POST['question_alimoney__your_expenses_home'],
	'entry.1332187237' => $_POST['question_alimoney__your_expenses_children_about'],
	'entry.1848817308' => $_POST['question_alimoney__your_expenses_children'],
	'entry.656714752' => $_POST['question_alimoney__maintenanse'],
	'entry.604058371' => $_POST['question_alimoney__little_children'],
	'entry.184730797' => $_POST['question_alimoney__maintenanse_disabled'],
	'entry.1051117765' => $_POST['question_alimoney__you_disabled'],
	'entry.209577625' => $_POST['question_alimoney__you_need_help'],
	'entry.1858916463' => $_POST['question_alimoney__maintenanse_amount'],
	'entry.1128496409' => $_POST['question_money__jointly_property'],
	'entry.1657309426' => $_POST['question_money__disput_moments'],
	'entry.198648192' => $_POST['question_money__marriage_agreement'],
	'entry.1486828461' => $_POST['question_money__jointly_property_list'],
	'entry.1949444289' => $_POST['question_money__jointly_property_cost'],
	'entry.1217594506' => $_POST['question_money__jointly_money'],
	'entry.510339430' => $_POST['question_money__maternity_capital'],
	'entry.552795882' => $_POST['question_money__wifes_personal'],
	'entry.536336094' => $_POST['question_money__mans_personal'],
	'entry.2144560922' => $_POST['question_money__credit_money'],
	'entry.1626460598' => $_POST['question_money__repaired_estate'],
	'entry.1387404678' => $_POST['question_money__repaired_estate_cost'],
	'entry.1017042174' => $_POST['question_money__repaired_estate_additional_cost'],
	'entry.722751439' => $_POST['question_money__repaired_estate_jointly'],
	'entry.978396384' => $_POST['question_money__repaired_estate_maternity'],
	'entry.90337407' => $_POST['question_money__repaired_estate_wifes_personal'],
	'entry.245519595' => $_POST['question_money__repaired_estate_mans_personal'],
	'entry.1036915059' => $_POST['question_money__repaired_estate_credit'],
	'entry.1395375339' => $_POST['question_credits__obligations'],
	'entry.2016850941' => $_POST['question_credits__obligations_target'],
	'entry.910343850' => $_POST['question_credits__obligations_rest'],
	'entry.230264574' => $_POST['question_credits__obligations_payer'],
	'entry.782135362' => $_POST['question_credits__property_division'],

	'draftResponse' => '[[null,null,"-348999811317292979"]]',
	"pageHistory" => "0",
	"fbzx" => "-348999811317292979"
);

// Далее не трогать
// с помощью CURL заносим данные в таблицу google
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// указываем, что у нас POST запрос
curl_setopt($ch, CURLOPT_POST, 1);
// добавляем переменные
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
//заполняем таблицу google
$output = curl_exec($ch);
curl_close($ch);

?>
