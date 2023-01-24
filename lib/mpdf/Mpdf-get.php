<?php

require_once __DIR__ . '/vendor/autoload.php'; // مسار الفيندور ولو اعدنا تسمية فولدر فيندور يجب مراعاة ذلك

$mpdf = new \Mpdf\Mpdf();

$stylesheet = file_get_contents('style.css'); // مسار ستايل شيت الذي سوف ينسق صفحة البي دي اف التي سيتم عرضها
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);

$html = '<h1>Hello world!</h1>'; // هذا على سبيل المثال ولاحظ ارتباط هذا المتغير بالسطر اسفله
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

//$mpdf->WriteHTML('<h1>Hello world!</h1>'); بدلا من هذا واسهل يكتب السطر الذي فوقه ثم تخصيص متغير لمحتو اتش تي ام ال يكون اعلى السطر الاعلى
$mpdf->Output();