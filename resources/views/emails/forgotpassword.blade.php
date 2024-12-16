<!DOCTYPE html>
<html>
<head>
    <title>Lien de réinitialisation de votre mot de passe</title>
</head>
<body>
    <div class="email-header">
        <h3>Bonjour {{ $userName }}  {{ $userFirstName }} !</h3>
    </div>
    <div class="card-container">
        <div class="card-title">
            Lien de réinitialisation de votre mot de passe
        </div>
        <div class="card-content">
            <p>Rendez vous sur <a href='https://monitoring.acquaprocess.eu/password/reset'>https://monitoring.acquaprocess.eu/password/reset</a> pour réinitialiser votre mot de passe.</p>
            <p>Ce code est utilisable à usage unique, il vous sera demandé lors de la réinitialisation : {{ $code }}</p>
            <p>Si vous n'avez pas demandé de réinitialisation de mot de passe, vous pouvez ignorer cet e-mail.</p>
            <p>Si vous rencontrez des problèmes, n'hésitez pas à nous contacter.</p>
        </div>
        <div class="card-footer">
            Merci, <br>
            L'Acquagest
        </div>
    </div>
</body>
</html>

<style>

    body {
        font-family: Arial, sans-serif;
        color: #333;
    }
    a {
        color: #007bff;
        text-decoration: none;
    }
    .email-header {
        background-color: #3788bd;
        color: #fff;
        padding: 1rem;
        text-align: center;
    }
    .email-header h3 {
        margin: 0;
    }
    .card-container {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 0.25rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        margin: 1rem;
        padding: 1rem;
    }
    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 1rem;
        text-align: center;
    }
    .card-content {
        font-size: 1rem;
        line-height: 1.5;
        margin-bottom: 1rem;
    }
    .card-footer {
        font-size: 16px;
        color: #999999;
        text-align: right;
    }
</style>