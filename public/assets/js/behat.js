$(document).ready(function(){

    $('button.raw').on('click', function(e){
        e.preventDefault();
        var button = this;
        $(button).text("Running...").attr('disabled', 'disabled');
        $('div.test-output-raw').empty().append("Results will shown here...");
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
        $('div.test-output-wrapper').empty().append("Results will shown here...");
        $.get('/example_command').success(function(data){
            var results = data;
            $('div.test-output-wrapper').empty();
            $('div.test-output-wrapper').append($(results).get(9));
            $(button).text("Run Wrapper Command Again..").attr('disabled', false);
        })
    });

    $('button.hooked').on('click', function(e){
        e.preventDefault();
        var button = this;
        $(button).text("Running...").attr('disabled', 'disabled');
        $('div.test-output-hooked').empty().append("Results will shown here...");
        $.get('/example_hooked').success(function(data){
            var results = data;
            $('div.test-output-hooked').empty();
            results = nl2br(results, true);
            $('div.test-output-hooked').append(results);
            $(button).text("Run Hooked Command Again..").attr('disabled', false);
        })
    });

    $('button.hooked').on('click', function(e){
        e.preventDefault();
        var button = this;
        $(button).text("Running...").attr('disabled', 'disabled');
        $('div.test-output-hooked').empty().append("Results will shown here...");
        $.get('/example_hooked').success(function(data){
            var results = data;
            $('div.test-output-hooked').empty();
            results = nl2br(results, true);
            $('div.test-output-hooked').append(results);
            $(button).text("Run Hooked Command Again..").attr('disabled', false);
        })
    });

    $('button.inc').on('click', function(e){
        e.preventDefault();
        var button = this;
        $(button).text("Running...").attr('disabled', 'disabled');
        $('div.test-output-inc').empty().append("Results will shown here...");

        $.ajax({
            url: '/example_inc'
        }).success(function(data){
             console.log(data);
            $('button.inc').removeAttr('disabled');
            $('button.inc').text("Run Inc again");
        }).always(function(data){
                console.log(data);
        });
        //readFile();

    });

    function readFile(){
        for(var i = 0; i < 40; i++) {
            $.ajax({
                url: '/results.html',
            }).success(function(data){
                    results = data;
                    console.log(data);
                    console.log("Ajax back from file read");
                    $('div.test-output-inc').empty();
                    results = nl2br(results, true);
                    $('div.test-output-inc').append(results);
            });
        };
    }


    function nl2br (str, is_xhtml) {
        var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
    };

});