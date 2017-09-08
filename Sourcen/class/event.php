<?
    include $_SERVER['DOCUMENT_ROOT'].'/vstp/database/databasehandler.php';

    class Event {

        const TABLE = 'Event';

        private $databaseHandler;

        private $id;
        public $name;
        public $description;
        
        public $date;
        public $length;

        public $currentParticipants;
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

            $this->date = $result[0]['date'];
            $this->length = $result[0]['length'];
            
            $this->currentParticipants = $result[0]['participants'];
            $this->maxParticipants = $result[0]['maxParticipants'];
            
            $this->eventManager = $result[0]['eventManager'];
            
        }

        function save() {

            $values = [
                new ColumnItem('name', $this->name),
                new ColumnItem('description', $this->description),
                new ColumnItem('date', $this->date),
                new ColumnItem('length', $this->length),
                new ColumnItem('participants', $this->currentParticipants),
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