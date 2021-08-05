let search_cards = $('#search_cards');

search_cards.keyup(function(){
    if(search_cards.val().length >= 4){
        console.log(search_cards.val());
        $.ajax({url: "http://127.0.0.1:8000/cards/fetch?card_name=" + search_cards.val() + "&lang=de", success: function(result){
            result.forEach(element => {
                console.log(element.name);
            });
        }});
    }
});