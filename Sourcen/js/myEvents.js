
$('[data-toggle="tooltip"]').tooltip({
    container: 'body'
});

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
