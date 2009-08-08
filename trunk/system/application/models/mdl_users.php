<?php

class mdl_users extends Model {
        var $username;

        function mdl_users() {
                parent::Model();
        }

        function get_user_list() {
                $this->db->select('username', FALSE);
                $this->db->from( 'users' );
                $query = $this->db->get();
                return $query->result();
        }
 
        function create_user( $data ) {
                $this->load->library( 'encrypt' );
                $data['passwd'] = $this->encrypt->encode( $data['passwd'] );
                $geosql = "ST_GeomFromText( 'POINT( " . $data['geocode']['long'] . " " . $data['geocode']['lat'] . " )', 4326 )";
                $this->db->set( "geom", $geosql, false );
                $this->db->set( "username", $data['username'] );
                $this->db->set( "passwd", $data['passwd'] );
                $this->db->set( "email", $data['email'] );
                $this->db->set( "firstname", $data['firstname'] );
                $this->db->set( "lastname", $data['lastname'] );
                $this->db->set( "address", $data['address'] );
                $this->db->set( "city", $data['city'] );
                $this->db->set( "state", $data['state'] );
                $this->db->set( "zipcode", $data['zipcode'] );
                $this->db->insert( 'users' );
         }

         function login( $data ) {
                $this->load->library( 'encrypt' );
                $this->db->select( 'username, passwd, zipcode' );
                $this->db->from( 'users' );
                $this->db->where( 'username', $data['username'] );
                $query = $this->db->get();
                if ( $query->num_rows() == 1 ) {
                        foreach ( $query->result() as $row ) {
                                if ( $data['password'] == $this->encrypt->decode( $row->passwd ) ) {
                                        return true;
                                } else {
                                        return false;
                                }
                        }
                } else {
                        return false;
                }
         }

         function is_admin( $username ) {
                $this->db->distinct();
                $this->db->select( 'users.username, users.id, user_groups.groupname, user_groups.id, user_groups_join.userid, user_groups_join.groupid' );
                $this->db->from( 'users, user_groups, user_groups_join' );
                $this->db->where( 'users.username', $username );
                $this->db->where( 'user_groups.id', 2 );
                $this->db->where( 'user_groups_join.groupid', 2 );
                $query = $this->db->get();
                if ( $query->num_rows() == 1 ) {
                        return true;
                } else {
                        return false;
                }
        }

        function view ( $user = null ) {
                if ( isset( $user ) ) {
                        $this->db->select ( 'username, firstname, lastname, email, address, city, state, zipcode' );
                        $this->db->from ( 'users' );
                        $this->db->where ( 'username', $user );
                        $query = $this->db->get();
                        if ( $query->num_rows() == 1 ) {
                                $i = 0;
                                foreach ( $query->result() as $row ) {
                                        $userinfo['username'] = $row->username;
                                        $userinfo['email'] = $row->email;
                                        $userinfo['firstname'] = $row->firstname;
                                        $userinfo['lastname'] = $row->lastname;
                                        $userinfo['address'] = $row->address;
                                        $userinfo['city'] = $row->city;
                                        $userinfo['state'] = $row->state;
                                        $userinfo['zipcode'] = $row->zipcode;
                                        $i++;
                                }
                                return $userinfo;
                        }
                }

                return 'Error';
        }

        function update ( $user = null, $userinfo = null ) {

                $location = array();

                if ( isset( $user ) && isset( $userinfo ) ) {
                        $userinfo['passwd'] = $this->encrypt->encode( $userinfo['passwd'] );
                        $geosql = "ST_GeomFromText( 'POINT( " . $userinfo['geocode']['long'] . " " . $userinfo['geocode']['lat'] . " )', 4326 )";
                        $location['geom'] = $geosql;
                        unset( $userinfo['geocode'] );

                        $this->db->update ( 'users', $userinfo );
                        $this->db->where ( 'username', $userinfo['username'] );

                        $this->db->set ( 'geom', $location['geom'], false );
                        $this->db->where ( 'username', $userinfo['username'] );
                        $this->db->update ( 'users' );
                }
        }

}
