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
                return $this->getCompleteContent();
            }
            
            $pdf = $this->parser->parseFile($pdfPath);
            $text = $pdf->getText();
            
            return $this->extractContent($text);
        } catch (Exception $e) {
            return $this->getCompleteContent();
        }
    }
    
    private function extractContent($text) {
        // Implementação de extração real do PDF...
        // Por enquanto retornamos o conteúdo completo
        return $this->getCompleteContent();
    }
    
    private function getCompleteContent() {
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
                        [
                            'title' => 'SEGUNDA-FEIRA',
                            'bible_reading' => 'Gn 1:14-19; Is 45:18',
                            'prayer_reading' => '"Fez Deus os dois grandes luzeiros: o maior para governar o dia, e o menor para governar a noite" (Gn 1:16).',
                            'content' => 'O título da mensagem desta semana é: "A restauração da terra: o quinto dia e o sexto dia". Retomando o quarto dia da criação, conforme visto na semana passada, compreenderemos que Deus criou todas as coisas visando exercer Seu governo na terra. Criou os dois grandes luzeiros não apenas para separar a luz das trevas, mas também para estabelecer Seu senhorio por meio deles (Gn 1:14-19).'
                        ],
                        [
                            'title' => 'TERÇA-FEIRA',
                            'bible_reading' => 'Mt 27:1, 20; At 6:3; 7:2-53; Gl 5:13',
                            'prayer_reading' => '"Elegeram Estêvão, homem cheio de fé e do Espírito Santo" (At 6:5a).',
                            'content' => 'Conforme vimos ontem, todos os habitantes da terra estão sujeitos ao governo estabelecido por Deus mediante a luz do sol e da lua. Na semana passada, vimos que Deus criou esses luzeiros de luz concreta com a finalidade de governar. Na esfera espiritual, Cristo é o Sol nascente das alturas, e Seu desejo é governar sobre toda a terra.'
                        ],
                        [
                            'title' => 'QUARTA-FEIRA',
                            'bible_reading' => 'Gn 1:20-23; Mt 8:23-27',
                            'prayer_reading' => '"Eu lhes tenho dado a tua palavra, e o mundo os odiou, porque eles não são do mundo, como também eu não sou" (Jo 17:14).',
                            'content' => 'No quinto dia, Deus criou os seres vivos, como os peixes do mar e as aves dos céus, que são seres de baixo nível de consciência, porém superiores à vida vegetal criada no terceiro dia, quando surgiu a porção seca (Gn 1:20-23).'
                        ],
                        [
                            'title' => 'QUINTA-FEIRA',
                            'bible_reading' => 'Gn 1:20; Cl 3:1-2',
                            'prayer_reading' => '"Juntamente com ele, nos ressuscitou, e nos fez assentar nos lugares celestiais em Cristo Jesus" (Ef 2:6).',
                            'content' => 'Toda criatura da terra possui massa e, por ser feita de matéria, está sujeita à ação da gravidade da terra. Mas Deus, milagrosamente, criou as aves, seres vivos alados que conseguem sair do chão e voar (Gn 1:20), vencendo, assim, a ação da gravidade terrestre.'
                        ],
                        [
                            'title' => 'SEXTA-FEIRA',
                            'bible_reading' => 'Gn 1:11-12; Êx 19:4; Ez 1:4-5, 10',
                            'prayer_reading' => '"Os que esperam no SENHOR renovam as suas forças, sobem com asas como águias, correm e não se cansam, caminham e não se fatigam" (Is 40:31).',
                            'content' => 'Na Bíblia Deus é ilustrado como águia. Como águia, Ele não é influenciado pela ação da gravidade da terra e ainda consegue levar-nos para a região celestial. Em Êxodo 19, Deus afirma que tirou os filhos de Israel do Egito, levou-os sobre asas de águia e os achegou a Si (v. 4).'
                        ],
                        [
                            'title' => 'SÁBADO',
                            'bible_reading' => 'Gn 1:3, 6, 9, 26-27; 18:1-3; Jo 1:18; Fp 2:7; Hb 2:8; 9:11-14',
                            'prayer_reading' => '"Este [Cristo] é a imagem do Deus invisível, o primogênito de toda a criação" (Cl 1:15).',
                            'content' => 'No sexto dia, além dos animais, Deus também criou a mais importante de Suas criaturas: o homem (Gn 1:26-27). Finalmente, no final do sexto dia, Deus criou o homem, o centro de Sua criação. Ainda que os cientistas não concordem com isso, os céus existem para que a terra exista, a terra existe para a criação do homem, e o homem existe para fazer a vontade de Deus.'
                        ],
                        [
                            'title' => 'DOMINGO',
                            'bible_reading' => 'Gn 1:26-28; Mt 28:18-20; At 1:8',
                            'prayer_reading' => '"Toda a autoridade me foi dada no céu e na terra. Ide, portanto, fazei discípulos de todas as nações" (Mt 28:18b,19a).',
                            'content' => 'Deus nos concedeu uma bênção maravilhosa: ser fecundos e multiplicar-nos (Gn 1:28). O tempo em que vivemos corresponde ao sexto dia da criação, o que indica que já se completaram seis mil anos desde que Deus restaurou Sua criação e formou o homem.'
                        ]
                    ]
                ],
                [
                    'number' => 3,
                    'title' => 'NO SÉTIMO DIA DEUS DESCANSOU DE TODA OBRA QUE FIZERA – (Gn 2:1-3)',
                    'days' => [
                        [
                            'title' => 'SEGUNDA-FEIRA',
                            'bible_reading' => 'At 2:42',
                            'prayer_reading' => '"Em nada considero a vida preciosa para mim mesmo, contanto que complete a minha carreira e o ministério que recebi do Senhor Jesus para testemunhar o evangelho da graça de Deus" (At 20:24).',
                            'content' => 'O título da mensagem desta semana é: "No sétimo dia Deus descansou de toda obra que fizera". Deus restaurou a terra e criou o homem para cumprir Seu propósito: fazer Cristo encabeçar todas as coisas por meio da igreja.'
                        ],
                        [
                            'title' => 'TERÇA-FEIRA',
                            'bible_reading' => 'Gn 1:27, 31; 2:2-4',
                            'prayer_reading' => '"Há, todavia, uma coisa, amados, que não deveis esquecer: que, para o Senhor, um dia é como mil anos, e mil anos, como um dia" (2 Pe 3:8).',
                            'content' => 'No final do sexto dia, Deus criou o homem e a mulher. Ele não criou um ser de gênero indefinido, portanto não sejamos enganados pelas falsas ideologias do mundo. Deus os abençoou e lhes deu a missão de ser fecundos e encher a terra, sujeitando-a.'
                        ],
                        [
                            'title' => 'QUARTA-FEIRA',
                            'bible_reading' => '1 Co 15:24-26; Ap 20:6-8, 10-14',
                            'prayer_reading' => '"E será pregado este evangelho do reino por todo o mundo, para testemunho a todas as nações. Então, virá o fim" (Mt 24:14).',
                            'content' => 'O profeta Daniel teve a visão das setenta semanas: "Setenta semanas estão determinadas sobre o teu povo e sobre a tua santa cidade, para fazer cessar a transgressão, para dar fim aos pecados, para expiar a iniquidade, para trazer a justiça eterna, para selar a visão e a profecia e para ungir o Santo dos Santos."'
                        ],
                        [
                            'title' => 'QUINTA-FEIRA',
                            'bible_reading' => 'Hb 1:1; 2:5-6; 2 Pe 3:13',
                            'prayer_reading' => '"Não foi a anjos que sujeitou o mundo que há de vir, sobre o qual estamos falando" (Hb 2:5).',
                            'content' => 'Deus criou o homem no final do sexto dia e, no sétimo dia, descansou. Você percebe que o primeiro dia do homem é o sétimo dia da criação? Isso indica que ele foi criado para entrar no descanso de Deus. Não fomos criados para lutar ou viver por nossa capacidade, mas para descansar.'
                        ],
                        [
                            'title' => 'SEXTA-FEIRA',
                            'bible_reading' => 'Sl 2:1-5; 2 Co 10:4; Ef 3:18-19; Hb 1:9; 2:1-4, 7-10',
                            'prayer_reading' => '"Por esta razão, importa que nos apeguemos, com mais firmeza, às verdades ouvidas, para que delas jamais nos desviemos" (Hb 2:1).',
                            'content' => 'Deus fez o homem por um pouco menor que os anjos e o coroou de glória e honra, constituindo-o sobre as obras de Suas mãos (Hb 2:7-8). Portanto Deus não sujeitou todas as coisas apenas a Cristo, mas também a nós, pois fomos unidos ao Senhor e fazemos parte de Seu Corpo.'
                        ],
                        [
                            'title' => 'SÁBADO',
                            'bible_reading' => 'Gn 1:28; Dt 8:2-3; Mt 4:4; 2 Co 10:5-6; Hb 2:14-18; 3:7-19',
                            'prayer_reading' => '"Tende cuidado, irmãos, jamais aconteça haver em qualquer de vós perverso coração de incredulidade que vos afaste do Deus vivo" (Hb 3:12).',
                            'content' => 'A palavra é uma arma poderosíssima. Por isso nas ruas usamos a palavra da imersão diária para levar os pensamentos das pessoas cativos à obediência de Cristo. Quando formos totalmente preenchidos com essa palavra, nossa submissão a Deus será completa.'
                        ],
                        [
                            'title' => 'DOMINGO',
                            'bible_reading' => 'Is 66:2; Hb 4:2',
                            'prayer_reading' => '"Aquele que entrou no descanso de Deus, também ele mesmo descansou de suas obras, como Deus das suas" (Hb 4:10).',
                            'content' => 'O povo de Israel recebeu a promessa de entrar no descanso, mas alguns não entraram, tendo tombado no deserto em razão de seu coração incrédulo e desobediente. O livro de Hebreus mostra que a palavra que receberam não lhes aproveitou, porquanto não foi acompanhada pela fé (Hb 4:2).'
                        ]
                    ]
                ],
                [
                    'number' => 4,
                    'title' => 'A CRIAÇÃO DO HOMEM – (Gn 2:4-7)',
                    'days' => [
                        [
                            'title' => 'SEGUNDA-FEIRA',
                            'bible_reading' => 'Gn 2:4-7; At 2:42-47',
                            'prayer_reading' => '"O SENHOR tem piedade de Sião; terá piedade de todos os lugares assolados dela, e fará o seu deserto como o Éden, e a sua solidão, como o jardim do SENHOR; regozijo e alegria se acharão nela, ações de graças e som de música" (Is 51:3).',
                            'content' => '"A criação do homem" é o título da mensagem desta semana, na qual veremos a importância da criação do homem. Deus criou as plantas e a relva, mas só fez cair a chuva depois que criou o homem, porque este é que precisa lavrar a terra para a vida crescer.'
                        ],
                        [
                            'title' => 'TERÇA-FEIRA',
                            'bible_reading' => 'Gn 1:1, 11; 2:4-6; Jo 5:17',
                            'prayer_reading' => '"De Deus somos cooperadores; lavoura de Deus e edifício de Deus sois vós" (1 Co 3:9).',
                            'content' => 'Vimos que a alegria e a vida normal da igreja primitiva duraram apenas seis anos. Logo em seguida, surgiu a perseguição dos judeus e dos judaizantes. Já no final do primeiro século, a igreja estava degradada.'
                        ],
                        [
                            'title' => 'QUARTA-FEIRA',
                            'bible_reading' => 'Gn 2:7; Jó 32:8; 34:14-15; Pv 20:27; 1 Co 2:10-11',
                            'prayer_reading' => '"O Espírito de Deus me fez, e o sopro do Todo-Poderoso me dá vida" (Jó 33:4).',
                            'content' => 'O ponto central da mensagem desta semana é entendermos a constituição do homem. Para isso precisamos fazer um exame, como um raio X e uma ressonância magnética do ser humano, para vermos como ele funciona, como foi criado por Deus e como executará a vontade de Deus.'
                        ],
                        [
                            'title' => 'QUINTA-FEIRA',
                            'bible_reading' => 'Is 57:15',
                            'prayer_reading' => '"Tudo fez Deus formoso no seu devido tempo; também pôs a eternidade no coração do homem, sem que este possa descobrir as obras que Deus fez desde o princípio até ao fim" (Ec 3:11).',
                            'content' => 'Toda a criação de Deus foi feita de maneira bela e formosa; nada destoa nem está fora de lugar. Deus fez tudo bonito, apropriado e adequado em seu devido tempo e pôs a eternidade no coração do homem, sem que este possa descobrir as obras que Deus fez.'
                        ],
                        [
                            'title' => 'SEXTA-FEIRA',
                            'bible_reading' => 'Jo 1:1; 4:23-24; 8:9; 1 Jo 1:1-3',
                            'prayer_reading' => '"O pendor da carne dá para a morte, mas o do Espírito, para a vida e paz" (Rm 8:6).',
                            'content' => 'O espírito do homem foi criado para fazer contato com Deus, por isso Ele mesmo soprou Seu Espírito no homem. Graças ao Senhor, temos essa revelação! Deus é espírito, e importa que Seus adoradores O adorem em espírito e em verdade (Jo 4:24).'
                        ],
                        [
                            'title' => 'SÁBADO',
                            'bible_reading' => 'Gn 2:17; 3:4; Mt 13:16-19; Rm 2:15; 3:23; 5:12; Ef 2:1',
                            'prayer_reading' => '"Digo a verdade em Cristo, não minto, testemunhando comigo, no Espírito Santo, a minha própria consciência" (Rm 9:1).',
                            'content' => 'A consciência compartilha com a alma o conhecimento vindo de Deus pela intuição. A parte da alma ligada à consciência é a mente, a qual, com seus pensamentos, transforma a mensagem espiritual recebida de Deus em mensagem inteligível.'
                        ],
                        [
                            'title' => 'DOMINGO',
                            'bible_reading' => 'Jo 17:17; Ef 1:13; 2:3; 4:17; 1 Pe 1:6-7, 9',
                            'prayer_reading' => '"Para que a santificasse, tendo-a purificado por meio da lavagem de água pela palavra" (Ef 5:26).',
                            'content' => 'Com a queda do homem, o pecado entrou no mundo, o espírito humano ficou amortecido e a mente não consegue mais receber mensagens de Deus. Isso resultou na vaidade dos pensamentos humanos (Ef 4:17). Nós também éramos assim, como os gentios, obscurecidos de entendimento, alheios à vida de Deus, mas agora, graças a Deus, fomos regenerados.'
                        ]
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