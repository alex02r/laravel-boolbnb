<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
        <div class="row">
            <div class="col-12 text-center ">
                <div class="content">
                    <h1>404</h1>
                    <p>Oops! Sembra che tu stia cercando di accedere ad un contenuto non autorizzato.</p>
                    <p>Ritorna alla tua <a href="{{ route('user.dashboard') }}"></a>dashboard personale</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>