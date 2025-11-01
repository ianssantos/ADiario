<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once 'pdf-processor.php';

$pdfFile = isset($_GET['pdf']) ? $_GET['pdf'] : 'ad.pdf';
$pdfPath = '../pdfs/' . $pdfFile;

if (file_exists($pdfPath)) {
    $processor = new PDFProcessor();
    $content = $processor->processPDF($pdfPath);
    echo json_encode($content);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'PDF não encontrado']);
}
?>