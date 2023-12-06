<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebDev - Restaurante</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        header {
            background-color: #3498db;
            color: white;
            text-align: center;
            padding: 20px;
        }

        header h1 {
            margin: 0;
            font-size: 36px;
        }

        main {
            text-align: center;
            padding: 50px;
        }

        main p {
            font-size: 18px;
            color: #333;
        }

        footer {
            background-color: #3498db;
            color: white;
            text-align: center;
            padding: 10px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        footer p {
            margin: 0;
        }

        main ul {
            list-style: none;
            padding: 0;
        }

        main li {
            margin: 10px 0;
        }

        main a {
            text-decoration: none;
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        main a:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <?php include '../components/header.components.php' ?>


    <main>

        <p>Area de Usuario</p>
    </main>
    <?php include '../components/footer.components.php' ?>
</body>

</html>