var map;
var boundaries;
var bluemarble;
var quakes;

OpenLayers.IMAGE_RELOAD_ATTEMPTS = 5;
OpenLayers.DOTS_PER_INCH = 25.4 / 0.28;

function init() {

	var bounds = new OpenLayers.Bounds( -180, -90, 180, 90 );

	var mapOptions = { 
		maxResolution: 'auto',
		maxExtent: bounds,
/*		restrictedExtent: bounds */
	};			

        map = new OpenLayers.Map( 'map', mapOptions );

        boundaries = new OpenLayers.Layer.WorldBoundaries();
	bluemarble = new OpenLayers.Layer.BlueMarble();
        bluemarble.setVisibility( false );
     	map.addLayer( boundaries );
	map.addLayer( bluemarble );

	var style = new OpenLayers.Style({
	        pointRadius: 16,
	        externalGraphic: "http://mnps.org/googlemaps/images/blue.png"
	});

	quakes = new OpenLayers.Layer.GML( 
		"Earthquakes", 
		"http://earthquake.usgs.gov/eqcenter/catalogs/7day-M2.5.xml",
		{
			format: OpenLayers.Format.GeoRSS,
			formatOptions: {
				createFeatureFromItem: function(item) {
					var feature = OpenLayers.Format.GeoRSS.prototype.createFeatureFromItem.apply( this, arguments );
					feature.attributes.thumbnail = "quake";
					return feature;
				}
			},
			styleMap: new OpenLayers.StyleMap({
				"default": style
			})
		}
	);

//	map.addLayer( quakes );

	/**
	 * add controls
	 */
	var click = new OpenLayers.Control.Click( { 'id':'clickControl'} );
	map.addControl( click );
	click.activate();

	var centerpos = new OpenLayers.Control.CenterPosition( { 'id':'centerControl'} );
	map.addControl( centerpos );
	centerpos.activate();

	/**
	 * position map
	 */ 
	map.zoomToMaxExtent(); 
}	
