<?php
class Articles
{
    public static function add($titel, $inhoud)
    {
        $sql = "INSERT INTO artikels SET titel = ?, inhoud = ?";

        try
        {
            $stmt = DB::getInstance()->prepare($sql);
            $stmt->execute([$titel, $inhoud]);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            die();
        }

        return true;
        
    }

    public static function update($id, $titel, $inhoud)
    {
        $sql = "UPDATE artikels SET titel = ?, inhoud = ? WHERE id = ?";

        try
        {
            $stmt = DB::getInstance()->prepare($sql);

            $stmt->bindParam(1, $titel, PDO::PARAM_STR);
            $stmt->bindParam(2, $inhoud, PDO::PARAM_STR);
            $stmt->bindParam(3, $id, PDO::PARAM_INT);
            
            $stmt->execute();
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            die();
        }

        return true;
        
    }

    public static function get()
    {
        return DB::query('select * from artikels');   
    }

    public static function getOne($id) 
    {
        $sql = "SELECT * FROM artikels where id = ?";

        try
        {
            $stmt = DB::getInstance()->prepare($sql);
            $stmt->execute([$id]);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            die();
        }

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function delete($id)
    {
        $sql = "DELETE FROM artikels where id = ?";

        try
        {
            $stmt = DB::getInstance()->prepare($sql);
            $stmt->execute([$id]);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            die();
        }

        return true;
    }
}