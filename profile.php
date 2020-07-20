<?php session_start();

if (!isset($_SESSION['email'])) {
    header("location: ./login.php");
}
include('./scripts/php/tweets.class.php');
$info = new Tweets();
if (isset($_GET['pseudo'])) {
    $userID = $info->getUserId($_GET['pseudo']);
    $userInfo = $info->getMemberInfo($userID);
} else $userInfo = $info->getMemberInfo($_SESSION['id_user']);
?>

<!DOCTYPE html>

<head>
    <title>TweetAcademie My Profile</title>
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
        <div class="col-lg-6 col-md-12 col-sm-12" id="centralDiv">
            <div class="row" id="Home">
                <a href="./index.php"><img src="./assets/left-arrow.png" class="ml-3 mt-1 mr-4" style="height: 30px;"></a>
                <h3 class="ml-3 mt-1"><?= "@" . $userInfo[3]; ?></h3>
            </div>
            <div class="col d-inline" id="profileHeader">
                <div id="profileHeaderTop" class="row borderBot pb-4">
                    <img id="profilePic" src="./assets/default_profile_400x400.png">
                </div>
                <div id="profileHeaderBot" class="container-fluid mt-2">
                    <div class="row-12 mt-2">
                        <h3><?= $userInfo[1] . " " . $userInfo[2]; ?></h3>
                    </div>
                    <input id="id_user" type="hidden" value="<?= $userInfo[0]; ?>">
                    <!-- <input id="pseudo" type="hidden" value="<?= $userInfo[3]; ?>"> -->
                    <div class="row-12 greyFont">
                        <h5><?= "@" . $userInfo[3] ?></h5>
                    </div>
                    <div class="row-12 greyFont">
                        <h5><?= "Joined the :<br>" . $userInfo[7] ?></h5>
                    </div>
                    <div class="row-12 d-flex greyFont">
                        <h6>Following : 0</h6>
                        <h6 class="ml-4">Followers : 0</h6>
                    </div>
                </div>
            </div>
            <div class="col" id="test">
                <!-- TWEETS GOES HERE -->
                <?php include("./scripts/php/tweetsFeed.php"); ?>
            </div>
        </div>
        <!-- END CENTRAL SECTION -->
        <!-- RIGHT SECTION -->
        <div class="col-lg-5 d-none d-lg-block d-xl-block" id="rightDiv">
            <div class="col ml-2">
                <div class="row mt-2">
                        <div class="col-9">
                            <input type="text" name="quicksearch" id="quicksearch" placeholder=" Search for people...">
                        </div>
                        <div class="col-2">
                            <input class="btn btn-primary mt-2" type="submit" id="find_person" value="->">
                        </div>
                    <div id="show"></div>
                </div>
                <div class="row mt-4">
                    <div id="trendingZone" class="col">
                        <div id="trendingContent" class="row trending_objects">
                            <div class="row_search trending_objects trending_objects__content">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END RIGHT DIV -->
    </div>
    <!-- JS/JQUERY BOOTSTRAP -->
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="./scripts/js/mainpageScript.js"></script>
    <script src="./scripts/js/script.js"></script>
</body>