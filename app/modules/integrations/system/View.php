<?php
class ModuleView extends View
{
    public function contentPart()
    {
        switch (ACTION) {
            default:
                echo $this->Content();
                break;
        }
    }
}

/* End of file */