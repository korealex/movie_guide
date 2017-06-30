$(document).ready(function () {
    var shows = [
        {
            seriesName:"Fringe",
            banner:"http://thetvdb.com/banners/_cache/topfanart/850231.jpg",
            overview:"The series follows a Federal Bureau of Investigation \"Fringe Division\" team based in Boston. The team uses unorthodox \"fringe\" science and FBI investigative techniques to investigate a series of unexplained, often ghastly occurrences, some of which are related to mysteries surrounding a parallel universe.",
            network:"FOX",
            firstAired:"2008-08-26",
        },
        {
            seriesName:"Mr. Robot",
            banner:"http://thetvdb.com/banners/_cache/topfanart/1147314.jpg",
            overview:"Mr. Robot follows Elliot, a young programmer who works as a cyber-security engineer by day and a vigilante hacker by night. Elliot finds himself at a crossroad when the mysterious leader of an underground hacker group recruits him to destroy the corporation he is paid to protect.",
            network:"USA Network",
            firstAired:"2015-06-24",
        },
        {
            seriesName:"Silicon Valley",
            banner:"http://thetvdb.com/banners/_cache/topfanart/1128505.jpg",
            overview:"In the high-tech gold rush of modern Silicon Valley, the people most qualified to succeed are the least capable of handling success. A comedy partially inspired by Mike Judge's own experiences as a Silicon Valley engineer in the late 1980s.",
            network:"HBO",
            firstAired:"2014-04-06",
        },
        {
            seriesName:"The Fresh Prince of Bel-Air",
            banner:"http://thetvdb.com/banners/_cache/topfanart/1032146.jpg",
            overview:"A wealthy family living in Bel-Air, California, receives a dubious gift from their poorer relations in Philadelphia when  Will Smith arrives as The Fresh Prince Of Bel-Air. Will shatters the sophisticated serenity of Bel-Air with his streetwise common sense, much to the dismay of his upper-crust uncle, Philip Banks (James Avery), Aunt Vivian (Janet Hubert-Whitten and Daphne Maxwell Reid) and three conceited cousins, Carlton (Alfonso Ribeiro), Hilary (Karyn Parsons) and Ashley (Tatyana Ali) - and butler Geoffrey (Joseph Marcell). As the Banks family opens their home - and their checkbook - to their needy relative, Will adapts easily to their indulgent lifestyle. Yet, he reminds everyone that the simplest pleasures of family life can't be bought at any price.",
            network:"NBC",
            firstAired:"1990-09-10",
        }
    ];

    console.log('ready')
    var unloadShows = function () {
        var tvShows = [];
        if(tvShows.length == 0){

            $('#TVshows .columns .column').removeClass('fadeInUp').addClass('fadeOut',200);


        }
    }
    var loadShows = function (callback) {
        var tvShows = shows;
        if(tvShows.length > 0){
            return callback(tvShows);
        }
    }

    unloadShows();


    $('#search').keyup(function () {
        var content = $(this).val();
        if(content.length>3){
            console.log('searching for: ' + content)
            $('.search-container').addClass('is-loading');

            var cardContent = loadShows(function (tvShows) {
                var  tvShowsCardContent = tvShows.map(function (show) {
                    var card =  new TVshowCard(show);
                    return card.getCard()
                });
                $('.search-container').removeClass('is-loading');

                return tvShowsCardContent;
            });

            $('#TVshows .columns').html(cardContent.join(""));
            console.log(cardContent.join(""))
        }else{
            $('.search-container').removeClass('is-loading');
            unloadShows();
        }


    });



});
