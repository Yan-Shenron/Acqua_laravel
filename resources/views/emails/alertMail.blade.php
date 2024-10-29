<!DOCTYPE html>
<html>
<head>
    <title>Email personnalisé</title>
</head>
<body>
    <div class="email-header">
        <h3>Alerte du boîtier #{{ $boitierId }}</h3>
    </div>
    <div class="card-container">
        <div class="card-title">
            {{ $title }}
        </div>
        <div class="card-content">
            <p>Bonjour {{ $userFirstName }} {{ $userName }},</p>
            <p>Nous avons reçu une alerte du boîtier #{{ $boitierId }} le {{ $alertBoitierDate }} avec la valeur suivante: {{ $alertBoitierValue }}. </p>
            <p>Veuillez considérer cette alerte dès que possible.</p>
        </div>
        <div class="card-footer">
            Merci, <br>
            L'équipe Acquagest
        </div>
    </div>
</body>
</html>

<style>
    body {
        font-family: Arial, sans-serif;
        color: #333333;
        background-color: #f5f5f5;
        padding: 30px;
    }
    .email-header {
        background-color: #3788bd;
        color: #fff;
        padding: 15px;
        text-align: center;
    }
    .card-container {
        background-color: #fff;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        margin-bottom: 30px;
    }
    .card-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 15px;
        text-align: center;
    }
    .card-content {
        font-size: 18px;
        line-height: 1.5;
        margin-bottom: 15px;
    }
    .card-footer {
        font-size: 16px;
        color: #999999;
        text-align: right;
    }
</style>




