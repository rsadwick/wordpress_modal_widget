(function ($) {

    jQuery(document).ready(function () {

        //todo: come up with a trigger Events class and use ON/OFF for observing
        /* GFC.Instance().Events.On(GFC.App.EVENT.SOME_EVENT_HAPPENED,
         function () {
         //something here
         }
         );*/
    });

    //todo: check dom for form modals
    jQuery('body').on('click', ".gfc-form-modal", function (e) {
        GFC.Instance().GetModal({content: $(this).data('type')}).Show();
        return false;
    });

    //cache body element to search later
    window.GFC.Instance(new GFC.App
        (
            'body'
        ));

    //all init stuff goes in here
    jQuery(document).ready(function () {
        //GFC.Instance().GetModal({content: '<p>Test this modal!</p>'}).Show()
    });

})(jQuery);
