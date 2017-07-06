/**
 * Created by al on 07-04-17.
 */

window.MainContent = {
    getEpisodes: function (id) {

        var item = window.shows_main.filter(function (item) {
            if (item.id == id) {
                return true;
            }
            return false;

        });
        $('#content-data').addClass('slideOutUp')
        $('#search-area').addClass('slideOutDown fadeOut')

        $('#content-data').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
            function () {
                $('#main-content').html(window.MainContent.showDetails());
            });

        console.log(item, 1);
    },
    main_bg:function () {

        var images = ['/assets/images/bg-0.jpg','/assets/images/bg-1.jpg','/assets/images/bg-3.jpg', ];
        return images[Math.floor(Math.random()*images.length)];

    },

    initHome: function (search_string) {
        search_string = (search_string) ? search_string : "";
        return `
        <section class="hero is-dark  is-small animated fadeInDown" id="content-data" style='cursor:pointer;  background-image: url(
${this.main_bg()}); background-position: center; background-size: cover;
                            '>
        <div class="hero-body">
            <div class="container">
                <h1 class="title is-1">
                    <strong>Welcome to tvDB</strong>
                </h1>
                <h2 class="subtitle">
                    This site uses thetvdatabase.com open database to search for tv shows.
                </h2>

                <div class="field has-addons">
                    <p class="control search-container is-expanded">
                        <input id="search" class="input" type="text" value="${search_string}" placeholder="search for tv shows">
                    </p>
                    <p class="control">
                        <button id="search-btn" class="button is-primary">
                            Search
                        </button>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="section animated" id="search-area" >
        <div class="container main-content ">

            <div id="TVshows">
                <div class="columns is-multiline is-desktop">
                </div>

            </div>
        </div>
    </section>
        `

    },
    showDetails: function (show_data) {
        console.log(show_data)
        search_string = (show_data && show_data.search_string) ? show_data.search_string : "";
        var tv_show_view = new ShowDetails(show_data);
        if(show_data.tv_shows_episodes){
            var episodes = show_data.tv_shows_episodes.map(function (show, index) {
                var card = new EpisodeCard(show, show_data, index);
                return card.getCard()
            });
        }else{
            var episodes = [];
        }
        var image = function () {
            if (show_data.show_images.fanart.length>0) {
                return show_data.show_images.fanart[0].fileName;
            }
        }


        return `

<section class="hero animated fadeIn is-dark is-small" id="show-details">

  <div class="hero-body">
   <div class="card-image-wrapper" style=' padding-top: 0; background-image: url(/assets/images/pattern.jpg); background-position: top; background-size: cover; '>
    <div class="card-image"  style='padding-top: 0; height:350px; background-image: url(${image()}); background-position: top; background-size: cover; '>
    <div class="container">
        <div class="nav-left">
           <a class=" is-small  is-outlined"  id="back-btn" style="color: #ddd">
                    <span class="icon is-small">
                      <i class="fa fa-arrow-left"></i>
                    </span>
                    <span>back to ${search_string} search</span>
                </a> 
        </div>
        </div>
    </div>
</div>
    <div class="container" id="tv-show-details">
    ${tv_show_view.render()}
    </div>
    
      <section>
    <div class="container">
      <h1 style="border-bottom: 1px dotted  #888; margin-top: 10px; padding-bottom: 20px; margin-bottom: 25px;" class="title">Episodes</h1>
    </div>
  </section>
    
    <div class="container" id="tv-show-episodes">
        <div class="columns is-multiline is-desktop">${episodes.join("")}</div> 
    </div>
  </div>
  
  
</section>`;
    }

}