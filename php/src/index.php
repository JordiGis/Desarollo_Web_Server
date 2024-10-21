<?php  
require $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';  


use JGF\Model\Persona;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Dompdf\Dompdf;


$dompdf = new Dompdf();
$html = "<html><body>Hola, això és una prova.</body></html>";
$dompdf->loadHtml($html);
// $dompdf->loadHtml(file_get_contents('path/to/your/file.html'));
$dompdf->setPaper('A4', 'portrait'); // o 'landscape'
$dompdf->render();
$dompdf->stream("document.pdf", array("Attachment" => false));
// $output = $dompdf->output();
// file_put_contents('path/to/save/document.pdf', $output);



// $log = new Logger("MiLog");
// $log->pushHandler(
//     new RotatingFileHandler(
//         $_SERVER["DOCUMENT_ROOT"] . '/../logs/milog.log', 
//         0, 
//         Logger::DEBUG
//     )
// );

// $log->debug("Mensaje de debug");
// $log->info("Mensaje de info");
// $log->warning("Mensaje de warning");
// $log->error("Mensaje de error");
// $log->critical("Mensaje de critical");
// $log->alert("Mensaje de alert");
?>