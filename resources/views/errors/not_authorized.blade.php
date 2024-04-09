<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Indirizzo non autorizzato</title>

    <style>
    .content{
    margin-top: 200px;

        h1{
            font-size: 80px;
            color: #ff5555;
        }

        p{
            font-size: 25px;
            margin: 30px 0px;
        }
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="content">
                    <h1>403</h1>
                    <p>Oops! Hai fatto il furbo e stai cercando di accedere ad un contenuto <strong>non autorizzato</strong>.</p>
                    <p>Ritorna alla tua <a href="{{ route('user.dashboard') }}">dashboard personale</a>.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>