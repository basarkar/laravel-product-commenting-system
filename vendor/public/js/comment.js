/**
 * Created by bappasarkar on 12/16/16.
 */
(function ($) {
    // Comment form submit.
    $(document).on('submit', '#comment-form', function (e) {
        // Disable the submit button to prevent repeated clicks
        $('#comment-submit-button').prop('disabled', true);
        e.preventDefault();
        var form_id = this.id;
        // Empty the error div.
        $('#' + form_id + ' .err-feedback').html('');

        var action = $(this).attr('action');
        var postData = new FormData(this);
        // We might submit to cross domain.
        $.ajax({
            type: 'POST',
            dataType: 'json',
            crossDomain: true,
            data: postData,
            url: action + '?format=json',
            processData: false,
            contentType: false,
            xhrFields: {
                withCredentials: true
            },
            success: function (data, status) {
                if (data.success) {
                    // Render the comment.
                    var html = '<div class="row"><div class="col-lg-12 margin-tb"><div class="pull-left" style="margin-right:10px;">' +
                        '<b>' + data.username + '</b></div><div class="pull-left">' + data.comment + '</div></div></div>';
                    $('#comment').prepend(html);
                }
                else {
                    // Show error.
                    var err_class = '#' + form_id + ' .err-feedback';
                    $(err_class).show();
                    var error_string = '';
                    $.each(data, function (key, value) {
                        error_string += value + "<br/>";
                    });
                    $(err_class).html(error_string);
                    $(err_class).attr("tabindex", -1).focus();
                }
                $('#comment-submit-button').prop('disabled', false);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Sorry, there\'s been an error connecting. Please try again later.');
                alert(errorThrown);
                $('#comment-submit-button').prop('disabled', false);
            }
        });
    });
})(jQuery);