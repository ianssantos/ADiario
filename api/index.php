<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

function extractPDFContent($pdfPath) {
    // Esta é uma implementação básica - você precisaria de uma biblioteca como TCPDF
    $content = [
        'weeks' => []
    ];
    
    // Simulação de extração - na prática você usaria uma biblioteca PDF
    if(file_exists($pdfPath)) {
        // Aqui você implementaria a extração real do PDF
        $content = simulatePDFExtraction();
    }
    
    return $content;
}

function simulatePDFExtraction() {
    return [
        'weeks' => [
            [
                'title' => 'SEMANA 1: A RESTAURAÇÃO DA TERRA: O TERCEIRO DIA E O QUARTO DIA',
                'days' => [
                    [
                        'title' => 'SEGUNDA-FEIRA',
                        'bible_reading' => 'Gn 1:9, 14-19; Jo 1:1-5; Ef 1:9-10; 5:16-19',
                        'prayer_reading' => '"Outrora, éreis trevas, porém, agora, sois luz no Senhor; andai como filhos da luz" (Ef 5:8).',
                        'content' => 'Na mensagem desta semana, cujo título é "A restauração da terra: o terceiro dia e o quarto dia", falaremos sobre o que ocorreu no terceiro e quarto dias da restauração da criação de Deus. No terceiro dia, Deus fez surgir a porção seca de terra (Gn 1:9) e, no quarto dia, fez os dois grandes luzeiros e as estrelas (vs. 14-19). Veremos que esses itens nos remetem a nossa experiência de Cristo como nossa boa terra, cheia de vida e de riquezas, e de Cristo como nosso sol, que nos ilumina e governa.'
                    ],
                    // ... adicione todos os outros dias aqui
                ]
            ],
            // ... adicione outras semanas aqui
        ]
    ];
}

$pdfPath = '../pdfs/ad.pdf';
$content = extractPDFContent($pdfPath);

echo json_encode($content);
?>