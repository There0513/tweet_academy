$(document).ready(function () {
    $("#find_person").on("submit", function (e) {
        e.preventDefault();
        $.post(
            './scripts/php/user.php',
            {
                quicksearch: $("#quicksearch").val(),
                check_func: 'messagesSearch'
            },
            function (data, status) {
                if (status == 'success') {
                    console.log(data, status);
                    $('#trendingZone').show();
                    $('.row_search').html(data);
                }
                else {
                    console.log("else-data = " + data + "status = " + status);
                }
            },
            'text'
        );
    });

    $("#messageForm").on("submit", function (e) {
        e.preventDefault();
        if ($('#messageContent').val() != "") {
            $.post(
                './scripts/php/user.php',
                {
                    id_receiver: $('#idReceiver').html(),
                    message_content: $('#messageContent').val(),
                    check_func: 'sendMessage'
                },
                function (data) {
                    console.log(data);
                    $('#messageContent').val("");
                    location.reload();
                }
            )
        }
    })
    document.getElementById("messageContent").focus();
})  