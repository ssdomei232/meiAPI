$(document).ready(function(){
    $.getJSON('file.php', function(data){
        var items = [];
        $.each(data, function(key, val){
            items.push("<tr><td>" + val.name + "</td><td>" + val.size + " bytes</td><td>" + val.modified_time + "</td></tr>");
        });
        $('table').append(items.join(''));
    });
});