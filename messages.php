<?php session_start();

if (!isset($_SESSION['email'])) {
    header("location: ./login.php");
}
?>

<!DOCTYPE html>

<head>
    <title>TweetAcademie Messages</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="d-flex container-fluid" id="main-body">
        <!-- NAVBAR -->
        <?php include("./scripts/php/dynamicNavbar.php"); ?>
        <!-- END NAVBAR -->
        <!-- CENTRAL SECTION -->
        <div class="col-lg-4 d-none d-md-block" id="centralDiv">
            <div class="row" id="Home">
                <div class="col-9">
                    <h3 class="ml-1 mt-1">Messages</h3>
                </div>
                <div class="col-2">
                    <img src="./assets/add-mail.png" style="height:40px;">
                </div>
            </div>
            <div class="row mt-4 pb-4 ml-2 mr-2 borderBot">
                <div class="col">
                    <form id="find_person">
                        <input type="text" name="quicksearch" id="quicksearch" placeholder=" Search for people...">
                    </form>
                </div>
            </div>
            <div class="row mt-4">
                <div id="findUsers" class="col" style="display: hidden;">
                    <div class="row trending_objects">
                        <div class="row_search trending_objects trending_objects__content">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row mt-4 mb     -2">
                    <h5 class="greyFont">Mes contacts</h5>
                </div>
                <?php include("./scripts/php/contactList.php") ?>
            </div>
        </div>
        <!-- END CENTRAL SECTION -->
        <!-- RIGHT SECTION -->
        <div class="col-lg-7" id="rightDiv" style="border-left: 1px solid rgb(56, 68, 77);">
            <?php include("./scripts/php/inbox.php"); ?>
        </div>
        <form id="messageForm">
            <div class="row">
                <div class="col-lg-10 col-9 pr-1">
                    <input class="mt-3" type="text" id="messageContent">
                </div>
                <div class="col">
                    <input id="messageSubmit" type="image" src="./assets/right-arrow.png" style="height: 40px;margin-top:10px;"></input>
                </div>
        </form>
    </div>
    </div>
    <!-- END RIGHT DIV -->
    </div>
    <!-- JS/JQUERY BOOTSTRAP -->
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="./scripts/js/messagesScript.js"></script>
</body>