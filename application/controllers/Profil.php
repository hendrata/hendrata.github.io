<?php
	/*
    @Copyright Indra Rukmana
    @Class Name : Profil(Front)
	*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {
	
	// Main Page Profile
	public function index() {

		$site  		= $this->mConfig->list_config();
		$gallery    = $this->mGalleries->listGalleryPubProfile();
		$blogs		= $this->mBlogs->listBlogsPub();
		
		$data = array(	'title'		=> 'Profil - '.$site['nameweb'],
						'site'		=> $site,
						'gallery'	=> $gallery,
						'blogs'		=> $blogs,
						'isi'		=> 'front/profile/list');
		$this->load->view('front/layout/wrapper',$data);
	}

	// List Clients
	public function klien() {

		$site  		= $this->mConfig->list_config();
		$blogs 		= $this->mBlogs->listLastBlogsPub();
		$gallery    = $this->mGalleries->listGalleryPubProfile();		
		$clients	= $this->mClients->listClients();
		
		$data = array(	'title'		=> 'Daftar Klien - '.$site['nameweb'],
						'site'		=> $site,
						'clients'	=> $clients,
						'gallery'	=> $gallery,
						'blogs'		=> $blogs,
						'isi'		=> 'front/profile/klien');
		$this->load->view('front/layout/wrapper',$data);
	}

	// List Price
	public function harga() {

		$site  		= $this->mConfig->list_config();
		$blogs 		= $this->mBlogs->listBlogsPub();
		$gallery    = $this->mGalleries->listGalleryPubPrice();				

		// Pagination
		$this->load->library('pagination');
		$config['base_url'] 		= base_url().'profil/harga/';
		$config['total_rows'] 		= count($this->mPrice->totalPrice());
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] 		= 5;
		$config['uri_segment'] 		= 3;
		$config['per_page'] 		= 10;
		$config['first_url'] 		= base_url().'profil/harga/';
		$this->pagination->initialize($config); 
		$page 		= ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) * $config['per_page'] : 0;
		$price 		= $this->mPrice->perPagePrice($config['per_page'], $page);
		// End Pagination				
		
		$data = array(	'title'		=> 'Daftar Harga - '.$site['nameweb'],
						'site'		=> $site,
						'price'		=> $price,
						'blogs'		=> $blogs,
						'gallery'	=> $gallery,
						'pagin' 	=> $this->pagination->create_links(),																		
						'isi'		=> 'front/profile/harga');
		$this->load->view('front/layout/wrapper',$data);
	}		
}