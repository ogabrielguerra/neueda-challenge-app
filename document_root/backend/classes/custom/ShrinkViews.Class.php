<?
class ShrinkViews extends AutoObj{

    public $Ao;
    private $tableTarget;

    function __construct(){
        $this->tableTarget = 'shrink_views';
        parent::__construct($this->tableTarget);
        $this->Ao = new AutoObj($this->tableTarget);
    }

}

?>
