/**
 * Created by al on 06-29-17.
 */
EpisodeCard = function (data, show_data,index) {


    var images = show_data.show_images.series;


    this.text_truncate = function(str, length, ending) {
        if (length == null) {
            length = 100;
        }
        if (ending == null) {
            ending = '...';
        }
        if (str.length > length) {
            return str.substring(0, length - ending.length) + ending;
        } else {
            return str;
        }
    };

    var randomImage = function () {
        if(images && images.length>0){
            return images[Math.floor(Math.random()*images.length)].fileName
        }
        return "/assets/images/no-image.jpg";

    };


    this.getCard = function () {
        return `<div class="column is-4 animated fadeIn episode-card is-black" data-id="${data.id}" data-index="${index}"  id="id-${data.id}">
                <div class="hero is-black" >
                    <div class="card-image  " style='cursor:pointer; height:75px; background-image: url(${data.banner}); background-position: center; background-size: cover;
                            '>
                        
                        <div class=" is-16by9">
                        
                            <div class="banner" data-showid="${data.id}" style='cursor:pointer; height:75px; 
                            background-image: url(${randomImage()}); background-position: center; background-size: cover;
                            ' alt="Image">
                            
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="media">
                            <div class="media-content">
                                <p class="title is-6"><strong>${data.episodeName}</strong></p>
                                <p class="subtitle is-6 show-overview">${this.text_truncate(data.overview, 200,"...")}</p>
                                
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>`;
    }
}

