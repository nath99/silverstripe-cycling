<?php

    use SilverStripe\ORM\DataList;
    use SilverStripe\Control\HTTPRequest;

    class ListPageController extends PageController {
        private static $allowed_actions = ['show'];
        private static $url_handlers = [
            'race/show/$Slug'    => 'show',
        ];

        protected function init() {
            parent::init();
        }

        public function show(HTTPRequest $request)
        {
            $race = RaceObject::get()->filter(['URLSlug' => $request->param('Slug')])->first();

            if (!$race) {
                return $this->httpError(404, 'There is no race matching that ID: '. $request->param('Slug'));
            } else {

                return array(
                    'Title' => $race->Title,
                    'Race' => $race
                );
            }
        }

        public function getUpcomingRaces(): DataList
        {
            return RaceObject::get()->filter(['Complete' => false]);
        }

        public function getCompletedRaces(): DataList
        {
            return RaceObject::get()->filter(['Complete' => true]);
        }
    }
