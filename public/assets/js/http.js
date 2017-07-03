/**
 * Created by al on 07-02-17.
 */
window.http = {
    get:function (url, params,callback) {
        console.log(url)
        var req = $.ajax({
            dataType: "json",
            url: url,
            data: params,
            success: function (data, textStatus, xhr) {
                if(!data || data.Error ){
                    return callback(data)
                }
                return callback(null, data)
            },
            error:function (xhr, status, error) {
                return callback(error)
            }
        });
    }
}