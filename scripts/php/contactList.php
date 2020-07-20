<?php

include("tweets.class.php");

$profile = new Tweets();
$results = $profile->getUserContacts();
$contactList = array();
foreach ($results as $array) {
    foreach ($array as $value) {
        if ($value != $_SESSION["id_user"]) {
            if (!in_array($value, $contactList)) {
                array_push($contactList, $value);
            }
        }
    }
}
foreach ($contactList as $value) {
    $member = new Tweets();
    $memberInfo = $member->getMemberInfo($value);
?>
    <div class="row">
        <div class="messageBubble contactBubble">
            <a class="contact" href="./messages.php?id=<?= $value ?>"><?= $memberInfo[1] . " " . $memberInfo[2] ?></a>
        </div>
    </div>
<?php
}
