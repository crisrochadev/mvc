<?php
namespace Src\Controllers;

class Controller
{
    private static $layout = null;
    private static $layoutData = [];


    /**
     * Define o layout a ser utilizado (método estático).
     *
     * @param string $layout Nome do layout (sem extensão)
     * @param array $array Dados a serem passados para o layout
     */
    public static function layout($layout, $array = [])
    {
        self::$layout = $layout;
        self::$layoutData = $array;
    }

    /**
     * Renderiza a view. Se um layout estiver definido, a view será renderizada dentro do layout.
     *
     * @param string $view Nome da view (sem extensão)
     * @param array $array Dados a serem passados para a view
     */
    public static function view($view, $array = [])
    {
        extract($array);


        ob_start();
        include __DIR__ . '/../../resources/views/' . $view . '.php';
        $content = ob_get_clean();

        if (self::$layout) {
            extract(self::$layoutData);
            ob_start();
            include __DIR__ . '/../../resources/layouts/' . self::$layout . '.php';
            return ob_get_clean();
        }

        $response = new \Src\Http\Response();
        $response->setStatusCode(200)
            ->setContent($content)->send();
    }

    public static function send($content, $status = 200)
    {
        $response = new \Src\Http\Response();
        $response->setStatusCode($status)
            ->setContent($content)->send();
    }
    public static function error()
    {
        self::layout('main');
        return self::view('error');
    }
}
