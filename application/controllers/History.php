<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends Application {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    /*
        Initially called on the controller name being passed in
        
        Loads in the title of the page
        Sets up the dropdown menu for a selection of the stock's history
        Gets all the transactions from the currently specified stock
        Loads in table rows for the stock. * Will be fixed properly later
    */
    public function index() {
        $this->data['pagetitle'] = ucfirst('history'); // Capitalize the first letter
        $this->data['page'] = 'pages/history/history';
        $this->data['searchbar'] = $this->populatesearchbar();
        $this->data['content'] = $this->getall();
        $this->render();
    }

    public function populatesearchbar()
    {
        $result ='';
        $stocks = $this->stocks->get_stocks();
        foreach ($stocks->result() as $stock)
        {
            $result .= $this->parser->parse('pages/history/searchoption',
                (array) $stock, true);
        }
        $data['selectdata'] = $result;
        $data['searchby'] = 'Stock';
        return $this->parser->parse('pages/history/select', $data, true);
    }

    public function getall()
    {
        $result = '';
        $stocks = $this->transactions->get_transactions();
        foreach ($stocks->result() as $stock)
        {
            $result .= $this->parser->parse('pages/history/stock_row',
                (array) $stock, true);
        }
        $data['rows'] = $result;
        return $this->parser->parse('pages/history/stocks_table', $data, true);
    }

    /*
        Calls the stock function when history/stock/GOLD is in the URL and passes in GOLD to the defautl index function
    */
    public function stock() {
        $this->data['pagetitle'] = ucfirst('history'); // Capitalize the first letter
        $result = '';
        $trans = $this->transactions->get_trans($this->input->post('search'));
        foreach ($trans->result() as $info)
        {
            $result .= $this->parser->parse('/pages/history/stock_row', (array) $info, true);
        }
        $data['rows'] = $result;
        $this->data['page'] = 'pages/history/history';
        $this->data['searchbar'] = $this->populatesearchbar();
        $this->data['content'] = $this->parser->parse('pages/history/stocks_table', $data, true);
        $this->render();
    }
}

