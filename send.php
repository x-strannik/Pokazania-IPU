<?php
$hurl = $_POST['hurl'];
$hname = $_POST['blgname'];
$hlogo = $_POST['blglogo'];
$emailad = $_POST['ov6'];
// Переменные, которые отправляет пользователь
$subject = $_POST['subject'];
$email = $_POST['email'];
$tel610= $_POST['tel-610'];
$text657= $_POST['text-657'];

$text491= $_POST['text-491'];
$text876= $_POST['text-876'];
$text383= $_POST['text-383'];

$text978= $_POST['text-978'];
$text789= $_POST['text-789'];
$text145= $_POST['text-145'];

$text926= $_POST['text-926'];
$text60= $_POST['text-60'];
$text419= $_POST['text-419'];

$textarea340= $_POST['textarea-340'];

$text = $_POST['text'];
$file = $_FILES['myfile'];

// Формирование самого письма
$title = $subject;

$htmlBody1 = '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
<style>
    @media screen {
    @font-face{
    font-family:"Open Sans";
    font-style:normal;
    font-weight:400;
    src:local("Open Sans"), local("OpenSans"), url("http://fonts.gstatic.com/s/opensans/v10/cJZKeOuBrn4kERxqtaUH3bO3LdcAZYWl9Si6vvxL-qU.woff") format("woff");
    }
    }
</style>
<table cellpadding="0" cellspacing="0" style="width:100%; max-width:100%; margin: 0px auto; border:0px">
<thead>
<tr>
<td style="padding:16px; color:#fff; font-size:18px;background:#000;" colspan="2"><img src="';
$htmlBodyLog1 = '" style="max-width: 320px !important; height=40px" alt="">
</td>
</tr>
<tr>
<td style="padding:16px; font-size:18px;background:#595959; color:#fff;" colspan="2">Благодарим за передачу показаний приборов учета:
</td>
</tr>
</thead>
<tbody>
<tr>
<td style="width:35%; border:0px; padding:12px 20px; font-size:16px;background:#f6f6f6;">
<p><b>Email:</b>&nbsp;&nbsp;';
$htmlBody2 = '</p>
<p><b>Адрес:</b>&nbsp;&nbsp;';
$htmlBody3 = '</p>
<p><b>№ лицевого счета:</b>&nbsp;&nbsp;';
$htmlBody4 = '</p>
</td>
</tr>
<tr>
<td style="width:35%; border:0px; padding:12px 20px; font-size:16px;background:#d8d8d8;">
<p><b>№ прибора учета:</b>&nbsp;&nbsp;';
$htmlBody5 = '</p>
<p><b>Предыдущие показания:</b>&nbsp;&nbsp;';
$htmlBody6 = '</p>
<p><b>Текущие показания:</b>&nbsp;&nbsp;';
if(empty($text978) and empty($text789) and empty($text145))
{
$htmlBody7 = '</p>
</td>
</tr>
<tr>
<td style="display: none; width:35%; border:0px; padding:12px 20px; font-size:16px;background:#f6f6f6;">
<p><b>№ прибора учета:</b>&nbsp;&nbsp;';
}
else {
$htmlBody7 = '</p>
</td>
</tr>
<tr>
<td style="width:35%; border:0px; padding:12px 20px; font-size:16px;background:#f6f6f6;">
<p><b>№ прибора учета:</b>&nbsp;&nbsp;';
}
$htmlBody8 = '</p>
<p><b>Предыдущие показания:</b>&nbsp;&nbsp;';
$htmlBody9 = '</p>
<p><b>Текущие показания:</b>&nbsp;&nbsp;';
if(empty($text926) and empty($text60) and empty($text419))
{
$htmlBody10 = '</p>
</td>
</tr>
<tr>
<td style="display: none; width:35%; border:0px; padding:12px 20px; font-size:16px;background:#d8d8d8;">
<p><b>№ прибора учета:</b>&nbsp;&nbsp;';
}
else {
$htmlBody10 = '</p>
</td>
</tr>
<tr>
<td style="width:35%; border:0px; padding:12px 20px; font-size:16px;background:#d8d8d8;">
<p><b>№ прибора учета:</b>&nbsp;&nbsp;';
}
$htmlBody11 = '</p>
<p><b>Предыдущие показания:</b>&nbsp;&nbsp;';
$htmlBody12 = '</p>
<p><b>Текущие показания:</b>&nbsp;&nbsp;';
if(empty($textarea340))
{
$htmlBody13 = '</p>
</td>
</tr>
<tr>
<td style="display: none; width:35%; border:0px; padding:12px 20px; font-size:16px;background:#f6f6f6;">
<p><b>Дополнительная информация:</b>&nbsp;&nbsp;';
}
else {
$htmlBody13 = '</p>
</td>
</tr>
<tr>
<td style="width:35%; border:0px; padding:12px 20px; font-size:16px;background:#d8d8d8;">
<p><b>Дополнительная информация:</b>&nbsp;&nbsp;';
}
$htmlBody14 = '</p>
</td>
</tr>
<tr>
<td colspan="2" style="border:0px; background:#000; color:#fff; padding:12px 20px; font-size:14px;">Это сообщение отправлено с сайта <a href="';
$htmlBody15 = '" target="_blank">';
$htmlBody16 = '</a>.
</td>
</tr>
</tbody>
</table>';

$body = "$htmlBody1 $hlogo $htmlBodyLog1 $email $htmlBody2 $text657 $htmlBody3 $tel610 $htmlBody4 $text491 $htmlBody5 $text876 $htmlBody6 $text383 $htmlBody7 $text978 $htmlBody8 $text789 $htmlBody9 $text145 $htmlBody10 $text926 $htmlBody11 $text60 $htmlBody12 $text419 $htmlBody13 $textarea340 $htmlBody14 $hurl $htmlBody15 $hname $htmlBody16
";

$textBody = "от ЛС: $tel610<br> 
Email: $email<br><br>

<b>Адрес:</b> $text657<br>
<b>№ лицевого счета:</b> $tel610<br><br>

<b>№ прибора учета:</b> $text491<br>
<b>Предыдущие показания:</b> $text876<br> 
<b>Текущие показания:</b> $text383<br><br>

<b>№ прибора учета:</b> $text978<br>
<b>Предыдущие показания:</b> $text789<br> 
<b>Текущие показания:</b> $text145<br><br>

<b>№ прибора учета:</b> $text926<br>
<b>Предыдущие показания:</b> $text60<br> 
<b>Текущие показания:</b> $text419<br><br>

<b>Дополнительная информация:</b><br> 
$textarea340<br><br>



--<br> 
Это сообщение отправлено с сайта <a href='$hurl' target='_blank'>$hname</a>.
";

// Показания в файл.	
$textDate = date('d.m.Y');
$textFile = "$tel610;$textDate;$text657;$text491;$text876;$text383;$text978;$text789;$text145;$text926;$text60;$text419;$email;";	
$dump = $textFile . PHP_EOL;
if ($subject == "Показания ИПУ от ЛС через сайт") {
$filename = __DIR__ . '/pok/' . date('Y-m') . '.txt';
} else {
$filename = __DIR__ . '/pok/' . date('Y-m') . '-manual.txt';
}
file_put_contents($filename, $dump, FILE_APPEND | LOCK_EX);

$headers = array();
$headers[] = 'Content-Type: text/html; charset="UTF-8"'; 
try {
// Проверяем отравленность сообщения
if(!mail($emailad, $title, $textBody, implode("\r\n", $headers))){$result = "error";} 
else {$result = "success";
// Отправка сообщения с благодарностью клиенту
mail($email, $title, $body, implode("\r\n", $headers));
} 
} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение0
,	не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}
// Отображение результата
echo json_encode(["result" => $result, "status" => $status]);
?>