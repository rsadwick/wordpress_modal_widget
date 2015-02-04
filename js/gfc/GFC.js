(function ($) {

    var GFC = {};

    GFC.Instance = function (newInstance) {
        if (null != newInstance)
            GFC._instance = newInstance;
        return GFC._instance;
    };

    //common functions that are needed:

    GFC.ValidateEmail = function (email) {
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (filter.test(email))
            return true;
        else
            return false;
    };

    window.GFC = GFC;
})(jQuery);
