$(document).ready(function () {

    $('#main-content').html(window.MainContent.initHome());
    // $('#main-content').html(window.MainContent.showDetails());
    $('#main-content').on('click', '#search-btn', function () {
        find()
    });
    $('#main-content').on('click', '#back-btn', function (e) {
        backToSearch(e);
    });
    $('#main-content ').on('click', '.show-card', function (e) {
        console.log(e)
        showDetails(e);
    });

});
var view_data = {
    tv_shows_search:null,
    selected_tv_show:null,
    tv_shows_episodes:null,


}

var unloadShows = function () {
    var tvShows = [];
    if (tvShows.length == 0) {
        $('#TVshows .columns .column').removeClass('fadeInUp').addClass('fadeOut', 200);
        $('#TVshows .columns').html('');
    }
}


var find = function () {
    var content = $('#search').val();
    console.log('searching for: ' + content)
    $('.search-container').addClass('is-loading');

    var cardContent = loadShows(content, function (error, tvShows) {
        if (error) {
            $('.search-container').removeClass('is-loading');
            unloadShows();
        } else {


            view_data.tv_shows_search = tvShows;


            var tvShowsCardContent = tvShows.map(function (show,index) {
                var card = new TVshowCard(show,index);
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

var loadDetails = function (searchParam, callback) {
    window.http.get('/episodes', {id: searchParam}, function (error, response) {
        if (response) {
            shows_main = response.data
            var episodes = response.data
            if (episodes.length > 0) {
                return callback(null, episodes);
            }
        } else {
            if (!error) {
                error = "Resource not found";
            }
            return callback(error);
        }
    });

};


var showDetails = function (event) {

    var id = $(event.currentTarget ).data('id');
    view_data.selected_tv_show = view_data.tv_shows_search[ $(event.currentTarget ).data('index')];
    loadDetails(id,function (error, response) {
        console.log(response)
        $(event.currentTarget ).removeClass('fadeIn').addClass('zoomOutUp')
            .one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
                function () {
                    $('#content-data').addClass('slideOutUp')
                    $('#search-area').addClass('fadeOut')
                    $('#content-data').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
                        function () {
                            $('#main-content').html(window.MainContent.showDetails());
                            console.log(view_data);
                        });
            });
    });
}

var backToSearch = function (e) {
    $('#show-details').removeClass('fadeIn').addClass('fadeOut');
    $('#show-details').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
        function () {
            $('#main-content').html(window.MainContent.initHome());

        });
}

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
