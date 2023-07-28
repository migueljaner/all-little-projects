var clickperms = () => $(document).on('click','td.editar, td.crear, td.borrar', function (e) {
    $(document).off('click','td.editar, td.crear, td.borrar');
    $(e.currentTarget).toggleClass('on');
    let client_id = $(e.currentTarget).parent().find('td.id').html();
    let perm = $(e.currentTarget).attr('class').split(' ')[0];
    let user_id = $('#selectUser').val();
    changePerms(perm, user_id, client_id);
});
$(document).ready(function () {
    $('#selectUser , #selectClient').change(function (e) { 
        getUserClients();
    });
    $(document).on('change','#selectClient',function (e) {
        let client_id = $('#selectClient').val();
        if(client_id == 0){
            $('#clientTable').find('tr').show();
            $('#clientTable').show();
        }else{
            let tr = $('#clientTable').find('td.id:contains('+client_id+')').parent();
            if(tr.length > 0){
                $('#clientTable > tbody > *:not(td.id:contains('+client_id+'))').hide();
                $('#clientTable').show();
                $('#addUserPerm').remove();
                tr.show();
            }else{
                $('#clientTable').hide();
                var button = '<button class="btn btn-primary" id="addUserPerm">Add Perm</button>';
                $(button).insertAfter('#selectClient');
            }
        }
    });
    $(document).on('click','#addUserPerm', function (e) {
        let client_id = $('#selectClient').val();
        let user_id = $('#selectUser').val();
        
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "addperm/"+user_id+"/"+client_id,
            success: function (response) {
                const perm = JSON.parse(response);
                getUserClients(user_id);
                $('#addUserPerm').remove();
            },
            error: function(response){
                alert('Ha habido un error');
            }
        });
    });
    
    $(document).on('click','#clientTable button.btn-danger', function (e) {
        let tr = $(e.currentTarget).parents('tr');
        let client_id = tr.find("td[class='id']").html();
        let user_id = $('#selectUser').val();
        console.log(client_id, user_id);
        toggleModal('modalDelete');
                if ($('#modalDelete  button.btn-danger').length > 0) {
                    $('#modalDelete  button.btn-danger').click(function (e) { 
                        tr.css('display', 'none');
                        delRow(user_id,client_id); 
                        toggleModal('modalDelete');
                        $('#modalDelete  button.btn-danger').off();
                    });
                }       
    });
    clickperms();
});
function getUserClients(id = null) {
 if(id == null){
    $.ajax({
        url: "/admin/select/users",
        success: function (response) {
            clientSelector(response);
        },
        error: function(response){
            alert('Ha habido un error');
        }
    });
 }else{
     $.ajax({
        url: "/admin/select/users/"+id,
        success: function (response) {
            buildClientsTable(response);
        },
        error: function(response){
            alert('Ha habido un error');
        }
    });
 }
}
function clientSelector(clients) {
    $('#selectClientDiv').remove();
        var select = '<div id="selectClientDiv"><br><h4 class="perms text-left text-secondary">Clients per User</h4><select class="mt-3 browser-default custom-select" name="client" id="selectClient"><option value="0" selected>Show All Clients...</option>';
        clients.forEach(e => {
            select += `<option value="${e.id}">${e.id}--${e.name}</option>`;
        });
        select += '</select></div>';
        $(select).insertAfter('#selectUser');
        let user_id = $('#selectUser').val();
        getUserClients(user_id);
}
function buildClientsTable(clients){
    $('#clientTable').remove();
    if(clients.length > 0){
        var table = '<table class="mt-4" id="clientTable"><thead><tr><th>ID</th><th>Name</th><th>Crear</th><th>Editar</th><th>Borrar</th></tr></thead><tbody>';
        clients.forEach(e => {
            let crear = (e.crear==1 ? '<td class="crear on"></td>' : '<td class="crear off"></td>');
            let editar = (e.editar==1 ? '<td class="editar on"></td>' : '<td class="editar off"></td>');
            let borrar = (e.borrar==1 ? '<td class="borrar on"></td>' : '<td class="borrar off"></td>');
        table += `<tr><td class="id">${e.id}</td><td>${e.name}</td>${crear}${editar}${borrar}<td><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td></tr>`
        });
        table += '</tbody></table>';
        $(table).insertAfter('#selectClientDiv');
        $('#selectClient').val('0');

    }
}
function changePerms(perm,user_id, client_id){
    $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/client/change/"+perm+"/"+user_id+"/"+client_id,
        success: function (response) {

        },
        error: function(response){
            alert('Ha habido un error');
        },
        complete: function(response){
            clickperms();
        }
    });
}
function delRow(user_id, client_id) {
    $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "delperm/"+user_id+"/"+client_id,
        success: function (response) {
            console.log(response);
        },
        error: function(response){
            alert('Ha habido un error');
        }
    });
}