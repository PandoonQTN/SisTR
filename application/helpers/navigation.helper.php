<?php

namespace Sistr;

defined('SISTR') or die('Acces interdit');

abstract class NavigationHelper {

    private static $menu = array(
        array(
            'title' => 'Sujet',
            'controller' => 'sujet',
            'action' => 'lister'
        ), array(
            'title' => 'Suivi',
            'controller' => 'suivi',
            'action' => 'lister'
        ), array(
            'title' => 'Utilisateur',
            'controller' => 'utilisateur',
            'action' => 'lister'
        ),
    );

    public static function render() {
        $app = \F3il\Application::getInstance();
        $tab = $app->getCurrentLocation();
        ?><ul class="nav navbar-nav">
        <?php
        foreach (self::$menu as $m) {
            self::itemRender($m, $tab);
        }
        ?>
        </ul>
        <?php
    }

    private static function itemRender($item, $location) {
        ?>
        <li<?php
            if ($location['controller'] === $item['controller'] && $location['action'] === $item['action']) {
                ?> class="active" <?php }
            ?> >
            <a href="index.php?controller=<?php echo $item['controller']; ?>&action=<?php echo $item['action']; ?>"><?php echo $item['title'] ?></a>
        </li>
        <?php
    }

}
