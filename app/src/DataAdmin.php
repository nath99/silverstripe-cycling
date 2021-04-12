<?php

    use SilverStripe\Admin\ModelAdmin;

    class DataAdmin extends ModelAdmin {
        private static $managed_models = [
            ClubObject::class,
            RaceObject::class,
            RiderObject::class
        ];

        private static $url_segment = 'site-data';

        private static $menu_title = 'Site Data';
    }
