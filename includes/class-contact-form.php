<?php

class ContactForm
{
    public $database;
    public $name;
    public $email;
    public $message;

    public function __construct( $name = '', $email = '', $message = '' )
    {
        $this->database = new Database();

        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }

    /**
     * Submit form
     */
    public function submit()
    {

        // Only change code below this line 
             
            $error = 0;
            // instruction: check if all the fields are not empty
            if(empty($this->name)||empty($this->email)||empty($this->message)){
                $error++;
                return ['message'=>'All fields are required !','status'=>'fail'];
            }

            // instruction: check if email is valid
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL))
            {
                $error++;
              return ['message'=>'Invalid email format !','status'=>'fail'];
            }else if(strlen($this->message)<10)
            {
                $error++;
                return ['message'=>'Message should be at least 10 characters !','status'=>'fail'];
            }

            // instruction: if all the fields are valid, insert the data into database
            if($error==0){
                
                $statement=$this->database->__construct()->prepare("INSERT INTO contact_form (name,email,message) VALUES (:name,:email,:message)");
                $statement->execute([
                    'name' => $this->name,
                    'email' => $this->email,
                    'message' => $this->message
                ]);
                
                // instruction: return status=success if the data is inserted into database
                
                 return [
                   'message'=>'Thanks for your message ! We will get right back to you.',
                   'status'=>'success'
                ];
             }


        // Only change code above this line

    }

    /**
     * [bonus point] Send message to admin email via SMTP API (postmark, mailgun, etc.)
     */
    public function sendMessage()
    {   
        // Only change code below this line 

            // instruction: send email to admin email via SMTP API (postmark, mailgun, etc.)

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_USERPWD, 'api:');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($curl, CURLOPT_URL, 
              'https://api.mailgun.net/v3/mailgun.org/messages');
            curl_setopt($curl, CURLOPT_POSTFIELDS, 
                array('from' => $this->name.' <'.$this->email.'>',
                      'to' => 'name <abc123@gmail.com>',
                      'subject' => 'New Message',
                      'text' => $this->message ));
            $response = curl_exec($curl);
            $error = curl_error($curl);

            curl_close($curl);

            if($error)
                return 'API not working';

            return $response;


            // instruction: return status=success if the email is sent
            

        // Only change code above this line
    }

}