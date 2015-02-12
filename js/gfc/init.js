(function ($) {
	
	var modalSettings;
   
    //assigns a click event to all modals on the page:
    jQuery('body').on('click', ".gfc-form-modal", function (e) {
        GFC.Instance().GetModal({content: $(this).data('type'), settings: modalSettings });
        return false;
    });

    //cache body element to search later
    window.GFC.Instance(new GFC.App
        (
            'body'
        ));

    //loads the settings that the widget outputs to the frontend
    jQuery(document).ready(function () {
         modalSettings = jQuery('body').find('#gfc-modal').data();  
    });

})(jQuery);
