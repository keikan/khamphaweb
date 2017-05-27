<?php

/**
 * Created by PhpStorm.
 * User: keikan
 * Date: 5/20/17
 * Time: 9:21 AM
 */

App::uses('AppController', 'Controller');
class LinkController extends AppController
{

    public $uses = array('Link');

    public function index(){

//        $this->Counter->_constructDB();
        $listLink = $this->Link->find('all', [
            "limit"  => 10,
            "order" => "rand()"
        ]);

        $this->set('listLink',$listLink);
    }

    public function requestLink(){
        $id = rand(1,17148);
        $links = $this->Link->find('first', array(
            'conditions' => array('id' => $id)
        ));


        $this->Link->save(array(
            "id" => $id,
            "rank" => $links["Link"]['rank'] + 1,
        ));


        $this->redirect($links["Link"]['link']);

    }

    public function genLink(){
        $data = 'list_url.csv';
        $date = date('Y-m-d H:i:s');
        $i = 0;
        if (($handle = fopen($data, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
                echo $i."</br>";
                $i++;
                if(!empty($data[0])) {
                    $this->Link->create();
                    $this->Link->save(array(
                        "link" => $data[0],
                        "rank" => 0,
                        "created" => $date,
                        "visit" => 0,
                    ));
                }

            }
            echo 'thanh cong';
        } else {

            echo 'File could not be opened.';
        }

        fclose($handle);
        die;
    }

}