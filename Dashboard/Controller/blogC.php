<?php
set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__DIR__));
require 'config.php';

class blogC
{

    public function listblogs()
    {
        $sql = "SELECT * FROM blog";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteblog($ide)
    {
        $sql = "DELETE FROM blog WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addblog($blog)
    {
        $sql = "INSERT INTO blog(title, user, date, contenu, idUser)
        VALUES (:title, :usn, STR_TO_DATE(:date, '%d/%m/%Y'), :contenu, :idUser)";
    
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'title' => $blog->gettitle(),
                'usn' => $blog->getuser(),
                'date' => $blog->getdate(),
                'contenu' => $blog->getcontenu(),
                'idUser' => $_SESSION['idUser'] // Include idUser from session
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    


    function showblog($id)
    {
        $sql = "SELECT * from blog where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $blog = $query->fetch();
            return $blog;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateblog($blog, $id)
    {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare(
                'UPDATE blog SET 
                    title = :title,
                    user = :user, 
                    date = :date, 
                    contenu = :contenu
                WHERE id = :idblog '
            );
    
            // Convert the date format from "dd/mm/yyyy" to "yyyy-mm-dd" for MySQL
            $dateFormatted = date_format(date_create_from_format('d/m/Y', $blog->getdate()), 'Y-m-d');
    
            $query->execute([
                'idblog' => $id,
                'title' => $blog->gettitle(),
                'user' => $blog->getuser(),
                'date' => $dateFormatted, // Use the formatted date
                'contenu' => $blog->getcontenu()
            ]);
    
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error updating blog: " . $e->getMessage();
        }
    }
    
    
    function getbytitle($title) {
        $sql = "SELECT * from blog where title = :title";
        $db = config::getConnexion();
        try {
          $query = $db->prepare($sql);
          $query->execute([
            ':title' => $title
          ]);
    
          $admin = $query->fetch();
          return $admin;
        } catch (Exception $e) {
          die('Error: '. $e->getMessage());
        }
      }

      function getbyid($id) {
        $sql = "SELECT * from blog where id = :id";
        $db = config::getConnexion();
        try {
          $query = $db->prepare($sql);
          $query->execute([
            ':id' => $id
          ]);
    
          $admin = $query->fetch();
          return $admin;
        } catch (Exception $e) {
          die('Error: '. $e->getMessage());
        }
      }
      public function searchBlogs($search, $search_type) {
        $db = config::getConnexion();
        $sql = "";
        $searchParam = '%' . $search . '%'; // Add wildcards for partial matching
    
        // Construct the SQL query based on the search type
        switch ($search_type) {
            case 'title':
                $sql = "SELECT * FROM blog WHERE title LIKE :search";
                break;
            case 'date':
                $sql = "SELECT * FROM blog WHERE date LIKE :search";
                break;
            case 'user':
                $sql = "SELECT * FROM blog WHERE user LIKE :search";
                break;
            case 'content': // Added case for content search
                $sql = "SELECT * FROM blog WHERE  contenu LIKE :search";
                break;
            default:
                echo "<script>alert('Missing information. Please try another one.');</script>";
                return null; // Return null or handle error as needed
                break;
        }
    
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':search', $searchParam, PDO::PARAM_STR);
            $query->execute();
            $searchResults = $query->fetchAll(PDO::FETCH_ASSOC);
            return $searchResults;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function trieSearchTitles($search) {
        $sql = "SELECT * FROM blog WHERE title LIKE :search ORDER BY title ASC"; // Alphabetical order
        $db = config::getConnexion();
        $searchParam = '%' . $search . '%'; // Add wildcards for partial matching
    
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':search', $searchParam, PDO::PARAM_STR);
            $query->execute();
            $searchResults = $query->fetchAll(PDO::FETCH_ASSOC);
            return $searchResults;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    public function trieSearchDates($search) {
        $sql = "SELECT * FROM blog WHERE date LIKE :search ORDER BY date DESC"; // Most recent first
        $db = config::getConnexion();
        $searchParam = '%' . $search . '%'; // Add wildcards for partial matching
    
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':search', $searchParam, PDO::PARAM_STR);
            $query->execute();
            $searchResults = $query->fetchAll(PDO::FETCH_ASSOC);
            return $searchResults;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function getBlogsPaginated($page , $itemsPerPage )
{
    $offset = ($page - 1) * $itemsPerPage;
    $sql = "SELECT * FROM blog LIMIT :offset, :itemsPerPage";

    $db = config::getConnexion();

    try {
        $query = $db->prepare($sql);
        $query->bindValue(':offset', $offset, PDO::PARAM_INT);
        $query->bindValue(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
        $query->execute();
        $blogs = $query->fetchAll(PDO::FETCH_ASSOC);
        return $blogs;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
function countAllBlogs()
    {
        $sql = "SELECT COUNT(*) as total FROM blog";
        $db = config::getConnexion();
        try {
            $result = $db->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            return $row['total'];
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
}

class commentsC
{


    public function listcomments($idg)
    {
    $sql = "SELECT * FROM comments WHERE blog = :id";
    $db = config::getConnexion();
    $req = $db->prepare($sql);
    $req->bindValue(':id', $idg);
    try {
        $req->execute(); // Execute the prepared statement
        $liste = $req->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows as associative array
        return $liste;
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
    }


    function deletecomments($ide)
    {
        $sql = "DELETE FROM comments WHERE id_comment = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);

        try {
            $req->execute(); // Execute the prepared statement
            $liste = $req->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows as associative array
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }



    // Other methods...

    function addComments($comments)
    {
        $sql = "INSERT INTO comments(content, date, user, blog, idUser)
                VALUES (:content, STR_TO_DATE(:date, '%d/%m/%Y'), :usn, :blog, :idUser)";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'content' => $comments->getcontent(),
                'date' => $comments->getdate(),
                'usn' => $comments->getuser(),
                'blog' => $comments->getblog(),
                'idUser' => $comments->getIdUser() // Assuming getIdUser() is a method in comments class
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Other methods...




    function showcomments($id)
    {
        $sql = "SELECT * from comments where id_comment = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $comments = $query->fetch();
            return $comments;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updatecomments($comments, $id)
{
    try {
        $db = config::getConnexion();
        $query = $db->prepare(
            'UPDATE comments SET 
                content = :content,
                date = :date, 
                user = :user, 
                blog = :blog
            WHERE id_comment = :idcomments'
        );

        // Convert the date format from "dd/mm/yyyy" to "yyyy-mm-dd" for MySQL
        $dateFormatted = date_format(date_create_from_format('d/m/Y', $comments->getdate()), 'Y-m-d');

        $query->execute([
            'idcomments' => $id,
            'content' => $comments->getcontent(),
            'date' => $dateFormatted, // Use the formatted date
            'user' => $comments->getuser(),
            'blog' => $comments->getblog()
        ]);

        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo "Error updating comments: " . $e->getMessage();
    }
}

    function getbycontent($content) {
        $sql = "SELECT * from comments where content = :content";
        $db = config::getConnexion();
        try {
          $query = $db->prepare($sql);
          $query->execute([
            ':content' => $content
          ]);
    
          $admin = $query->fetch();
          return $admin;
        } catch (Exception $e) {
          die('Error: '. $e->getMessage());
        }
      }

      function getbyid($id) {
        $sql = "SELECT * from comments where id = :id";
        $db = config::getConnexion();
        try {
          $query = $db->prepare($sql);
          $query->execute([
            ':id' => $id
          ]);
    
          $admin = $query->fetch();
          return $admin;
        } catch (Exception $e) {
          die('Error: '. $e->getMessage());
        }
      }
      public function searchCommentsByBlogID($blogid, $search_query, $search_type)
      {
          $db = config::getConnexion();
          $sql = "";
          $searchParam = '%' . $search_query . '%'; // Add wildcards for partial matching
      
          // Construct the SQL query based on the search type
          switch ($search_type) {
              case 'date':
                  $sql = "SELECT * FROM comments WHERE blog = :blogid AND date LIKE :search";
                  break;
              case 'user':
                  $sql = "SELECT * FROM comments WHERE blog = :blogid AND user LIKE :search";
                  break;
              case 'content': // Added case for content search
                  $sql = "SELECT * FROM comments WHERE blog = :blogid AND content LIKE :search";
                  break;
              default:
                  echo "<script>alert('Missing information. Please try another one.');</script>";
                  break;
          }
      
          $req = $db->prepare($sql);
          $req->bindValue(':blogid', $blogid);
          $req->bindValue(':search', $searchParam, PDO::PARAM_STR);
          try {
              $req->execute(); // Execute the prepared statement
              $liste = $req->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows as associative array
              return $liste;
          } catch (Exception $e) {
              die('Error:' . $e->getMessage());
          }
      }
      
      public function getCommentsPaginated($blogid, $page, $itemsPerPage)
      {
        $offset = ($page - 1) * $itemsPerPage;

        $db = config::getConnexion();
    
        try {
            $sql = "SELECT * FROM comments WHERE blog = :blogid LIMIT :offset, :itemsPerPage";
            $query = $db->prepare($sql);
            $query->bindValue(':blogid', $blogid);
            $query->bindValue(':offset', $offset, PDO::PARAM_INT);
            $query->bindValue(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
            $query->execute();
            $comments = $query->fetchAll(PDO::FETCH_ASSOC);
            return $comments;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

      
}
