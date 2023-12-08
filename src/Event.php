<?php



namespace Solenoid\SSE;



class Event
{
    public string $type;
    public string $data;



    # Returns [self]
    public function __construct (string $type, string $data)
    {
        // (Getting the values)
        $this->type = $type;
        $this->data = $data;
    }

    # Returns [Event]
    public static function create (string $type, string $data)
    {
        // Returning the value
        return new Event( $type, $data );
    }



    # Returns [string]
    public function to_string ()
    {
        // Returning the value
        return "event: $this->type\ndata: $this->data\n\n";
    }



    # Returns [string]
    public function __toString ()
    {
        // Returning the value
        return $this->to_string();
    }
}



?>