<?php

namespace Sistr;

defined('SISTR') or die("Accès interdit");

use F3il\Field;
use F3il\Form;

/**
 * Classe UtilisateurForm
 */
class NoteForm extends Form {

    /**
     * Constructeur par defaut de la classe
     * @param type $action
     */
    public function __construct($action) {
        parent::__construct($action, 'note-form');

        $this->addFormField(new \F3il\Field('titre', 'Titre', NULL, TRUE));
        $this->addFormField(new \F3il\Field('text', 'Text', NULL, TRUE));
    }




}
