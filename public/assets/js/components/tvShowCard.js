/**
 * Created by al on 06-29-17.
 */
TVshowCard = function (data) {
    this.id = data.id;
    this.seriesName = data.seriesName;
    this.banner = data.banner;
    this.overview = data.overview;
    this.network = data.network;
    this.firstAired = data.firstAired;
    this.getCard = function () {
        return `<div class="column is-4 animated fadeIn show-card " id="id-${this.id}"  onclick="MainContent.getEpisodes(${this.id})">
                <div class="card" >
                    <div class="card-image">
                        <div class=" is-16by9">
                            <div class="banner" data-showid="${this.id}" style='cursor:pointer; height:75px; background-image: url(${this.banner}); background-position: center; background-size: cover;
                            ' alt="Image"></div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="media">
                            <div class="media-content">
                                <p class="title is-6"><strong>${this.seriesName}</strong></p>
                                <p class="subtitle is-6">${this.network}</p>
                                
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>`;
    }
}

