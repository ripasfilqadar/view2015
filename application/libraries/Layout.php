<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Layout
{
	function __construct() {
		$this->ci = &get_instance();
	}

	function render($url, $data=NULL) {
		$this->ci->load->view('include/default_header', $data);
		$this->ci->load->view($url, $data);
		$this->ci->load->view('include/default_footer', $data);
	}
}
?>