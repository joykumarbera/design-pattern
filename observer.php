<?php

/**
 * a simple implementation of the observer pattern for dev
 */

interface SubjectInterface
{
    public function attachObserver( ObserverInterface $observer );

    public function notify();
}

interface ObserverInterface
{
    public function update( SubjectInterface $subject );
}


class SomeRegisterProcess implements SubjectInterface
{
    /**
     * var to store all observer
     * @var array
     */
    private $observer = array();

    /**
     * name of the user after register
     * @var string
     */
    public $name;

    /**
     * add an observer to the list
     */
    public function attachObserver( ObserverInterface $observer ) 
    {
        $this->observer [] = $observer;
    }

    /**
     * alert all observers when an event is whappen
     */
    public function notify() 
    {
        if ( !empty( $this->observer ) )
        {
            foreach( $this->observer as $listner )
            {
                $listner->update( $this );
            }
        }
    }

    /**
     * register an user
     */
    public function registerAnUser( $name )
    {
        $this->name = $name;
        // do some register process with database
        $this->notify();
    }

}

class EmailToAdmin implements ObserverInterface
{
    public function sendEmail( $name )
    {
        return 'send mail to admin for new user '. $name;
    }

    public function update( SubjectInterface $subject ) 
    {
        echo $this->sendEmail( $subject->name );
    }
}

class LogToFile implements ObserverInterface
{
    public function logSomeData( $data )
    {
        return 'log to the file for new user ' . $data;
    }

    public function update( SubjectInterface $subject ) 
    {
        echo $this->logSomeData( $subject->name );
    }
}

// application code 

// initiating observers
$observer_1 = new EmailToAdmin();
$observer_2 = new LogToFile();


$new_register = new SomeRegisterProcess();
$new_register->attachObserver( $observer_1 );
$new_register->attachObserver( $observer_2 );


$new_register->registerAnUser( 'developer' );

