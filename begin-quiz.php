<?php

// Еще внизу есть mail_to
// $email_to = 'trofimenkonick@yandex.ru';
$email_to = 'vekzakona@yandex.ru';
$email_from = 'info@splitfamily.ru';
$email_subject = "Новый пользователь начал проходить квиз";

$msg_box = "";
$errors = array();

// если форма без ошибок
if (empty($errors)) {

	// собираем данные из формы
	$message = '';

	$postData = file_get_contents('php://input');
	// `application/json`
	$postData = json_decode($postData, true);

	foreach ($postData as $key => $post) {
		$message .= "<br><br><p><b>{$post['question']}</b>: <span>{$post['answer']}</span></p>";
	}

	$output = array(
		'message' => $message,
	);

	$json = json_encode($output);
	// echo $json;
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

// if ($config['wirecrm']) {
//Пример добавления сделки с указанием определенного этапа продажи на PHP
$apikey = "fe862c882cdb98f54182625f86d0bf60";
//Получаем список этапов сделок
$get_deals_url = "https://wirecrm.com/api/v1/deals/stages";

$headers = array("X-API-KEY:" . $apikey);

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
$contact_name = $postData['user_name']['answer'];
$contact_tel = $postData['user_tel']['answer'];

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
$new_contact = wirecrm_post($contact_url, $headers, $contact_json);

//Добавляем сделку с первым этапом из списка выше
$deal = array(
	'name' => $contact_name . ': начал проходить квиз',
	'description' => 'Начал проходить квиз',
	'currency' => '1',
	'stage' => $all_deals_json->data[0]->id,
	'd_close' => $today,
	// 'stage' => 0,
);
$deal_json = json_encode($deal);
$deal_url = "https://wirecrm.com/api/v1/deals";
$new_deal = wirecrm_post($deal_url, $headers, $deal_json);

$json = array(
	'contact' => $new_contact,
	'deal' => $new_deal,
);

print_r(json_encode($json));
// }
