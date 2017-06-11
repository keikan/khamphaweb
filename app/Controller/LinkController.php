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

    public $uses = array('Link', 'Subdomain');

    public function index(){

//        $this->Counter->_constructDB();
        $listLink = $this->Subdomain->find('all', array(
            "limit"  => 10,
            "order" => "rand()"
        ));

        $this->set('listLink',$listLink);
    }

    public function requestLink(){
        $links = "";
        for($i = 0; $i < 100 ; $i ++) {
            $id = rand(2, 120501);
            $links = $this->Subdomain->find('first', array(
                'conditions' => array('id' => $id)
            ));
            if(strlen($links["Subdomain"]['link']) > 0)
                break;
        }

        $this->Subdomain->save(array(
            "id" => $id,
            "visit" => $links["Subdomain"]["visit"] + 1,
        ));


        $this->redirect($links["Subdomain"]['link']);

    }

    public function requestLinkList(){
        $paramLink = $this->request->query('link');
        $paramID = $this->request->query('id');


        $links = $this->Subdomain->find('first', array(
            'conditions' => array('id' => $paramID)
        ));

        pr($links);
        $this->Subdomain->save(array(
            "id" => $paramID,
            "visit" => $links["Subdomain"]["visit"] + 1,
        ));


        $this->redirect($paramLink);

    }

    public function genLink(){

        $data = "text_demo.txt";
        $date = date('Y-m-d H:i:s');
        $i = 0;

        $rs = file_get_contents($data);
        pr($rs);
        if (($handle = fopen($data, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
                $data = utf8_encode($data);
                echo "</br>". $data[0];
                $i++;
                if ($i == 10 )
                    break;
                if(!empty($data[0])) {
                    $this->Subdomain->create();
                    $this->Subdomain->save(array(
                        "link" => $data[0],
//                        "title" => $data[1],
//                        "description" => $data[2],
//                        "keyword" => $data[3],
//                        "linkref" => $data[4],
//                        "rank" => 0,
//                        "created" => $date,
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

    public function genLinkFromExcel(){
        App::import('Vendor', 'PHPExcel/PHPExcel/IOFactory');
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 3000);
        $objPHPExcel = PHPExcel_IOFactory::load(WWW_ROOT . 'LINKVN.xlsx');
        $numPage = 138499;
        $date = date('Y-m-d H:i:s');

        for($i = 1; $i < $numPage; $i++){
            $link = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getValue();
            $title = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getValue();
            $des = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getValue();
            $key = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getValue();
            $ref = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getValue();
            $lang = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getValue();
            if(strlen($key) == 0)
                $key = "";
            if(strlen($title) == 0)
                $title = "";
            if(strlen($des) == 0)
                $des = "";
            if(strlen($ref) == 0)
                $ref = "";
            if(strlen($lang) == 0)
                $lang = "";

            if(strlen($link) > 0) {
                $this->Subdomain->create();
                $this->Subdomain->save(array(
                    "link" => $link,
                    "title" => $title,
                    "description" => $des,
                    "keyword" => $key,
                    "linkref" => $ref,
                    "language" => $lang,
                    "rank" => 0,
                    "created" => $date,
                    "visit" => 0,
                ));
            }

        }
        echo 'Thanh cong';
        die;

    }

}