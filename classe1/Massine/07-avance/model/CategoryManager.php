<?php
// création du namespace
namespace model;

use PDO;
use Exception;

// implémentation de 2 interfaces
class CategoryManager implements ManagerInterface, CrudInterface
{
    private PDO $db;

    // implémenté à cause de MangerInterface
    public function __construct(PDO $connect){
        $this->db = $connect;
    }

    use SlugifyTrait;

    public function create(AbstractMapping $data): bool|string
    {
        $sql = "INSERT INTO `category` (`category_name`, `category_slug`, `category_desc`) VALUES (?,?,?)";
        $prepare = $this->db->prepare($sql);
        try {
            $prepare->execute([
                $data->getCategoryName(),
                $data->getCategorySlug(),
                $data->getCategoryDesc(),
            ]);
            return true;
        }catch (Exception $e){
            return $e->getMessage();
        }

    }

    public function readById(int $id): bool|AbstractMapping
    {
        $sql = "SELECT * FROM `category` WHERE `id` = ?";
        $prepare = $this->db->prepare($sql);
        $prepare->bindValue(1,$id,PDO::PARAM_INT);
        try{
            $prepare->execute();

            if($prepare->rowCount()!==1)
                return false;

            $result = $prepare->fetch(PDO::FETCH_ASSOC);

            $category = new CategoryMapping($result);
            $prepare->closeCursor();
            return $category;

        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    // récupération de tous nos articles
    public function readAll($orderDesc=true): array
    {
        $sql = "SELECT * FROM `category` ";
        $query = $this->db->query($sql);
        $stmt = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($stmt as $item){
            
            // réutilisation des setters
            $result[] = new CategoryMapping($item);
        }
        $query->closeCursor();
        return $result;
    }

public function update(int $id, AbstractMapping $data): bool|string
{
    // on vérifie que l'id ($id = get et $data->getId() vient du POST) de la catégorie n'a pas été modifié par l'utilisateur
    if ($id != $data->getId())
        return "Pas bien de toucher à l'id !";
    // on peut faire l'update
    $sql = "UPDATE `category` SET 
                 `category_name`= :name,
                 `category_slug`= :slug,
                 `category_desc`= :desc
            WHERE `id` = :id;      
                 ";
    $prepare = $this->db->prepare($sql);
    $prepare->bindValue("id", $data->getId(), PDO::PARAM_INT);
    $prepare->bindValue("name", $data->getCategoryName());
    $prepare->bindValue("slug", $data->getCategorySlug());
    $prepare->bindValue("desc", $data->getCategoryDesc());
    try{
        $prepare->execute();
        return true;
    }catch (Exception $e){
        return $e->getMessage();
    }
}



    public function delete(int $id)
    {
        $sql = "DELETE FROM `category` WHERE `id`=?";
        $prepare = $this->db->prepare($sql);
        try{
            $prepare->execute([$id]);
            return true;
        }catch(Exception $e){
            return false;
        }
    }
}