
var MitrmShortLinksWidget = function () {
    var item = this;
    this.containerResult = $('.js_short_link_content');
    this.form = $('.js_short_link_form');
    this.formSubmit = $('.js_short_link_form_submit');

    this.form.submit(function(e) {
        item.formSubmit.prop('disabled', false);
        $.ajax({
            url: item.form.attr('action'),
            type: 'post',
            data: item.form.serialize(),
            dataType: 'json',
            success: function (data) {
                if(data.status === true) {
                    item.containerResult.show();
                    item.containerResult.find('.js_short_link_result').val(data.short_link);
                } else {
                    item.containerResult.show();
                    item.containerResult.find('.js_short_link_result').val(data.error);
                }
                console.log(data);
                item.formSubmit.prop('disabled', false);
                return false;
            }
        });
        return false;

    });

};


$(document).ready(function () {
    window.mitrmShortLinks = new MitrmShortLinksWidget();
});

