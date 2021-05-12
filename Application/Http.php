<?php

namespace Application;

class Http
{
    public function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit();
    }
    
    /**
     * Renvoie vrai si la requête a été faite en post (envoi de formulaire par exemple)
     * 
     * @return bool
     */
    public function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
    
    public function sendJson(array $data): void
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
}