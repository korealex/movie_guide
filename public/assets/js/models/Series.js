window.Series = {
    getById:function (id, callback) {
        $.ajax({
            method: "GET",
            crossDomain: true,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', "Bearer " + "eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE0OTg3MDUxMDksImlkIjoibW92aWVzcG90Iiwib3JpZ19pYXQiOjE0OTg2MTg3MDksInVzZXJpZCI6NDgyNjcyLCJ1c2VybmFtZSI6ImtvcmVhbGV4In0.eNMbSQAtIzJ14nsXmX9bV2f6BZ4Z1Sg4R8WbgrGA4A9nH0_-YK6BlmHlD2mAnWqF4pMtsuCxHGLuS3kot6fwqgP4mmMVoDa6bLDLSN-kshgohwnGS6lAxM6O_vGS_OrmUWJzetu3DDjwE7tTdOIJR7M2KJbQK0L8gSU3YKkwD4SBZhD1vVu5JTfyhoZacX06pDjjOmsrOg7LD1hekVhz92zZnIQLkk2TkwYoyC7akfM86uGR4RXZ2d8XdwBzpfFuW7D2czJg9GDLR4Wctd9QGP1ExS9VVv8eH2Wyxdv50BeT26Gb6vxKBzK6R7RPilhtvFfSHAln6mbDLLntDmQRwg");
            },

            url: "https://api.thetvdb.com/series/"+id,

        }).done(function( data ) {
            console.log( "Data Saved: " + data );
            callback(null,data)
        })
        
    }
}