<?php
namespace app\modules;

class Menu {
    protected $links;
    protected $currentUrl;

    protected static $menu = [
        ['name' => 'Главная', 'URL' => '/'],
        ['name' => 'Аутентификация', 'URL' => '/login'],
        ['name' => 'Регистрация', 'URL' => '/register'],
    ];

    public static function getMenu($currentURL) {
        $result = self::$menu; //глубокое копирование
        foreach ($result as &$elem) {
            if ($elem['URL'] === $currentURL)
                $elem['active'] = true;
            else
                $elem['active'] = false;
        }
        return $result;
    }
}
