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
                if(data.success === true){
                    $('#helpfulPageStat').text(data.helpfullness);
                    $('.helpfulPageInfo').hide().attr('hidden', true);

                    switch(vote_action){
                        case 'vote_for':
                            $('.helpfulPageSuccess').show().attr('hidden', false);
                            break;
                        case 'vote_aganist':
                            $('.helpfulPageForm').show().attr('hidden', false);
                            break;
                    }
                }else{
                    if(data.message != ''){
                        $('.helpfulPageInfo').hide().attr('hidden', true);
                        $('.helpfulPageError').show().attr('hidden', false).text(data.message);
                    }


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
                if(data){
                    $('#helpfulPageStat').text(data);
                }

            },
            'dataType':'json'
        });
    }


    $('.helpfulPageForm').on('submit', function(){
        var form = $(this);
        $.ajax({
            type: "POST",
            url: "/",
            data: form.serialize(),
            success: function(data) {
                if(data.success === true){
                    $('.helpfulPageInfo').hide().attr('hidden', true);
                    $('.helpfulPageForm').hide().attr('hidden', true);
                    $('.helpfulPageSuccess').show().attr('hidden', false);
                }

            },
            'dataType':'json'
        });

        return false;
    });


    $(document).on('click', '.closeHelpfulPageForm', function(){
        $('.helpfulPageForm')[0].reset().hide().attr('hidden', true);
        $('.helpfulPageInfo').hide().attr('hidden', true);
        $('.helpfulPageSuccess').show().attr('hidden', false);
    })
});