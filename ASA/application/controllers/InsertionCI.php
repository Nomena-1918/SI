<?php 
// security
    defined('BASEPATH') OR exit('No direct script access allowed');
// --- 
    class InsertionCI extends CI_Controller{
        
        
        public function index(){
            $this->load->view("person");
        }

        public function process(){
            $stat = $_POST['status'];
            echo $stat;
            if( $stat == 'DIR'){
                $this->all_model->insertDT( $_POST['namelead'],$_POST['adress'],$_POST['phone'],$_POST['email']);
                redirect("IndexCI");
            }
            else if( $stat == 'SOCIETE'){

                $this->all_model->insertINFO($_POST['nom'],$_POST['objet'],$_POST['capital'],$_POST['dg'],$_POST['creation'],$_POST['siege'],$_POST['emptotal'],$_POST['datedebut'],$_POST['devisetenu']);
                //bouclena ny devis izay tsy null ihany no inserena amle societe
                $all_devise = $this->all_model->get_all_("devise");
                $idsociete = $this->all_model->get_lastId_from_("societe");
                foreach($all_devise as $dev){
                    $devise_choix = "dev_".$dev['id'];
                    if(isset($_POST[$devise_choix])){
                        if($idsociete!=""){
                            echo $_POST[$devise_choix];
                            $this->all_model->insertDeviseReference($idsociete,$_POST[$devise_choix]);
                        }
                    }
                }
                redirect("IndexCI");
            }
        }

        public function updatejrn(){
            $id = $_POST['id'];
            $code = $_POST['code'];
            $intitule = $_POST['intitule'];
            $this->all_model->upadate_journal($id, $code, $intitule);
        }

        public function insertionjrn(){
            $code = $_POST['code'];
            $intitule = $_POST['intitule'];
            $this->all_model->insert_journal($code, $intitule);
        }
        
    }
?>