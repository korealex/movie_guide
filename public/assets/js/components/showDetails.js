/**
 * Created by al on 07-06-17.
 */
ShowDetails = function (data,index) {

    this.getCard = function () {
        return `<div class="column is-4 animated fadeIn show-card " data-id="${data.id}" data-index="${index}"  id="id-${data.id}">
                <div class="card" >
                    <div class="card-image">
                        <div class=" is-16by9">
                            <div class="banner" data-showid="${data.id}" style='cursor:pointer; height:75px; background-image: url(${data.banner}); background-position: center; background-size: cover;
                            ' alt="Image"></div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="media">
                            <div class="media-content">
                                <p class="title is-6"><strong>${data.seriesName}</strong></p>
                                <p class="subtitle is-6">${data.network}</p>
                                
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>`;
    }
}

