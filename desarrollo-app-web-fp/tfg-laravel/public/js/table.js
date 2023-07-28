window.onload = function load() {
    if(window.location.pathname.indexOf("/show/clients") > -1 || window.location.pathname.indexOf("/show/del/Clients") > -1 ){
        registerClickdataTableClients();
        $('.dataTables_paginate .paginate_button').click(function(){
            registerClickdataTableClients();
        });
    }
    else if(window.location.pathname.indexOf("/show/establishments") > -1 || window.location.pathname.indexOf("/show/del/Establishments") > -1){
        registerClickdataTableEstablishments();
        $('.dataTables_paginate .paginate_button').click(function(){
            registerClickdataTableEstablishments();
        });
    }
    else if(window.location.pathname.indexOf("/show/categorytypes") > -1){
        registerClickdataTableCat();
        $('.dataTables_paginate .paginate_button').click(function(){
            registerClickdataTableCat();
        });
    }
    else if(window.location.pathname.indexOf("/show/qualitytypes") > -1){
        registerClickdataTableQual();
        $('.dataTables_paginate .paginate_button').click(function(){
            registerClickdataTableQual();
        });
    }
}
function registerClickdataTableClients() {
        if(window.location.pathname.indexOf("del") > -1 ){
            $('#myTable > tbody > tr > td:nth-last-child(n+3):not(:first-of-type)').click(function (e) { 
                let id = $(e.currentTarget).parent().find("td[class='sorting_1']").html();
                window.location.href = "/show/del/Establishments/"+id;
            });
        }else{
            $('#myTable > tbody > tr > td:nth-last-child(n+3):not(:first-of-type)').click(function (e) { 
                let id = $(e.currentTarget).parent().find("td[class='sorting_1']").html();
                window.location.href = "/show/establishments/"+id;
            });
        }
        $(document).on('click','#myTable button.btn-danger', function (e) {
            let tr = $(e.currentTarget).parents('tr');
            let id =  tr.find("td[class='sorting_1']").html();
            toggleModal('modalDelete');
                if ($('#modalDelete  button.btn-danger').length > 0) {
                    $('#modalDelete  button.btn-danger').click(function (e) { 
                        tr.css('display', 'none');
                        delRow('client' ,id);
                        toggleModal('modalDelete');
                        $('#modalDelete  button.btn-danger').off();
                    });  
                }
        });
        $(document).on('click','#myTable button.btn-info', function (e) {
            let tr = $(e.currentTarget).parents('tr');
            let id =  tr.find("td[class='sorting_1']").html();
            let tds = tr.children();
            let name = tds.eq(1).html();
            $('div[id="modalEdit"]').find('input[name="name"]').val(name);
            $('div[id="modalEdit"]').find('input[name="id"]').val(id);
            toggleModal('modalEdit');
        });
        $(document).on('click','#myTable button.btn-success', function (e) {
            let tr = $(e.currentTarget).parents('tr');
            let id =  tr.find("td[class='sorting_1']").html();
            toggleModal('modalRecover');
            if ($('#modalRecover  button.btn-success').length > 0) {
                $('#modalRecover  button.btn-success').click(function (e) { 
                    tr.css('display', 'none');
                    recoverRow('client',id); 
                    toggleModal('modalRecover');
                    $('#modalDelete  button.btn-success').off();
                }); 
            }       
        });
}
function registerClickdataTableEstablishments() {
    $('#myTable > tbody > tr > td:nth-last-child(n+3):not(:first-of-type)').click(function (e) { 
        console.log(e.currentTarget);
        let id = $(e.currentTarget).parent().find("td[class='sorting_1']").html();
        window.location.href = "/show/clientele/"+id;
    });
    $(document).on('click','#myTable button.btn-danger', function (e) {
        let tr = $(e.currentTarget).parents('tr');
        let id = tr.find("td[class='sorting_1']").html();
        toggleModal('modalDelete');
                if ($('#modalDelete  button.btn-danger').length > 0) {
                    $('#modalDelete  button.btn-danger').click(function (e) { 
                        tr.css('display', 'none');
                        delRow('establishment',id); 
                        toggleModal('modalDelete');
                        $('#modalDelete  button.btn-danger').off();
                    }); 
                }       
    });
    $(document).on('click','#myTable button.btn-info', function (e) {
        let tr = $(e.currentTarget).parents('tr');
        let id =  tr.find("td[class='sorting_1']").html();
        let tds = tr.children();
        //let guid = tds.eq(1).html();
        let name = tds.eq(2).html();
        let category = tds.eq(4).html();
        
        if (category == 'Hotel'){
            category = 1;
        }else if(category == 'Restaurant'){
            category = 2;
        }else if(category == 'Beach Club'){
            category = 3;
        }
        else{
            category = 0;
        }
        console.log(category);
        $('div[id="modalEdit"]').find('input[name="name"]').val(name);
        $('div[id="modalEdit"]').find('select[name="categori_type"]').val(category);
        $('div[id="modalEdit"]').find('input[name="id"]').val(id);
        toggleModal('modalEdit');
    });
    $(document).on('click','#myTable button.btn-success', function (e) {
        let tr = $(e.currentTarget).parents('tr');
        let id =  tr.find("td[class='sorting_1']").html();
        toggleModal('modalRecover');
        if ($('#modalRecover  button.btn-success').length > 0) {
            $('#modalRecover  button.btn-success').click(function (e) { 
                tr.css('display', 'none');
                recoverRow('establishment',id); 
                toggleModal('modalRecover');
                $('#modalDelete  button.btn-success').off();
            }); 
        }       
    });
}
function registerClickdataTableCat(){
    $(document).on('click','#myTable button.btn-danger', function (e) {
        let tr = $(e.currentTarget).parents('tr');
        let id = tr.find("td[class='sorting_1']").html();
        let changefor = $('#modalDelete select[name="changefor"]');
        changefor.find('option[value="'+id+'"]').remove();
        toggleModal('modalDelete');
                if ($('#modalDelete  button.btn-danger').length > 0) {
                    $('#modalDelete  button.btn-danger').click(function (e) { 
                        tr.css('display', 'none');
                        delRow('category_types',id, changefor.val()); 
                        toggleModal('modalDelete');
                        $('#modalDelete  button.btn-danger').off();
                    }); 
                }       
    });
    $(document).on('click','#myTable button.btn-info', function (e) {
        let tr = $(e.currentTarget).parents('tr');
        let id =  tr.find("td[class='sorting_1']").html();
        let tds = tr.children();
        let name = tds.eq(1).html();
        $('div[id="modalEdit"]').find('input[name="name"]').val(name);
        $('div[id="modalEdit"]').find('input[name="id"]').val(id);
        toggleModal('modalEdit');
    });
}
function registerClickdataTableQual(){
    $(document).on('click','#myTable button.btn-danger', function (e) {
        let tr = $(e.currentTarget).parents('tr');
        let id = tr.find("td[class='sorting_1']").html();
        let changefor = $('#modalDelete select[name="changefor"]');
        changefor.find('option[value="'+id+'"]').remove();
        toggleModal('modalDelete');
                if ($('#modalDelete  button.btn-danger').length > 0) {
                    $('#modalDelete  button.btn-danger').click(function (e) { 
                        tr.css('display', 'none');
                        delRow('quality_types',id, changefor.val()); 
                        toggleModal('modalDelete');
                        $('#modalDelete  button.btn-danger').off();
                    }); 
                }       
    });
    $(document).on('click','#myTable button.btn-info', function (e) {
        let tr = $(e.currentTarget).parents('tr');
        let id =  tr.find("td[class='sorting_1']").html();
        let tds = tr.children();
        let name = tds.eq(1).html();
        $('div[id="modalEdit"]').find('input[name="name"]').val(name);
        $('div[id="modalEdit"]').find('input[name="id"]').val(id);
        toggleModal('modalEdit');
    });
}
function delRow(table, id, changefor) {
    if(changefor){
        var ajxurl = "/del/"+table+"/"+id+"/"+changefor;
    }else{
        var ajxurl = "/del/"+table+"/"+id;
    }
    $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: ajxurl,
        success: function (response) {
            location.reload();
        },
        error: function(response){
            alert('Ha habido un error');
        }
    });
}
function recoverRow(table, id){
    $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/recover/"+table+"/"+id,
        success: function (response) {
            location.reload();
        },
        error: function(response){
            alert('Ha habido un error');
        }
    });
}