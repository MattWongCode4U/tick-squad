<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends Application {

    public function index() {
        $this->data['pagetitle'] = ucfirst('history'); // Capitalize the first letter
	$this->load->helper('url');
        //default value of dropdown selection
	$value = $this->input->post("DropDownBox");
	if (is_null($value))
	    redirect('/history/stock/BOND');
	else
	    redirect('/history/stock/'.$value);

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
            
            $tblData .= '<tr>';
            $tblData .= '<td>'.$trans.'</td>';
            $tblData .= '<td>'.$quantity.'</td>';
            $tblData .= '<td>'.$date.'</td>';
            $tblData .= '</tr>';
        }
        // load the page content into data['content']
        $this->data['page'] = 'pages/history';
        $this->data['content'] = $tblData;
        
        $this->render();
    }

    public function stock($stock) {
        $this->data['pagetitle'] = ucfirst('history'); // Capitalize the first letter
	$trans = $this->transactions->details($stock);
	$tblData = '';
	foreach ($trans as $info) {
	    $date = $info->DateTime;
	    $player = $info->Stock;
	    $stock = $info->Stock;
	    $trans = $info->Trans;
	    $quantity = $info->Quantity;

	    $tblData .= '<tr>';
	    $tblData .= '<td>'.$trans.'</td>';
	    $tblData .= '<td>'.$quantity.'</td>';
	    $tblData .= '<td>'.$date.'</td>';
	    $tblData .= '</tr>';
	}

	$this->data['page'] = 'pages/history';
	$this->data['content'] = $tblData;

	$this->render();

    }
}

