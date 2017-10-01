function previousWeek(currentYear, currentWeek) {

    if(currentWeek == 1) {
        submitWeek(currentYear - 1, 52);
        return;
    }
    submitWeek(currentYear, currentWeek-1);
}

function nextWeek(currentYear, currentWeek) {
    if(currentWeek == 52) {
        submitWeek(currentYear + 1, 1);
        return;
    }
    submitWeek(currentYear, currentWeek+1);
}

function submitWeek(year, week) {
    $('#projectWeek').append('<input type="hidden" name="year" value="'+ year +'" />');
    $('#projectWeek').append('<input type="hidden" name="week" value="'+ week +'" />');
    $("#projectWeek").submit(); 
}

function deleteEvent(id, year, week, position) {
    $('#delete').append('<input type="hidden" name="eventId" value="'+ id +'" />');
    $('#delete').append('<input type="hidden" name="year" value="'+ year +'" />');
    $('#delete').append('<input type="hidden" name="week" value="'+ week +'" />');
    $('#delete').append('<input type="hidden" name="position" value="'+ position +'" />');
    $('#delete').append('<input type="hidden" name="delete" value="X" />');
    $("#delete").submit(); 
}