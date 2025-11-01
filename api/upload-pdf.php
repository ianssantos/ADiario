<?php
if ($_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
    $tempName = $_FILES['pdf_file']['tmp_name'];
    $targetPath = 'pdfs/ad.pdf';
    
    if (move_uploaded_file($tempName, $targetPath)) {
        echo "PDF atualizado com sucesso! <a href='index.html'>Voltar ao leitor</a>";
        
        // Limpa o cache forçando recarregamento
        if (file_exists('pdfs/debug.txt')) {
            unlink('pdfs/debug.txt');
        }
    } else {
        echo "Erro ao fazer upload do PDF.";
    }
} else {
    echo "Erro no upload: " . $_FILES['pdf_file']['error'];
}
?>