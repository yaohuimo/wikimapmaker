<?php

class Home extends Controller {

        var $headerInfo;
        var $pageInfo;

        function Home()
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

                        <h2 style='font-size:200%;border: solid 1px #ccc;padding:.3em;margin:1em auto 2em auto;width:325px;text-align:center;background:#FEFEFE;'><a href="/make">Make a map</a></h2>
EOF;

                $this->load->view( 'header', $this->headerInfo );
                $this->load->view( 'body', $this->pageInfo );
                $this->load->view( 'footer' );
	}

}

