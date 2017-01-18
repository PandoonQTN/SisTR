<?php
namespace F3il;
defined('F3IL') or die('Acces interdit');

/**
 * Classe HttpHelper 
 */
abstract class HttpHelper {
    
    /**
     * Fonction permettant de rediriger vers une page 
     * @param type $url : url de la page
     */
    public static function redirect($url) {
        if(!headers_sent()):
            header('Location: '.$url);
        else:
            ?>
            <script type="text/javascript">
                window.location = "<?php echo $url;?>";
            </script>
            <?php
        endif;
    }
}