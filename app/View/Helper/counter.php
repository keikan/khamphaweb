<?php
	/**
	*@ Counter Website static
	*@ Helper for CakePHP Framework
	*@ Author : NiceIT - contact : tuantinhoc@yahoo.com
	*
	* Prepair Data Model For Helper. Create db table with structure below
	* @ DB Table : counters => Model : Counter => file : Counter.php
	* @ Fields : 
	* @ => id - int, primary key auto_increment
	* @ => IP - varchar(20)
	* @ => time - varchar(11)
	* @ => date_visit (50)
	*/

    class CounterHelper extends HtmlHelper{

        //IP FROM USER
        private $IP;

        //User Online
        private $User_Online;

        //Total today
        private $Total_Today;

        //Total yesterday
        private $Total_Yesterday;

        //Total Previous Month
        private $Total_Mon_Prev;

        //Total This Month
        private $Total_Month;

        //Total Hits
        private $Total_Hits;

        //Timeout
        private $TimeOut;

        //Time now
        private $Time;

        //Init Model
        private $Model;

        function _constructDB(){

            /*
            *@ Init model for this helper
            */
            $counterDB = ClassRegistry::init('Counter');

            //Set model to class's variable
            $this->Model = $counterDB;

            /*
            *@ Set user IP and time out expired
            */
            $this->IP = $_SERVER['REMOTE_ADDR'];
            $this->TimeOut = 15;//Every 15 minutes update


            /*
            *@ Get now time and set it to class's variable
            */
            $time = getdate();
            $this->Time = $time;

            /*
            *@ Call Counter's functions
            */
            $this->UserRequest();
            $this->GetDetail();
            $this->ShowDetail();
        }


        //Call function for user request server
        private function UserRequest(){

            /*
            *@ If IP already set
            */
            $user = $this->Model->find("first", array(
                'conditions' => array('ip' => $this->IP),
                'order' => 'id DESC'
            ));
            if ( !empty($user) ){

                //Get log detail for this user in database


                //Get time
                $newTime = $this->Time['hours']*60 + $this->Time['minutes'];

                /*
                *@ If time larger than timeout, set new log
                */
                $temp = explode("/", $user['Counter']['date_visit']);
                if ( ( $newTime - $user['Counter']['time'] ) > $this->TimeOut || $temp[0] < $this->Time['mday'] || $temp[1] < $this->Time['mon']) {

                    //More than Timeout minutes since user visited
                    $this->data['ip'] = $this->IP;
                    $this->data['time'] = $this->Time['hours']*60 + $this->Time['minutes'];
                    $this->data['date_visit'] = $this->Time['mday'] . "/" . $this->Time['mon'] . "/" . $this->Time['year'];


                    //Store new log into database
                    $this->Model->create();
                    $this->Model->save($this->data);
                }
            }
            else{
                //Update new data to DB
                $this->data['ip'] = $this->IP;
                $this->data['time'] = $this->Time['hours']*60 + $this->Time['minutes'];
                $this->data['date_visit'] = $this->Time['mday'] . "/" . $this->Time['mon'] . "/" . $this->Time['year'];

                $this->Model->create();
                $this->Model->save($this->data);

            }
        }

        //Get detail log static for website
        private function GetDetail(){
            $data = $this->Model->find("all");
            $newTime = $this->Time['hours']*60 + $this->Time['minutes'];

            /*
            *@ Get detail static
            */

            //Set some temp variable to count

            $this_month = $this->Time['mon'];
            $this_date = $this->Time['mday'];

            //Set all to zero
            $this->User_Online = 0;
            $this->Total_Today = 0;
            $this->Total_Yesterday = 0;
            $this->Total_Mon_Prev = 0;
            $this->Total_Month = 0;

            //Start get detail
            foreach ( $data as $value ){
                $temp = explode ("/", $value['Counter']['date_visit']);
                if ( $temp[0] == $this->Time['mday'] && $temp[1] == $this->Time['mon'] ){
                    //Get user online
                    if ( $newTime - $value['Counter']['time'] < $this->TimeOut )
                        ++$this->User_Online;
                }

                if ( $this->Time['year'] == $temp[2] ){

                    //Get today static
                    if ( $this_date == $temp[0] )
                        ++$this->Total_Today;

                    //Get this month static
                    if ( $this_month == $temp['1'] )
                        ++$this->Total_Month;
                }

            }

            //For previous

            $prev_date = $this->Time['mday'] - 1;
            $prev_mon = $this->Time['mon'] - 1;

            if ( $prev_date < 1){
                $prev_date = 30;
                $prev_mon -= 1;
            }

            if ( $prev_mon < 1)
                $prev_mon = 12;

            foreach ($data as $value){
                $temp = explode ("/", $value['Counter']['date_visit']);

                if ( $this->Time['year'] == $temp[2] ){
                    if ( $prev_date == $temp[0] )
                        ++$this->Total_Yesterday;
                    if ( $prev_mon == $temp['1'] )
                        ++$this->Total_Mon_Prev;
                }
            }

            $this->Total_Hits = $this->Model->find("count");
        }

        //Show detail static for website
        private function ShowDetail(){
            echo $this->CounterStyle();
            echo "<div id='counter'>";
                echo "<div id='ip'>Your IP : " . $this->IP . "</div>";
                echo "<div id='online'>Online : " . $this->User_Online . "</div>";
                echo "<div id='today'>Today : " . $this->Total_Today . "</div>";
                echo "<div id='yesterday'>Yesterday : " . $this->Total_Yesterday . "</div>";
                echo "<div id='this_mon'>This month : " . $this->Total_Month . "</div>";
                /* echo "<div id='prev_mon'>Previous month : " . $this->Total_Mon_Prev . "</div>"; */
                echo "<div id='total'>Total hits : " . $this->Total_Hits . "</div>";               
            echo "</div>";
        }

        //Stand alone css style
        private function CounterStyle(){
            $css = "
                <style>
                    #counter{
                        font-size: 11px;
                        padding: 5px;
                        text-align: left;
                    }
                    #counter div{
                        padding-left: 20px;
                        margin-top: 4px;
                        margin-bottom: 4px;
                    }

                    #ip{
                        font-size: 12px;
                        font-weight: bold;
                        color: red;
                    }
                    #online{
                        background: url(/img/counter/online.png) no-repeat left center;
                    }
                    #today{
                        background: url(/img/counter/vtoday.png) no-repeat left center;
                    }
                    #yesterday{
                        background: url(/img/counter/vyesterday.png) no-repeat left center;
                    }
                    #this_mon{
                        background: url(/img/counter/mon.png) no-repeat left center;
                    }
                    #prev_mon{
                        background: url(/img/counter/prevmon.png) no-repeat left center;
                    }
                    #total{
                        background: url(/img/counter/total.png) no-repeat left center;
                    }
                </style>
            ";
            return $css;
        }
    }

?>