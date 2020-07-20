$(document).ready(function () {
    $('#button_inscription').click(function () {
        var check_func = 'inscription';
        var name = $('#name').val();
        var surname = $('#surname').val();
        var username = $('#username').val();
        var DOB = $('#DOB').val();
        var email = $('#email').val();
        var pass = $('#pass').val();
        var bio = $('#bio').val();
        $.post('./scripts/php/user.php', {
            name: name, surname: surname, username: username, DOB: DOB, email: email, pass: pass, bio: bio, check_func: check_func
        }, function (donnees) {
            $('#afficher').html(donnees)
        });
    });
    $('#button_connexion').click(function () {
        var check_func = 'connexion';
        var email_connect = $('#email_connect').val();
        var pass_connect = $('#pass_connect').val();
        $.post('./scripts/php/user.php', {
            email_connect: email_connect, pass_connect: pass_connect, check_func: check_func
        }, function (donnees) {
            $('#afficher').html(donnees)
        });
    });
    $('#button_email_modif').click(function () {
        var check_func = 'modification';
        var check_func_modif = 'email';
        var new_email_modif = $('.new_email_modif').val();
        var pass_email_modif = $('.pass_email_modif').val();
        $.post('./scripts/php/user.php', {
            check_func: check_func, check_func_modif, check_func_modif, new_email_modif: new_email_modif, pass_email_modif: pass_email_modif
        }, function (donnees) {
            $('.afficher').html(donnees)
        });
    });
    $('#button_pseudo_modif').click(function () {
        var check_func = 'modification';
        var check_func_modif = 'pseudo';
        var new_pseudo_modif = $('.new_pseudo_modif').val();
        var pass_pseudo_modif = $('.pass_pseudo_modif').val();
        $.post('./scripts/php/user.php', {
            check_func: check_func, check_func_modif, check_func_modif, new_pseudo_modif: new_pseudo_modif, pass_pseudo_modif: pass_pseudo_modif
        }, function (donnees) {
            $('.afficher').html(donnees)
        });
    });
    $('#button_name_modif').click(function () {
        var check_func = 'modification';
        var check_func_modif = 'name';
        var new_name_modif = $('.new_name_modif').val();
        var pass_name_modif = $('.pass_name_modif').val();
        $.post('./scripts/php/user.php', {
            check_func: check_func, check_func_modif, check_func_modif, new_name_modif: new_name_modif, pass_name_modif: pass_name_modif
        }, function (donnees) {
            $('.afficher').html(donnees)
        });
    });
    $('#button_surname_modif').click(function () {
        var check_func = 'modification';
        var check_func_modif = 'surname';
        var new_surname_modif = $('.new_surname_modif').val();
        var pass_surname_modif = $('.pass_surname_modif').val();
        $.post('./scripts/php/user.php', {
            check_func: check_func, check_func_modif, check_func_modif, new_surname_modif: new_surname_modif, pass_surname_modif: pass_surname_modif
        }, function (donnees) {
            $('.afficher').html(donnees)
        });
    });
    $('#button_bio_modif').click(function () {
        var check_func = 'modification';
        var check_func_modif = 'bio';
        var new_bio_modif = $('.new_bio_modif').val();
        var pass_bio_modif = $('.pass_bio_modif').val();
        $.post('./scripts/php/user.php', {
            check_func: check_func, check_func_modif, check_func_modif, new_bio_modif: new_bio_modif, pass_bio_modif: pass_bio_modif
        }, function (donnees) {
            $('.afficher').html(donnees)
        });
    });

    $("#find_person").click(function (e) {
        e.preventDefault();
        $.post(
            './scripts/php/user.php',
            {
                quicksearch: $("#quicksearch").val(),
                check_func: 'quicksearch'
            },
            function (data, status) {
                if (status == 'success') {
                    console.log(data, status);
                    $('#findUsers').show();
                    $('.row_search').html(data);
                }

                else {
                    console.log("else-data = " + data + "status = " + status);
                }
            },
            'text'
        );
    });
    $("#submit_search").click(function (e) {
        e.preventDefault();
        $.post(
            './scripts/php/user.php',
            {
                id_user: $("#id_user").val(),
                check_func: 'submitsearch'

            },
            function (data, status) {
                if (status == 'success') {
                    $('#show').html(data);
                    console.log(data, status);
                    return;
                }
                else {
                    console.log("else-data = " + data + "status = " + status);
                    location.href = 'my_account.php?id_user=' + id_user.value;
                }
            },
            'text'
        );
    });
    $("#my_followers").on("click", function (e) {
        e.preventDefault();
        $.post(
            './scripts/php/user.php',
            {
                id_followed: $("#id_user").val(),
                check_func: 'myfollowers'
            },
            function (data, status) {
                if (status == 'success') {
                    $('.list_followers').html(data);
                    console.log(data, 'whattttt', status);
                    return;
                }
                else {
                    console.log("else-data = " + data + "status = " + status);
                }
            },
            'text'
        );
    });
    $("#my_followings").click(function (e) {
        e.preventDefault();
        $.post(
            './scripts/php/user.php',
            {
                id_following: $("#id_user").val(),
                check_func: 'myfollowings'
            },
            function (data, status) {
                if (status == 'success') {
                    $('.list_followings').html(data);
                    console.log(data, status);
                    return;
                }
                else {
                    console.log("else-data = " + data + "status = " + status);
                }
            },
            'text'
        );
    });
    $("#follow").click(function (e) {
        e.preventDefault();
        $.post(
            './scripts/php/user.php',
            {
                id_profile: $("#id_user").val(),
                check_func: 'follow'
            },
            function (data, status) {
                if (status == 'success') {
                    $('#follow').hide();
                    $('#unfollow').show();
                    return;
                }
                else {
                    $('#follow').hide();
                    $('#unfollow').show();
                    console.log("else-data = " + data + "status = " + status);
                }
            },
            'text'
        );
    });
    $("#unfollow").click(function (e) {
        e.preventDefault();
        $.post(
            './scripts/php/user.php',
            {
                id_profile: $("#id_user").val(),
                check_func: 'unfollow'
            },
            function (data, status) {
                if (status == 'success') {
                    console.log(data, status);
                    $('#unfollow').hide();
                    $('#follow').show();
                    return;
                }
                else {
                    console.log("else-data = " + data + "status = " + status);
                }
            },
            'text'
        );
    });
    $('input.hash').keyup(function () {
        if (
            ($(this).val().length > 0) && ($(this).val().substr(0, 1) != '#')
            || ($(this).val() == '')
        ) {
            $(this).val('#');
        }
    });
    $('#submit_hashtag').click(function () {

        $.post('./scripts/php/user.php', {
            contentHashtag: $('#content_hashtag').val(),
            check_func: 'hashtag'
        }, function (data) {

            $('#show').html(data);
        });
    })

    $('#submit_tweet').click(function () {
        var check_func = 'tweet';
        var contentTweet = $('#content_tweet').val();

        $.post('./scripts/php/user.php', {
            contentTweet: contentTweet,
            check_func: check_func
        }, function (donnees) {
            console.log(donnees);
            $('#affichage').html(donnees);
        });
    });

    $("#signupAsk").on("click", function () {
        $('#signupForm').hide();
        $('#signinForm').show();
    });

    $("#signinAsk").on("click", function () {
        $('#signupForm').show();
        $('#signinForm').hide();
    })

    // rajouté
    // $('.to_share').click(function () {
    //     var check_func = 'share';
    //     var idTweet = $(this).attr('id');
    //     console.log(idTweet); // à tester : tweet a id du tweet ->chaque id est unique + id_tweet
    //     $.post('./scripts/php/user.php', {
    //         idTweet: idTweet,
    //         check_func: check_func
    //     }, function (donnees) {
    //         alert('Votre tweet à été partagé');
    //         console.log(donnees);
    //         $('#affichage').html(donnees);
    //     });
    // })
    $(".to_share").click(function (e) {
        e.preventDefault();
        var idTweet = $(this).attr('id');
        console.log(idTweet);
        $.post(
            './scripts/php/user.php',
            {
                idTweet: idTweet,
                check_func: 'share'
            },
            function (data, status) {
                if (status == 'success') {
                    alert('Votre tweet à été partagé');
                    console.log(data, status);
                    // $('#affichage').html(donnees);
                    return;
                }
                else {
                    console.log("else-data = " + data + "status = " + status);
                }
            },
            'text'
        );
    });

    $('.button_reponse').click(function () {
        var check_func = 'commentaire';
        var idTweet = $(this).closest('div').attr('id');
        var div = document.getElementById(idTweet);
        var contentReponse = div.childNodes.length;
        var last = div.lastChild;
        //      for (let i = 0; i != div.childNodes.length; i++) {
        // if (div.childNodes[i].is("textarea")) {
        //     alert(div.childNodes[i].nodeValue);
        // }
        alert(last.closest("textarea").val());
        //    }
        //var contentReponse = $(this).closest('textarea').value;

        $.post('./scripts/php/user.php', {
            idTweet: idTweet,
            check_func: check_func,
            contentReponse: contentReponse
        }, function (donnees) {
            $('#affichage').html(donnees);
        });
    })
    // fin du rajout
    $('#theme_day').click(function () {
        $('.row').css("background-color", "burlywood");
        $('.col').css("background-color", "burlywood");
        $('#rightDiv').css("background-color", "burlywood");
        $('#main-body').css("background-color", "burlywood");
        $('#main-body').css("color", "rgb(21, 32, 43)");
    })
    $('#theme_night').click(function () {
        $('.row').css("background-color", "rgb(21, 32, 43)");
        $('.col').css("background-color", "rgb(21, 32, 43)");
        $('#rightDiv').css("background-color", "rgb(21, 32, 43)");
        $('#main-body').css("background-color", "rgb(21, 32, 43)");
        $('#main-body').css("color", "white");
    })
});