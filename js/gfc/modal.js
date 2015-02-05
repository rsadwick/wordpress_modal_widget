(function ($) {
    GFC.Modal = (function () {
        Modal.name = 'GFC.Modal';

        function Modal(config) {
            var scope = this;
            scope.content = $('.' + config.content + '_wrapper');
            scope.settings = config.settings;
            var modalTimeout;
            var self;

            scope.overlay = $('<div/>').attr('class', 'gfc-overlay');
            
            if(config.settings.background){
            	var bgColor = scope.HexToRGBA(config.settings.background, config.settings.opacity);
            	scope.overlay.css('backgroundColor', bgColor);
            }
            
            scope.modal = $('<div/>').attr('class', 'gfc-modal');
            scope.overlay.append(scope.modal);
            scope.overlay.find(scope.modal).append(scope.content);

            //events
            scope.overlay.on("click", function () {
                scope.Hide();
            });

            scope.modal.on("click", function (e) {
                e.stopPropagation();
            });

            //gravity forms events:
            $(document).on("gform_post_render", function(e, form_id, current_page){
               //fires on each step
               // console.log(form_id, current_page);
            });

            $(document).on("gform_confirmation_loaded", function(e, form_id, current_page){
                //When confirmation is loaded, the modal times out and removes the confirm message and adds back in the original form
                modalTimeout = setTimeout((function(){
                    scope.Reset(scope);
                }), 2000);
            });
            
            $(document).keyup(function(e) {
            	if(e.keyCode == 27){
            		scope.Hide();
            	}
            });

            //set the modal to this instance
            this.SetModal(scope.overlay);
        }

        Modal.prototype.Canvas = null;

        Modal.prototype.Show = function () {
            this.GetModal().show();
            this.content.toggleClass('show');
            this.content.find('.gform_ajax_spinner').hide();
        };

        Modal.prototype.Hide = function () {
            scope = this;
            if (!scope.Canvas.is(':visible')) {
                return;
            }
            scope.GetModal().hide();
        };

        Modal.prototype.GetModal = function () {
            return this.Canvas;
        };

        Modal.prototype.SetModal = function (modal) {
            this.Canvas = modal;
        };

        Modal.prototype.Reset = function(_scope){
            _scope.GetModal().hide();
            _scope.GetModal().find(_scope.overlay).html("");
            _scope.GetModal().find(_scope.modal).html("");

            _scope.overlay.append(_scope.modal);
            _scope.overlay.find(_scope.modal).append(_scope.content);
            window.clearTimeout(_scope.modalTimeout);
        };
        
        Modal.prototype.HexToRGBA = function(hex, alpha){
        	var rgbaCol = 'rgba(' + parseInt(hex.slice(-6,-4),16)
			    + ',' + parseInt(hex.slice(-4,-2),16)
			    + ',' + parseInt(hex.slice(-2),16)
			    +',' + alpha + ')';
			return rgbaCol;
        };

        return Modal;
    })();
})(jQuery);
