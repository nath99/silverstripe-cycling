<?php

    use SilverStripe\ORM\DataObject;
    use SilverStripe\Forms\TextField;
    use SilverStripe\Forms\TextareaField;

    class RiderObject extends DataObject {
        private static $table_name = "rider_objects";
        private static $singular_name = 'Rider';
        private static $plural_name = 'Riders';

        private static $db = [
            'Title'         => 'Varchar',
            'FirstName'     => 'Varchar',
            'Surname'       => 'Varchar',
            'Grading'       => 'Varchar',
            'Age'           => 'Int',
            'Gender'        => 'Varchar',
        ];

        private static $has_one = [];

        private static $has_many = [];

        private static $belongs_many_many = [
            'Races'   => RaceObject::class,
        ];

        private static $summary_fields = [
            'Title'     => 'Rider Name',
            'Age'       => 'Age',
            'Grading'   => 'Grading'
        ];

        public function getCMSFields() {
            $fields = parent::getCMSFields();

            $fields->removeFieldsFromTab('Root.Main', ['Title']);

            $fields->addFieldsToTab('Root.Main', [
                TextField::create('FirstName', 'First Name'),
                TextField::create('Surname', 'Surname'),
                TextField::create('Grading', 'Grading'),
                TextField::create('Age', 'Age'),
                TextField::create('Gender', 'Gender')
            ]);

            return $fields;
        }

        public function onBeforeWrite()
        {
            $this->Title = $this->FirstName . ' ' . $this->Surname;

            parent::onBeforeWrite();
        }
    }
