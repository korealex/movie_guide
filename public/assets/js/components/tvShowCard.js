/**
 * Created by al on 06-29-17.
 */
TVshowCard = function (data) {
    this.seriesName = data.seriesName;
    this.banner = data.banner;
    this.overview = data.overview;
    this.network = data.network;
    this.firstAired = data.firstAired;
    this.getCard = function () {
        return `<div class="column is-3 animated fadeInUp">
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-16by9">
                            <img src="${this.banner}" alt="Image">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media">
                            <div class="media-content">
                                <p class="title is-4">${this.seriesName}</p>
                                <p class="subtitle is-6">${this.network}</p>
                            </div>
                        </div>
                        <div class="content">${this.overview}
                            <br>
                            <small>${this.firstAired}</small>
                        </div>
                    </div>
                </div>
            </div>`;
    }
}

