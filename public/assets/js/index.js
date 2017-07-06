$(document).ready(function () {

    $('#main-content').html(window.MainContent.initHome(view_data.search_string));
    // $('#main-content').html(window.MainContent.showDetails());
    $('#main-content').on('click', '#search-btn', function (e) {
      search(e);
    });

    $('#search').keypress(function(e){
        if(e.which == 13){//Enter key pressed
            $('#search-btn').trigger('click')
        }
    });


    $('#main-content').on('click', '#back-btn', function (e) {
        backToSearch(e);
    });

    $('#main-content ').on('click', '.show-card', function (e) {
        console.log( $(e.currentTarget).find('.banner').html(`<div class="loader-spin">Loading...</div>`))
        $(e.currentTarget).removeClass('fadeIn').addClass('pulse');
        showDetails(e);
    });

});

var search = function (e) {
    $(e.currentTarget).addClass('is-loading');
    view_data.search_string = $('#search').val();
    find(view_data.search_string,function () {
        $(e.currentTarget).removeClass('is-loading');
    })
}

var view_data = {
    tv_shows_search:null,
    selected_tv_show:null,
    tv_shows_episodes:null,
    search_string:null,
    show_images:{}
}

var unloadShows = function (error_string) {
    error_string = (error_string)?formated_error_string(error_string):""
    console.log(error_string)

    var tvShows = [];
    if (tvShows.length == 0) {
        if($('#TVshows .columns .column').length>0){
            $('#TVshows .columns .column').removeClass('fadeInUp').addClass('fadeOut').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
                function () {
                    error_string = (error_string)?formated_error_string(error_string):""
                    console.log(error_string)
                    $('#TVshows .columns').html(error_string);
                });
        }else{
            $('#TVshows .columns').html(error_string);
        }



    }
}

var formated_error_string = function (string) {
   return  `<div id="error_msg" class="has-text-centered"><div class=" animated shake"> <h2 class="title is-2">${string}</h2></div></div>`

}

var find = function (content,callback) {

    console.log('searching for: ' + content)
    window.history.replaceState(
        {
            "pageTitle":content
        },content,"/find/"+content);

    var cardContent = loadShows(content, function (error, tvShows) {
        if (error) {
            unloadShows(error);
            window.history.replaceState(
                {
                    "pageTitle":content
                },content,"/");
            callback();
        } else {

            view_data.tv_shows_search = tvShows;


            var tvShowsCardContent = tvShows.map(function (show,index) {
                var card = new TVshowCard(show,index);
                return card.getCard()
            });


            $('#TVshows .columns').html(tvShowsCardContent.join(""));

            $('.banner').each(function (index, value) {
                var image = value
                image.src = getBgUrl(value)
                image.onload = function () {
                    console.log(index, 'loaded')
                }
            })
            callback();
        }
    });


};

var loadShows = function (searchParam, callback) {
    window.http.get('/search', {q: searchParam}, function (error, response) {

       if((response && response.Error) || error){

           if (response) {
               return callback(response.Error);
           }else if(error) {
               return callback(error.Error);
           }
       }
        if (response) {
            var tvShows = response.data
            if (tvShows.length > 0) {
                return callback(null, tvShows);
            }
        } else {

        }
    });

};

var loadDetails = function (searchParam, callback) {
    window.http.get('/episodes', {id: searchParam}, function (error, response) {
        if (response) {
            var show = response.data
            if (show.episodes.length > 0) {
                return callback(null, show);
            }
        } else {
            if (!error) {
                error = "Resource not found";
            }
            return callback(error);
        }
    });

};

var loadSeriesDetails = function (id, callback) {
    window.http.get('/series/'+id, {}, function (error, response) {
        if (response) {
            var details = response.data
            if (details) {
                return callback(null, details);
            }
        } else {
            if (!error) {
                error = "Resource not found";
            }
            return callback(error);
        }
    });

};

var imagesCollection = function (id,callback) {
    var images = {};
    loadImages({id, type:"series"}, function (error, response) {
        if(response){
            images.series = response
        }else{
            images.series = []
        }
        loadImages({id, type:"fanart"}, function (error, response) {
            if(response){
                images.fanart = response
            }else{
                images.fanart = []
            }
            callback(images);
        });
    });




}

var loadImages = function (searchParam, callback) {
    window.http.get('/images', searchParam, function (error, response) {
        if (response) {
            var images = response.data
            if (images.length > 0) {
                return callback(null, images);
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


    console.log(event,4)
    var id = $(event.currentTarget ).data('id');
    view_data.selected_tv_show = view_data.tv_shows_search[ $(event.currentTarget ).data('index')];
    loadDetails(id,function (error, response) {
        console.log(response,1)


        if(error ||response.Error ){
            console.log(response,2)

            view_data.tv_shows_episodes = []
        }else{
            view_data.selected_tv_show = response
            view_data.tv_shows_episodes = response.episodes
            window.history.pushState(
                {
                    "pageTitle":view_data.selected_tv_show.seriesName
                },null,
                "/series/"+slug(view_data.selected_tv_show.seriesName));

        }

        imagesCollection(id, function (images) {
            view_data.show_images = images;

            $(event.currentTarget ).removeClass('fadeIn').addClass('zoomOutUp')
                .one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
                    function () {
                        $('#content-data').addClass('slideOutUp')
                        $('#search-area').addClass('fadeOut')
                        $('#content-data').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
                            function () {
                                $('#main-content').html(window.MainContent.showDetails(view_data));


                            });
                    });


        })







    });
}

var backToSearch = function (e) {
    $('#show-details').removeClass('fadeIn').addClass('fadeOut');
    $('#show-details').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
        function () {
            $('#main-content').html(window.MainContent.initHome(view_data.search_string));
            find(view_data.search_string,function () {
                
            });
            window.history.replaceState(
                {
                    "pageTitle":view_data.selected_tv_show.seriesName
                },view_data.selected_tv_show.seriesName,"/");

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

var slug = function(str) {
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();

    // remove accents, swap ñ for n, etc
    var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
    var to   = "aaaaaeeeeeiiiiooooouuuunc------";
    for (var i=0, l=from.length ; i<l ; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes

    return str;
};
