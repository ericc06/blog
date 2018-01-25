function check_not_empty() {
    var empty = false;
    $('input,textarea').filter('[required]').each(function(i, requiredField){
        if($(requiredField).val().trim() == null || $(requiredField).val().trim() == '')
        {
            empty = true;
        }
    });

    if (empty == false) {
        var intro = tinyMCE.get('intro').getContent({ format: 'text' }).trim();
        var content = tinyMCE.get('content').getContent({ format: 'text' }).trim();
        alert("*" + content + "*");
        if (intro == null || intro == "" || content == null || content == "") {
            empty = true;
        }
    }

    if (empty == true) {
        alert("Merci de renseigner tous les champs.");
        return false;
    }
    else {
        return true;
    }
}