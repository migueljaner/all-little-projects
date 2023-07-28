window.onload = function() {
    if(window.location.pathname.indexOf("/show/clients") > -1 ){
        var table= 'client';
        $('#myTable > tbody > tr > td:nth-last-child(n+3)').click(function (e) { 
            var id = $(e.currentTarget).parent().find("td[class='sorting_1']").html();
            window.location.href = "/show/establishments/"+id;
        });
        $('button.btn > i.fa-trash').click(function (e) {
            $tr = $(e.currentTarget).parents('tr');
            $tr.css('display', 'none');
            var id =  $tr.find("td[class='sorting_1']").html();
            delRow(table ,id);
        })
    }
    else if(window.location.pathname.indexOf("/show/establishments") > -1 ){
        var table= 'establishment';
        $('#myTable > tbody > tr > td:nth-last-child(n+3)').click(function (e) { 
            var id = $(e.currentTarget).parent().find("td[class='sorting_1']").html();
            window.location.href = "/show/clientele/"+id;
        });
        $('button.btn > i.fa-trash').click(function (e) {
            $tr = $(e.currentTarget).parents('tr');
            $tr.css('display', 'none');
            var id = $tr.find("td[class='sorting_1']").html();
            delRow(table,id);        
        })
    }
    function delRow(table, id) {
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/del/"+table+"/"+id,
            success: function (response) {
                console.log('Eliminado');
            },
            error: function(response){
                alert('Ha habido un error');
            }
        });
    }
}