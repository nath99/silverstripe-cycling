<?php

    use SilverStripe\ORM\DataObject;
    use SilverStripe\CMS\Model\SiteTree;
    use SilverStripe\Forms\TextField;
    use SilverStripe\Forms\TextareaField;
    use \SilverStripe\Forms\LiteralField;
    use SilverStripe\Forms\GridField\GridField;
    use SilverStripe\Forms\GridField\GridFieldAddNewButton;
    use SilverStripe\Forms\GridField\GridFieldDeleteAction;
    use SilverStripe\Forms\GridField\GridFieldDetailForm;
    use SilverStripe\Forms\GridField\GridFieldEditButton;
    use SilverStripe\Forms\GridField\GridFieldViewButton;
    use SilverStripe\Forms\GridField\GridFieldConfig_RecordViewer;
    use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

    use Symbiote\GridFieldExtensions\GridFieldAddExistingSearchButton;
    use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

    class RaceObject extends DataObject {
        private static $table_name = "race_objects";
        private static $singular_name = 'Race';
        private static $plural_name = 'Races';

        private static $db = [
            'URLSlug'   => 'Text',
            'Title'     => 'Text',
            'RaceDate'  => 'Datetime',
            'Address'   => 'Text',
            'Complete'  => 'Boolean'
        ];

        private static $has_one = [
            'Club'      => ClubObject::class
        ];

        private static $has_many = [];

        private static $many_many = [
            'Riders'    => RiderObject::class
        ];

        private static $many_many_extraFields = [
            'Riders'    => [
                'Position' => 'Int'
            ]
        ];

        public function getCMSFields() {
            $fields = parent::getCMSFields();

            $fields->removeFieldsFromTab('Root.Main', ['URLSlug']);
            $fields->removeFieldFromTab('Root.Riders', 'Riders');

            $fields->addFieldsToTab('Root.Main', [
                TextField::create('Title', 'Title'),
                TextareaField::create('Address', 'Address')
            ]);


            if($this->ID) {
                $ridersConf = GridFieldConfig_RecordEditor::create(20);
                $ridersConf->removeComponentsByType([
                    GridFieldViewButton::class,
                    GridFieldDetailForm::class,
                    GridFieldEditButton::class,
                    GridFieldDeleteAction::class,
                    GridFieldAddNewButton::class
                ]);
                $ridersConf->addComponent(new GridFieldDeleteAction(true));
                $ridersConf->addComponent(new GridFieldAddExistingSearchButton());
                $ridersConf->addComponent(new GridFieldOrderableRows('Position'));

                $fields->addFieldToTab('Root.Riders', GridField::create('Riders', 'Riders', $this->Riders(), $ridersConf)->setDescription('After race is completed, order of riders reflects their finishing position in the race.'));
            } else {
                $fields->addFieldToTab('Root.Riders', LiteralField::create('RidersNotice', '<h3>Please save the race before adding riders.</h3>'));
            }

            return $fields;
        }

        public function onBeforeWrite() {
            if(!$this->URLSlug)
                $this->URLSlug = SiteTree::create()->generateURLSegment($this->Title);

            parent::onBeforeWrite();
        }

        public function Link() {
            return \SilverStripe\Control\Director::BaseURL() . 'race/show/'. $this->URLSlug;
        }
    }
