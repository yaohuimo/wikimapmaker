	<div id='makemap-steps'>

		<ul>
			<li class='stepslabel'>Make a map:</li>
			<li class='stepopt'>>> <a href='/make/baselayer'>Select base layer</a></li>
			<li class='stepopt'>>> <a href='/make/params'>Set parameters</a></li>
			<li class='stepopt'>>> <a href='/make/overlays'>Select overlays</a></li>
			<li class='stepopt'>>> Generate map</li>
			<li class='stepopt'>>> Preview in wiki page</li>
			<li class='stepopt'>>> Add to wiki page</li>
		</ul>

	</div>

	<div id='makemap-content'>

        <?php

        if( isset( $step ) ) {
		switch ( $step ) {
			case 'baselayer':
	                        if ( isset( $mapOptions['baselayers'] ) ) {

					echo '<div id="mapoptions">'; 
			
					/** 
					 * Base map options
					 */				
					echo form_open('make/baselayer'); 

					/** 
					 * Set map title and author
					 */
					$titledata = array( 'name' => 'maptitle',
							'value' => null,
							'maxlength' => 128,
							'size' => 64
					);
					echo '<h3 id="mapoptions-title">Map title</h3>';
					echo form_input( $titledata );

					$authordata = array( 'name' => 'mapauthor',
							'value' => null,
							'maxlength' => 128,
							'size' => 64
					);
					echo '<h3 id="mapoptions-author">Author</h3>';
					echo form_input( $authordata );
				
					/**
					 * Select base layer
					 */
                                        echo '<h3 id="mapoptions-baselayer">Base Layers</h3>';
					echo '<ul class="radioopts">';
					foreach( $mapOptions['baselayers'] as $baseLayer ) {
						$radiodata = array( 'name' => 'baselayer-opts',
								'value' => $baseLayer,
								'checked' => false,
								'id' => str_replace( ' ', '', $baseLayer ) 
						);
						echo '<li class="radioopt">' . form_radio( $radiodata ) . ' ' . $baseLayer . '</li>';
					}
				
					echo '</ul>';
				
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
					
					$submitdata = array( 'name' => 'submitbaselayer',
								'value' => 'Next >>',
								'id' => 'submitbaselayer',
								'class' => 'submitbutton'
						);
					echo form_submit( $submitdata );
	
					echo '</div><!-- end button row //-->'; 
					echo '</form>';
					echo '</div><!-- end map options //-->'; 

					break;
	                        }
			case 'params':
				echo '<div id="mapoptions">';
				echo '<h3>Parameters</h3>';

                                echo form_open('make/params');
				
				/* 
				 * center point
				 */
				$latdata = array( 'name' => 'latbox',
						'id' => 'latbox',
						'value' => '',
						'maxlength' => 8,
						'size' => 8
				);	
				$londata = array( 'name' => 'lonbox',
						'id'  => 'lonbox',
						'value' => '',
						'maxlength' => 8,
						'size' => 8
				);

				echo '<h4>Center</h4>';			    
				echo '<table><tr><td>Latitude: ' . form_input( $latdata ) . '</td>';
				echo '<td>Longitude: ' . form_input( $londata ) . '</td></tr></table>';
		
				$zoomdata = array( 'name' => 'zoombox',
						'id' => 'zoombox',
						'value' => '',
						'maxlength' => 8,
						'size' => 8
				);

				echo '<h4>Zoom level</h4>';
				echo form_input( $zoomdata );

//				echo '<h3>Layers</h3>';
//				echo '<h4>Base layer</h4>';
//				echo '<ul><li>Blue Marble</li></ul>';

				$hiddendata = array( 
						'step' => 'overlays',
						'baselayer' => $this->session->userdata( 'baselayer' ),
						'mapid' => $mapid
				);
				echo form_hidden( $hiddendata );

                                echo '<div class="buttonrow" style="text-align:right;">';
				$backdata = array( 'name' => 'backbutton',
							'content' => 'Back',
							'id' => 'backbutton',
							'class' => 'submitbutton'
					);
                                $submitdata = array( 'name' => 'submitparams',
                                                        'value' => 'Next',
                                                        'id' => 'submitparams',
							'class' => 'submitbutton'
                                        );

				echo form_button( $backdata );
                                echo form_submit( $submitdata );
				echo '</div></form>';

				echo '</div>';
				
				break;

                        case 'overlays':
                                echo '<div id="mapoptions">';
                                echo '<h3>Overlays</h3>';

				echo '<ul>
					<li>Earthquakes</li>
					<li>Census data</li>
					</ul>';
				
				echo '</div>';
				break;
                }
	}

        ?>

	<?php 
	
	if( isset( $isMap ) ) {
		echo $mapCode;
	}

	?>

	</div>
