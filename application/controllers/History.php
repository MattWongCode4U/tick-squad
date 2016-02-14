<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
            $data['title'] = ucfirst('history'); // Capitalize the first letter
            $this->load->view('templates/header', $data);
            $this->load->view('pages/history');
            $this->load->view('templates/footer', $data);
            
            $dom = new DOMDocument();
            $dom->LoadHTML("pages/history.php");
            
            $select = $dom->getElementById('stock-select');
            $stocks = '<option value="BOND">Bond</option>'.
                        '<option value="GOLD">Gold</option>'.
                        '<option value="GRAN">Grain</option>'.
                        '<option value="IND">Industrial</option>'.
                        '<option vlaue="OIL">Oil</option>'.
                        '<option value="TECH">Tech</option>';
            
            $select->innertext = $stocks;
            
            //get value from dropdown
            $currentStock = ;
            
            //get from the transactions table, 
            //all info that have Stock = thing from dropdown
            $trans = $this->transactions->some('Stock', $currentStock);
            
            $transactions = array();
            foreach($trans as $info){
                $this1 = array(
                    'DateTime' => $info->DateTime,
                    'Player' => $info->Player,
                    'Stock' => $info->Stock,
                    'Trans' => $info->Trans,
                    'Quantity' => $info->Quantity
                );
                $transactions[] = $this1;
            }
            
            $this->data['transactions'] = $transactions;
            
            $this->render();
	}
}
