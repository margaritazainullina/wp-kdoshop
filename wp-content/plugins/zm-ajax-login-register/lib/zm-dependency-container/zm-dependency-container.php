<?php

if ( ! class_exists( 'ZM_Dependency_Container' ) ){
    Class ZM_Dependency_Container {

        private $_instances = array();
        private $_params = array();

        public function __construct($params){
            $this->_params = $params;
        }


        public function get_instance( $key=null, $value=null, $params=null ){
            if ( empty( $this->_instances[ $key ] )
                || ! is_a( $this->_instances[ $key ], $value ) ){
                $this->_instances[ $key ] = new $value( $params );
            }
            return $this->_instances[ $key ];
        }
    }
}