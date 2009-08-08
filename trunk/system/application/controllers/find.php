<?php

class Find extends Controller {

	var $headerInfo;
	var $pageInfo;

	function Find() {
		parent::Controller();	
	}
	
	function index() {

                // set header info
                $this->headerInfo = array();
                $this->headerInfo['isMap'] = false;
                $this->headerInfo['scriptName'] = null;
                $this->headerInfo['baseLayer'] = null;
                $this->headerInfo['layers'] = array();

		$this->pageInfo['content'] = <<<EOF
			<h2>Data sources</h2>
			<ul>
				<li><a href="http://data.gov">Data.gov</a></li>
				<li><a href="http://octo.dc.gov">DC OCTO</a></li>
			</ul>
EOF;
	
		$this->load->view( 'header', $this->headerInfo );
		$this->load->view( 'body', $this->pageInfo );
		$this->load->view( 'footer' );
	}

	function add() {
		
		// set header info
                $this->headerInfo = array();
                $this->headerInfo['isMap'] = false;
                $this->headerInfo['scriptName'] = null;
                $this->headerInfo['baseLayer'] = null;
                $this->headerInfo['layers'] = array();

                $this->load->view( 'header', $this->headerInfo );

                $this->load->helper( array( 'form', 'url' ) );
                $this->load->library( 'validation' );

                $rules['sourcename'] = 'required';
                $rules['provider'] = 'required';
		$rules['providerurl'] = 'required';
                $this->validation->set_rules( $rules );

                if ( $this->validation->run() == FALSE )
                {
                        $this->load->view( 'body-find-add' );
                }
                else
                {
			$this->pageInfo['content'] = 'Submitted';
	                $this->load->view( 'body', $this->pageInfo );
		}

                $this->load->view( 'footer' );

	}
}

