<?php

    use SilverStripe\ORM\DataObject;
    use SilverStripe\Forms\TextField;
    use SilverStripe\Forms\TextareaField;

    class ClubObject extends DataObject {
        private static $table_name = "club_objects";
        private static $singular_name = 'Club';
        private static $plural_name = 'Clubs';

        private static $db = [
            'Title'     => 'Text',
            'Address'   => 'Text',
        ];

        private static $has_one = [];

        private static $has_many = [
            'Races'     => RaceObject::class
        ];

        private static $many_many = [];

        public function getCMSFields() {
            $fields = parent::getCMSFields();

            $fields->addFieldsToTab('Root.Main', [
                TextField::create('Title', 'Title'),
                TextareaField::create('Address', 'Address')
            ]);

            return $fields;
        }
    }
