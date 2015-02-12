(function ($) {

    var GFC = {};

    GFC.Instance = function (newInstance) {
        if (null != newInstance)
            GFC._instance = newInstance;
        return GFC._instance;
    };

    //Add common functions if needed to framework - GFC.SomethingUsful

    window.GFC = GFC;
})(jQuery);
