<?php
session_start();
class User
{
    private $pdo;
    private $user;
    private $bdd;
    private $password;
    private $name;
    private $surname;
    private $username;
    private $DOB;
    private $email;
    private $pass;
    private $bio;
    private $email_connect;
    private $pass_connect;


    function __construct()
    {
        $this->user = 'Theresa';
        $this->password = 'mysql123';
        $this->bdd = 'tweet_academie';
        $this->pdo = new PDO(
            'mysql:host=localhost;dbname=' . $this->bdd,
            $this->user,
            $this->password
        );
    }
    function inscription()
    {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $username = $_POST['username'];
        $DOB = $_POST['DOB'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $bio = $_POST['bio'];
        $curdate = date("Y-m-d");
        $theme = 0;
        $profile_picture = 'test';

        $thepass = hash('ripemd160', $pass);

        $sql = "SELECT email FROM user WHERE email='$email'";
        $stmt = $this->pdo->query($sql);
        $final_email = $stmt->fetch();

        $sql_pseudo = "SELECT pseudo FROM user WHERE pseudo='$username'";
        $stmt_pseudo = $this->pdo->query($sql_pseudo);
        $final_pseudo = $stmt_pseudo->fetch();

        if (($final_email['email']) == $email) {
            echo "<script>alert('Un compte utilise déja cet adresse mail')</script>";
        } elseif ($final_pseudo['pseudo'] == $username) {
            echo "<script>alert('Un compte utilise déja ce pseudo')</script>";
        } else {
            $sql = "INSERT INTO `user`(`name`, `surname`, `pseudo`, `birthdate`, `email`, `password`, `subscribe_date`, `profile_picture`, `bio`, `theme`) VALUES (?,?,?,?,?,?,?,?,?,?)";
            $stmt = $this->pdo->prepare($sql);
            $test = $stmt->execute([$name, $surname, $username, $DOB, $email, $thepass, $curdate, $profile_picture, $bio, $theme]);
            echo "<script>alert('Tu es incris')</script>";
        }
    }
    function connexion()
    {
        $email_connect = $_POST['email_connect'];
        $pass_connect = $_POST['pass_connect'];

        $sql_email_connect = "SELECT email FROM user WHERE email='$email_connect'";
        $stmt_email_connect = $this->pdo->query($sql_email_connect);
        $final_email_connect = $stmt_email_connect->fetch();

        $sql_pass_connect = "SELECT password FROM user WHERE email='$email_connect'";
        $stmt_pass_connect = $this->pdo->query($sql_pass_connect);
        $final_pass_connect = $stmt_pass_connect->fetch();

        $h = hash('ripemd160', $pass_connect);

        if ($final_email_connect['email'] == $email_connect && $h == $final_pass_connect['password']) {
            $sql_info_id = "SELECT id_user FROM user WHERE email='$email_connect'";
            $stmt_info_id = $this->pdo->query($sql_info_id);
            $final_info_id = $stmt_info_id->fetch();

            $_SESSION['id_user'] = $final_info_id['id_user'];

            $sql_info_user = "SELECT * FROM user WHERE id_user =" . $_SESSION['id_user'];
            $stmt_info_user = $this->pdo->query($sql_info_user);
            $final_info_user = $stmt_info_user->fetch();

            $_SESSION['name'] = $final_info_user['name'];
            $_SESSION['surname'] = $final_info_user['surname'];
            $_SESSION['email'] = $final_info_user['email'];
            $_SESSION['password'] = $final_info_user['password'];



            echo "<script>document.location.href ='index.php'</script>";
        } else {
            echo "<script>alert('Mauvais Email ou mot de passe.')</script>";
        }
    }
    function modification()
    {
        $check_func_modif = $_POST['check_func_modif'];

        if ($check_func_modif == 'email') {
            $new_email_modif = $_POST['new_email_modif'];
            $pass_email_modif = $_POST['pass_email_modif'];
            $h = hash('ripemd160', $pass_email_modif);

            $sql = "SELECT email FROM user WHERE email='$new_email_modif'";
            $stmt = $this->pdo->query($sql);
            $final_email = $stmt->fetch();

            if ($final_email == true) {
                echo "<script>alert('Cet email est déja pris.')</script>";
            } else {
                if ($h == $_SESSION['password']) {
                    $new_mail = "UPDATE user SET email='$new_email_modif' WHERE id_user=" . $_SESSION['id_user'];
                    $mail_stmt = $this->pdo->query($new_mail);
                    $new_mail_update = $mail_stmt->fetch();
                    echo "<script>alert('Votre email a bien été modifié.')</script>";
                } else {
                    echo "<script>alert('Mauvais mot de passe.')</script>";
                }
            }
        } elseif ($check_func_modif == 'pseudo') {
            $new_pseudo_modif = $_POST['new_pseudo_modif'];
            $pass_pseudo_modif = $_POST['pass_pseudo_modif'];
            $h = hash('ripemd160', $pass_pseudo_modif);

            $sql = "SELECT pseudo FROM user WHERE pseudo='$new_pseudo_modif'";
            $stmt = $this->pdo->query($sql);
            $final_pseudo = $stmt->fetch();

            if ($final_pseudo == true) {
                echo "<script>alert('Cet pseudo est déja pris.')</script>";
            } else {
                if ($h == $_SESSION['password']) {
                    $new_mail = "UPDATE user SET pseudo='$new_pseudo_modif' WHERE id_user=" . $_SESSION['id_user'];
                    $mail_stmt = $this->pdo->query($new_mail);
                    $new_mail_update = $mail_stmt->fetch();
                    echo "<script>alert('Votre pseudo a bien été modifié.')</script>";
                } else {
                    echo "<script>alert('Mauvais mot de passe.')</script>";
                }
            }
        } elseif ($check_func_modif == 'name') {
            $new_name_modif = $_POST['new_name_modif'];
            $pass_name_modif = $_POST['pass_name_modif'];
            $h = hash('ripemd160', $pass_name_modif);

            if ($h == $_SESSION['password']) {
                $new_mail = "UPDATE user SET name='$new_name_modif' WHERE id_user=" . $_SESSION['id_user'];
                $mail_stmt = $this->pdo->query($new_mail);
                $new_mail_update = $mail_stmt->fetch();
                echo "<script>alert('Votre name a bien été modifié.')</script>";
            } else {
                echo "<script>alert('Mauvais mot de passe.')</script>";
            }
        } elseif ($check_func_modif == 'surname') {
            $new_surname_modif = $_POST['new_surname_modif'];
            $pass_surname_modif = $_POST['pass_surname_modif'];
            $h = hash('ripemd160', $pass_surname_modif);

            if ($h == $_SESSION['password']) {
                $new_mail = "UPDATE user SET surname='$new_surname_modif' WHERE id_user=" . $_SESSION['id_user'];
                $mail_stmt = $this->pdo->query($new_mail);
                $new_mail_update = $mail_stmt->fetch();
                echo "<script>alert('Votre surname a bien été modifié.')</script>";
            } else {
                echo "<script>alert('Mauvais mot de passe.')</script>";
            }
        } elseif ($check_func_modif == 'bio') {
            $new_bio_modif = $_POST['new_bio_modif'];
            $pass_bio_modif = $_POST['pass_bio_modif'];
            $h = hash('ripemction="" method="post">
            <p><input type="text" name="quicksearch" id="quicksearch" placeholder="Find person" /></p>
            <input typd160', $pass_bio_modif);

            if ($h == $_SESSION['password']) {
                $new_mail = "UPDATE user SET bio='$new_bio_modif' WHERE id_user=" . $_SESSION['id_user'];
                $mail_stmt = $this->pdo->query($new_mail);
                $new_mail_update = $mail_stmt->fetch();
                echo "<script>alert('Votre bio a bien été modifié.')</script>";
            } else {
                echo "<script>alert('Mauvais mot de passe.')</script>";
            }
        }
    }
    function quickSearch()
    {
        $find_person = $_POST['quicksearch'];
        foreach ($this->pdo->query("SELECT id_user, UPPER(name) AS name, surname, pseudo FROM user 
            WHERE name LIKE '%" . $find_person . "%' 
            OR surname LIKE '%" . $find_person . "%' 
            OR pseudo LIKE '%" . $find_person . "%'") as $profile) {
            echo '<a href=profile.php?pseudo=' . $profile['pseudo'] . '>' . $profile["name"] . ' ' . $profile["surname"] . '</a><br>';
            echo '<input type="hidden" class="id_user" value="' . $profile["id_user"] . '"><br>';
        }
    }

    function messagesSearch()
    {
        $find_person = $_POST['quicksearch'];
        foreach ($this->pdo->query("SELECT id_user, UPPER(name) AS name, surname, pseudo FROM user 
            WHERE name LIKE '%" . $find_person . "%' 
            OR surname LIKE '%" . $find_person . "%' 
            OR pseudo LIKE '%" . $find_person . "%'") as $profile) {
            echo '<a href=messages.php?id=' . $profile['id_user'] . '>' . $profile["name"] . ' ' . $profile["surname"] . '</a><br>';
        }
    }

    function submitSearch()
    {
        $id_user = $_POST['id_user'];
        $id_session = $_SESSION['id_user'];
        echo '<input id="id_user" type="hidden" value="' . $id_user . '"';
        foreach ($this->pdo->query("SELECT id_user, UPPER(name) AS name, surname, pseudo, subscribe_date, bio 
            FROM user WHERE id_user='$id_user'") as $result) {
            $id_perso = $result['id_perso'];
            echo '<br><br>' . "Name: " . $result['name'] . '<br><br>
                     Surname: ' . $result["surname"] . '<br><br>
                     Pseudo: ' . $result["pseudo"] . '<br><br>
                     Bio: ' . $result["bio"] . '<br><br>
                     Subscribe date: ' . $result["subscribe_date"] . '<br>';
        }
        //ajout theresa :
        $check = $this->pdo->query("SELECT f.id_follower FROM follow f LEFT JOIN user u ON f.id_followed=u.id_user 
            WHERE u.id_user=$id_user AND f.id_follower=$id_session");
        $value = $check->fetchColumn();
        if ($value > 0) { //more than 0 lines result
            echo '<p><button id="unfollow">unfollow user</button><br>';
            echo '<p><button id="follow" style="display: none;">follow user</button><br>';
        } else { //(following)
            echo '<p><button id="follow">follow user</button><br>';
            echo '<p><button id="unfollow" style="display: none;">unfollow user</button><br>';
        }
        echo '<p><button id="my_followers">followers</button><br>
                    <div class="list_followers"></div>';
        echo '<button id="my_followings">followings</button><br>
                    <div class="list_followings"></div></p>';
        echo '<script src="script.js"></script>';
        foreach ($this->pdo->query("SELECT t.tweet_date, t.url_image, t.id_tweet, t.content_tweet, t.id_rep, u.pseudo 
            FROM tweet t LEFT JOIN user u ON t.id_autor=u.id_user WHERE t.id_autor=$id_user ORDER BY t.id_tweet DESC") as $tweet) {
            echo '<br><ins><i>' . $tweet['pseudo'] . "</ins></i> tweeted the " . $tweet['tweet_date'] . ": " . '<br>' . '<strong>' . $tweet['content_tweet'] . '</strong>' . '<br>';
            $id_tweet = $tweet['id_tweet'];
            foreach ($this->pdo->query("SELECT tweet_date, url_image, id_tweet, content_tweet, id_rep FROM tweet WHERE id_rep=$id_tweet") as $reply) {
                echo "pseudo replied the " . $reply['tweet_date'] . ": <br>" . $reply['content_tweet'] . '<br>';
            }
        }
    }
    function my_followers()
    {
        $id_followed = $_POST['id_followed'];
        foreach ($this->pdo->query("SELECT u.pseudo AS pseudo FROM user u 
        LEFT JOIN follow f ON u.id_user=f.id_follower 
        WHERE f.id_followed=$id_followed GROUP BY f.id_follower") as $followers) {
            echo $followers['pseudo'] . '<br>';
        }
    }
    function my_followings()
    {
        $id_following = $_POST['id_following'];
        foreach ($this->pdo->query("SELECT u.pseudo FROM user u 
        LEFT JOIN follow f ON u.id_user=f.id_followed 
        WHERE f.id_follower=$id_following GROUP BY f.id_followed") as $followings) {
            echo $followings['pseudo'] . '<br>';
        }
    }
    public function requestHashtag()
    {
        $tag = substr($_POST['contentHashtag'], 1);
        $qpdo3 = "SELECT content_tweet FROM tweet WHERE content_tweet LIKE BINARY '%#$tag%'";
        //AND content_tweet NOT LIKE BINARY '%#$tag%_'
        $req3 = $this->pdo->query($qpdo3);

        foreach ($req3 as $row) {
            $row = $row[0];
            $row = explode(" ", $row);
            $firstCar = count($row);

            $i = 0;
            while ($i < $firstCar) {

                if (substr($row[$i], 0, 1) == '#') {
                    $row[$i] = "<a href='#'>$row[$i]</a>";
                } elseif (substr($row[$i], 0, 1) == '@') {
                    $row[$i] = "<a href='#'>$row[$i]</a>";
                }
                $i++;
            }
            $row = implode(" ", $row);
            $qpdo = "SELECT tweet_date FROM tweet WHERE content_tweet LIKE BINARY '%#$tag%' AND content_tweet NOT LIKE BINARY '%#$tag%_'";
            $req = $this->pdo->query($qpdo);
            $time = $req->fetch();
            echo "<div><p>Le " . $time[0] . "</p>";
            echo "<p>$row</p></div>";
        }
    }

    public function requestTweet() //modif Theresa
    {
        $idAutor = $_SESSION['id_user'];
        $words = explode(" ", $_POST['contentTweet']);

        foreach ($words as $row) {
            if ($row[0] == '#') {
                //check if already in BDD
                $row = substr($row, 1);
                $check_tag = $this->pdo->query("SELECT hashtag FROM tweet_tag 
                WHERE hashtag LIKE BINARY '$row'");
                $value_tag = $check_tag->fetchColumn();
                if ($value_tag != "") { //->already in BDD
                    echo '<a href="#">#' . $row . '</a>';
                } else if ($value_tag == "") { //->add to BDD
                    echo 'put_in_BDD_and_echo';
                    $this->pdo->query("INSERT INTO tweet_tag (id_user, hashtag) 
                    VALUES ($idAutor, '$row')");
                    echo '<a href="#">#' . $row . '</a>';
                }
                $row = '#' . $row;
            } else if ($row[0] == '@') {
                echo '<a href="#">#' . $row . '</a>';
                //href -> link vers la page de profile de $row (follower)
            } else {
                echo $row . '<br>';
            }
            $tweet .= ' ' . $row;
        }
        $this->pdo->query("INSERT INTO tweet (id_autor, tweet_date, content_tweet) 
        VALUES ($idAutor, NOW(), '$tweet')");
        echo $idAutor . " " . $tweet . '<br>';
    }
    public function followUser() //ajout theresa
    {
        $id_profile = $_POST['id_profile'];
        $id_session = $_SESSION['id_user'];

        $this->pdo->query("INSERT INTO follow (id_follower, id_followed) VALUES ($id_session, $id_profile)");
        return;
        //INSERT INTO follow (id_follower, id_followed) VALUES (4, 1)
    }
    public function unFollowUser() //ajout theresa
    {
        $id_profile = $_POST['id_profile'];
        $id_session = $_SESSION['id_user'];
        echo $id_profile . $id_session;

        $this->pdo->query("DELETE FROM follow WHERE id_follower=$id_session AND id_followed=$id_profile");
        //DELETE FROM follow WHERE id_follower=4 AND id_followed=1
        //katha=$_SESSION['id_user'] | andre=$_POST['id_profile']
    }
    // rajouté
    public function toShareTweet()
    {
        $qpdo1 = "SELECT NOW()";
        $req1 = $this->pdo->query($qpdo1);
        $timeArray = $req1->fetch();
        var_dump($timeArray);
        $time = $timeArray[0];

        $qpdo2 = "SELECT content_tweet FROM tweet WHERE id_tweet='$_POST[idTweet]'";
        $req2 = $this->pdo->query($qpdo2);
        $contentTweet = $req2->fetch();
        $contentTweet = $contentTweet[0];

        $qpdo3 = "INSERT INTO tweet (id_autor, tweet_date, content_tweet, id_retweet) VALUES ('$_SESSION[id_user]', '$time', '$contentTweet', '$_POST[idTweet]')";
        $req3 = $this->pdo->query($qpdo3);
        $req3->fetch();
    }

    public function commentTweet()
    {
        echo 'couuuu';
        $qpdo1 = "SELECT NOW()";
        $req1 = $this->pdo->query($qpdo1);
        $timeArray = $req1->fetch();
        $time = $timeArray[0];

        if ($time) {
            // $qpdo2 = "INSERT INTO tweet (id_autor, tweet_date, content_tweet, id_rep) VALUES ('$_SESSION[id_user]', '$time', '$_POST[contentReponse]', '$_POST[idTweet]')";
            // $req2 = $this->pdo->query($qpdo2);
            // if ($req2) {
            echo "<script>alert('$_POST[contentReponse]')</script>";
            // }
        }
    }

    // fin du rajout

    function sendMessage()
    {
        $id_user = $_SESSION['id_user'];
        $id_receiver = $_POST['id_receiver'];
        $message = $_POST["message_content"];
        $query = "INSERT INTO message(id_expeditor, id_receiver, content_message) VALUES($id_user, $id_receiver, '$message')";

        $result = $this->pdo->query($query);
        if ($result != false) {
            echo "success";
        } else echo "fail";
    }
}
$user = new User;
$check_func = $_POST['check_func'];
if ($check_func == 'inscription') {
    $user->inscription();
} elseif ($check_func == 'connexion') {
    $user->connexion();
} elseif ($check_func == 'modification') {
    $user->modification();
} elseif ($check_func == "quicksearch") {
    $user->quickSearch();
} elseif ($check_func == "messagesSearch") {
    $user->messagesSearch();
} elseif ($check_func == 'submitsearch') {
    $user->submitSearch();
} elseif ($check_func == 'myfollowers') {
    $user->my_followers();
} elseif ($check_func == 'myfollowings') {
    $user->my_followings();
} elseif ($check_func == 'hashtag') {
    $user->requestHashtag();
} elseif ($check_func == 'tweet') {
    $user->requestTweet();
} elseif ($check_func == 'follow') {
    $user->followUser();
} elseif ($check_func == 'unfollow') {
    $user->unFollowUser();
} elseif ($check_func == 'share') {
    $user->toShareTweet();
} elseif ($check_func == 'commentaire') {
    $user->commentTweet();
} elseif ($check_func == "sendMessage") {
    $user->sendMessage();
}
