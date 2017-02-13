console.log('here')
console.log($('#startdate').val());
    console.log('ready')
    $('#saveEvent').click(function () {
        var startdate, endDate, title, description, event;
        startdate = $('#startdate').val();
        endDate = $('#enddate').val();
        title = $('#title').val();
        description = $('#desc').val();

        school_id = $('#school').val();
        teacher_id = $('#teacher').val();

        event = {
            'title': title,
            'description': description,
            'date': startdate,
            'enddate': endDate,
            'school_id': school_id,
            'teacher_id': teacher_id,
            'action': 'ajax_add_event'
        }
        $.post(ajax_url, event,
            function (data) {
                if(data){
                    window.location.href = '/dashboard/calendar';
                }

            });


})