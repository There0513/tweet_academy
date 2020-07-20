<?php

$inbox = new Tweets();

if (isset($_GET["id"])) {
    $receiver = $inbox->getMemberInfo($_GET["id"]);
    $name = $receiver[1];
    $surname = $receiver[2];
    $pseudo = "@" . $receiver[3];
} else {
    $name = "Nom";
    $surname = "Prenom";
    $pseudo = '@pseudo';
} ?>
<div class="row mb-2" id="Home">
    <div class="col mt-3">
        <h4 style="margin-bottom: 0px;"><?= $name . " " . $surname ?></h4>
        <p class="greyFont"><?= $pseudo ?></p>
        <p id="idReceiver" style="display:none;"><?= $_GET['id'] ?></p>
    </div>
</div>
<div id="inbox" class="col borderBot">
    <?php
    if (isset($_GET["id"])) {
        $receiver = $inbox->getMemberInfo($_GET["id"]);
        $expeditor = $inbox->getMemberInfo($_SESSION['id_user']);
        $result = $inbox->getMessages();

        for ($n = 0; $n < count($result); $n++) {
            if ($result[$n][0] == $_SESSION['id_user']) {
    ?>
                <div class="row sentMessage">
                    <div class="messageBubble">
                        <p class="message"><?= $result[$n][3] ?></p>
                    </div>
                </div>
            <?php
            } else { ?>
                <div class="row receivedMessage">
                    <div class="messageBubble">
                        <p class="message"><?= $result[$n][3] ?></p>
                    </div>
                </div>
    <?php }
        }
    }
    ?>