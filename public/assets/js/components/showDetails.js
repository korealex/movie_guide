/**
 * Created by al on 07-06-17.
 */
ShowDetails = function (show_data,index) {
    var data = show_data.selected_tv_show;


    this.render = function () {
        return `

                  
                  <h1 class="title">
                  <strong>${data.seriesName}</strong>
                  </h1>
                  <h2 class="subtitle">
                    ${data.network} - ${data.firstAired}  
                  </h2>
                  <p class="">Air time: ${data.airsDayOfWeek + " " + data.airsTime }</p>
                   <p style=" margin-bottom: 10px;" class="">Rating: ${data.rating}</p>
                  <p> ${data.overview}</p>
                  <a target="_blank" style="margin-top: 10px; margin-bottom: 10px;" href="http://www.imdb.com/title/${data.imdbId}" class="button is-outlined">View more information</a>
`;
    }

}

