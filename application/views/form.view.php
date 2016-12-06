<?php

namespace Sistr;

defined('SISTR') or die("Accès interdit");
$this->setPageTitle("Form");
?> 

<h2>Form Test</h2>


<?php
    $this->form->render();
?>
<pre>
<?php
    print_r($this->form);
?>
</pre>