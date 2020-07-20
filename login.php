<?php session_start(); ?>

<!DOCTYPE html>

<head>
    <title>TweetAcademie Login/Signup</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div id="signupMain" class="container-fluid">
        <!-- SIGNUP/SIGNIN -->
        <div id="signupTitle" class="row mt-4" style="place-content:center;">
            <h1>Welcome to Tweet_Academie !</h1>
        </div>
        <div class="row">
            <div id="signupForm" class="col mt-4">
                <h2>Signup</h2>
                <label for="email">Email</label><br>
                <input class="signForm" type="email" id="email_connect" required><br>

                <label for="pass">Mot de passe</label><br>
                <input class="signForm" type="password" id="pass_connect" required><br>

                <button class="btn btn-primary mt-2" id="button_connexion">Valider</button>
                <div class="row" style="place-content:center;">
                    <p id="signupAsk" class="greyFont mt-4 signSwitch" style="font-style:italic;">Not a member yet ? Click here to sign up !</p>
                </div>
            </div>
            <div id="signinForm" class="col mt-4 text-center" style="display: none;">
                <h2>Inscription</h2>
                <label for="name">Nom</label><br>
                <input class="signForm" type="text" id="name" required><br>

                <label for="surname">Prenom</label><br>
                <input class="signForm" type="text" id="surname" required><br>

                <label for="username">Pseudonyme</label><br>
                <input class="signForm" type="text" id="username" required><br>

                <label for="DOB">Date</label><br>
                <input class="signForm" type="date" id="DOB" required><br>

                <label for="email">Email</label><br>
                <input class="signForm" type="email" id="email" required><br>

                <label for="pass">Mot de passe</label><br>
                <input class="signForm" type="password" id="pass" required><br>

                <label for="bio">Description</label><br>
                <textarea id="bio"></textarea><br>

                <button class="btn btn-primary mt-1" id="button_inscription">Valider</button>
                <div class="row" style="place-content:center;">
                    <p id="signinAsk" class="greyFont mt-4 signSwitch" style="font-style:italic;">Already a member ?</p>
                </div>
            </div>
        </div>
        <div id="afficher"></div>
    </div>
    <!-- JS/JQUERY BOOTSTRAP -->
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="./scripts/js/script.js"></script>
</body>