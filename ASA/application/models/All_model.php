<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class All_model extends CI_Model {
        
        public function insertDT($nm,$add,$phone,$mail){
            $request = "insert into person(namelead,addres,phone,mail) values(%s , %s, %s, %s)";
            $request  = sprintf($request,$this->db->escape($nm),$this->db->escape($add),$this->db->escape($phone),$this->db->escape($mail));
            $status = $this->db->query($request);
            return $status;
        }

        public function insertINFO($nom,$obj,$capital,$dg,$creation,$adress,$nbemp,$datedebut,$devis_tenu){
            $request = "insert into societe(soc_name,soc_objet,capital,dirigeantID,soc_creationdate,soc_adresse,soc_emptotal,datedebut,devise_tenu_compte)
                        values 
                        (%s,%s,%s,%s,%s,%s,%s,%s,%s)";
            $request  = sprintf($request,
            $this->db->escape($nom),$this->db->escape($obj),
            $this->db->escape($capital),$this->db->escape($dg),$this->db->escape($creation),
            $this->db->escape($adress),$this->db->escape($nbemp),
            $this->db->escape($datedebut),
            $this->db->escape($devis_tenu));
            $status = $this->db->query($request);
            return $status;
        }

        public function insertDeviseReference($idsociete,$devis_tenu){
            $request = "insert into S_devisereference(idsociete,idref_devise) values 
            (%s,%s)";
            $request = sprintf($request,$this->db->escape($idsociete),$this->db->escape($devis_tenu));
            $status = $this->db->query($request);
            return $status;
        }
        public function insertDetailScan($idsociete,$type,$num,$scanpdf){
            $request = "insert into S_detailscan(idsociete,idtype,numero,scanpdf) values 
            ('%s,%s,%s,%s')";
            $request = sprintf($request,$this->db->escape($idsociete),$this->db->escape($type),$this->db->escape($num),$this->db->escape($scanpdf));
            $status = $this->db->query($request);
            return $status;
        }  
        public function insertPhoneList($idsociete,$phone){
            $request = "insert into S_phonelist(idsociete,phonenumber) values 
            ('%s,%s')";
            $request = sprintf($request,$this->db->escape($idsociete),$this->db->escape($phone));
            $status = $this->db->query($request);
            return $status;
        }
        public function insertEmailList($idsociete,$mail){
            $request = "insert into S_emaiList(idsociete,email) values 
            ('%s,%s')";
            $request = sprintf($request,$this->db->escape($idsociete),$this->db->escape($mail));
            $status = $this->db->query($request);
            return $status;
        }

        public function get_all_($nom_table){
            $tab = array();
            $str = "select * from %s";
            $str = sprintf($str, $nom_table);
            $request = $this->db->query($str);
            foreach( $request->result_array() as $row ){
                array_push($tab,$row);
            }
            // var_dump($tab);
            return $tab;
        }

        public function get_lastId_from_($nom_table){
            $request = 'select * from %s order by id desc limit 1';
            $request = sprintf($request, $nom_table);
            $request = $this->db->query($request);
            $linedata = $request->row_array();
            return $linedata['id'];
        }
        
        public function import_Files(){
            $fp = fopen('test.txt', 'r');
            $content = fgets($fp,255);
            fclose($fp);
            echo 'Notre contenue '.$contenu_du_fichier;
        } 
        
        public function import_Csv(){
            $fp = fopen('test.txt', 'r');
            if ($fp !== false){
                $csv_data =[];

                while(($data =  fgetcsv($fp, 1000, ",")) !== false ){
                    $csv_data[] = $data;
                }

                fclose($fp);
                
                foreach($csv_data as $row){
                    echo implode(",", $row). "</br>";
                }
            }else{
                echo "Error lors du chargement";
            }
        }

        public function upadate_journal($id, $new_code, $new_title){
            $request = "update journaux set code=%s, intitule=%s where id=%s"; 
            $request = sprintf($request,$this->db->escape($new_code),$this->db->escape($new_title),$this->db->escape($id));
            $status = $this->db->query($request);
            return $status;
        }

        public function insert_journal($code, $title){
            // $request = "insert into journaux(code,intitule) values ('%s , %s')"; 
            // $request = sprintf($request,$this->db->escape($code),$this->db->escape($title));
            // $status = $this->db->query($request);
            $id_last_ = $this->get_lastId_from_("journaux");
            $my_id = array(
                "id" => $id_last_,
                "code" => $code,
                "intitule" => $title
            );
            // return $status;
            echo json_encode($my_id);
        }

        
    }
        

?>