<?php


namespace App\Models;

use App\Core\Model;

class Cours extends Model{
    protected $id;
    protected $titre;
    protected $description;
    protected $fichier;


    public function creer(){
        $rqt = "INSERT INTO cours(titre, desription, fichier) VALUES(:titre, :description, :fichier)";
        $res = $this->db->prepare($rqt);
        return $res->execute([
            ':titre' => $this->titre,
            ':description' => $this->description,
            ':fichier' => $this->fichier
        ]);
    }
    public function tous(){
        $res = $this->db->query("SELECT * FROM cours");
        return $res->fetchAll();
    }

    public function chercherId($id){
        $rqt = "SELECT * FROM cours WHERE cours_id = :id";
        $res = $this->db->prepare($rqt);
        $res->excute([':id' => $id]);
        return $res->fetch();
    }

    public function supprimer($id){
        $rqt = "DELETE FROM cours WHERE cours_id = :id";
        $res = $this->db->prepare($rqt);
        return $res->execute([':id' => $id]);
    }

    public function modifier($cours){
        $rqt = 'UPDATE cours SET titre = :titre, description = :description, fichier = :fichier WHERE cours_id = :id';
        return $res = $this->db->prepare([
            ':titre' => $cours['titre'],
            ':description' => $cours['description'],
            ':fichier' => $cours['fichier'],
        ]);
    }
}