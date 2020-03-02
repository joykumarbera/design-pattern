<?php

/**
 * this is small implementation of the strategy pattern
 */


/**
 * this interface act like an mediator between two parties
 */
interface SomeStrategyInterface
{
    /**
     * this method should be implement by both parties
     * @param array $data expected input as an array 
     */
    public function someAlorithm( $data );
}


/**
 * this is the core class to implement the interface and some process business logic on that data 
 * 
 */
class StrategyOneinJson implements SomeStrategyInterface
{

    /**
     * this is some function to process the data
     * @param array $data
     * @return json
     */
    public function someAlorithm( $data )
    {
        if( !is_array( $data ) )
            throw new \Exception('is is not an array');
        if( empty( $data ) )
            throw new \Exception('is can\'t be empty');
        return json_encode( $data );
    }
}

/**
 * this is the core class to implement the interface and some process business logic on that data 
 * 
 */
class StrategyTwoinString implements SomeStrategyInterface
{
    /**
     * this is some function to process the data
     * @param array $data 
     * @return string
     */
    public function someAlorithm( $data )
    {
        if( !is_array( $data ) )
            throw new \Exception('is is not an array');
        if( empty( $data ) )
            throw new \Exception('is can\'t be empty');
        
        $output = '';
        foreach( $data as $val )
        {
            $output .= $val . ' ';
        }
        return $output;
    }
}

/**
 * this is client code to use the multiple strategy for proccess the data
 */
class SomeClientCode
{
    private $data;

    public function __construct( $data = array() )
    {
        $this->data = $data;
    }

    public function processData( SomeStrategyInterface $machine )
    {
        return $machine->someAlorithm( $this->data );
    }   
}

// application code 
$client = new SomeClientCode( array(
                                'dev',
                                'wants',
                                'more',
                                'code'
                            ) );

$after_process_1 = $client->processData( new StrategyOneinJson() );
$after_process_2 = $client->processData( new StrategyTwoinString() );

print_r($after_process_1);
print_r($after_process_2);