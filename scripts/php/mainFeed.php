<?php

include("tweets.class.php");

$test = new Tweets();
$mainFeed = $test->getLastTweets();

for ($n = 0; $n <= count($mainFeed) - 1; $n++) {
    $author = $test->getMemberInfo($mainFeed[$n][0]);
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
                <?php if ($mainFeed[$n][6] === NULL) {
                    parseTweet($mainFeed[$n][3]);
                } else {
                    $re_tweet = $test->getTweetFromRetweet($mainFeed[$n][6]);
                    // var_dump($re_tweet[0][0]);
                    $author_retweet = $test->getMemberInfo($re_tweet[0][0]);
                    // var_dump($author_retweet);
                    $authorName = $author_retweet[1] . " " . $author_retweet[2];
                    $authorPseudo = "@" . $author_retweet[3]; ?>
                    <div class="row align-items-baseline tweetInfo">
                        <h5 class="mr-4"><?= $authorName; ?></h5>
                        <h6 class="mr-4"><?= '<a href="profile.php?pseudo=' . ltrim($authorPseudo, '@') . '">' . $authorPseudo . '</a>'; ?></h6>
                        <h6 class="mr-4"><?= $re_tweet[2]; ?></h6>
                    </div>
                    <div class="row tweetContent">
                        <?php parseTweet($mainFeed[$n][3]);
                        ?>
                    </div>
                <?php
                }; ?>
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
            $commentFeed = $test->getComments($mainFeed[$n][1]);
            for ($y = 0; $y <= count($commentFeed) - 1; $y++) {
                $author = $test->getMemberInfo($commentFeed[$y][0]);
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
