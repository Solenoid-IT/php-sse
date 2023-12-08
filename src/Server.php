<?php



namespace Solenoid\SSE;



class Server
{
    private int $lifetime;



    # Returns [self]
    public function __construct (int $lifetime = 0)
    {
        // (Getting the value)
        $this->lifetime = $lifetime;
    }

    # Returns [Server]
    public static function create (int $lifetime = 0)
    {
        // Returning the value
        return new Server( $lifetime );
    }



    # Returns [void]
    public function start (callable $event_handler)
    {
        // (Setting the headers)
        header('Content-Type: text/event-stream;');
        header('Cache-Control: no-cache, no-store;');
        header('Connection: keep-alive;');



        // (Getting the value)
        $start_timestamp = time();

        while ( true )
        {// Processing each clock
            if ( $this->lifetime > 0 && time() - $start_timestamp >= $this->lifetime )
            {// (Lifetime has been terminated)
                // Breaking the iteration
                break;
            }



            // (Calling the function)
            $event = $event_handler();

            if ( $event )
            {// Value found
                // (Sending the event)
                Server::send( $event );
            }



            if ( connection_aborted() )
            {// (Connection has been aborted)
                // Breaking the iteration
                break;
            }
        }
    }



    # Returns [void]
    public static function send (Event $event)
    {
        // Printing the value
        echo $event . str_repeat( ' ', 64 * 1024 );

        // (Flushing the output buffer)
        ob_end_flush();
        flush();
    }
}



?>