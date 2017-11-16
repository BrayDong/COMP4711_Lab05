<?php

/**
 * CSV-persisted collection.
 * 
 * @author		JLP
 * @copyright           Copyright (c) 2010-2017, James L. Parry
 * ------------------------------------------------------------------------
 */
class XML_Model extends Memory_Model
{
//---------------------------------------------------------------------------
//  Housekeeping methods
//---------------------------------------------------------------------------

	/**
	 * Constructor.
	 * @param string $origin Filename of the CSV file
	 * @param string $keyfield  Name of the primary key field
	 * @param string $entity	Entity name meaningful to the persistence
	 */
	function __construct($origin = null, $keyfield = 'id', $entity = null)
	{
		parent::__construct();

		// guess at persistent name if not specified
		if ($origin == null)
			$this->_origin = get_class($this);
		else
			$this->_origin = $origin;

		// remember the other constructor fields
		$this->_keyfield = $keyfield;
		$this->_entity = $entity;

		// start with an empty collection
		$this->_data = array(); // an array of objects
		$this->fields = array(); // an array of strings
		// and populate the collection
		$this->load();
	}


    static function arrayToObject($array) {
        if (!is_array($array)) {
            return $array;
        }

        $object = new stdClass();
        if (is_array($array) && count($array) > 0) {
            foreach ($array as $name=>$value) {
                $name = strtolower(trim($name));
                if (!empty($name)) {
                    $object->$name = XML_Model::arrayToObject($value);
                }
            }
            return $object;
        }
        else {
            return FALSE;
        }
    }

	/**
	 * Load the collection state appropriately, depending on persistence choice.
	 * OVER-RIDE THIS METHOD in persistence choice implementations
	 */
	protected function load()
	{

        $data = simplexml_load_string(file_get_contents($this->_origin));



        $data = json_decode(json_encode((array)$data), TRUE);

        //$this

        $this->_data = [];


        $firstKey = array_keys($data)[0];

        //print_r($data[$firstKey]);
        //echo "<br><br>";

        foreach($data[$firstKey] AS $element) {


            //var_dump(self::arrayToObject($element));

            $this->_fields = array_keys($element);


            $this->_data[@$element['id']] = self::arrayToObject($element);

        }

        //print_r($this->_data);

        //$this->_data = $data;



        //---------------------
//		if (($handle = fopen($this->_origin, "r")) !== FALSE)
//		{


//			$first = true;
//			while (($data = fgetcsv($handle)) !== FALSE)
//			{
//				if ($first)
//				{
//					// populate field names from first row
//					$this->_fields = $data;
//					$first = false;
//				}
//				else
//				{
//					// build object from a row
//					$record = new stdClass();
//					for ($i = 0; $i < count($this->_fields); $i ++ )
//						$record->{$this->_fields[$i]} = $data[$i];
//					$key = $record->{$this->_keyfield};
//					$this->_data[$key] = $record;
//				}
//			}


			//fclose($handle);
		//}
		// --------------------
		// rebuild the keys table
		$this->reindex();
	}

	/**
	 * Store the collection state appropriately, depending on persistence choice.
	 * OVER-RIDE THIS METHOD in persistence choice implementations
	 */
	protected function store()
	{
		// rebuild the keys table
		$this->reindex();

		//throw new Exception("Not yet implemented!");
				//---------------------

        $domDoc = new DOMDocument;
        $rootElt = $domDoc->createElement('items');
        $rootNode = $domDoc->appendChild($rootElt);

        foreach($this->_data AS $row) {
            $rowElement = $domDoc->createElement('item');

            foreach($row AS $key => $value) {

                $element = $domDoc->createElement($key);
                $element->appendChild($domDoc->createTextNode($value));

                $rowElement->appendChild($element);
            }
            $rootNode->appendChild($rowElement);

        }

        $data = $domDoc->saveXML();

        var_dump($data);

        file_put_contents($this->_origin, $data);

		// --------------------
	}

}
