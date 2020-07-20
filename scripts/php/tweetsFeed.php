<?php

$id_session = $_SESSION['id_user'];

try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=tweet_academie',
        'Theresa',
        'mysql123'
    );
} catch (\Throwable $th) {
    echo $th;
}
if (empty($_GET['pseudo'])) {
    $userID = $id_session;
}
$check = $pdo->query("SELECT f.id_follower FROM follow f LEFT JOIN user u ON f.id_followed=u.id_user 
            WHERE u.id_user=$userID AND f.id_follower=$id_session");
$value = $check->fetchColumn();
if ($value > 0) { //more than 0 lines result
    echo '<div class="row tweetCard pb-2"><div class="col"><button class="btn btn-primary" id="unfollow">Unfollow user</button>';
    echo '<button class="btn btn-primary" id="follow" style="display: none;">Follow user</button></div>';
} else { //(following)
    echo '<div class="row"><div class="col"><button class="btn btn-primary" id="follow">follow user</button>';
    echo '<button class="btn btn-primary" id="unfollow" style="display: none;">unfollow user</button></div>';
}
echo '<div class="col"><button class="btn btn-primary" id="my_followers">Followers</button>
                    <div class="list_followers"></div></div>';
echo '<div class="col"><button class="btn btn-primary" id="my_followings">Followings    </button>
                    <div class="list_followings"></div></div></div>';
// include("guillaume.class.php");
$profile = new Tweets();
$mainFeed = $profile->getTweetsFromProfile($userID);

for ($n = 0; $n <= count($mainFeed) - 1; $n++) {
    $author = $profile->getMemberInfo($mainFeed[$n][0]);
    $authorName = $author[1] . " " . $author[2];
    $authorPseudo = "@" . $author[3];
?>
    <div class="row tweetCard pt-3">
        <div class="col-2">
            <img src="./assets/default_profile_400x400.png" class="tweetProfilePic">
        </div>
        <div class="col-10 tweetBody">
            <div class="row align-items-baseline tweetInfo">
                <h5 class="mr-2"><?= $authorName; ?></h5>
                <h6 class="mr-2"><?= '<a href="profile.php?pseudo=' . ltrim($authorPseudo, '@') . '">' . $authorPseudo . '</a>'; ?></h6>
                <h6 class="mr-2"><?= $mainFeed[$n][2]; ?></h6>
            </div>
            <div class="row tweetContent">
                <?= parseTweet($mainFeed[$n][3]); ?>
            </div>
            <div class="row mt-2 mb-2">
                <div class="col">
                    <button class="btn btn-primary btn-sm button_reponse">REPLY</button>
                </div>
                <div class="col">
                    <button class="btn btn-primary btn-sm" btn-sm>LIKE</button>
                </div>
                <div class="col">
                    <button id="<?= $mainFeed[$n][1]; ?>" class="btn btn-primary btn-sm to_share">RETWEETS</button>
                </div>
            </div>
            <?php
                $commentFeed = $profile->getComments($mainFeed[$n][1]);
            for ($y = 0; $y <= count($commentFeed) - 1; $y++) {
                $author = $profile->getMemberInfo($commentFeed[$y][0]);
                $authorName = $author[1] . " " . $author[2];
                $authorPseudo = "@" . $author[3];
            ?>
                <div class="row tweetCard pt-3">
                    <div class="col-2">
                        <img src="./assets/default_profile_400x400.png" class="tweetProfilePic">
                    </div>
                    <div class="col-10 tweetBody">
                        <div class="row align-items-baseline tweetInfo">
                            <h5 class="mr-2"><?= $authorName; ?></h5>
                            <h6 class="mr-2"><?= '<a href="profile.php?pseudo=' . ltrim($authorPseudo, '@') . '">' . $authorPseudo . '</a>'; ?></h6>
                            <h6 class="mr-2"><?= $commentFeed[$y][2]; ?></h6>
                        </div>
                        <div class="row tweetContent">
                            <?= parseTweet($commentFeed[$y][3]); ?>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p>LIKES</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }; ?>
        </div>
    </div>
<?php
}
// foreach ($pdo->query("SELECT t.tweet_date, t.url_image, t.id_tweet, t.content_tweet, t.id_rep, u.pseudo 
//             FROM tweet t LEFT JOIN user u ON t.id_autor=u.id_user WHERE t.id_autor=$userID ORDER BY t.id_tweet DESC") as $tweet) {
//     echo '<br><ins><i>' . $tweet['pseudo'] . "</ins></i> tweeted the " . $tweet['tweet_date'] . ": " . '<br>' . '<strong>' . $tweet['content_tweet'] . '</strong>' . '<br>';
//     $id_tweet = $tweet['id_tweet'];
//     foreach ($pdo->query("SELECT tweet_date, url_image, id_tweet, content_tweet, id_rep FROM tweet WHERE id_rep=$id_tweet") as $reply) {
//         echo "pseudo replied the " . $reply['tweet_date'] . ": <br>" . $reply['content_tweet'] . '<br>';
//     }
// }
function parseTweet($tweet_content)
{
    $tweet_content = explode(" ", $tweet_content);

    foreach ($tweet_content as $row) {
        if ($row[0] == '#') {
            $row = '<a href="#">' . $row . '</a>';
        } else if ($row[0] == '@') {
            $row = '<a href="profile.php?pseudo=' . ltrim($row, '@') . '">' . $row . '</a>';
        } else {
            $row;
        }
        $tweet .= ' ' . $row;
    }
    echo trim($tweet);
}
