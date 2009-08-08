<?php

class About extends Controller {

        var $headerInfo;
        var $pageInfo;

        function About()
        {
                parent::Controller();
        }

        function index()
        {

                // set header info
                $this->headerInfo = array();
                $this->headerInfo['isMap'] = true;
                $this->eaderInfo['scriptName'] = 'mapmaker';
                $this->eaderInfo['baseLayer'] = null;
                $this->headerInfo['layers'] = array();

                $this->pageInfo['content'] = <<<EOF
                        <h2>About</h2>
                        <p>Wiki MapMaker is a project to develop a user-friendly mapmaker wizard-like application for users to generate maps for inclusion in Wikipedia and other wikis.  Maps are generated dynamically using <a href="http://openlayers.org">OpenLayers</a>, together with data sources such as OpenStreetMap and NASA satellite imagery as base layers, and overlays from <a href="http://data.gov">data.gov</a> and other sources that provide data (suitably licensed or public domain).</p>

                        <p>This project builds upon the <a href="http://meta.wikimedia.org/wiki/OpenStreetMap">OpenStreetMap-Wikipedia integration project</a>, which aims to get simple locator and other dynamically generated maps into Wikipedia. The map capabilities of the initial integration will be limited to OpenStreetMap as the only layer available, plus markers, in order to keep implementation super simple at first and allow us to test the server infrastructure and <a href="http://www.mediawiki.org/wiki/Extension:SlippyMap">SlippyMap extension</a> in production use.</p>

<p>Beyond simple locator maps created from OpenStreetMap data, there is a need for other types of maps (e.g. thematic maps), or more complicated maps that build upon OpenStreetMap, with various overlays or different base layers (e.g. satellite imagery).  The Wiki Mapmaker project aims to address these needs.  Currently, Wiki Mapmaker maps generated are dynamic, required JavaScript, and are not cached.  In the future, it will also be possible to generate static maps that can be uploaded to Wikipedia and handled like any other image, and can be cached.  Some overlays are being made available for Wiki MapMaker that pull data from data.gov, such as the <a href="http://www.data.gov/details/29">recent earthquake feed</a>.</p>

                        <h2 style='font-size:160%;border: solid 1px #ccc;padding:.3em;margin:1em auto 2em auto;width:250px;text-align:center;background:#FEFEFE;'><a href="/make">Make a map</a></h2>
EOF;

                $this->load->view( 'header', $this->headerInfo );
                $this->load->view( 'body', $this->pageInfo );
                $this->load->view( 'footer' );
	}

}

