<?php require_once '../../To do list/db_conn.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-Essentials Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS CODES/homepagina.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #1d5995 !important;
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        .hero-section {
            background: url('sd.jpg') no-repeat center center;
            background-size: cover;
            height: 39vh;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .hero-section h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
        }
        .hero-section p {
            font-size: 1.25rem;
            max-width: 600px;
        }
        .container .card {
            margin-top: 20px;
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .card-text {
            font-size: 1rem;
        }
        .footer {
            background-color: #1d5995;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
  <a class="navbar-brand" href="homepage.php">Web-Essentials</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="../../calculator/calc.php">Calculator</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Tools
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="../../To do list/index.php">To Do List</a>
          <a class="dropdown-item" href="../../agenda/agenda.php">Agenda</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

<div class="hero-section">
    <div>
        <h1>Welkom bij Web-Essentials</h1>
        <p>Ontdek alles wat je nodig hebt om te slagen. Van tools en middelen tot het laatste nieuws.</p>
        <a href="#" class="btn btn-primary btn-lg">Meer informatie</a>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img class="card-img-top" src="s.webp" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Klaslokalen</h5>
                    <p class="card-text">Onze moderne klaslokalen zijn uitgerust met de nieuwste technologie.</p>
                    <a href="#" class="btn btn-primary">Meer lezen</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img class="card-img-top" src="a.webp" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Bibliotheek</h5>
                    <p class="card-text">Onze bibliotheek biedt een breed scala aan bronnen voor studenten.</p>
                    <a href="#" class="btn btn-primary">Meer lezen</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img class="card-img-top" src="lab.png" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Laboratoria</h5>
                    <p class="card-text">Onze state-of-the-art laboratoria zijn ideaal voor praktisch leren.</p>
                    <a href="#" class="btn btn-primary">Meer lezen</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <p>&copy; 2024 Web-Essentials. Alle rechten voorbehouden.</p>
</div>

</body>
</html>
