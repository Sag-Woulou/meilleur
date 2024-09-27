<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur cote serveur</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #0D1B2A, #0f2350, #660000); /* Dégradé bleu foncé, vert foncé et violet foncé */
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
            background-color: #21592c;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #18772b;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>500</h1>
    <h2>Oops ! Une erreur est survenue lors de la demande.</h2>
    <a href="{{ url('/') }}">Retour à l'accueil</a>
</div>
</body>
</html>
