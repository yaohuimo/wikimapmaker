<?php

class mdl_gml extends Model {

        var $db;
        var $xml;
        var $geomtype;
        var $srs;
        var $coords;

        function mdl_gml() {
                parent::Model();
                ini_set( 'max_execution_time', '1000' );
                $this->db = $this->load->database( 'default', TRUE);
        }

        function getBBox( $layerName ) {
                $this->db->select( 'ST_AsGML( 2, ST_Envelope( ST_Collect( the_geom ) ) ) as bbox', FALSE );
                $this->db->from( $layerName );
                $query = $this->db->get();
                if ( $query->num_rows() > 0 ) {
                        foreach ( $query->result() as $row ) {
                                $gmldoc = $row->bbox;
                        }
                }

                $this->parseGML( $gmldoc );

                return 'success';
        }

        function parseGML( $gml ) {

                /* Initialize variables */
                $level = 0;
                $char_data = '';

                /* Create the parser handle */
                $this->xml = xml_parser_create( 'UTF-8' );

                xml_set_object( $this->xml, $this );

                /* Set the handlers */
                xml_set_element_handler( $this->xml, '_start_handler', '_end_handler' );

                xml_set_character_data_handler( $this->xml, '_character_handler' );

                /* Start parsing the whole file in one run */
                xml_parse( $this->xml, $gml );

                print $this->geomtype . '<br/>' . $this->srs . '<br/>';

                foreach ( $this->coords as $coords ) {
                        print $coords[0] . ', ' . $coords[1] . '<br/>';
                }

        }


        /*
        * Handler for start tags
        */
        function _start_handler ( $xml, $tag, $attributes )
        {
                global $level;

                /* Flush collected data from the character handler */
                $this->_flush_data();

                if ( $level == 0 ) {
                        $tagtemp = explode( ':', $tag );
                        $this->geomtype = $tagtemp[1];
                }

                foreach ( $attributes as $key => $value ) {
                        if ( $key == 'SRSNAME' ) {
                                $this->srs = $value;
                        }
                }

                /* Increase indentation level */
                $level++;
        }

        function _end_handler ( $xml, $tag )
        {
                global $level;

                /* Flush collected data from the character handler */
                $this->_flush_data();

                /* Decrease indentation level and print end tag */
                $level--;
        }

        function _character_handler ( $xml, $data )
        {
                global $level, $char_data;

                /* Add the character data to the buffer */
                $char_data .= ' '. $data;
        }


        function _flush_data ()
        {
                global $level, $char_data;


                /* Trim data and dump it when there is data */
                $char_data = trim( $char_data );

                if ( strlen( $char_data ) > 0 ) {
                        // Wrap it nicely, so that it fits on a terminal screen
                        $data = split( "\n", wordwrap( $char_data, 76 - ( $level *2 ) ) );
                        $i = 0;
                        foreach ( $data as $line ) {
                                $this->coords[$i] = explode( ',', $line );
                                $i++;
                        }
                }

                /* Clear the data in the buffer */
                $char_data = '';
        }

}

?>
	
