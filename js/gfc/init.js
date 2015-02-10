(function ($) {
	
	var modalSettings;
   
    //todo: check dom for form modals
    jQuery('body').on('click', ".gfc-form-modal", function (e) {
        GFC.Instance().GetModal({content: $(this).data('type'), settings: modalSettings });
        return false;
    });

    //cache body element to search later
    window.GFC.Instance(new GFC.App
        (
            'body'
        ));

    //all init stuff goes in here
    jQuery(document).ready(function () {
         modalSettings = jQuery('body').find('#gfc-modal').data();
         
    });

})(jQuery);
