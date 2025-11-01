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
            // Parse do PDF
            $pdf = $this->parser->parseFile($pdfPath);
            $text = $pdf->getText();
            
            return $this->extractContent($text);
        } catch (Exception $e) {
            return $this->getFallbackContent();
        }
    }
    
    private function extractContent($text) {
        $content = ['weeks' => []];
        
        // Divide o texto em páginas (assumindo que cada página começa com "===== Page X =====")
        $pages = preg_split('/===== Page \d+ =====/', $text);
        
        $currentWeek = null;
        $currentDay = null;
        
        foreach ($pages as $page) {
            // Detecta semanas (SEMANA X:)
            if (preg_match('/SEMANA (\d+):(.+)/', $page, $weekMatches)) {
                $currentWeek = [
                    'number' => intval($weekMatches[1]),
                    'title' => trim($weekMatches[2]),
                    'days' => []
                ];
                $content['weeks'][] = $currentWeek;
                continue;
            }
            
            // Detecta dias (SEMANA X – DIA-DA-SEMANA)
            if (preg_match('/SEMANA (\d+) – ([A-Z]+-FEIRA)/', $page, $dayMatches)) {
                $weekNumber = intval($dayMatches[1]);
                $dayName = $dayMatches[2];
                
                // Encontra a semana correspondente
                foreach ($content['weeks'] as &$week) {
                    if ($week['number'] === $weekNumber) {
                        $currentDay = [
                            'title' => $dayName,
                            'bible_reading' => $this->extractBibleReading($page),
                            'prayer_reading' => $this->extractPrayerReading($page),
                            'content' => $this->extractDayContent($page)
                        ];
                        $week['days'][] = $currentDay;
                        break;
                    }
                }
            }
        }
        
        return $content;
    }
    
    private function extractBibleReading($page) {
        if (preg_match('/Leitura bíblica:\s*(.+?)(?=Ler com oração:|$)/s', $page, $matches)) {
            return trim($matches[1]);
        }
        return '';
    }
    
    private function extractPrayerReading($page) {
        if (preg_match('/Ler com oração:\s*(.+?)(?=Anote abaixo|$)/s', $page, $matches)) {
            return trim($matches[1]);
        }
        return '';
    }
    
    private function extractDayContent($page) {
        // Remove cabeçalhos e rodapés
        $content = preg_replace('/Leitura bíblica:.+?Ler com oração:.+?(?=[A-Z])/s', '', $page);
        $content = preg_replace('/Anote abaixo.+/s', '', $content);
        $content = preg_replace('/=====.+?=====/', '', $content);
        
        return trim($content);
    }
    
    private function getFallbackContent() {
        // Conteúdo completo como fallback
        return [
            'weeks' => [
                [
                    'number' => 1,
                    'title' => 'A RESTAURAÇÃO DA TERRA: O TERCEIRO DIA E O QUARTO DIA – (Gn 1:3-19)',
                    'days' => [
                        [
                            'title' => 'SEGUNDA-FEIRA',
                            'bible_reading' => 'Gn 1:9, 14-19; Jo 1:1-5; Ef 1:9-10; 5:16-19',
                            'prayer_reading' => '"Outrora, éreis trevas, porém, agora, sois luz no Senhor; andai como filhos da luz" (Ef 5:8).',
                            'content' => 'Na mensagem desta semana, cujo título é "A restauração da terra: o terceiro dia e o quarto dia", falaremos sobre o que ocorreu no terceiro e quarto dias da restauração da criação de Deus. No terceiro dia, Deus fez surgir a porção seca de terra (Gn 1:9) e, no quarto dia, fez os dois grandes luzeiros e as estrelas (vs. 14-19). Veremos que esses itens nos remetem a nossa experiência de Cristo como nossa boa terra, cheia de vida e de riquezas, e de Cristo como nosso sol, que nos ilumina e governa. Também reconheceremos a função da igreja como a lua, que governa durante a noite que precede a segunda vinda do sol, que é Cristo.'
                        ],
                        [
                            'title' => 'TERÇA-FEIRA',
                            'bible_reading' => 'Mt 17:1-7; At 7:2; 2 Co 4:2-4; Fp 3:7-8',
                            'prayer_reading' => '"Porquanto vós todos sois filhos da luz e filhos do dia; nós não somos da noite, nem das trevas" (1 Ts 5:5).',
                            'content' => 'Anteriormente abordamos que os filhos da luz contribuem para que a vontade de Deus seja feita na terra. Na Primeira aos Tessalonicenses, encontramos também a expressão "filhos da luz e filhos do dia": "Vós, irmãos, não estais em trevas, para que esse Dia como ladrão vos apanhe de surpresa; porquanto vós todos sois filhos da luz e filhos do dia; nós não somos da noite, nem das trevas. Assim, pois, não durmamos como os demais; pelo contrário, vigiemos e sejamos sóbrios" (5:4-5). Aqui lemos que não apenas somos filhos da luz para fazer a vontade de Deus, mas também somos filhos do dia.'
                        ],
                        [
                            'title' => 'QUARTA-FEIRA',
                            'bible_reading' => 'Gn 1:3',
                            'prayer_reading' => '"Disse também Deus: Ajuntem-se as águas debaixo dos céus num só lugar, e apareça a porção seca. E assim se fez" (Gn 1:9).',
                            'content' => 'No primeiro dia da restauração da criação, Deus restaurou a luz (Gn 1:3). A luz é essencial para gerar, sustentar e manter a vida. Sem luz não há vida. No segundo dia, Deus criou a atmosfera e, com o ar criado, produziu oxigênio para que o homem e os demais seres pudessem respirar e viver na terra.'
                        ],
                        [
                            'title' => 'QUINTA-FEIRA',
                            'bible_reading' => 'Jo 3:3, 8; Gl 6:15',
                            'prayer_reading' => '"A terra, pois, produziu relva, ervas que davam semente segundo a sua espécie e árvores que davam fruto, cuja semente estava nele, conforme a sua espécie. E viu Deus que isso era bom" (Gn 1:12).',
                            'content' => 'Uma vez que fez surgir a terra seca no terceiro dia, Deus tinha como criar a vida sobre a terra. O primeiro tipo de vida criada por Deus foi a "relva, ervas que deem semente e árvores frutíferas que deem fruto segundo a sua espécie, cuja semente esteja nele, sobre a terra" (Gn 1:11).'
                        ],
                        [
                            'title' => 'SEXTA-FEIRA',
                            'bible_reading' => 'Dt 8:9, 17; Hb 4:12; Ap 20:6',
                            'prayer_reading' => '"Simão Pedro, servo e apóstolo de Jesus Cristo, aos que conosco obtiveram fé igualmente preciosa na justiça do nosso Deus e Salvador Jesus Cristo" (2 Pe 1:1).',
                            'content' => 'Em Deuteronômio lemos sobre a boa terra de Canaã: "O SENHOR, teu Deus, te faz entrar numa boa terra, terra de ribeiros de águas, de fontes, de mananciais profundos, que saem dos vales e das montanhas; terra de trigo e cevada, de vides, figueiras e romeiras; terra de oliveiras, de azeite e mel; terra em que comerás o pão sem escassez, e nada te faltará nela; terra cujas pedras são ferro e de cujos montes cavarás o cobre."'
                        ],
                        [
                            'title' => 'SÁBADO',
                            'bible_reading' => 'Gn 1:14-19',
                            'prayer_reading' => '"Fez Deus os dois grandes luzeiros: o maior para governar o dia, e o menor para governar a noite; e fez também as estrelas" (Gn 1:16).',
                            'content' => 'No quarto dia, Deus criou os luzeiros (Gn 1:14-19). Podemos perguntar-nos: "Deus já não havia criado a luz no primeiro dia?". A luz do primeiro dia é uma luz difusa, cuja fonte luminosa, cuja procedência, não conseguimos distinguir.'
                        ],
                        [
                            'title' => 'DOMINGO',
                            'bible_reading' => 'Sl 110:3; Jo 8:2-12',
                            'prayer_reading' => '"Graças à entranhável misericórdia de nosso Deus, pela qual nos visitará o sol nascente das alturas, para alumiar os que jazem nas trevas e na sombra da morte, e dirigir os nossos pés pelo caminho da paz" (Lc 1:78-79).',
                            'content' => 'Ontem falamos sobre a criação dos luzeiros que governam a terra: o sol, a lua e as estrelas. Na esfera espiritual, Cristo é o sol, que nos ilumina e governa. No capítulo primeiro de Lucas, lemos: "Graças à entranhável misericórdia de nosso Deus, pela qual nos visitará o sol nascente das alturas, para alumiar os que jazem nas trevas e na sombra da morte, e dirigir os nossos pés pelo caminho da paz" (vs. 78-79).'
                        ]
                    ]
                ],
                [
                    'number' => 2,
                    'title' => 'A RESTAURAÇÃO DA TERRA: O QUINTO DIA E O SEXTO DIA – (Gn 1:20-31)',
                    'days' => [
                        // Dias da semana 2...
                    ]
                ],
                [
                    'number' => 3,
                    'title' => 'NO SÉTIMO DIA DEUS DESCANSOU DE TODA OBRA QUE FIZERA – (Gn 2:1-3)',
                    'days' => [
                        // Dias da semana 3...
                    ]
                ],
                [
                    'number' => 4,
                    'title' => 'A CRIAÇÃO DO HOMEM – (Gn 2:4-7)',
                    'days' => [
                        // Dias da semana 4...
                    ]
                ]
            ]
        ];
    }
}

// Uso
if (isset($_GET['pdf'])) {
    $pdfPath = '../pdfs/' . $_GET['pdf'];
    $processor = new PDFProcessor();
    $content = $processor->processPDF($pdfPath);
    header('Content-Type: application/json');
    echo json_encode($content);
}
?>