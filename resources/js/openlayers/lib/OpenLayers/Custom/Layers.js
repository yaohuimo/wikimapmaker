OpenLayers.Layer.WorldBoundaries = OpenLayers.Class(OpenLayers.Layer.WMS, {
        isBaseLayer: true,
        initialize: function(name, url, options) {
                name = 'World Boundaries';
                url = 'http://labs.metacarta.com/wms/vmap0';
                options = { layers: 'basic' };
                var arguments = [name, url, options];
                OpenLayers.Layer.WMS.prototype.initialize.apply(this, arguments);
        }
});

OpenLayers.Layer.BlueMarble = OpenLayers.Class(OpenLayers.Layer.WMS, {
        isBaseLayer: true,
        initialize: function(name, url, options) {
                name = 'Blue Marble';
                url = 'http://wms.jpl.nasa.gov/wms.cgi';
                options = {
                        layers: 'BMNG',
                        format: 'image/png'
                };
                var arguments = [name, url, options];
                OpenLayers.Layer.WMS.prototype.initialize.apply(this, arguments);
        }
});

OpenLayers.Layer.Landsat = OpenLayers.Class(OpenLayers.Layer.WMS, {
        isBaseLayer: true,
        initialize: function(name, url, options) {
                 name = 'Landsat';
                 url = 'http://wms.jpl.nasa.gov/wms.cgi';
                 options = {
                        layers: 'strmplus',
                        format: 'image/png'
                 };
                 var arguments = [name, url, options];
                 OpenLayers.Layer.WMS.prototype.initialize.apply(this, arguments);
        }
});
