<?php
    include_once __DIR__ . '/../database/databaseHandler.php';

    /**
     * Class Event
     */
    class Event {

        const TABLE = 'Event';

        private $databaseHandler;

        public $id;
        public $name;
        public $description;
        
        public $length;
        public $maxParticipants;

        public $eventManager;

        /**
         * Event constructor.
         * @param null $id
         */
        function __construct($id = NULL) {

            $this->databaseHandler = new PDOHandler();

            if($id != NULL) {
                $this->load($id);
            }
        }

        /**
         * @param $id
         */
        function load($id) {
            $result = $this->databaseHandler->select(self::TABLE, 'eventId = '.$id);
            
            $this->id = $result[0]['eventId'];
            $this->name = $result[0]['name'];
            $this->description = $result[0]['description'];
            
            $this->length = $result[0]['length'];
            
            $this->maxParticipants = $result[0]['maxParticipants'];
            $this->eventManager = $result[0]['eventManager'];
            
        }

        /**
         * Save event
         * @return bool
         */
        function save() {

            $values = [
                new ColumnItem('name', $this->name),
                new ColumnItem('description', $this->description),
                new ColumnItem('length', $this->length),
                new ColumnItem('maxParticipants', $this->maxParticipants),
                new ColumnItem('eventManager', $this->eventManager)
            ];

            if($this->id == NULL) {
                // new event
                return $this->databaseHandler->insert(self::TABLE, $values);
            } else {
                // update
                return $this->databaseHandler->update(self::TABLE, $values, 'eventId = '.$this->id);
            }
        }

        /**
         * Delete event
         */
        function delete() {
            $where = 'eventId = '.$this->id;
            if($this->databaseHandler->delete(self::TABLE, $where)) {
                $this->id = NULL;
                $this->name = NULL;
                $this->description = NULL;
                $this->length = NULL;
                $this->maxParticipants = NULL;
                $this->eventManager = NULL;
            }
        }
    }

?>