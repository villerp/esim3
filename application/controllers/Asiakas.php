<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asiakas extends CI_Controller {

public function listaa () {
	$this->load->model('asiakas_model');
	$data['asiakkaat']=$this->asiakas_model->getAsiakas();
	$data['sivun_sisalto']='asiakas/listaa';
	$this->load->view('menu/sisalto', $data);
}
public function lisaa() {
	$btn=$this->input->post('btnTallenna');
	$lisaa_asiakas=array(
		"etunimi"=>$this->input->post('en'),
		"sukunimi"=>$this->input->post('sn'),
		"email"=>$this->input->post('em')
		);
	$this->load->model('asiakas_model');
	if(isset($btn)) {


	$lisays=$this->asiakas_model->addAsiakas($lisaa_asiakas);
	if($lisays>0) {
		echo '<script>alert("Lisäys onnistui")</script>';
	}
	}
	$data['sivun_sisalto']='asiakas/lisaa';
	$this->load->view('menu/sisalto', $data);
}
public function nayta_poistettavat() {
	$this->load->model('asiakas_model');
	$data['asiakkaat']=$this->asiakas_model->getAsiakas();
	$data['sivun_sisalto']='asiakas/poista';
	$this->load->view('menu/sisalto', $data);
}
public function poista($id) {
	$this->load->model('asiakas_model');
	$poista=$this->asiakas_model->delAsiakas($id);
	if($poista>0) {
		echo '<script>alert("Poisto onnistui")</script>';
	}
	$data['asiakkaat']=$this->asiakas_model->getAsiakas();
	$data['sivun_sisalto']='asiakas/listaa';
	$this->load->view('menu/sisalto', $data);
}
public function etsi_tilaus() {
	$id=$this->input->post('valittu_id');
	$btn=$this->input->post('btnEtsi');
	$this->load->model('asiakas_model');
	$this->load->model('Tilaus_model');
	$data['asiakkaat']=$this->asiakas_model->getAsiakas();
	if(isset($btn)){
		$data['tilaus']=$this->Tilaus_model->searchTilaus($id);
	}
	$data['sivun_sisalto']='asiakas/etsi_tilaus';
	$this->load->view('menu/sisalto', $data);
}
}