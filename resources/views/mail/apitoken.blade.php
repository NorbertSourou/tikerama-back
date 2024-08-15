<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        p {
            font-size: 12px;
        }

        .signature {
            font-style: italic;
        }
    </style>
</head>
<body>
<div>

    <p> Bonsoir {{$credentials['name']}},</p>
    Recevez nos salutations les plus distinguées.
    Retrouvez ci-dessous votre clé d'API pour accéder à notre service:

    <span style="color: #000000; font-size: 24px">
        <b>
            {{$credentials['token']}}
        </b>
 </span>


</div>
</body>
</html>
