<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index()
    {
        $this->load->view('homeview');    
    }

    public function cart()
    {
        $this->load->view('cartview');        
    }

    public function checkout()
    {
        $this->load->view('checkoutview');
        
    }

}

/* End of file Home.php */

?>