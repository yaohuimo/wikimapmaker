<?php

class Make extends Controller {

	var $mapOptions;
	var $headerInfo;
	var $pageInfo;
	var $mapid;

	function Make() {
		parent::Controller();
	}
	
	function index() {

                // set header info
		$this->headerInfo = array(
			'isMap' => false,
			'scriptName' => null,
			'baseLayer' => null,
			'layers' => array()
		);

		// set page info
		$this->pageInfo = array(
			'pageTitle' => 'Make a map',
			'mapCode' => null
		);

		$this->load->view( 'header', $this->headerInfo );
		$this->load->view( 'body-makemap-steps', $this->pageInfo );
		$this->load->view( 'footer' );

	}


	function baselayer() {

		$data = null;

		// set map options
		$baseLayers = array( 
			'boundaries' => 'Boundaries',
			'osm' => 'OpenStreetMap',
			'bm'  => 'Blue Marble',
		);

		$this->mapOptions = array( 
			'baselayers' => $baseLayers,
		);

		// set header info
		$this->_setMap( true );

                // set page info
		$this->pageInfo['step'] = 'baselayer';		

		if ( ! $this->session->userdata( 'baselayer' ) ) {
			$mapData = array( 'baselayer' => 'boundaries' );
			$this->session->set_userdata( $mapData );
		}

                $this->load->view( 'header', $this->headerInfo );

		$this->load->helper( array( 'form', 'url' ) );		
		$this->load->library( 'validation' );

		$rules['baselayer-opts'] = 'required';
		$rules['maptitle'] = 'required';
		$this->validation->set_rules( $rules );
				
		if ( $this->validation->run() == FALSE )
		{
	                $this->load->view( 'body-makemap-steps', $this->pageInfo );			
		}
		else
		{
			$this->load->model( 'mdl_maps' );
			$step = $this->input->post( 'step' );
			$data['title'] = $this->input->post( 'maptitle' );
			$data['baselayer'] = $this->session->userdata( 'baselayer' );
			$this->mapid = $this->mdl_maps->create_map_from_title( $data );
			echo $this->mapid;
			$this->pageInfo['step'] = 'params';
			$this->pageInfo['mapid'] = $this->mapid;
			$this->load->view( 'body-makemap-steps', $this->pageInfo );
		}

                $this->load->view( 'footer' );
	}

	function setbaselayer( $layeropt=null ) {

		switch ( $layeropt ) {
			case 'boundaries':
				$mapData = array( 'baselayer' => 'boundaries' );
				$this->session->set_userdata( $mapData );
				break;
			case 'osm':
		                $mapData = array( 'baselayer' => 'osm' );
	        	        $this->session->set_userdata( $mapData );
				break;
			case 'bluemarble':
				$mapData = array( 'baselayer' => 'bluemarble' );
				$this->session->set_userdata( $mapData );
				break;
		}
	}

	function params() {
                // set map options
                $this->mapOptions = array(
                        'baselayer' => $this->session->userdate( 'baselayer' );
                );

                // set header info
                $this->_setMap( true );

                // set page info
                $this->pageInfo['pageTitle'] = 'Make a map';
		$this->pageInfo['step'] = 'params';

                $this->load->view( 'header', $this->headerInfo );

                $this->load->helper( array( 'form', 'url' ) );
                $this->load->library( 'validation' );

                $rules['baselayer-opts'] = 'required';
                $this->validation->set_rules( $rules );

                if ( $this->validation->run() == FALSE ) {
                        $this->load->view( 'body-makemap-steps', $this->pageInfo );
                } else {
			echo 'setting params';
                        $this->load->model( 'mdl_maps' );
			$step = $this->input->post( 'step' );
			$data['lat'] = $this->input->post( 'latbox' );
			$data['lon'] = $this->input->post( 'lonbox' );
			$data['zoom'] = $this->input->post( 'zoombox' );
			$data['mapid'] = $this->input->post( 'mapid' );
			$this->mdl_maps->set_zoom( $data );
                        $this->load->view( 'body-makemap-steps', $this->pageInfo );
                }

                $this->load->view( 'footer' );
	}

	function overlays() {
                // set header info
                $this->_setMap( true );

                // set page info
                $this->pageInfo['step'] = 'overlays';

                $this->load->view( 'header', $this->headerInfo );

                $this->load->helper( array( 'form', 'url' ) );
                $this->load->library( 'validation' );

                $rules['baselayer-opts'] = 'required';
                $this->validation->set_rules( $rules );

                if ( $this->validation->run() == FALSE ) {
                        $this->load->view( 'body-makemap-steps', $this->pageInfo );
                } else {
                        echo 'setting overlays';
                        $this->load->view( 'body-makemap-steps', $this->pageInfo );
                }

                $this->load->view( 'footer' );
	}

	/**
	 * Ajax functions
	 */
        function setbaselayer( $layeropt=null ) {

                switch ( $layeropt ) {
                        case 'boundaries':
                                $mapData = array( 'baselayer' => 'boundaries' );
                                $this->session->set_userdata( $mapData );
                                break;
                        case 'osm':
                                $mapData = array( 'baselayer' => 'osm' );
                                $this->session->set_userdata( $mapData );
                                break;
                        case 'bluemarble':
                                $mapData = array( 'baselayer' => 'bluemarble' );
                                $this->session->set_userdata( $mapData );
                                break;
                }
        }

	function _setMap( $mode ) {
		if ( $mode == true ) {
			$this->headerInfo['isMap'] = true;
			$this->headerInfo['scriptName'] = 'mapmaker';
			$this->headerInfo['baselayer'] = $this->session->userdata('baselayer');
			$this->headerInfo['layers'] = $this->session->userdata('layers');
			$this->pageInfo['isMap'] = true;
			$this->pageInfo['mapCode'] = '<div id="map" class="smallmap"></div>';
			$this->pageInfo['mapOptions'] = $this->mapOptions;
		}
	}

}


