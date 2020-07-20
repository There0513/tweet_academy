<?php session_start();

if (!isset($_SESSION['email'])) {
    header("location: ./login.php");
} ?>

<!DOCTYPE html>

<head>
    <title>TweetAcademie Homepage</title>
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
                <h3 class="ml-3 mt-1">Home</h3>
            </div>
            <div class="row" id="postTweet">
                <div class="col-2 mt-3">
                    <img src="./assets/default_profile_400x400.png" id="tweetProfilePic">
                </div>
                <div class="col-10">
                    <input id="tweetContent" type="text" class="form-control mt-4" placeholder="What's on your mind ?">
                    <div class="row justify-content-end mr-4 mt-2">
                        <button id="submitTweet" class="btn-sm btn-primary">Send</button>
                    </div>
                </div>
            </div>
            <div class="col" id="tweetsList">
                <?php include('./scripts/php/mainFeed.php'); ?>
                <!-- TWEETS GOES HERE -->
            </div>
        </div>
        <!-- END CENTRAL SECTION -->
        <!-- RIGHT SECTION -->
        <div class="col-lg-5 d-none d-lg-block d-xl-block" id="rightDiv">
            <div class="col ml-2">
                <div class="row mt-2">
                    <div class="col-9">
                        <input type="text" class="hash" name="content_hashtag" id="content_hashtag" value="#hashtag_search" style="color: grey;" />
                    </div>
                    <div class="col-2">
                        <button class="btn btn-primary btn-sm mt-2" id="submit_hashtag">-></button>
                    </div>
                </div>
                <div id="show"></div>
                <div class="row mt-4">
                    <div id="trendingZone" class="col">
                        <div id="trendingContent" class="row trending_objects">
                            <div class="row_search trending_objects trending_objects__content">
                            </div>
                            <!-- TRENDING GOES HERE -->
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