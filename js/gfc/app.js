(function ($) {
    GFC.App = function (canvas) {
        this.Canvas = $(canvas);
    };
    GFC.App.prototype =
    {
        Canvas: null,
        Events: null,
        GetModal: function (config) {
            this._modal = new GFC.Modal(config);
            this.Canvas.append(this._modal.Canvas);
            return this._modal;
        }
    };

    GFC.App.EVENT =
    {
        SOME_EVENT_FIRED: 'SOME_EVENT_FIRED:hello'
    };
})(jQuery);
