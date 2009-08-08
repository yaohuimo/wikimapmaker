        <?php

	echo "<div id='findcontent'>";

	echo form_open('find/add'); 

	/** 
	 * Set map title and author
	 */
	$namedata = array( 'name' => 'sourcename',
			'value' => null,
			'maxlength' => 128,
			'size' => 64
	);
	echo '<h3 id="findopts-name">Source name</h3>';
	echo form_input( $namedata );

	$providerdata = array( 'name' => 'provider',
			'value' => null,
			'maxlength' => 128,
			'size' => 64
	);
	echo '<h3 id="findopts-provider">Provider</h3>';
	echo form_input( $providerdata );

	$provider2data = array( 'name' => 'provider2',
			'value' => null,
			'maxlength' => 128,
			'size' => 64
	);
	echo '<h2 id="findopts-provider2">Provider 2</h2>';
	echo form_input( $provider2data );

	$urldata = array( 'name' => 'providerurl',
			'value' => null,
			'maxlength' => 128,
			'size' => 64
	);
	echo '<h3 id="findopts-url">Url</h2>';
	echo form_input( $urldata );
	
	/** 
	 * Hidden parameters
	 */
	$hiddendata = array(
	                'step' => 'baselayer',
			'nextstep' => 'params',
			'baselayer' => null
        );
        echo form_hidden( $hiddendata );
	
	/**
	 * Submit button
	 */
	echo '<div class="buttonrow" style="text-align:right;">';
				
	$submitdata = array( 'name' => 'submitsource',
			'value' => 'Submit >>',
			'id' => 'submitsource',
			'class' => 'submitbutton'
	);
	echo form_submit( $submitdata );
	
	echo '</div><!-- end button row //-->'; 
	echo '</form>';
	echo '</div><!-- end findcontent //-->'; 

	/**
	 * Provider dropdown box
	 */

	echo '<div id="find-providerlist">';
	echo '<h3>Select a data provider</h3>';

	echo form_open('/find/add');
	
	$providers = array( 
		'datagov' => 'Data.gov',
		'dcgov' => 'dc.gov'
	);
	echo form_dropdown( 'providers', $providers );
	
	echo '</div>';
	echo '</form>';

	?>

	</div>
