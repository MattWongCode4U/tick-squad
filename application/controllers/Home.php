<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
	public function index()	{
            $data['title'] = ucfirst('home'); // Capitalize the first letter
	    $this->data['players-panel'] = $this->players_panel();
            $this->load->view('templates/header', $data);
            $this->load->view('pages/home');
            $this->load->view('templates/footer', $data);
	}
	
	public function players_panel() {
	    $result = '';
	    $players = $this->Players_Model->get_players();

	    foreach ($players->result() as $row) {
		$result .= $this->parser->parse('home/player_row', (array) $row, true);
	    }

    	    $data['rows'] = $result;

	    return $this->parser->parse('home/players_table', $data, true);
	}
}
