$(document).ready(function(){

    $('button.raw').on('click', function(e){
        e.preventDefault();
        var button = this;
        $(button).text("Running...").attr('disabled', 'disabled');
        $('div.test-output-raw').empty().append("Results will show here...");
        $.get('/example_raw').success(function(data){
            var results = data;
            $('div.test-output-raw').empty();
            $('div.test-output-raw').append($(results).get(9));
            $(button).text("Run Raw Test Again..").attr('disabled', false);
        })
    });


    $('button.wrapper').on('click', function(e){
        e.preventDefault();
        var button = this;
        $(button).text("Running...").attr('disabled', 'disabled');
        $('div.test-output-wrapper').empty().append("Results will show here...");
        $.get('/example_command').success(function(data){
            var results = data;
            $('div.test-output-wrapper').empty();
            $('div.test-output-wrapper').append($(results).get(9));
            $(button).text("Run Wrapper Command Again..").attr('disabled', false);
        })
    });

});