<?
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/database/databasehandler.php';

    class Event {

        const TABLE = 'Event';

        private $databaseHandler;

        public $id;
        public $name;
        public $description;
        
        public $length;
        public $maxParticipants;

        public $eventManager;

        function __construct($id = NULL) {

            $this->databaseHandler = new PDOHandler();

            if($id != NULL) {
                $this->load($id);
            }
        }

        function load($id) {
            $result = $this->databaseHandler->select(self::TABLE, 'eventId = '.$id);
            
            $this->id = $result[0]['eventId'];
            $this->name = $result[0]['name'];
            $this->description = $result[0]['description'];
            
            $this->length = $result[0]['length'];
            
            $this->maxParticipants = $result[0]['maxParticipants'];
            $this->eventManager = $result[0]['eventManager'];
            
        }

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
    }

?>