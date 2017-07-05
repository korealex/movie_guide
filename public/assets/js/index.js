$(document).ready(function () {

    $('#main-content').html(window.MainContent.initHome());
    $('#search-btn').click(find);
    $(document).keypress(function (e) {
        if(e.which == 13) {
            find;
        }
    });
});
window.shows_main = [];

var unloadShows = function () {
    var tvShows = [];
    if (tvShows.length == 0) {
        $('#TVshows .columns .column').removeClass('fadeInUp').addClass('fadeOut', 200);
        $('#TVshows .columns').html('');
    }
}
var loadShows = function (searchParam, callback) {
    window.http.get('/search', {q: searchParam}, function (error, response) {
        if (response) {
            shows_main = response.data
            var tvShows = response.data
            if (tvShows.length > 0) {
                return callback(null, tvShows);
            }
        } else {
            if (!error) {
                error = "Resource not found";
            }
            return callback(error);
        }
    });

};

var find = function () {
    var content = $('#search').val();


    console.log('searching for: ' + content)
    $('.search-container').addClass('is-loading');

    var cardContent = loadShows(content, function (error, tvShows) {
        if (error) {
            $('.search-container').removeClass('is-loading');
            unloadShows();
        } else {
            var tvShowsCardContent = tvShows.map(function (show) {
                var card = new TVshowCard(show);
                return card.getCard()
            });
            $('.search-container').removeClass('is-loading');
            $('#TVshows .columns').html(tvShowsCardContent.join(""));

            $('.banner').each(function (index, value) {
                var image = value
                image.src = getBgUrl(value)
                image.onload = function () {
                    console.log(index, 'loaded')
                }
            })
        }
    });
};

var getBgUrl = function (el) {
    var bg = "";
    if (el.currentStyle) { // IE
        bg = el.currentStyle.backgroundImage;
    } else if (document.defaultView && document.defaultView.getComputedStyle) { // Firefox
        bg = document.defaultView.getComputedStyle(el, "").backgroundImage;
    } else { // try and get inline style
        bg = el.style.backgroundImage;
    }
    return bg.replace(/url\(['"]?(.*?)['"]?\)/i, "$1");
}
