var contactModal = $('#contact_modal');

function populateList(res) {

    $('#contact_list').find('tbody tr:not(.contact-clone)').remove();

    $.each(res, function(key, val){
        let clone = $('.contact-clone').clone(true);
        clone.removeAttr('hidden').removeClass('contact-clone');
        clone.find('.contact-firstname').text(val.firstname);
        clone.find('.contact-lastname').text(val.lastname);
        clone.find('.view-btn').attr('data-id', val.id);
        clone.find('.edit-btn').attr('data-id', val.id);
        clone.find('.delete-btn').attr('data-id', val.id);
        $('#contact_list').append(clone);
    });
}

function getContactList(){
    $.ajax({
        url: window.location.origin + '/contacts',
        method: 'get',
        data: {},
        dataType: 'json',
        success: function(res) {
            if (res) {
                populateList(res);
            }
        },
        error: function(xhr, errno, errmsg) {
            console.log(xhr, errno, errmsg)
        }
    })
}

function addContact(){
    contactModal.find('.modal-title').html('Create contact');
    contactModal.find('.modal-body div:first').show();
    contactModal.find('.modal-footer').show();
    contactModal.find('.add-number-btn').show();
    contactModal.find('.create-btn').show();
    contactModal.find('.save-btn').hide();
    contactModal.find('input[type=text]').val('');
    contactModal.find('#contact_numbers li:not(.number-clone, .number-display)').remove();
    contactModal.modal('show');
}

function createContact() {
    let data = $('#contactForm').serialize();
    $.ajax({
        url: window.location.origin + '/contacts',
        method: 'post',
        data: data,
        dataType: 'json',
        success: function(res) {
            if (res) {
                contactModal.modal('hide');
                getContactList();
            }
        },
        error: function(xhr, errno, errmsg) {
            console.log(xhr, errno, errmsg)
        }
    })
}

function editContact(obj){
    let id = $(obj.currentTarget).attr('data-id');
    $.ajax({
        url: window.location.origin + '/contacts/' + id,
        method: 'get',
        data: {},
        dataType: 'json',
        success: function(res) {
            if (res) {
                contactModal.find('.modal-title').html('Edit contact');
                contactModal.find('.modal-body div:first').show();
                contactModal.find('.modal-footer').show();
                contactModal.find('.add-number-btn').show();
                contactModal.find('.create-btn').hide();
                contactModal.find('.save-btn').show();
                contactModal.find('#firstname').val(res.firstname);
                contactModal.find('#lastname').val(res.lastname);
                contactModal.find('#contact_id').val(res.id);
                $("#contact_numbers").find('li:not(.number-clone, .number-display)').remove();
                $.each(JSON.parse(res.numbers), function(key, num){
                    let clone = $('.number-clone').clone(true);
                    clone.removeAttr('hidden').removeClass('number-clone');
                    clone.find('input[type=text]').attr('name', 'contact[numbers][]').val(num);
                    $("#contact_numbers").append(clone);
                });
                contactModal.modal('show');
            }
        },
        error: function(xhr, errno, errmsg) {
            console.log(xhr, errno, errmsg)
        }
    });
}

function updateContact(){
    let data = $('#contactForm').serialize();
    let id = $('#contactForm').find('#contact_id').val();
    $.ajax({
        url: window.location.origin + '/contacts/' + id,
        method: 'put',
        data: data,
        dataType: 'json',
        success: function(res) {
            if (res) {
                contactModal.modal('hide');
                getContactList();
            }
        },
        error: function(xhr, errno, errmsg) {
            console.log(xhr, errno, errmsg)
        }
    })
}

function deleteContact(obj){
    let id = $(obj.currentTarget).attr('data-id');
    $.ajax({
        url: window.location.origin + '/contacts/' + id,
        method: 'delete',
        data: '_token=' + $('meta[name=csrf-token]').attr('content'),
        dataType: 'json',
        success: function(res) {
            if (res) {
                contactModal.modal('hide');
                getContactList();
            }
        },
        error: function(xhr, errno, errmsg) {
            console.log(xhr, errno, errmsg)
        }
    })
}

function populateNumberList(res) {

    $("#contact_numbers").find('li:not(.number-clone, .number-display)').remove();

    $.each(JSON.parse(res.numbers), function(key, num){
        let clone = $('.number-display').clone();
        clone.removeAttr('hidden').removeClass('number-display');
        clone.html(num);
        $("#contact_numbers").append(clone);
    });

    contactModal.find('.modal-title').html(res.firstname + ' ' + res.lastname);
    contactModal.find('.modal-body div:first').hide();
    contactModal.find('.modal-footer').hide();
    contactModal.find('.add-number-btn').hide();
    contactModal.modal('show');
}

function getNumbers(obj) {
    let id = $(obj.currentTarget).attr('data-id');
    $.ajax({
        url: window.location.origin + '/contacts/' + id,
        method: 'get',
        data: {},
        dataType: 'json',
        success: function(res) {
            if (res) {
                populateNumberList(res);
            }
        },
        error: function(xhr, errno, errmsg) {
            console.log(xhr, errno, errmsg)
        }
    })
}

function addNumber() {
    let clone = $('.number-clone').clone();
    clone.removeClass('number-clone').removeAttr('hidden');
    clone.find('input[type=text]').attr('name', 'contact[numbers][]');
    $('#contact_numbers').append(clone);
}

function deleteNumber(obj) {
    $(obj.currentTarget).parent().parent().parent().remove();
}

$(function(){
    getContactList();
    $('.add-btn').click(addContact);
    $('.view-btn').click(getNumbers);
    $('.edit-btn').click(editContact);
    $('.create-btn').click(createContact);
    $('.save-btn').click(updateContact);
    $('.delete-btn').click(deleteContact);
    $(document).on('click', '.add-number-btn', addNumber);
    $(document).on('click', '.delete-number-btn', deleteNumber);
})