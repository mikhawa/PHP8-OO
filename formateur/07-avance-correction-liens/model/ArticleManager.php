<?php
// création du namespace
namespace model;

use PDO;
use Exception;

// implémentation de 2 interfaces
class ArticleManager implements ManagerInterface, CrudInterface
{
    private PDO $db;


    // implémenté à cause de MangerInterface
    public function __construct(PDO $connect){
        $this->db = $connect;
    }

    // Appel du Trait pour slugifier le titre
    use SlugifyTrait;

    /*
     * méthodes implémentées à cause de CrudInterface
     * AbstractMapping est le parent de tous nos
     * mapping, c'est-à-dire données où on applique un CRUD
     * dans notre cas une bdd MySQL
     */
    public function create(AbstractMapping $data): bool|string
    {
        $sql = "INSERT INTO `article` (`article_title`, `article_slug`, `article_text`, `article_visibility`) VALUES (?,?,?,?)";
        $prepare = $this->db->prepare($sql);
        try {
            $prepare->execute([
                $data->getArticleTitle(),
                $data->getArticleSlug(),
                $data->getArticleText(),
                $data->getArticleVisibility()
            ]);
            return true;
        }catch (Exception $e){
            return $e->getMessage();
        }

    }

    public function readById(int $id): bool|AbstractMapping
    {
        $sql = "SELECT * FROM `article` WHERE `id` = ?";
        $prepare = $this->db->prepare($sql);
        $prepare->bindValue(1,$id,PDO::PARAM_INT);
        try{
            $prepare->execute();
            // si pas d'article récupéré
            if($prepare->rowCount()!==1)
                return false;
            // on a un article
            $result = $prepare->fetch(PDO::FETCH_ASSOC);
            // création de l'instance de type ArticleMapping
            $article = new ArticleMapping($result);
            $prepare->closeCursor();
            return $article;

        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function readBySlug(string $slug): bool|AbstractMapping
    {
        $sql = "SELECT a.*, GROUP_CONCAT(c.`category_name` SEPARATOR '|||') AS `category_name`, 
                       GROUP_CONCAT(c.`category_slug` SEPARATOR '|||') AS `category_slug`
                FROM `article` a
                LEFT JOIN `article_has_category` h 
                    ON a.`id`=h.`article_id`
                LEFT JOIN `category` c
                    ON h.`category_id`=c.`id` 
                WHERE a.`article_slug` = ? AND `article_visibility`=1";
        $prepare = $this->db->prepare($sql);
        $prepare->bindValue(1,$slug);
        try{
            $prepare->execute();
            // si pas d'article récupéré
            if($prepare->rowCount()!==1)
                return false;
            // on a un article
            $result = $prepare->fetch(PDO::FETCH_ASSOC);
            // création de l'instance de type ArticleMapping
            $article = new ArticleMapping($result);
            // on a les catégories dans l'article
            if(!is_null($result['category_name'])){
                $names = explode("|||",$result['category_name']);
                $slugs = explode("|||",$result['category_slug']);
                $categories = [];
                for($i=0; $i<count($names); $i++){
                    $categories[] = new CategoryMapping([
                        "category_name"=>$names[$i],
                        "category_slug"=>$slugs[$i]
                    ]);
                }
                $article->setCategory($categories);
            }
            $prepare->closeCursor();
            return $article;

        }catch(Exception $e){
            die($e->getMessage());
        }

    }

    // récupération de tous nos articles
    public function readAll(bool $orderDesc = true): array
    {
        $sql = "SELECT * FROM `article` ";
        if($orderDesc===true)
            $sql .= "ORDER BY `article_date` DESC";
        $query = $this->db->query($sql);
        $stmt = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($stmt as $item){
            // réutilisation des setters
            $result[] = new ArticleMapping($item);
        }
        $query->closeCursor();
        return $result;
    }

    public function update(int $id, AbstractMapping $data): bool|string
    {
        // on vérifie que l'id ($id = get et $data->getId() vient du POST) de l'article n'a pas été modifié par l'utilisateur
        if ($id != $data->getId())
            return "Pas bien de toucher à l'id !";
        // on peut faire l'update
        $sql = "UPDATE `article` SET 
                     `article_title`= :title,
                     `article_slug`= :slug,
                     `article_text`= :text,
                     `article_date` = :datea,
                     `article_visibility` = :visibility
                WHERE `id` = :id;      
                     ";
        $prepare = $this->db->prepare($sql);
        $prepare->bindValue("id", $data->getId(), PDO::PARAM_INT);
        $prepare->bindValue("title", $data->getArticleTitle());
        $prepare->bindValue("slug", $data->getArticleSlug());
        $prepare->bindValue("datea", $data->getArticleDate());
        $prepare->bindValue("text", $data->getArticleText());
        $prepare->bindValue("visibility", $data->getArticleVisibility(), PDO::PARAM_INT);
        try{
            $prepare->execute();
            return true;
        }catch (Exception $e){
            return $e->getMessage();
        }
    }



    public function delete(int $id)
    {
        $sql = "DELETE FROM `article` WHERE `id`=?";
        $prepare = $this->db->prepare($sql);
        try{
            $prepare->execute([$id]);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    /*
     * Nos méthodes n'existant pas dans l'interface
     */

    // on souhaite ne récupérer que les articles visibles
    // pour la page d'accueil
    public function readAllVisible(bool $orderDesc = true): array
    {
        $sql = "SELECT a.`id`, a.`article_title`, a.`article_slug`, LEFT(a.`article_text`,250) AS `article_text`, a.`article_date`,
                 GROUP_CONCAT(c.`category_name` SEPARATOR '|||') AS `category_name`, GROUP_CONCAT(c.`category_slug` SEPARATOR '|||') AS `category_slug`
                    FROM `article` a
                    LEFT JOIN `article_has_category` h 
                        ON a.`id`=h.`article_id`
                    LEFT JOIN `category` c
                        ON h.`category_id`=c.`id`
                    WHERE a.`article_visibility`=1 
                    GROUP BY a.`id`";
        if($orderDesc===true)
            $sql .= "ORDER BY `article_date` DESC";
        $query = $this->db->query($sql);
        $stmt = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($stmt as $item){
            // réutilisation des setters
            $result[] = new ArticleMapping($item);
            // on a les catégories dans l'article
            if(!is_null($item['category_name']) && !is_null($item['category_slug'])){
                $names = explode("|||",$item['category_name']);
                $slugs = explode("|||",$item['category_slug']);
                $categories = [];
                for($i=0; $i<count($names); $i++){
                    $categories[] = new CategoryMapping([
                        "category_name"=>$names[$i],
                        "category_slug"=>$slugs[$i]
                    ]);
                }
                $result[count($result)-1]->setCategory($categories);
            }
        }
        $query->closeCursor();
        return $result;
    }
    // on souhaite récupérer tous les articles d'une catégorie
    public function readAllByCategorySlug(string $slug, bool $orderDesc = true): array|bool
    {
        $sql = "SELECT a.`id`, a.`article_title`, a.`article_slug`, LEFT(a.`article_text`,250) AS `article_text`, a.`article_date`,
                 GROUP_CONCAT(c.`category_name` SEPARATOR '|||') AS `category_name`, GROUP_CONCAT(c.`category_slug` SEPARATOR '|||') AS `category_slug`
                    FROM `article` a
                    LEFT JOIN `article_has_category` h 
                        ON a.`id`=h.`article_id`
                    LEFT JOIN `category` c
                        ON h.`category_id`=c.`id`
                    WHERE a.`article_visibility`=1 AND c.`category_slug`=?
                    GROUP BY a.`id`";
        if ($orderDesc === true)
            $sql .= "ORDER BY `article_date` DESC";
        $prepare = $this->db->prepare($sql);
        $prepare->bindValue(1, $slug);
        try {
            $prepare->execute();
            // si pas d'article récupéré
            if ($prepare->rowCount() === 0)
                return false;
            $stmt = $prepare->fetchAll(PDO::FETCH_ASSOC);
            foreach ($stmt as $item) {
                // réutilisation des setters
                $result[] = new ArticleMapping($item);
                // on a les catégories dans l'article
                if (!is_null($item['category_name']) && !is_null($item['category_slug'])) {
                    $names = explode("|||", $item['category_name']);
                    $slugs = explode("|||", $item['category_slug']);
                    $categories = [];
                    for ($i = 0; $i < count($names); $i++) {
                        $categories[] = new CategoryMapping([
                            "category_name" => $names[$i],
                            "category_slug" => $slugs[$i]
                        ]);
                    }

                }
                $result[count($result) - 1]->setCategory($categories);
            }
            $prepare->closeCursor();
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}