<?php
require_once 'vendor/autoload.php';

use Smalot\PdfParser\Parser;

class PDFProcessor {
    private $parser;
    
    public function __construct() {
        $this->parser = new Parser();
    }
    
    public function processPDF($pdfPath) {
        try {
            if (!file_exists($pdfPath)) {
                throw new Exception("PDF não encontrado: " . $pdfPath);
            }
            
            $pdf = $this->parser->parseFile($pdfPath);
            $text = $pdf->getText();
            
            // Salva o texto extraído para debug
            file_put_contents('../pdfs/debug.txt', $text);
            
            return $this->extractContentFromText($text);
            
        } catch (Exception $e) {
            error_log("Erro ao processar PDF: " . $e->getMessage());
            return $this->getFallbackContent();
        }
    }
    
    private function extractContentFromText($text) {
        $weeks = [];
        $currentWeek = null;
        $currentDay = null;
        
        // Divide por páginas
        $pages = preg_split('/===== Page \d+ =====/', $text);
        
        foreach ($pages as $page) {
            $page = trim($page);
            if (empty($page)) continue;
            
            // Detecta SEMANA
            if (preg_match('/SEMANA\s+(\d+):?\s*(.+)/i', $page, $weekMatch)) {
                $weekNumber = intval($weekMatch[1]);
                $weekTitle = trim($weekMatch[2]);
                
                $currentWeek = [
                    'number' => $weekNumber,
                    'title' => $weekTitle,
                    'days' => []
                ];
                $weeks[] = $currentWeek;
                continue;
            }
            
            // Detecta dias (SEGUNDA-FEIRA, TERÇA-FEIRA, etc.)
            $daysPattern = '/(SEGUNDA|TERÇA|QUARTA|QUINTA|SEXTA|SÁBADO|DOMINGO)[-\s]*FEIRA/i';
            if (preg_match($daysPattern, $page, $dayMatch)) {
                $dayName = strtoupper($dayMatch[1] . '-FEIRA');
                
                if ($currentWeek) {
                    $currentDay = [
                        'title' => $dayName,
                        'bible_reading' => $this->extractBibleReading($page),
                        'prayer_reading' => $this->extractPrayerReading($page),
                        'content' => $this->extractDayContent($page)
                    ];
                    $currentWeek['days'][] = $currentDay;
                }
            }
        }
        
        // Se não encontrou semanas no PDF, usa fallback
        if (empty($weeks)) {
            return $this->getFallbackContent();
        }
        
        return ['weeks' => $weeks];
    }
    
    private function extractBibleReading($text) {
        if (preg_match('/Leitura bíblica:\s*(.+?)(?=Ler com oração:|$)/s', $text, $match)) {
            return trim($match[1]);
        }
        return 'Leitura bíblica não encontrada';
    }
    
    private function extractPrayerReading($text) {
        if (preg_match('/Ler com oração:\s*(["\']?.+?["\']?)(?=Anote abaixo|$)/s', $text, $match)) {
            return trim($match[1]);
        }
        return 'Leitura de oração não encontrada';
    }
    
    private function extractDayContent($text) {
        // Remove cabeçalhos conhecidos
        $content = preg_replace('/Leitura bíblica:.+?Ler com oração:.+?(?=[A-Z])/s', '', $text);
        $content = preg_replace('/Anote abaixo.+/s', '', $content);
        $content = preg_replace('/=====.+?=====/', '', $content);
        $content = preg_replace('/SEMANA\s+\d+.+?(?=[A-Z])/s', '', $content);
        
        return trim($content) ?: 'Conteúdo do dia em processamento...';
    }
    
    private function getFallbackContent() {
        // Retorna apenas estrutura vazia para forçar o uso do PDF real
        return [
            'weeks' => [
                [
                    'number' => 1,
                    'title' => 'PDF em processamento...',
                    'days' => [
                        [
                            'title' => 'CARREGANDO',
                            'bible_reading' => 'Aguarde...',
                            'prayer_reading' => 'Processando PDF...',
                            'content' => 'O conteúdo do PDF está sendo carregado. Se esta mensagem persistir, verifique se o arquivo ad.pdf está na pasta pdfs/'
                        ]
                    ]
                ]
            ]
        ];
    }
}

// Processa o PDF quando chamado
if (isset($_GET['pdf'])) {
    $pdfFile = $_GET['pdf'];
    $pdfPath = '../pdfs/' . $pdfFile;
    
    $processor = new PDFProcessor();
    $content = $processor->processPDF($pdfPath);
    
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    echo json_encode($content);
    exit;
}
?>