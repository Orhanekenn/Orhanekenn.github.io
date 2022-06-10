<?php 

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

header('Access-Control-Allow-Origin:*'); 
header('Access-Control-Allow-Headers:X-Request-With');

header('Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);
$app->setBasePath("/rent/public");

$app->get("/houses", function(Request $request, Response $response) {
    $sql = "SELECT * FROM sale_house";

    try{
        $db = new Db();
        $conn = $db->connect();

        $stmt = $conn->query($sql);
        $houses = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = null;
        $response->getBody()->write(json_encode($houses));
        return $response->withHeader("content-type", "application/json")->withStatus(200);

    } catch(PDOException $e) {
        
        $error = array(
            "message" => $e->getMessage()
        );

        $response->getBody()->write(json_encode($error));
        return $response->withHeader("content-type", "application/json")->withStatus(500);
        
    }
});

$app->get("/houses/{id}", function(Request $request, Response $response, array $args) {

    $id = $args['id'];
    $sql = "SELECT * FROM sale_house WHERE id=$id";

    try{
        $db = new Db();
        $conn = $db->connect();

        $stmt = $conn->query($sql);
        $house = $stmt->fetch(PDO::FETCH_OBJ);

        $db = null;
        $response->getBody()->write(json_encode($house));
        return $response->withHeader("content-type", "application/json")->withStatus(200);

    } catch(PDOException $e) {
        
        $error = array(
            "message" => $e->getMessage()
        );

        $response->getBody()->write(json_encode($error));
        return $response->withHeader("content-type", "application/json")->withStatus(500);
        
    }
});

$app->post("/houses", function(Request $request, Response $response) {
    $id = $request->getParam("id");
    $house_name = $request->getParam("house_name");
    $location = $request->getParam("location");
    $description = $request->getParam("description");
    $price = $request->getParam("price");
    $is_sold = $request->getParam("is_sold");
    
    $sql = "INSERT INTO sale_house (id, house_name, location, description, price, is_sold) VALUE (:id, :house_name, :location, :description, :price, :is_sold)";

    try{
        $db = new Db();
        $conn = $db->connect();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->bindParam("house_name", $house_name);
        $stmt->bindParam("location", $location);
        $stmt->bindParam("description", $description);
        $stmt->bindParam("price", $price);
        $stmt->bindParam("is_sold", $is_sold);

        $result = $stmt->execute();

        $db = null;
        $response->getBody()->write(json_encode($result));
        return $response->withHeader("content-type", "application/json")->withStatus(200);

    } catch(PDOException $e) {
        
        $error = array(
            "message" => $e->getMessage()
        );

        $response->getBody()->write(json_encode($error));
        return $response->withHeader("content-type", "application/json")->withStatus(500);
        
    }
});

$app->delete("/houses/{id}", function(Request $request, Response $response, array $args) {
    $id = $args["id"];
    
    $sql = "DELETE FROM sale_house WHERE id = $id";

    try{
        $db = new Db();
        $conn = $db->connect();

        $stmt = $conn->prepare($sql);

        $result = $stmt->execute();

        $db = null;
        $response->getBody()->write(json_encode($result));
        return $response->withHeader("content-type", "application/json")->withStatus(200);

    } catch(PDOException $e) {
        
        $error = array(
            "message" => $e->getMessage()
        );

        $response->getBody()->write(json_encode($error));
        return $response->withHeader("content-type", "application/json")->withStatus(500);
        
    }
});

$app->put("/houses/{id}", function(Request $request, Response $response) {
    $id = $request->getParam("id");
    $is_sold = $request->getParam("is_sold");
    
    $sql = "UPDATE sale_house SET id= :id, is_sold = :is_sold WHERE id = $id";

    try{
        $db = new Db();
        $conn = $db->connect();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->bindParam("is_sold", $is_sold);

        $result = $stmt->execute();

        $db = null;
        $response->getBody()->write(json_encode($result));
        return $response->withHeader("content-type", "application/json")->withStatus(200);

    } catch(PDOException $e) {
        
        $error = array(
            "message" => $e->getMessage()
        );

        $response->getBody()->write(json_encode($error));
        return $response->withHeader("content-type", "application/json")->withStatus(500);
        
    }
});

//RENTS

$app->get("/rents", function(Request $request, Response $response) {
    $sql = "SELECT * FROM rent_house";

    try{
        $db = new Db();
        $conn = $db->connect();

        $stmt = $conn->query($sql);
        $houses = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = null;
        $response->getBody()->write(json_encode($houses));
        return $response->withHeader("content-type", "application/json")->withStatus(200);

    } catch(PDOException $e) {
        
        $error = array(
            "message" => $e->getMessage()
        );

        $response->getBody()->write(json_encode($error));
        return $response->withHeader("content-type", "application/json")->withStatus(500);
        
    }
});

$app->get("/rents/{id}", function(Request $request, Response $response, array $args) {

    $id = $args['id'];
    $sql = "SELECT * FROM rent_house WHERE id=$id";

    try{
        $db = new Db();
        $conn = $db->connect();

        $stmt = $conn->query($sql);
        $house = $stmt->fetch(PDO::FETCH_OBJ);

        $db = null;
        $response->getBody()->write(json_encode($house));
        return $response->withHeader("content-type", "application/json")->withStatus(200);

    } catch(PDOException $e) {
        
        $error = array(
            "message" => $e->getMessage()
        );

        $response->getBody()->write(json_encode($error));
        return $response->withHeader("content-type", "application/json")->withStatus(500);
        
    }
});

$app->post("/rents", function(Request $request, Response $response) {
    $id = $request->getParam("id");
    $house_name = $request->getParam("house_name");
    $location = $request->getParam("location");
    $description = $request->getParam("description");
    $price = $request->getParam("price");
    $is_rented = $request->getParam("is_rented");
    
    $sql = "INSERT INTO rent_house (id, house_name, location, description, price, is_rented) VALUE (:id, :house_name, :location, :description, :price, :is_rented)";

    try{
        $db = new Db();
        $conn = $db->connect();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->bindParam("house_name", $house_name);
        $stmt->bindParam("location", $location);
        $stmt->bindParam("description", $description);
        $stmt->bindParam("price", $price);
        $stmt->bindParam("is_rented", $is_rented);

        $result = $stmt->execute();

        $db = null;
        $response->getBody()->write(json_encode($result));
        return $response->withHeader("content-type", "application/json")->withStatus(200);

    } catch(PDOException $e) {
        
        $error = array(
            "message" => $e->getMessage()
        );

        $response->getBody()->write(json_encode($error));
        return $response->withHeader("content-type", "application/json")->withStatus(500);
        
    }
});

$app->delete("/rents/{id}", function(Request $request, Response $response, array $args) {
    $id = $args["id"];
    
    $sql = "DELETE FROM rent_house WHERE id = $id";

    try{
        $db = new Db();
        $conn = $db->connect();

        $stmt = $conn->prepare($sql);

        $result = $stmt->execute();

        $db = null;
        $response->getBody()->write(json_encode($result));
        return $response->withHeader("content-type", "application/json")->withStatus(200);

    } catch(PDOException $e) {
        
        $error = array(
            "message" => $e->getMessage()
        );

        $response->getBody()->write(json_encode($error));
        return $response->withHeader("content-type", "application/json")->withStatus(500);
        
    }
});

$app->put("/rents/{id}", function(Request $request, Response $response) {
    $id = $request->getParam("id");
    $is_rented = $request->getParam("is_rented");
    
    $sql = "UPDATE rent_house SET id= :id, is_rented = :is_rented WHERE id = $id";

    try{
        $db = new Db();
        $conn = $db->connect();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->bindParam("is_rented", $is_rented);

        $result = $stmt->execute();

        $db = null;
        $response->getBody()->write(json_encode($result));
        return $response->withHeader("content-type", "application/json")->withStatus(200);

    } catch(PDOException $e) {
        
        $error = array(
            "message" => $e->getMessage()
        );

        $response->getBody()->write(json_encode($error));
        return $response->withHeader("content-type", "application/json")->withStatus(500);
        
    }
});

?>