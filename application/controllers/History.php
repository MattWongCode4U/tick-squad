<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends Application {

    public function index() {
        $data['title'] = ucfirst('history'); // Capitalize the first letter
        $this->load->view('templates/header', $data);
        $this->load->view('pages/history', $data);
        $this->load->view('templates/footer', $data);

        //default value of dropdown selection
        $value = 'BOND';
        if (isset($_POST['BTN'])) {
            $value = $_POST['DropDownBox'];
        }

        //debugging value of the current dropdown selection
        echo $value;

        //get value from dropdown
        $currentStock = $value;

        //get from the transactions table, 
        //all info that have Stock = thing from dropdown
        $trans = $this->transactions->details($currentStock);

        $transactions = array();
        $tblData = '';
        foreach ($trans as $info) {
            $date = $info->DateTime;
            $player = $info->Player;
            $stock = $info->Stock;
            $trans = $info->Trans;
            $quantity = $info->Quantity;
            
            $tblData += '<tr>';
            $tblData += '<td>'.$trans.'</td>';
            $tblData += '<td>'.$quantity.'</td>';
            $tblData += '<td>'.$date.'</td>';
            $tblData += '</tr>';
        }

        $this->data['transactions'] = $tblData;
        
        $this->render();

    }
}

