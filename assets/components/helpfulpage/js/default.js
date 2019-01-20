$(document).ready(function(){
    $(document).on('click', '.helpfulPage a', function(e){
        e.preventDefault();

        var resource_id = $(this).closest('.helpfulPage').data('page');
        var vote_action = $(this).data('action');

        $.ajax({
            type: "POST",
            url: "/",
            data: {action:'helpfulPageVote',vote_action:vote_action,resource_id:resource_id},
            success: function(data) {
                if(data.success){
                    $('#helpfulPageStat').text(data.helpfullness);
                }

            },
            'dataType':'json'
        });
    });

    if($('#helpfulPageStat').length){
        var resource_id = $('#helpfulPageStat').closest('.helpfulPage').data('page');
        $.ajax({
            type: "POST",
            url: "/",
            data: {action:'helpfulPageStat',resource_id:resource_id},
            success: function(data) {
                if(data.success){
                    $('#helpfulPageStat').text(data.helpfullness);
                }

            },
            'dataType':'json'
        });
    }
});