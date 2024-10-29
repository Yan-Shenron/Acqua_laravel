<!DOCTYPE html>
<html>
<head>
    <title>Your Password</title>
</head>
<body>
    <div class="email-header">
        <h3>Bonjour {{ $userFirstName }} {{ $userName }}!</h3>
    </div>
    <div class="card-container">
        <div class="card-title">
            Votre Mot de Passe
        </div>
        <div class="card-content">
            <p>Votre mot de passe est : {{ $clearPassword }}</p>
            <p>Merci de le conserver en lieu sûr et de ne pas le partager.</p>
            <p>Nous vous recommandons de <a href='http://acquagest.shenron.dev'>personnaliser votre mot de passe</a> dès que possible.</p>
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