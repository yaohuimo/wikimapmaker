<?php

class Home extends Controller {

	function Home()
	{
		parent::Controller();	
	}
	
	function index()
	{

                // set header info
                $mHeaderInfo = array();
                $mHeaderInfo['isMap'] = true;
                $mHeaderInfo['scriptName'] = 'mapmaker';
                $mHeaderInfo['baseLayer'] = null;
                $mHeaderInfo['layers'] = array();

		$this->load->view( 'header', $mHeaderInfo );
		$this->load->view( 'body' );
		$this->load->view( 'footer' );
	}
}

