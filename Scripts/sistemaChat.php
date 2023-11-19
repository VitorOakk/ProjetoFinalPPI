<?php



namespace Api\WebSocket;

session_start();

require __DIR__ . '/../vendor/autoload.php';
require 'conexao.php';
use Api\WebSocket\sistemaChat;
use Ratchet\ConnectionInterface;
use Ratchet\WebSocket\MessageComponentInterface;

class sistemaChat implements MessageComponentInterface{

    protected $cliente;

    public function __construct(){
        
        //Armazena os usuarios conectados
        $this->cliente = new \SplObjectStorage();
    }

    public function onOpen(ConnectionInterface $connection){
        //Adiciona cliente na lista
        $this->cliente->attach($connection);


        echo"Nova conexao: {$connection->resourceId}\n\n ";

    }

    public function onMessage(ConnectionInterface $from, $msg){
        $data = json_decode($msg);

        if ($data->type === "post") {


        // Transmita a mensagem com dados para todos os clientes
        foreach ($this->cliente as $cliente) {
            $cliente->send(json_encode([
                'type' => 'post',
                'content' => $data->content,
                'nome' => $data->nome,
                'sobrenome' => $data->sobrenome,
                'ID' => $data->id,
                'bio' => $data->bio,
            ]));
        }
        }
    }

    public function onClose(ConnectionInterface $connection){
        $this->cliente->detach($connection);
        echo "Usuario {$connection->resourceId} desconectou";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Erro: {$e->getMessage()}\n\n";
    }

    

}