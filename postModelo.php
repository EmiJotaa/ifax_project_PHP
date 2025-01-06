<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';
require_once 'config/settings.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coletando os dados do formulário
    $nome = isset($_POST['Nome']) ? htmlspecialchars(trim($_POST['Nome'])) : '';
    $telefone = isset($_POST['Telefone']) ? htmlspecialchars(trim($_POST['Telefone'])) : '';
    $email = isset($_POST['Email']) ? filter_var(trim($_POST['Email']), FILTER_VALIDATE_EMAIL) : '';
    $assunto = isset($_POST['Assunto']) ? htmlspecialchars(trim($_POST['Assunto'])) : '';
    $mensagem = isset($_POST['Message']) ? nl2br(htmlspecialchars(trim($_POST['Message']))) : '';
    $salvar_email_newsletter = isset($_POST['salvar_email_newsletter']) ? 1 : 0;


    if (empty($nome) || empty($telefone) || empty($email) || empty($assunto) || empty($mensagem)) {
        header('Location: fale-conosco?erro=campos_vazios');
        exit;
    }

 if ($salvar_email_newsletter === 1) {
        $newsletterModel = new \App\Model\Newsletter();

        if ($newsletterModel->emailExiste($email)) {
            header('Location: fale-conosco?erro=email_ja_cadastrado');
            exit;
        }

        // Se não houver duplicata, salva no banco de dados
        $camposNewsletter = [
            'nome' => $nome,
            'email' => $email
        ];

        $newsletterModel->insertNewsletter($camposNewsletter);
}

$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;  
    $mail->CharSet = 'UTF-8';                    
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.hostinger.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'contato@marquindosom.com';                     
    $mail->Password   = 'Emijota22@';                               
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    

    //Recipients
    $mail->setFrom('contato@marquindosom.com', "Caixa de entrada");
    $mail->addAddress('mrcez4rr@gmail.com', 'Marco');
    $mail->addReplyTo($email, $nome);


    //Content
    $mail->isHTML(true);                                 
    $mail->Subject = $assunto;
    $mail->Body    = "
        <h1>Mensagem de $nome</h1>
        <p><strong>Telefone:</strong> $telefone</p>
        <p><strong>E-mail:</strong> $email</p>
        <p><strong>Mensagem:</strong><br>$mensagem</p>
    ";
    $mail->AltBody = "Mensagem de $nome: \nTelefone: $telefone \nE-mail: $email \nMensagem: $mensagem";

    $mail->send();

    header("Location:/ifax/mensagem-recebida");
    exit;

}catch (Exception $e) {
    echo "Error";
 }
}
?>