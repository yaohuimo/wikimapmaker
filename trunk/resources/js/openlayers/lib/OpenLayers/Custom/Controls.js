OpenLayers.Control.Click = OpenLayers.Class(OpenLayers.Control, {

        defaultHandlerOptions: {
                'single': true,
                'double': false,
                'pixelTolerance': 0,
                'stopSingle': false,
                'stopDouble': false
        },

        initialize: function( options ) {

                this.handlerOptions = OpenLayers.Util.extend(
                        {}, this.defaultHandlerOptions
                );
                OpenLayers.Control.prototype.initialize.apply(
                        this, arguments
                );
                this.handler = new OpenLayers.Handler.Click(
                        this, {
                                'click': this.trigger
                        }, this.handlerOptions
                );
        },

        trigger: function(e) {
                var lonlat = map.getLonLatFromViewPortPx(e.xy);
                $('#latbox').val( lonlat.lat.toPrecision(8) );
                $('#lonbox').val( lonlat.lon.toPrecision(8) );
        }

});

OpenLayers.Control.CenterPosition = OpenLayers.Class(OpenLayers.Control, {

        /**
 *          * Property: element
 *                   * {DOMElement}
 *                            */
        element: null,

        /**
 *          * APIProperty: prefix
 *                   * {String}
 *                            */
        prefix: '',

        /**
 *          * APRProperty: separator
 *                   * {String}
 *                            */
        suffix: '',

        /**
 *          * APIProperty: numDigits
 *                   * {Integer}
 *                            */
        numDigits: 5,

        /**
 *          * APIProperty: granularity
 *                   * {Integer}
 *                            */
        granularity: 10,

        /**
 *          * Property: lastXY
 *                   * {<OpenLayers.Pixel>}
 *                            */
        lastXY: null,

        /**
 *          * APIProperty: displayProjection
 *                   * {<OpenLayers.Projection>}
 *                            */
        displayProjection: null,

        /**
 *          * APIProperty: centerXY
 *                   * {<OpenLayers.Pixel>}
 *                            */
        centerXY: null,

        /**
 *          * Constructor: OpenLayers.Control.CenterPosition
 *                   *
 *                            * Parameters:
 *                                     * options - {Object} Options for control.
 *                                              */
        initialize: function(options) {
                OpenLayers.Control.prototype.initialize.apply(this, arguments);
        },

        /**
 *          * Method: destroy
 *                   */
        destroy: function() {
                if (this.map) {
                        this.map.events.unregister('moveend', this, this.updateCenter);
                }
                OpenLayers.Control.prototype.destroy.apply(this, arguments);
        },

        /**
 *          * Method: updateCenter
 *                   */
        updateCenter: function() {
                centerpt = this.map.getCenter();
                $('#latbox').val( centerpt.lat.toPrecision(8) );
                $('#lonbox').val( centerpt.lon.toPrecision(8) );

                zoomlevel = this.map.getZoom();
                $('#zoombox').val( zoomlevel );
        },

        /**
 *          * Method: setMap
 *                   */
        setMap: function() {
                OpenLayers.Control.prototype.setMap.apply(this, arguments);
                this.map.events.register('moveend', this, this.updateCenter);
        },

        CLASS_NAME: "OpenLayers.Control.CenterPosition"
});

