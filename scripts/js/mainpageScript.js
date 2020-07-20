$(document).ready(function() {
    $('#submitTweet').click(function() {
        var check_func = 'tweet';
        var contentTweet = $('#tweetContent').val();
        const tweetsList = $('#tweetsList')

        $.post('./scripts/php/user.php', {
            contentTweet: contentTweet,
            check_func: check_func
        }, function(data) {
            tweetsList.load("./scripts/php/mainFeed.php", function() {
                $('#tweetContent').val('');
                console.log("coucou")
            });
            console.log(data);
        });
    });
});