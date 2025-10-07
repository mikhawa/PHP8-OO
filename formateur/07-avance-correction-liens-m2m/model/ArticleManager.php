<?php
// création du namespace
namespace model;


use Exception;
use PDO;

// implémentation de 2 interfaces
class ArticleManager implements ManagerInterface, CrudInterface
{
    private PDO $db;


    // implémenté à cause de MangerInterface
    public function __construct(PDO $connect){
        $this->db = $connect;
    }

    // Appel du Trait pour slugifier le titre
    use TextTrait;

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
            // si on a coché des catégories
            if(isset($_POST['categ']) && is_array($_POST['categ']) && count($_POST['categ'])>0){
                // on récupère l'id de l'article inséré
                $lastId = $this->db->lastInsertId();
                // on prépare la requête d'insertion dans la table de liaison
                $sqlHas = "INSERT INTO `article_has_category` (`article_id`, `category_id`) VALUES (?,?)";
                $prepareHas = $this->db->prepare($sqlHas);

                // on boucle sur les catégories cochées
                foreach ($_POST['categ'] as $categId){
                    // on insère la liaison article - catégorie
                    $prepareHas->execute([$lastId,$categId]);
                }
            }
            return true;
        }catch (Exception $e){
            return $e->getMessage();
        }

    }


    public function readById(int $id): bool|AbstractMapping
    {
        $sql = "SELECT a.*,
                    GROUP_CONCAT(h.`category_id`) as category_id
                FROM `article` a
                    LEFT JOIN `article_has_category` h ON a.`id` = h.`article_id`
                WHERE a.`id` = ?
                GROUP BY a.`id` ";


        $prepare = $this->db->prepare($sql);
        $prepare->bindValue(1,$id,PDO::PARAM_INT);
        try{
            $prepare->execute();
            // si pas d'article récupéré
            if($prepare->rowCount()!==1)
                return false;
            // on a un article
            $result = $prepare->fetch(PDO::FETCH_ASSOC);
            // si on a des catégories
            if(!is_null($result['category_id'])){
                // on crée un tableau en divisant par les ','
                $categId = explode(',',$result['category_id']);
                $result['category'] = $categId;
            }
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
        $sql = "SELECT a.*, 
                    GROUP_CONCAT(c.`category_name` SEPARATOR '|||') as category_name,
                    GROUP_CONCAT(c.`category_slug`SEPARATOR '|||') as category_slug

                FROM `article` a
            
                LEFT JOIN `article_has_category` h
                    ON h.`article_id` = a.`id`
                
                LEFT JOIN `category` c    
                    ON h.`category_id` = c.`id`
                WHERE `article_slug` = ? AND `article_visibility`=1
                GROUP BY a.`id` ";
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
            // s'il y a une ou plusieurs catégories
            if(!is_null($result['category_name'])&&!is_null($result['category_slug'])){
                // création d'un tableau (1 entrée minimum)
                // en divisant par les SEPARATOR de MySQL
                $name = explode('|||',$result['category_name']);
                $slug = explode('|||',$result['category_slug']);
                // on compte le nombre de category
                $countCateg = count($name);
                // création du tableau de catégorie,
                $categList=[];
                // on va créer une boucle tant qu'on a des catégories
                for($i=0;$i<$countCateg;$i++){
                    $categName = $name[$i];
                    $categSlug = $slug[$i];
                    $categList[] = new CategoryMapping([
                        'category_name'=>$categName,
                        'category_slug'=>$categSlug
                    ]);
                }
                $article->setCategory($categList);
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
            // on supprime les anciennes catégories
            $sqlDel = "DELETE FROM `article_has_category` WHERE `article_id`=?";
            $prepareDel = $this->db->prepare($sqlDel);
            $prepareDel->execute([$id]);
            // si on a coché des catégories
            if(isset($_POST['categ']) && is_array($_POST['categ']) && count($_POST['categ'])>0){
                // on prépare la requête d'insertion dans la table de liaison
                $sqlHas = "INSERT INTO `article_has_category` (`article_id`, `category_id`) VALUES (?,?)";
                $prepareHas = $this->db->prepare($sqlHas);
                // on boucle sur les catégories cochées
                foreach ($_POST['categ'] as $categId){
                    // on insère la liaison article - catégorie
                    $prepareHas->execute([$id,$categId]);
                }
            }
            return true;
        }catch (Exception $e){
            return $e->getMessage();
        }
    }



    public function delete(int $id)
    {
        // on supprime l'article
        $sql = "DELETE FROM `article` WHERE `id`=?";
        $prepare = $this->db->prepare($sql);
        // on supprime les anciennes catégories (si pas de cascade delete)
        $sqlDel = "DELETE FROM `article_has_category` WHERE `article_id`=?";
        $prepareDel = $this->db->prepare($sqlDel);

        try{
            $prepareDel->execute([$id]);
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
        $sql = "
            SELECT a.`id`, a.`article_title`, a.`article_slug`, LEFT(a.`article_text`,250) AS `article_text`, a.`article_date`,
                   GROUP_CONCAT(c.`category_name` SEPARATOR 'µ|||µ') as category_name , 
                   GROUP_CONCAT(c.`category_slug`SEPARATOR 'µ|||µ') as category_slug

            FROM `article` a
            
                LEFT JOIN `article_has_category` h
                    ON h.`article_id` = a.`id`
                
                LEFT JOIN `category` c    
                    ON h.`category_id` = c.`id`
            
            WHERE a.`article_visibility`=1
            GROUP BY a.`id` ";


        if($orderDesc===true)
            $sql .= "ORDER BY a.`article_date` DESC";
        $query = $this->db->query($sql);
        $stmt = $query->fetchAll(PDO::FETCH_ASSOC);
        // si jamais pas d'articles, on a quand même un tableau
        $result=[];
        // tant qu'on a des articles
        foreach ($stmt as $item){

            // réutilisation des setters
            $result[] = new ArticleMapping($item);

            // s'il y a une ou plusieurs catégories
            if(!is_null($item['category_name'])&&!is_null($item['category_slug'])){

                // création d'un tableau (1 entrée minimum)
                // en divisant par les SEPARATOR de MySQL
                $name = explode('µ|||µ',$item['category_name']);
                $slug = explode('µ|||µ',$item['category_slug']);

                // on compte le nombre de category
                $countCateg = count($name);

                // création du tableau de catégorie,
                $categList=[];
                // on va créer une boucle tant qu'on a des catégories
                for($i=0;$i<$countCateg;$i++){
                    $categName = $name[$i];
                    $categSlug = $slug[$i];
                    $categList[] = new CategoryMapping([
                        'category_name'=>$categName,
                        'category_slug'=>$categSlug
                    ]);
                }
                $result[count($result)-1]->setCategory($categList);

            }
        }
        $query->closeCursor();
        return $result;
    }


    public function readAllVisibleByCategorySlug(string $slugCateg,bool $orderDesc = true): array
    {
        $sql = "
            SELECT a.`id`, a.`article_title`, a.`article_slug`, LEFT(a.`article_text`,250) AS `article_text`, a.`article_date`,
                   (
                   SELECT GROUP_CONCAT(ca.`category_name`,'|||', ca.`category_slug` SEPARATOR '---')
                   FROM `category` ca
                       INNER JOIN `article_has_category` ahc ON ahc.`category_id`=ca.`id` WHERE ahc.`article_id`=a.`id`
                    ) AS `categories`

            FROM `article` a
            
                LEFT JOIN `article_has_category` h
                    ON h.`article_id` = a.`id`
                
                LEFT JOIN `category` c    
                    ON h.`category_id` = c.`id`
            
            WHERE a.`article_visibility`=1 AND c.`category_slug` = ?
            GROUP BY a.`id` ";


        if($orderDesc===true)
            $sql .= "ORDER BY a.`article_date` DESC";
        $query = $this->db->prepare($sql);
        $query->execute([$slugCateg]);
        $stmt = $query->fetchAll(PDO::FETCH_ASSOC);
        // si jamais pas d'articles, on a quand même un tableau
        $result=[];
        // tant qu'on a des articles
        foreach ($stmt as $item){

            // réutilisation des setters
            $result[] = new ArticleMapping($item);

            // s'il y a une ou plusieurs catégories
            if(!is_null($item['categories'])){

                // création d'un tableau (1 entrée minimum)
                // en divisant par les SEPARATOR de MySQL
                $categs = explode('---',$item['categories']);
                // on crée 2 tableaux pour nom et slug
                $name = [];
                $slug = [];
                // on divise chaque entrée par '|||'
                foreach ($categs as $categ){
                    $parts = explode('|||',$categ);
                    $name[]=$parts[0];
                    $slug[]=$parts[1];
                }

                // on compte le nombre de category
                $countCateg = count($name);

                // création du tableau de catégorie,
                $categList=[];
                // on va créer une boucle tant qu'on a des catégories
                for($i=0;$i<$countCateg;$i++){
                    $categName = $name[$i];
                    $categSlug = $slug[$i];
                    $categList[] = new CategoryMapping([
                        'category_name'=>$categName,
                        'category_slug'=>$categSlug
                    ]);
                }
                $result[count($result)-1]->setCategory($categList);

            }
        }
        $query->closeCursor();
        return $result;
    }
}