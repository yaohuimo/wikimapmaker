<?php

class mdl_sources extends Model {
        var $username;

        function mdl_sources() {
                parent::Model();
        }

        function get_source_list() {
                $this->db->select('name, source, source_url, description', FALSE);
                $this->db->from( 'data_sources' );
                $query = $this->db->get();
                return $query->result();
        }

}
