<?php 

// dans cette classe View, on régit toutes les vues disponible et on renvoie l'utilisateur sur la vue en question en appliquant un template contenant le header et le footer
// dans le template, la variable $description contient tout le script d'une vue et le met dans le template à l'endroit ou est situé $description
// la méthode generatePDF() est différente car elle fait appel à un deuxième template contenant seulement le contenu de la vue et non le header ni le footer car les pdf
// ne peuvent pas être mélanger à du html sinon une erreur s'afficherai
class View{
    private $_file;
    private $_t;

    public function __construct($action)
    {
        $this->_file='views/view'.$action.'.php';

    }

    public function generate($data){
        $content = $this->generateFile($this->_file, $data);

        $view = $this->generateFile('views/template.php', array(
        't' => $this->_t,
        'description' => $content));

        echo $view;
    }

    public function generatePDF($data){
        $content = $this->generateFile($this->_file, $data);

        $view = $this->generateFile('views/templatePDF.php', array(
        'description' => $content));

        echo $view;
    }

    private function generateFile($file,$data){
        if (file_exists($file)) {
            extract($data);
            ob_start();
            require $file;
            return ob_get_clean();
        }
        else{
            throw new Exception('Fichier '.$file.' introuvable');
        }
    }
}
