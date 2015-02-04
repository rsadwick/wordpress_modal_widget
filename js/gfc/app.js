(function ($) {
    GFC.App = function (canvas) {
        //this.Events = new GFC.Events();
        this.Canvas = $(canvas);
    };
    GFC.App.prototype =
    {
        _fellowShipService: null,
        Canvas: null,
        Events: null,

        //Service API calls to fellowshipone.com
        _getFellowShipService: function () {
            if (!this._fellowShipService)
                this._fellowShipService = new GFC.Service.FellowShip();
            return this._fellowShipService;
        },

        //grab specifc param from querystring
        GetQueryStringParam: function (url, param) {
            url = decodeURIComponent(url.replace(/\+/g, " "));
            var queryString = url.substring(url.indexOf('?') + 1);
            var params = queryString.split('&');
            var paramsLength = params.length;
            for (var i = 0; i < paramsLength; i++) {
                var paramName = params[i].split('=');
                if (paramName[0] == param) {
                    return paramName[1];
                }
            }
            return "";
        },

        GetModal: function (config) {
             if (null == this._modal) {
                this._modal = new GFC.Modal(config);
                this.Canvas.append(this._modal.Canvas);
             }
            else{
                 this._modal.Show();
             }

            return this._modal;
        }
    };

    GFC.App.EVENT =
    {
        SOME_EVENT_FIRED: 'SOME_EVENT_FIRED:hello'

    };
})(jQuery);
