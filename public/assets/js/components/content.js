/**
 * Created by al on 07-04-17.
 */

window.MainContent = {
    getEpisodes:function (id) {

        var item = window.shows_main.filter(function (item) {
            if(item.id == id){
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

        console.log(item,1);
    },

    initHome:function () {
        return `
        <section class="hero is-dark is-small animated fadeInDown" id="content-data">
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
                        <input id="search" class="input" type="text" placeholder="search for tv shows">
                    </p>
                    <p class="control">
                        <button id="search-btn" class="button is-info">
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
    showDetails:function () {
        console.log(this);
        return `

<section class="hero animated fadeIn is-dark is-large" id="show-details">

<div class="hero-head" id="show-details">
    <header class="nav">
      <div class="container">
        <div class="nav-left">
           <a class="button is-small" id="back-btn">
                    <span class="icon is-small">
                      <i class="fa fa-arrow-left"></i>
                    </span>
                    <span>back to search</span>
                </a> 
        </div>
       
        </div>
    </header>
  </div>

  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Large title
      </h1>
      <h2 class="subtitle">
        Large subtitle
      </h2>
      <p>When all the passengers on a plane die, FBI agent Olivia Dunham investigates the events and her partner almost dies. A desperate Olivia looks for help from Dr. Walter Bishop who has been institutionalized. Olivia, Dr. Bishop and his son Peter begin to discover what really happened on Flight 627 and begin to uncover a larger truth.</p>
    </div>
  </div>
</section>`

            ;
    }

}