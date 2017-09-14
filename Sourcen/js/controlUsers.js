$(function() {

    initControlUsers();
    var editMode = false;

    
    /* Base functions */

    // Init view at page load
    function initControlUsers() {

        // Display settings
        $('#new-message').css('display', 'none');
        $('#edit-message').css('display', 'none');
        updateTable();
        
        // Init element Hooks
        initEvents();
    }

    // Init events
    function initEvents() {
        $('#new-submit').click(function(){ startCreateNewUser() });
        $('.row-user').mouseenter(function() { addEditDeleteButtons($(this).attr('id')) });
        $('.row-user').mouseleave(function() { removeEditDeleteButtons($(this).attr('id')) });
    }

    // Create a new user
    function startCreateNewUser() {
        
        var ret = validateFormNew();

        // If an error occured, display error message
        if (ret.err == true) {
            $('#new-message').html(ret.msg);
            $('#new-message').css('display', 'block');
        } else {
            $('#new-message').html('');
            $('#new-message').css('display', 'none');

            // Get data from the form for new user
            var data = getDataForNewUser();

            // Create new user in database
            createNewUser(data);
        }
    }

    // Delete a user
    function deleteUser(id) {

        // Ask user to validate delete
        if (confirm('Sind Sie sicher, dass Sie "' + id + '" löschen möchten?')) {
            
            deleteUserFromDb(id);

        }

    }

    // Edit a user
    function editUser(id) {
        editMode = true;

        setRowEditMode(id);

        $('.fa-floppy-o').click(function(){
            ret = validateFormEdit();

            if (ret.err == true) {
                $('#edit-message').html(ret.msg);
                $('#edit-message').css('display', 'block');
            } else {
                $('#edit-message').html('');
                $('#edit-message').css('display', 'none');

                var data = getDataFromEditUser(id);

                saveEditUser(data); 
            }
        });
    }

    
    /* Validation functions */

    function validateFormNew() {
        var msg = '';
        var err = false;

        // Check, if name is filled
        if (checkFieldFilled('#new-name') == false) {
            msg += 'Der Name muss angegeben werden.<br>';
            err = true;
        }
        // Check, if password is filled
        if (checkFieldFilled('#new-password') == false) {
            msg += 'Passwort muss angegeben werden.<br>';
            err = true;
        }
        // Check, if password confirm is filled
        if (checkFieldFilled('#new-password-confirm') == false) {
            msg += 'Das Passwort muss bestätigt werden.<br>';
            err = true;
        }

        // Check, if password equals password confirm
        if (checkPasswordEqualsPasswordConfirm() == false) {
            msg += 'Das Passwort muss mit dem bestätigten Passwort übereinstimmen.<br>';
            err = true;
        }

        var ret = {msg:msg, err:err};

        return ret;
    }

    function validateFormEdit() {
        var msg = '';
        var err = false;

        // Check, if name is filled
        if (checkFieldFilled('#edit-name') == false) {
            msg += 'Der Name muss angegeben werden.<br>';
            err = true;
        }

        var ret = {msg:msg, err:err};

        return ret;
    }

    function checkFieldFilled(field) {
        if ($(field).val().length > 0){
            return true;
        }else{
            return false;
        }
    }
    
    function checkPasswordEqualsPasswordConfirm() {
        if ($('#new-password').val() == $('#new-password-confirm').val()){
            return true;
        }else{
            return false;
        }
    }


    /* Read-data functions */

    // Read data for new user from inputs
    function getDataForNewUser() {

        var name = '';
        var password = '';
        var personnalManager = false;
        var email = '';

        // Name
        name = $('#new-name').val();

        // Password
        password = $('#new-password').val();

        // Personnal Manager
        if ($('#new-personnal-manager').is(":checked")){
            personnalManager = true;
        }else{
            personnalManager = false;
        }

        // E-Mail
        email = $('#new-email').val();

        // Put in array
        var data = {name:name, password:password, personnalManager:personnalManager, email:email};

        // Convert to JSON
        var dataJson = JSON.stringify(data);

        return dataJson;

    }

    // Read data for edited user from inputs
    function getDataFromEditUser(id) {

        var primaryKey = id;
        var name = '';
        var personnalManager = false;
        var email = '';

        // Name
        name = $('#edit-name').val();

        // Personnal Manager
        if ($('#edit-personnal-manager').is(":checked")){
            personnalManager = true;
        }else{
            personnalManager = false;
        }

        // E-Mail
        email = $('#edit-email').val();

        // Put in array
        var data = {primaryKey:primaryKey, name:name, personnalManager:personnalManager, email:email};

        // Convert to JSON
        var dataJson = JSON.stringify(data);

        return dataJson;
    }

    
    /* Write-data functions */

    // Add user to table
    function addUserToTable(data) {
        
        var user = $.parseJSON(data);
        var html = '';

        html += ' \
            <tr id="' + user.name + '" class="row-user"> \
            <td class="btn-edit"></td> \
            <td class="btn-delete"></td> \
            <td class="lbl-name">' + user.name + '</td> \
        ';

        if (user.personnalManager == true) {
            html += '<td class="chb-personnal-manager"><center><input class="form-check-input" type="checkbox" value="yes" disabled checked></center></td>';
        } else {
            html += '<td class="chb-personnal-manager"><center><input class="form-check-input" type="checkbox" value="yes" disabled></center></td>';
        }

        html += ' \
            <td class="lbl-email">' + user.email + '</td> \
            </tr> \
        ';
        
        $('#tbody-users').append(html);
    }

    // Clear the user table
    function clearTable() {
        $('#tbody-users').html('');
    }

    // Clear user inputs after adding user
    function clearInputs() {
        $('#new-name').val('');
        $('#new-password').val('');
        $('#new-password-confirm').val('');
        $('#new-personnal-manager').prop('checked', false);
        $('#new-email').val(''); 
    }

    // Add buttons to edit or delete a user
    function addEditDeleteButtons(id) {
        if (editMode == false){
            $('#' + id).children('.btn-edit').html('<i class="fa fa-pencil"></i>');
            $('#' + id).children('.btn-delete').html('<i class="fa fa-trash"></i>');
            $('.fa-trash').click(function(){ deleteUser($(this).parent().parent().attr('id')) });
            $('.fa-pencil').click(function(){ editUser($(this).parent().parent().attr('id')) });
        }        
    }

    // Remove buttons for editing or deleting a user
    function removeEditDeleteButtons(id) {
        if (editMode == false){
            $('#' + id).children('.btn-edit').html('');
            $('#' + id).children('.btn-delete').html('');
        }
    }

    // Set user row into edit-mode
    function setRowEditMode(id) {
        // Set buttons
        $('#' + id).children('.btn-edit').html('<i class="fa fa-floppy-o"></i>');
        $('#' + id).children('.btn-delete').html('');

        // Switch labels to textboxes
        var name = $('#' + id).children('.lbl-name').html();
        var email = $('#' + id).children('.lbl-email').html();
        
        $('#' + id).children('.lbl-name').html('<input type="text" class="form-control" name="edit-name" id="edit-name" maxlength="12" value="' + name + '">');
        $('#' + id).children('.lbl-email').html('<input type="text" class="form-control" name="edit-email" id="edit-email" maxlength="45" value="' + email + '">');
    
        // Enable checkbox personnal manager
        $('#' + id).children('.chb-personnal-manager').children().children().attr('disabled', false).attr('id', 'edit-personnal-manager');
    }


    /* AJAX calls */

    // Create new user per AJAX-call
    function createNewUser(data) {
        $.ajax({
            type: 'POST',
            url: 'administration/ajaxCreateUser.php',
            data: {data : data},
            dataType: 'json',
            cache: false,

            success: function(ret){
                if (ret.err == true) {
                    alert(ret.msg);
                } else {
                    //alert('Der Nutzer wurde erfolgreich angelegt.');
                    
                    // Update Table to display new user
                    updateTable();

                    // Clear inputs
                    clearInputs();
                }
            },
            error: function(){
                alert('Beim Anlegen des Nutzers ist ein Fehler aufgetreten.');
            }
        });
    }

    // Update the user table => get all users from database
    function updateTable() {
        clearTable();

        $.ajax({
            url: 'administration/ajaxGetAllUsers.php',
            dataType: 'json',
            cache: false,

            success: function(users){

                // Iterate users
                for (i in users) {
                    
                    // Create user object
                    var user = {name:users[i].name, personnalManager:users[i].personnalManager, email:users[i].email};
                    
                    // Convert to JSON
                    var userJson = JSON.stringify(user);

                    // Add user to table
                    addUserToTable(userJson);

                    // Re-init events
                    $('.row-user').mouseenter(function() { addEditDeleteButtons($(this).attr('id')) });
                    $('.row-user').mouseleave(function() { removeEditDeleteButtons($(this).attr('id')) });
                }

            },
            error: function(){
                alert('Nutzer konnten nicht geladen werden.');
            }
        });
    }

    // Delete user from database
    function deleteUserFromDb(id) {
        $.ajax({
            type: 'POST',
            url: 'administration/ajaxDeleteUser.php',
            data: {id:id},
            dataType: 'json',
            cache: false,

            success: function(ret){
                if (ret.err == true) {
                    alert(ret.msg);
                } else {
                    //alert('Der Nutzer wurde erfolgreich gelöscht.');
                    
                    // Update Table to display new user
                    updateTable();
                }
            },
            error: function(){
                alert('Beim Löschen des Nutzers ist ein Fehler aufgetreten.');
            }
        });
    }

    // Save edits from user
    function saveEditUser(data) {
        $.ajax({
            type: 'POST',
            url: 'administration/ajaxEditUser.php',
            data: {data : data},
            dataType: 'json',
            cache: false,

            success: function(ret){
                if (ret.err == true) {
                    alert(ret.msg);
                } else {
                    //alert('Die Änderungen wurden erfolgreich gespeichert.');
                    
                    // Update Table to display new user
                    updateTable();

                    editMode = false;
                }
            },
            error: function(){
                alert('Beim Speichern des Nutzers ist ein Fehler aufgetreten.');
            }
        });
    }
});