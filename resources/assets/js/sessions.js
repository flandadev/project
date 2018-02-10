$(document).ready(function() {
    // On first open
    setStatistics();

    // every 60 seconds.
    setInterval(setStatistics, 60000)
})

function setStatistics() {
    $.get('https://freegeoip.net/json/').done(data => {
        $.get('/api/check', data).done(res => {
            let data = JSON.parse(res);
            console.log(`New user from ${data.city}, ${data.country}`);
        }).always(function() {
            getStatistics();
        });
    })
}

function getStatistics() {
    $.get('/api/stats').done(response => {
        let data = JSON.parse(response);
        let isS =  (data.active_users > 1) ? 's' : '';
        let msg = data.active_users + ' active user' + isS;

        console.log(msg);
        $('#stats').html(msg);
    })
}
