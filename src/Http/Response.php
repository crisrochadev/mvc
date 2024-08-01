<?php
namespace Src\Http;

class Response
{
    private int $statusCode;
    private $content; // Tipo de dado alterado para mixed para suportar string ou array
    private array $headers = []; // Inicializa como array vazio

    public function __construct(int $statusCode = 200, $content = '', array $headers = [])
    {
        $this->statusCode = $statusCode;
        $this->setContent($content);
        $this->headers = $headers;
    }

    /**
     * Define o código de status HTTP.
     *
     * @param int $statusCode
     * @return self
     */
    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * Define o conteúdo da resposta. Aceita string ou array.
     *
     * @param string|array $content
     * @return self
     */
    public function setContent($content): self
    {
        if (is_array($content)) {
            // Converte o array para JSON
            $this->content = json_encode($content);
            // Define o tipo de conteúdo para JSON
            $this->addHeader('Content-Type', 'application/json');
        } else if (is_string($content)) {
            $this->content = $content;
            // Define o tipo de conteúdo para texto, caso não esteja definido
            if (!array_key_exists('Content-Type', $this->headers)) {
                $this->addHeader('Content-Type', 'text/plain');
            }
        } else {
            throw new \InvalidArgumentException('O conteúdo deve ser uma string ou um array.');
        }
        return $this;
    }

    /**
     * Adiciona um cabeçalho à resposta.
     *
     * @param string $name
     * @param string $value
     * @return self
     */
    public function addHeader(string $name, string $value): self
    {
        $this->headers[$name] = $value;
        return $this;
    }

    /**
     * Envia a resposta para o cliente.
     *
     * @return void
     */
    public function send(): void
    {
        // Define os cabeçalhos HTTP
        http_response_code($this->statusCode);
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }

        // Envia o conteúdo
        echo $this->content;
    }
}
