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
        $('#content-data').removeClass('slideInDown').addClass('slideOutUp')
        $('#main-content').html(window.MainContent.shoeDeails());
        console.log(item,1);
    },

    initHome:function () {
        return `
        <section class="hero is-dark is-small animated slideInDown" id="content-data">
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
    <section class="section" >
        <div class="container main-content ">

            <div id="TVshows">
                <div class="columns is-multiline is-desktop">
                </div>

            </div>
        </div>
    </section>
        `

    },
    shoeDeails:function () {
        return `<section class="section" >
        <div class="container main-content ">

            <div id="TVshows">
                <div class="columns is-multiline is-desktop">
                </div>

            </div>
        </div>
    </section>`;
    }

}