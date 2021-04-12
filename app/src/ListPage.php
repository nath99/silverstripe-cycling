<?php

    class ListPage extends Page {
        private static $table_name = "list_pages";

        private static $db = [];

        private static $has_many = [];

        public function getCMSFields() {
            $fields = parent::getCMSFields();

            return $fields;
        }
    }
