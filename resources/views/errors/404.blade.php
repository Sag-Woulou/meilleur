<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page non trouvée</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #0D1B2A, #0A5041, #3D0066); /* Dégradé bleu foncé, vert foncé et violet foncé */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }
        .container {
            text-align: center;
        }
        h1 {
            font-size: 120px;
            margin: 0;
        }
        h2 {
            font-size: 30px;
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
            margin-bottom: 30px;
        }
        a {
            text-decoration: none;
            color: #fff;
            background-color: #1F4287;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #16324F;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>404</h1>
    <h2>Oops ! La page que vous cherchez n'existe pas.</h2>
    <p>Il semble que la page que vous avez demandée soit introuvable.</p>
    <a href="{{ url('/') }}">Retour à l'accueil</a>
</div>
</body>
</html>
