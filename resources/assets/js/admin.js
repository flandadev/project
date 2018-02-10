import sha1 from 'js-sha1';

$(document).ready(function() {
    $('[name="name"]').keyup(function() {
        let val = $('[name="name"]').val();
        if (val != '') {
            $('[name="event_token"]').val(sha1($(this).val()))
        } else {
            $('[name="event_token"]').val('')
        }
    });

    console.log('READY');
});
