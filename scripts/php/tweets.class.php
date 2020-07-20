<?php

require_once "user.php";

class Tweets extends User
{
    private $temp;

    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                'mysql:host=localhost;dbname=tweet_academie',
                'Theresa',
                'mysql123'
            );
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    function coucou()
    {
        echo "coucou";
    }
    function getTweetFromRetweet($id_retweet)
    {
        $query = "SELECT * FROM tweet WHERE id_tweet=$id_retweet";
        $this->temp = $this->pdo->query($query);
        $this->temp = $this->temp->fetchAll(3);
        return ($this->temp);
    }
    function getTweetsFromProfile($userID)
    {
        $query = "SELECT * from tweet WHERE id_autor=$userID ORDER BY tweet_date DESC LIMIT 6";
        $this->temp = $this->pdo->query($query);
        $this->temp = $this->temp->fetchAll(3);
        return ($this->temp);
    }
    function getComments($id_tweet)
    {
        $query = "SELECT * FROM tweet WHERE id_rep=$id_tweet";
        $this->temp = $this->pdo->query($query);
        $this->temp = $this->temp->fetchAll(3);
        return ($this->temp);
    }
    function getLastTweets()
    {
        $query = "SELECT * from tweet ORDER BY tweet_date DESC LIMIT 6";
        $this->temp = $this->pdo->query($query);
        $this->temp = $this->temp->fetchAll(3);
        return ($this->temp);
    }
    function getTweetMemberInfo($author_ID)
    {
        $query = "SELECT * FROM user WHERE id_user=$author_ID";
        $this->temp = $this->pdo->query($query);
        $this->temp = $this->temp->fetchAll(3);
        return ($this->temp);
    }
    function getMemberInfo($memberID)
    {
        $query = "SELECT * FROM user WHERE id_user=$memberID";
        $this->temp = $this->pdo->query($query);
        $this->temp = $this->temp->fetchAll(3);
        return ($this->temp[0]);
    }

    function getUserId($pseudo)
    {
        $query = "SELECT id_user FROM user WHERE pseudo='$pseudo'";
        $this->temp = $this->pdo->query($query);
        $this->temp = $this->temp->fetchAll(3);
        return ($this->temp[0][0]);
    }
    function getMessages()
    {
        $id_user = $_SESSION['id_user'];
        $id_receiver = $_GET['id'];
        $query = "SELECT * FROM (SELECT * FROM message WHERE (id_expeditor=$id_user and id_receiver=$id_receiver) OR (id_expeditor=$id_receiver and id_receiver=$id_user) ORDER BY message_date DESC LIMIT 15)Var1 ORDER BY message_date ASC";

        $temp = $this->pdo->query($query);
        $result = $temp->fetchAll(3);
        return $result;
    }
    function getUserContacts()
    {
        $id_user = $_SESSION['id_user'];
        $query = "select distinct id_expeditor, id_receiver from message where id_expeditor=$id_user or id_receiver=$id_user";
        $temp = $this->pdo->query($query);
        $result = $temp->fetchAll(3);
        return $result;
    }
}
