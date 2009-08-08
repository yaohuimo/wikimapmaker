<?php

class mdl_maps extends Model {
        var $username;

        function mdl_maps() {
                parent::Model();
        }

        function get_map_list() {
                $this->db->select('title', FALSE);
                $this->db->from( 'maps' );
                $query = $this->db->get();
                return $query->result();
        }

        function create_map_from_title( $data ) {

		$mapid = null;

                $this->db->set( 'title', $data['title'] );
		$this->db->set( 'baselayer', $data['baselayer'] );
                $this->db->insert( 'maps' );

		$this->db->select('id, title', FALSE);
		$this->db->from( 'maps' );
		$query = $this->db->get();

		if ( $query->num_rows() > 1 ) {
			foreach ( $query->result() as $row ) {
				if ( $row->title == $data['title'] ) {
					$mapid = $row->id;
				}
			}
		} else {
			$mapid = 'none';
		}
	
		return $mapid;
         }

	function set_baselayer( $data ) {
		if ( isset ( $data['mapid'] ) ) {
			$this->db->set( 'baselayer', $data['baselayer'] );
			$this->db->update( 'maps' );
			$this->db->where( 'id', $data['mapid'] );
		}
	}
		
	function set_zoom( $data ) {
		if ( isset ( $data['zoom'] ) ) {
			$this->db->set( 'zoom', $data['zoom'] );
			$this->db->update( 'maps' );
			$this->db->where( 'id', $data['mapid'] );
		}
	}

}
