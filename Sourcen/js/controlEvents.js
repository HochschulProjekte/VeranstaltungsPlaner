/**
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */

function editEvent(eventId) {
    $('#edit').append('<input type="hidden" name="id" value="' + eventId + '" />');
    $("#edit").submit();
}

function deleteEvent(eventId) {
    $('#delete').append('<input type="hidden" name="id" value="' + eventId + '" />');
    $("#delete").submit();
}